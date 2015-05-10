<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {
	public function index() {
		// list products
		$cid = $this->uri->segment(3);
		//$offset = $this->uri->segment(4);
		$page = $this->uri->segment(4);
		$offset = $page ? ($page - 1) * 12 : 0;
		$this->load->model('products');
		$this->load->library('pagination');
		$config['uri_segment'] = 4;
		$config['base_url'] = site_url('product/index/' . $cid);
		$config['total_rows'] = $this->products->get_num_by_cid($cid);
		$config['per_page'] = 12;
		$this->pagination->initialize($config);
		$data['products'] = $this->products->get_products_by_cid($cid, $config['per_page'], $offset);
		$this->load->model('categories');
		$data['category'] = $this->categories->get_category($cid);
		//print_r($data);
		$this->load->view('product/list', $data);
	}
	public function search() {
		if($this->input->post()) {
			$q = $this->input->post('q');
			redirect('product/search/' . $q);
		}
		$q = urldecode($this->uri->segment(3));
        if($q == '') {
            redirect();
        }
		$page = $this->uri->segment(4);
		$offset = $page ? ($page - 1) * 12 : 0;
		$this->load->model('products');
		$this->load->library('pagination');
		$config['uri_segment'] = 4;
		$config['base_url'] = site_url('product/search/' . $q);
		$config['total_rows'] = $this->products->get_num_by_search($q);
		$config['per_page'] = 12;
		$this->pagination->initialize($config);
		$data['products'] = $this->products->get_products_by_search($q, $config['per_page'], $offset);
		$category = new stdClass();
		$category->name = '搜索结果';
		$data['category'] = $category;
		$this->load->view('product/list', $data);
	}
	public function show() {
		// read user and show
		$pid = $this->uri->segment(3);
		$this->load->model('products');
		$product = $this->products->get_product($pid, true);
        if($product->hidden) {
            $this->load->view('page/product_delete');
            return;
        }
		$data['product'] = $product;
		$jcontact = $this->aauth->get_user_var('contact', $product->uid);
		$data['contact']= json_decode($jcontact);
		$jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $product->uid);
		$data['sdnuinfo'] = json_decode($jsdnuinfo);
		$data['avatar'] = $this->aauth->get_user_var('avatar', $product->uid);
        $this->load->model('collects');
        $data['in_collect'] = $this->collects->in_collect($product->pid, $this->aauth->get_user_id());
		$this->load->view('product/show', $data);
	}
	public function create() {
		if(! $this->aauth->is_loggedin()) {
			// not logged in
			redirect('user/login');
		}
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title' , '标题', 'required');
		$this->form_validation->set_rules('cid', '分类', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('original', '原价', 'required|numeric');
		$this->form_validation->set_rules('current', '现价', 'required|numeric');
		$this->form_validation->set_rules('place', '交易地点', 'required');
		$this->form_validation->set_rules('detail', '描述', 'required');
		$this->form_validation->set_rules('images', '图片', 'required');
		if($this->input->post() && $this->form_validation->run()) {
			// create product
			$data = $this->input->post();
			$data['uid'] = $this->aauth->get_user_id();
			$data['created'] = date("Y-m-d H:i:s");
			$data['ip'] = $this->input->ip_address();
			$data['ua'] = $this->input->user_agent();
            if($data['detail'] == '') {
                $data['detail'] = $data['detail_m'];
            }
            unset($data['detail_m']);
			$this->load->model('products');
			$pid = $this->products->add_product($data);
			redirect('product/show/' . $pid);
		} else {
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
			// show form
			$this->load->view('product/create', $data);
			//$this->load->view('product/basic_upload');
		}
	}
	public function done() {
		$pid = $this->uri->segment(3);
		$this->load->model('products');
		$this->products->done_product($pid);
		redirect('user/show');
	}
	public function delete() {
		$pid = $this->uri->segment(3);
		$this->load->model('products');
		$this->products->delete_product($pid);
		redirect('user/show');
	}
    public function report() {
		//$this->output->enable_profiler(TRUE);
        if( ! $this->aauth->is_loggedin()) {
            redirect('user/login');
        }
        $pid = $this->uri->segment(3);
		$sender_id = $this->aauth->get_user_id();
        $this->load->model('wants');
        $want = $this->wants->get_want($wid);
		$receiver_id = admin_uid();
		$title = 'report_' . $pid;
		$message = $this->input->post('message');
		$jsender_sdnuinfo = $this->aauth->get_user_var('sdnuinfo', $sender_id);
		$sender_sdnuinfo = json_decode($jsender_sdnuinfo);
		$send_date = date('Y-m-d H:i:s');
		$new_message = '<b>' . $sender_sdnuinfo->name . ' 发送于 ' .$send_date . '</b><br>' . $message;
		$this->aauth->send_pm($sender_id, $receiver_id, $title, $new_message);
		redirect('message/index/outbox');
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
	public function kindeditor() {
		$this->load->library('kindeditorjson');
		//$this->kindeditorjson->set_uid($this->aauth->get_user_id());
		$filename = $this->kindeditorjson->process($this->aauth->get_user_id());
		//$filename = $this->kindeditorjson->get_filename();
		// upload to qiniu
		$conf = array('ak' => 'A2o1e1u2qqPQECn3VWxL5BcGGmSWX3n2KhXgK7Rx',
						'sk' => 'EUkbMnHf2BNrqOx49-VGz7cUhiwd52Y82mne1zaL',
						'bucket' => 'milkcu',
						'auth' => 'public');
		$this->load->library('qiniu', $conf);
        $localfile = dirname($_SERVER['SCRIPT_FILENAME']) . '/files/' . $filename;
		$ret = $this->qiniu->upload->upload($localfile, 'sdnuflea/' . $filename);
		print_r($ret->data);
		// delete the file in local server
        if(! unlink($localfile)) {
            echo 'file process error.';
        }
	}
}
