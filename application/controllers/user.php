<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
    public function index() {
        if( ! $this->aauth->is_loggedin()) {
            redirect('user/login');
        }
		$uid = $this->aauth->get_user_id();
		$jcontact = $this->aauth->get_user_var('contact', $uid);
		$jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $uid);
        $avatar = $this->aauth->get_user_var('avatar', $uid);
		$data['contact'] = json_decode($jcontact);
		$data['sdnuinfo'] = json_decode($jsdnuinfo);
        $data['avatar'] = $avatar;
        $this->load->view('user/index', $data);
    }
    public function info() {
        if( ! $this->aauth->is_loggedin()) {
            redirect('user/login');
        }
		$uid = $this->aauth->get_user_id();
		$jcontact = $this->aauth->get_user_var('contact', $uid);
		$jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $uid);
		$data['user'] = $this->aauth->get_user($uid);
		$data['contact'] = json_decode($jcontact);
		$data['sdnuinfo'] = json_decode($jsdnuinfo);
        $this->load->view('user/info', $data);
    }
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
	public function collect() {
		// show the user info and products
		if( ! $this->aauth->is_loggedin()) {
			redirect('user/login');
		}
		$uid = $this->aauth->get_user_id();
		$jcontact = $this->aauth->get_user_var('contact', $uid);
		$jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $uid);
		$data['user'] = $this->aauth->get_user($uid);
		$data['contact'] = json_decode($jcontact);
		$data['sdnuinfo'] = json_decode($jsdnuinfo);
		$this->load->model('collects');
		$data['collects_num'] = $this->collects->get_num($uid);

		$this->load->library('pagination');
		$config['uri_segment'] = 3;
		$config['base_url'] = site_url('user/collect/');
		$config['total_rows'] = $this->collects->get_num($uid);
		$config['per_page'] = 12;
		$this->pagination->initialize($config);

		$page = $this->uri->segment(3);
		$offset = $page ? ($page - 1) * 12 : 0;
		$collects = $this->collects->get_collects_by_page($uid, $config['per_page'], $offset);
        $collects = array_reverse($collects);
        $data['collects'] = $collects;
		$data['avatar'] = $this->aauth->get_user_var('avatar', $this->aauth->get_user_id());
        $i = 0;
        $data['products'] = array();
        $this->load->model('products');
        foreach($collects as $c) {
            $data['products'][$i] = $this->products->get_product($c->pid);
            $data['products'][$i]->collect_created = $c->created;
            $i++;
        }
		$this->load->view('user/collect', $data);
	}
    public function addcollect() {
        if( ! $this->aauth->is_loggedin()) {
			redirect('user/login');
        }
        $pid = $this->uri->segment(3);
        $this->load->model('collects');
        $this->collects->add_collect($pid, $this->aauth->get_user_id());
        redirect('product/show/' . $pid);
    }
    public function delcollect() {
        if( ! $this->aauth->is_loggedin()) {
			redirect('user/login');
        }
        $pid = $this->uri->segment(3);
        $this->load->model('collects');
        $this->collects->del_collect($pid, $this->aauth->get_user_id());
        redirect('user/collect');
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
		$this->form_validation->set_rules('phone', '手机', 'integer|exact_length[11]');
		$this->form_validation->set_rules('qq', 'QQ', 'integer|min_lenght[5]|max_length[10]');
		$this->form_validation->set_rules('avatar', '头像', 'required');
		if($this->input->post() && $this->form_validation->run()) {
			$contact['email'] = $this->input->post('email');
			$contact['phone'] = $this->input->post('phone');
			$contact['qq'] = $this->input->post('qq');
            $contact['public'] = $this->input->post('public');
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
            // get qiniu token begin
            $conf = array('ak' => 'A2o1e1u2qqPQECn3VWxL5BcGGmSWX3n2KhXgK7Rx',
                            'sk' => 'EUkbMnHf2BNrqOx49-VGz7cUhiwd52Y82mne1zaL',
                            'bucket' => 'mysdnu',
                            'auth' => 'public');
            $this->load->library('qiniu', $conf);
            $this->qiniu->put_policy->init();
            $arr = array(
                Qiniu_put_policy::QINIU_PP_SCOPE => 'mysdnu',
                Qiniu_put_policy::QINIU_PP_DEADLINE => time()+7200,
                //Qiniu_put_policy::QINIU_PP_SAVE_KEY => 'mysdnutestbase64.jpg'
                );
            $this->qiniu->put_policy->set_policy_array($arr);
            $token = $this->qiniu->put_policy->get_token();
            // get qiniu token end
            $data['token'] = $token;
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
            if($this->aauth->is_banned($id)) {
                redirect('page/ban');
            }
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
		if(!$sdnuinfo) {
			redirect('user/login');
			return;
		}
        // 智慧山师账号直接登录，不再设置中间处理页面
        $avatar = 'mysdnu-user-avatar-default.jpg';
        $sdnuinfo = $this->session->userdata('sdnuinfo');
        $contact = array();
        $jcontact = json_encode($contact);
        $jsdnuinfo = json_encode($sdnuinfo);
        $email = $sdnuinfo['user_id'] . '@i.sdnu.edu.cn';
        $id = $this->aauth->create_user($email, $sdnuinfo['user_id'], $sdnuinfo['user_id']);
        if($id) {
            $this->aauth->set_user_var('avatar', $avatar, $id);
            $this->aauth->set_user_var('contact', $jcontact, $id);
            $this->aauth->set_user_var('sdnuinfo', $jsdnuinfo, $id);
            $this->aauth->login($email, $sdnuinfo['user_id']);
            // 发送注册成功通知
            $this->inform_complete($id);
            redirect('user/show');
        } else {
            // create user failure
            $this->load->view('page/complete_fail');
        }
        return;
        // 下面是以前的完善信息页面
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('phone', '手机', 'required|integer|exact_length[11]');
		$this->form_validation->set_rules('qq', 'QQ', 'integer|min_lenght[5]|max_lenght[10]');
		if($this->input->post() && $this->form_validation->run()) {
			// process the form
			$contact['email'] = $this->input->post('email');
			$contact['phone'] = $this->input->post('phone');
			$contact['qq'] = $this->input->post('qq');
            $contact['public'] = $this->input->post('public');
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
                // 发送注册成功通知
                $this->inform_complete($id);
				redirect('user/show');
			} else {
				// create user failure
				//redirect('user/login');
                redirect('user/complete');
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
        $localfile = dirname($_SERVER['SCRIPT_FILENAME']) . '/files/' . $filename;
		$ret = $this->qiniu->upload->upload($localfile, 'sdnuflea/' . $filename);
		// delete the file in local server
        if(! unlink($localfile)) {
            echo 'file process error.';
        }
	}
    private function inform_complete($id) {
		$sender_id = admin_uid();
		$receiver_id = $id;
		$title = 'inform_complete';
        $message = '您好，我是跳蚤市场的开发者刘新铜，非常欢迎您的加入。
            跳蚤市场提供免费的山师校内二手信息发布，是闲置物品旧货出售求购交换、进行二手物品交易的最佳选择。
            跳蚤市场基于智慧山师开放平台，仅限校内用户使用，同学交易更放心。
            如果您有任何的意见和建议欢迎与我联系，再次感谢您对跳蚤市场的支持。';
		$jsender_sdnuinfo = $this->aauth->get_user_var('sdnuinfo', $sender_id);
		$sender_sdnuinfo = json_decode($jsender_sdnuinfo);
		$send_date = date('Y-m-d H:i:s');
		$new_message = '<b>' . $sender_sdnuinfo->name . ' 发送于 ' .$send_date . '</b><br>' . $message;
		$this->aauth->send_pm($sender_id, $receiver_id, $title, $new_message);
    }
}
