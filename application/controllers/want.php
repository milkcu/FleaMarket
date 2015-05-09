<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Want extends CI_Controller {
    public function index() {
        $this->load->model('wants');
        $this->load->library('pagination');
		$page = $this->uri->segment(4);
		$offset = $page ? ($page - 1) * 12 : 0;
		$config['uri_segment'] = 4;
		$config['base_url'] = site_url('want/index');
		$config['total_rows'] = $this->wants->get_num();
		$config['per_page'] = 12;
		$this->pagination->initialize($config);
		$data['wants'] = $this->wants->get_wants($config['per_page'], $offset);
        $data['type'] = 'index';
        $this->load->view('want/list', $data);
    }
    public function create() {
		if(! $this->aauth->is_loggedin()) {
			// not logged in
			redirect('user/login');
		}
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('content' , '描述', 'required|max_length[300]');

        $this->load->model('wants');
        $this->load->library('pagination');
		$page = $this->uri->segment(4);
		$offset = $page ? ($page - 1) * 12 : 0;
		$config['uri_segment'] = 4;
		$config['base_url'] = site_url('want/create');
		$config['total_rows'] = $this->wants->get_num_by_uid($this->aauth->get_user_id());
		$config['per_page'] = 12;
		$this->pagination->initialize($config);
		if($this->input->post() && $this->form_validation->run()) {
			$data['content'] = $this->input->post('content');
			$data['uid'] = $this->aauth->get_user_id();
			$data['created'] = date("Y-m-d H:i:s");
			$data['ip'] = $this->input->ip_address();
			$data['ua'] = $this->input->user_agent();
			$this->load->model('wants');
			$this->wants->create_want($data);
			redirect('want/create');
		} else {
            $data['wants'] = $this->wants->get_wants($config['per_page'], $offset);
            $data['type'] = 'create';
			$this->load->view('want/create', $data);
		}
    }
    public function delete() {
		$wid = $this->uri->segment(3);
		$this->load->model('wants');
		$this->wants->delete_want($wid);
		redirect('want/create');
    }
    public function done() {
		$wid = $this->uri->segment(3);
		$this->load->model('wants');
		$this->wants->delete_want($wid);
		redirect('want/create');
    }
}
