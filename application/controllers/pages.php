<?php

class Pages extends CI_Controller {

	public function view($page = 'home')
	{

		if (!file_exists('application/views/pages/'.$page.'.php'))
		{
			show_404();
		}

		$data['title'] = ucfirst($page);
		$this->load->view('templates/top', $data);
		$this->load->view('pages/'.$page.'.php', $data);
		$this->load->view('templates/bottom.php', $data);

	}
}
