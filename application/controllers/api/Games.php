<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Games extends REST_Controller {
	
	private $client;
	
	function __construct() {
		
		// Construct the parent class
		parent::__construct();
		
		$this->methods['users_get']['limit'] = 50;
		$this->methods['users_post']['limit'] = 50;
		
		$this->client = new couchClient ('http://localhost:5984','tictactoe');
		
	}	

	function users_get() {
	
		echo 123;
	
	}	
	
	function users_post() {
		
		$client = $this->client;
		
		$action = $this->post('action');
		$gameId = $this->post('gameId');

		echo $action;
		
		switch ($action) {
			
			case "register":
				
				$new_doc = new stdClass();
				$new_doc->_id = $gameId;
				
				try {
					$response = $client->storeDoc($new_doc);
				} catch (Exception $e) {
					echo "ERROR: ".$e->getMessage()." (".$e->getCode().")<br>\n";
				}		
				
				break;
				
			case "unregister":
				
				try {
					$doc = $client->getDoc($gameId);
				} catch (Exception $e) {
					echo "ERROR: ".$e->getMessage()." (".$e->getCode().")<br>\n";
				}

				try {
					$client->deleteDoc($doc);
				} catch (Exception $e) {
					echo "ERROR: ".$e->getMessage()." (".$e->getCode().")<br>\n";
				}		
				
				break;
			
		}
		
		
	}
	
	
}