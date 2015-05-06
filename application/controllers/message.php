<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {
	function __construct() {
		parent::__construct();
		if( ! $this->aauth->is_loggedin()) {
			redirect('user/login');
		}
	}
	public function show() {
		$type = $this->uri->segment(3);
		$pmid = $this->uri->segment(4);
		if($type == 'inbox') {
			$pm = $this->aauth->get_pm($pmid, true);
		} elseif($type == 'outbox') {
			$pm = $this->aauth->get_pm($pmid, false);
		}
        if( ! $pm) {
            redirect('message/index/' . $type);
            return;
        }
		$data['pm'] = $pm;
		$data['user'] = $this->aauth->get_user($pm->sender_id);
		$jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $pm->sender_id);
		$sdnuinfo = json_decode($jsdnuinfo);
		$data['sdnuinfo'] = $sdnuinfo;
		$data['type'] = $type;

		$loggedin_id = $this->aauth->get_user_id();
		if($pm->receiver_id == $loggedin_id) {
			$other_id = $pm->sender_id;
		} elseif($pm->sender_id == $loggedin_id) {
			$other_id = $pm->receiver_id;
		}
		$other_sdnuinfo = json_decode($this->aauth->get_user_var('sdnuinfo', $other_id));
		$data['other_sdnuinfo'] = $other_sdnuinfo;
		$data['other_avatar'] = $this->aauth->get_user_var('avatar', $other_id);

		if(is_numeric($pm->title)) {
			$pid = $pm->title;
			$this->load->model('products');
			$product = $this->products->get_product($pid);
			//$data['new_title'] = '和' . $other_sdnuinfo->name . '关于宝贝的会话（' . $product->title . '）';
            $data['new_title'] = '来自【' . $product->title . '】的会话';
		}
		$this->load->view('message/show', $data);
	}
	public function send() {
		//$this->output->enable_profiler(TRUE);
		$to = $this->uri->segment(3);
		$sender_id = $this->aauth->get_user_id();
		$receiver_id = $this->input->post('receiver_id');
		$title = $this->input->post('title');
		$message = $this->input->post('message');
		$old_message = $this->input->post('old_message');
		$jsender_sdnuinfo = $this->aauth->get_user_var('sdnuinfo', $sender_id);
		$sender_sdnuinfo = json_decode($jsender_sdnuinfo);
		$send_date = date('Y-m-d H:i:s');
		if($this->input->post('old_message')) {
			$old_data = '<hr>' . $old_message;
		} else {
			$old_date = '';
		}
		$new_message = '<b>' . $sender_sdnuinfo->name . ' 发送于 ' .$send_date . '</b><br>' . $message . $old_data;
		$this->aauth->send_pm($sender_id, $receiver_id, $title, $new_message);
		if($this->input->post('old_id')) {
			$old_id = $this->input->post('old_id');
			$this->aauth->delete_pm($old_id);
		}
		redirect('message/index/' . $to);
	}
	public function index() {
		$type = $this->uri->segment(3);
		$page = $this->uri->segment(4);
		$uid = $this->aauth->get_user_id();

		$this->load->library('pagination');
		$config['uri_segment'] = 4;
		$config['base_url'] = site_url('message/index/' . $type);
		$config['per_page'] = 12;

		$offset = $page ? ($page - 1) * 12 : 0;

		if($type == 'outbox') {
			$config['total_rows'] = $this->aauth->count_outbox_pms($uid);
			$pms = $this->aauth->list_pms($config['per_page'], $offset, false, $uid);
		} elseif($type == 'inbox') {
			$config['total_rows'] = $this->aauth->count_inbox_pms($uid);
			$pms = $this->aauth->list_pms($config['per_page'], $offset, $uid, false);
		}

		$cnt = count($pms);
		for($i = 0; $i < $cnt; $i++) {
			$jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $pms[$i]->sender_id);
			$sdnuinfo = json_decode($jsdnuinfo);
			$pms[$i]->sender_sdnuinfo = $sdnuinfo;
			$jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $pms[$i]->receiver_id);
			$sdnuinfo = json_decode($jsdnuinfo);
			$pms[$i]->receiver_sdnuinfo = $sdnuinfo;
			if(is_numeric($pms[$i]->title)) {
				$pid = $pms[$i]->title;
				$this->load->model('products');
				$product = $this->products->get_product($pid);
				$pms[$i]->product = $product;
			}

			$loggedin_id = $this->aauth->get_user_id();
			if($pms[$i]->receiver_id == $loggedin_id) {
				$other_id = $pms[$i]->sender_id;
			} elseif($pms[$i]->sender_id == $loggedin_id) {
				$other_id = $pms[$i]->receiver_id;
			}
			$other_sdnuinfo = json_decode($this->aauth->get_user_var('sdnuinfo', $other_id));
			$pms[$i]->other_sdnuinfo = $other_sdnuinfo;

			//$pms[$i]->new_title = '和' . $other_sdnuinfo->name . '关于宝贝的会话';
            $pms[$i]->new_title = '来自【' . $pms[$i]->product->title . '】的会话';
		}

		$this->pagination->initialize($config);

		$data['unread_num'] = $this->aauth->count_unread_pms($uid);
		$data['type'] = $type;
		$data['pms_num'] = $config['total_rows'];
		$data['pms'] = $pms;
		$this->load->view('message/list', $data);
	}
	public function create() {
		if($this->input->post()) {
			// send pm
			//print_r($this->input->post());
			$receiver_name = $this->input->post('name');
			$title = $this->input->post('title');
			$message = $this->input->post('message');
			$sender_id = $this->aauth->get_user_id();
			$receiver_id = $this->aauth->get_user_id_by_name($receiver_name);
			$this->aauth->send_pm($sender_id, $receiver_id, $title, $message);
			echo "send_pm($sender_id, $receiver_id, $title, $message)";
			//redirect('message/send');
		} else {
			$this->load->view('message/create');
		}
	}
}
