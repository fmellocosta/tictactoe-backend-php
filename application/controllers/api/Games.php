<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Games extends REST_Controller {
	
	private $client;
	
	function __construct() {
		
		parent::__construct();
		
		$this->methods['users_get']['limit'] = 50;
		$this->methods['users_post']['limit'] = 50;
		
	}	

	function users_get() {
		echo 123;
	}	
	
	function users_post() {
		
		$action = $this->post('action');
		$gameId = $this->post('gameId');

		switch ($action) {
			
			case "register":

				$this->load->model('GamesModel');
				$this->GamesModel->register($gameId);
				
				break;
				
			case "unregister":
				
				$this->load->model('GamesModel');
				$this->GamesModel->unregister($gameId);				
				
				break;
				
				case "register_move":
					
					$playerId = $this->post('playerId');
					
					$this->load->model('GamesModel');
					$this->GamesModel->register_move($gameId, $playerId);
				
					break;				
			
		}
		
		
	}
	
}