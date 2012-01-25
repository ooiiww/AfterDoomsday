<?php
class Portal extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('tool');
	}
	
	function index()
	{
		$this->tool->step2();
		$this->tool->step3();
		$extrapara=array(
		"fields"=>"headurl_with_logo,tinyurl_with_logo",
		"count"=>5000
		);
		$data["friends"]=$this->tool->useapi("friends.getFriends",$extrapara);
		$this->load->view("test",$data);
	}
}
?>
