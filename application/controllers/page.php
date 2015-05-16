<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {
	public function index() {
        $this->load->model('settings');
        $data['imghead'] = $this->settings->get_var('imghead');
        $data['imgqrcode'] = $this->settings->get_var('imgqrcode');
		$this->load->model('categories');
		$data['categories'] = $this->categories->get_categories();
        $data['tab'] = 1;
		$this->load->view('page/index', $data);
	}
    public function phone() {
        $this->load->view('page/phone');
    }
    public function ban() {
        $this->load->view('page/ban');
    }
    public function disclaimer() {
        $this->load->model('settings');
        $data['txtdisclaimer'] = $this->settings->get_var('txtdisclaimer');
        $this->load->view('page/disclaimer', $data);
    }
    public function service() {
        $this->load->model('settings');
        $data['txtservice'] = $this->settings->get_var('txtservice');
        $this->load->view('page/service', $data);
    }
    public function feedback() {
        if( ! $this->aauth->is_loggedin()) {
            redirect('user/login');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('message', 'required');
        if($this->input->post() && $this->form_validation->run()) {
            $sender_id = $this->aauth->get_user_id();
            $receiver_id = admin_uid();
            $title = 'feedback_' . $sender_id;
            $message = $this->input->post('message');
            $jsender_sdnuinfo = $this->aauth->get_user_var('sdnuinfo', $sender_id);
            $sender_sdnuinfo = json_decode($jsender_sdnuinfo);
            $send_date = date('Y-m-d H:i:s');
            $new_message = '<b>' . $sender_sdnuinfo->name . ' 发送于 ' .$send_date . '</b><br>' . $message;
            $this->aauth->send_pm($sender_id, $receiver_id, $title, $new_message);
            redirect('message/index/outbox');
        }
    }
}
