<?php

class GamesModel extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->client = new couchClient ('http://localhost:5984','tictactoe');
	}
	
	function register($gameId) {
		
		$this->load->helper('utility');
		
		$client = $this->client;
		
		$gameDoc = new stdClass();
		$gameDoc->_id = $gameId;
		$gameDoc->idMoveDoc = generateRandomId();
		
		try {

			$response = $client->storeDoc($gameDoc);
			
			$moveDoc = new stdClass();
			$moveDoc->_id = $gameDoc->idMoveDoc;
			$moveDoc->move = 'PLAYER_1';
			$moveDoc->movesCounter = '1';
			
			$response = $client->storeDoc($moveDoc);
			
		} catch (Exception $e) {
			
			echo "ERROR: ".$e->getMessage()." (".$e->getCode().")<br>\n";
			
		}
	}	
	
	function unregister($gameId) {
		
		$client = $this->client;
		
		try {
			$gameDoc = $client->getDoc($gameId);
			$moveDoc = $client->getDoc($gameDoc->idMoveDoc);
		} catch (Exception $e) {
			echo "ERROR: ".$e->getMessage()." (".$e->getCode().")<br>\n";
		}
		
		try {
			$client->deleteDoc($gameDoc);
			$client->deleteDoc($moveDoc);
		} catch (Exception $e) {
			echo "ERROR: ".$e->getMessage()." (".$e->getCode().")<br>\n";
		}		
		
	}
	
	function register_move($gameId, $playerId) {
		
		$client = $this->client;
		
		try {
			$gameDoc = $client->getDoc($gameId);
		} catch (Exception $e) {
			echo "ERROR: ".$e->getMessage()." (".$e->getCode().")<br>\n";
		}
		
		try {
			$moveDoc = $client->getDoc($gameDoc->idMoveDoc);
		} catch (Exception $e) {
			echo "ERROR: ".$e->getMessage()." (".$e->getCode().")<br>\n";
		}
		
		$errors_found = 0;
		
		if ($playerId != $moveDoc->move) {
			$errors_found++;
			echo "NOT_YOUR_MOVE";
		} 
		
		if ($moveDoc->movesCounter >= 9) {
			$errors_found++;
			echo "OUT_OF_MOVES";			
		}
		
		if ($errors_found == 0) {
		
			$contador = $moveDoc->movesCounter;
			
			try {
				$moveDoc->move = ( ($playerId === 'PLAYER_1') ? 'PLAYER_2' : 'PLAYER_1' );
				$moveDoc->movesCounter = ($contador+1);
				$response = $client->storeDoc($moveDoc);
			} catch (Exception $e) {
				echo "ERROR: ".$e->getMessage()." (".$e->getCode().")<br>\n";
			}
			
		}
		
	}
	
}
