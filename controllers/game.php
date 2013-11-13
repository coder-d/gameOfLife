<?php

class Game extends Controller {


	function __construct() {
		parent::__construct();
	}
	
	function index() {

		//Session::init();
			# Global Variables
	global $world, $cell_size;
 
	
	# Create Initial Random Chaos within the world
	$this->model->start_world();
	
	Session::set('session_world',$world);
    //print_r(Session::get('session_world'));
	
	# Create a graphical representation of the world
	$content = $this->model->display_world($world);
	     
	    $this->view->cell_size=$cell_size;
	    $this->view->content=$content;
		$this->view->render('game/index');
	}
	


/**
 * Retrieves the next iteration of the World's evolution and return's the HTML rendering
 */
function refresh() {
	# Global Variables
	global $world, $new_world;
	
	# Calculate a new World 2D Array
	//$session_value=Session::get('session_world');
	$new_world = $this->model->calc_new_world(Session::get('session_world'));
	$world = $new_world;
	
	//Session::init();
	Session::set('session_world',$world);
	
	
	
	
	$content= $this->model->display_world($world);
	$this->view->content=$content;
	$this->view->render('game/refresh');
}
	
}