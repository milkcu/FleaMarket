<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function show() {
		// show the user info and products
		if( ! $this->aauth->is_loggedin()) {
			redirect('user/login');
		}
		//$uid = $this->uri->segment(3);
		$uid = $this->aauth->get_user_id();
		$jcontact = $this->aauth->get_user_var('contact', $uid);
		$jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $uid);
		$data['user'] = $this->aauth->get_user($uid);
		$data['contact'] = json_decode($jcontact);
		$data['sdnuinfo'] = json_decode($jsdnuinfo);
		$this->load->model('products');
		$data['products_num'] = $this->products->get_num_by_uid($uid);
		
		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = site_url('user/show/');
		$config['total_rows'] = $this->products->get_num_by_uid($uid);
		$config['per_page'] = 12;
		$this->pagination->initialize($config);
		
		$page = $this->uri->segment(3);
		$offset = $page ? ($page - 1) * 12 : 0;
		$data['products'] = $this->products->get_products_by_uid($uid, $config['per_page'], $offset);
		$data['avatar'] = $this->aauth->get_user_var('avatar', $this->aauth->get_user_id());
		$this->load->view('user/show', $data);
	}
	public function follow() {
		// show the user info and products
		if( ! $this->aauth->is_loggedin()) {
			redirect('user/login');
		}
		//$uid = $this->uri->segment(3);
		$uid = $this->aauth->get_user_id();
		$jcontact = $this->aauth->get_user_var('contact', $uid);
		$jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $uid);
		$data['user'] = $this->aauth->get_user($uid);
		$data['contact'] = json_decode($jcontact);
		$data['sdnuinfo'] = json_decode($jsdnuinfo);
		$this->load->model('products');
		$data['products_num'] = $this->products->get_num_by_uid($uid);
		
		$this->load->library('pagination');
		$config['base_url'] = site_url('user/follow');
		$config['uri_segment'] = 3;
		$config['per_page'] = 12;
		$config['total_rows'] = $this->products->get_num_by_uid($uid);
		$this->pagination->initialize($config);
		
		$page = $this->uri->segment(3);
		$offset = $page ? ($page - 1) * 12 : 0;
		$data['products'] = $this->products->get_products_by_uid($uid, $config['per_page'], $offset);
		$this->load->view('user/follow', $data);
	}
	public function modify() {
		// modify the info of user
		if( ! $this->aauth->is_loggedin()) {
			redirect('user/login');
			return;
		}
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('phone', '手机', 'required|integer');
		$this->form_validation->set_rules('qq', 'QQ', 'required|integer');
		$this->form_validation->set_rules('avatar', '头像', 'required');
		if($this->input->post() && $this->form_validation->run()) {
			$contact['email'] = $this->input->post('email');
			$contact['phone'] = $this->input->post('phone');
			$contact['qq'] = $this->input->post('qq');
			$jcontact = json_encode($contact);
			$this->aauth->set_user_var('contact', $jcontact);
			$avatar = $this->input->post('avatar');
			$this->aauth->set_user_var('avatar', $avatar);
			redirect('user/show');
		} else {
			$uid = $this->aauth->get_user_id();
			$jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $uid);
			$sdnuinfo = json_decode($jsdnuinfo);
			$data['sdnuinfo'] = $sdnuinfo;
			$jcontact = $this->aauth->get_user_var('contact', $uid);
			$contact = json_decode($jcontact);
			$data['contact'] = $contact;
			$avatar = $this->aauth->get_user_var('avatar');
			$data['avatar'] = $avatar;
			$this->load->view('user/modify', $data);
		}
	}
	public function login() {
		// redirect to the sdnu platform
		$this->load->library('sdnusdk');
		$this->sdnusdk->authorize();
	}
	public function callback() {
		// callback from sdnu platform
		$this->load->library('sdnusdk');
		$this->sdnusdk->callback();
		$sdnuinfo = $this->sdnusdk->getinfo();
		$this->session->set_userdata('sdnuinfo', $sdnuinfo);
		$id = $this->aauth->get_user_id_by_name($sdnuinfo['user_id']);
		if($id) {
			// not the first time
			$user = $this->aauth->get_user($id);
			$this->aauth->login($user->email, $sdnuinfo['user_id']);
			redirect('user/show');
		} else {
			// first logged in
			redirect('user/complete');
		}
	}
	public function complete() {
		// complete the registration when firt logged
		$sdnuinfo = $this->session->userdata('sdnuinfo');
		$this->load->helper('form');
		$this->load->library('form_validation');
		if(!$sdnuinfo) {
			redirect('user/login');
			return;
		}
		if($this->input->post()) {
			// process the form
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('phone', '手机', 'required|integer');
			$this->form_validation->set_rules('qq', 'QQ', 'required|integer');
			$contact['email'] = $this->input->post('email');
			$contact['phone'] = $this->input->post('phone');
			$contact['qq'] = $this->input->post('qq');
			$avatar = $this->input->post('avatar');
			$sdnuinfo = $this->session->userdata('sdnuinfo');
			$jcontact = json_encode($contact);
			$jsdnuinfo = json_encode($sdnuinfo);
			$id = $this->aauth->create_user($contact['email'], $sdnuinfo['user_id'], $sdnuinfo['user_id']);
			if($id) {
				$this->aauth->set_user_var('avatar', $avatar, $id);
				$this->aauth->set_user_var('contact', $jcontact, $id);
				$this->aauth->set_user_var('sdnuinfo', $jsdnuinfo, $id);
				$this->aauth->login($contact['email'], $sdnuinfo['user_id']);
				redirect('user/show/' . $id);
			} else {
				// create user failure
				redirect('user/login');
			}
		} else {
			// show the form
			$this->load->view('user/complete', $sdnuinfo);
		}
	}
	public function logout() {
		// user logged out
		$this->aauth->logout();
		redirect();
	}
	public function upload() {
		// ajax upload
		if(! $this->aauth->is_loggedin()) {
			return false;
		}
		$ext = pathinfo($_FILES['files']['name'][0], PATHINFO_EXTENSION);
		$filename = date('YmdHis') . rand(10, 99) . '-' . $this->aauth->get_user_id() . '.' . $ext;
		$_FILES['files']['name'][0] = $filename;
		$this->load->library('UploadHandler');
		// upload to qiniu
		$conf = array('ak' => 'A2o1e1u2qqPQECn3VWxL5BcGGmSWX3n2KhXgK7Rx', 
						'sk' => 'EUkbMnHf2BNrqOx49-VGz7cUhiwd52Y82mne1zaL',
						'bucket' => 'milkcu',
						'auth' => 'public');
		$this->load->library('qiniu', $conf);
		$ret = $this->qiniu->upload->upload(dirname($_SERVER['SCRIPT_FILENAME']) . '/files/' . $filename, 'sdnuflea/' . $filename);
		// delete the file in local server
	}
}
