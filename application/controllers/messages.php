<?php
class Messages extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('message_model');
	}

	public function index()
	{
		$data['messages'] = $this->message_model->get_messages();
		$data['title'] = 'All Messages';

		$this->load->view('templates/top', $data);
		$this->load->view('messages/index', $data);
		$this->load->view('templates/bottom', $data);
	}

	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Create a message';

		$this->form_validation->set_rules('sender_id', 'Sender', 'required');
		$this->form_validation->set_rules('receiver_id', 'Receiver', 'required');
		$this->form_validation->set_rules('type', 'Message Type', 'required');
		$this->form_validation->set_rules('alarm', 'Date', 'required');
		$this->form_validation->set_rules('content', 'Message', 'required');

		if ($this->form_validation->run() == false)
		{
			$this->load->view('templates/top', $data);
			$this->load->view('messages/create', $data);
			$this->load->view('templates/bottom', $data);
		}
		else
		{
			$this->message_model->set_message();
			$this->load->view('messages/success');
		}
	}
}
