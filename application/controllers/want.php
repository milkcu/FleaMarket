<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Want extends CI_Controller {
    public function index() {
        $this->load->model('wants');
        $this->load->library('pagination');
		$page = $this->uri->segment(3);
		$offset = $page ? ($page - 1) * 12 : 0;
		$config['uri_segment'] = 3;
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
		$this->form_validation->set_rules('content' , '描述', 'required|max_length[70]');
        $this->load->model('wants');
		if($this->input->post() && $this->form_validation->run()) {
			$data['content'] = $this->input->post('content');
			$data['uid'] = $this->aauth->get_user_id();
			$data['created'] = date("Y-m-d H:i:s");
			$data['ip'] = $this->input->ip_address();
			$data['ua'] = $this->input->user_agent();
            $data['state'] = 'wait';
			$this->load->model('wants');
			$this->wants->create_want($data);
			redirect('want/mine');
		} else {
            $data['type'] = 'create';
			$this->load->view('want/create', $data);
		}
    }
    public function mine() {
		if(! $this->aauth->is_loggedin()) {
			// not logged in
			redirect('user/login');
		};
        $this->load->model('wants');
        $this->load->library('pagination');
		$page = $this->uri->segment(3);
		$offset = $page ? ($page - 1) * 12 : 0;
		$config['uri_segment'] = 3;
		$config['base_url'] = site_url('want/mine');
		$config['total_rows'] = $this->wants->get_num_by_uid($this->aauth->get_user_id());
		$config['per_page'] = 12;
		$this->pagination->initialize($config);
        $data['wants'] = $this->wants->get_wants_by_uid($this->aauth->get_user_id(), $config['per_page'], $offset);
        $data['type'] = 'mine';
        $this->load->view('want/mine', $data);
    }
    public function delete() {
		$wid = $this->uri->segment(3);
		$this->load->model('wants');
		$this->wants->delete_want($wid);
		redirect('want/mine');
    }
    public function done() {
		$wid = $this->uri->segment(3);
		$this->load->model('wants');
		$this->wants->delete_want($wid);
		redirect('want/mine');
    }
    public function sendpm() {
		//$this->output->enable_profiler(TRUE);
        if( ! $this->aauth->is_loggedin()) {
            redirect('user/login');
        }
        $wid = $this->uri->segment(3);
		$sender_id = $this->aauth->get_user_id();
        $this->load->model('wants');
        $want = $this->wants->get_want($wid);
		$receiver_id = $want->uid;
		$title = 'want_' . $want->wid;
		$message = $this->input->post('message');
		$jsender_sdnuinfo = $this->aauth->get_user_var('sdnuinfo', $sender_id);
		$sender_sdnuinfo = json_decode($jsender_sdnuinfo);
		$send_date = date('Y-m-d H:i:s');
		$new_message = '<b>' . $sender_sdnuinfo->name . ' 发送于 ' .$send_date . '</b><br>' . $message;
		$this->aauth->send_pm($sender_id, $receiver_id, $title, $new_message);
		redirect('message/index/outbox');
    }
}
