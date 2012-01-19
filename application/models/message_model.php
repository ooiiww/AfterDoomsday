<?php
class Message_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_messages()
	{
		$query = $this->db->get('messages');
		return $query->result_array();
	}

	public function set_message()
	{
		$this->load->helper('url');
		$data = array(
			'sender_id' => $this->input->post('sender_id'),
			'receiver_id' => $this->input->post('receiver_id'),
			'type' => $this->input->post('type'),
			'alarm' => $this->input->post('alarm'),
			'content' => $this->input->post('content')
		);

		return $this->db->insert('messages', $data);
	}
}
?>
