<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {
	public function index() {
        if($this->uri->segment(3)) {
            $type = $this->uri->segment(3);
        } else {
            $type = 'all';
        }
        $data['type'] = $type;
		$page = $this->uri->segment(4);
		$offset = $page ? ($page - 1) * 12 : 0;
		$this->load->model('orders');
		$this->load->library('pagination');
		$config['uri_segment'] = 4;
		$config['base_url'] = site_url('order/index/' . $type);
        $uid = $this->aauth->get_user_id();
		$config['per_page'] = 12;
        switch($type) {
            case 'from' :
                $orders_num = $this->orders->get_num_by_fromid($uid);
                $orders = $this->orders->get_orders_by_fromid($uid, $config['per_page'], $offset);
                break;
            case 'to' :
                $orders_num = $this->orders->get_num_by_toid($uid);
                $orders = $this->orders->get_orders_by_toid($uid, $config['per_page'], $offset);
                break;
            default :
                $orders_num = $this->orders->get_num_all($uid);
                $orders = $this->orders->get_orders_by_uid($uid, $config['per_page'], $offset);
                break;
        }
        $data['orders'] = $orders;
        $config['total_rows'] = $orders_num;
        $data['orders_num'] = $orders_num;
        $data['uncomplete_num_by_fromid'] = $this->orders->get_uncomplete_num_by_fromid($uid);
        $data['uncomplete_num_by_toid'] = $this->orders->get_uncomplete_num_by_toid($uid);
		$this->pagination->initialize($config);
		$this->load->view('order/list', $data);
	}
	public function show() {
		$oid = $this->uri->segment(3);
		$this->load->model('orders');
		$order = $this->orders->get_order($oid);
        if( ! $order) {
            $this->load->view('page/order-abnormal');
            return;
        }
		$data['order'] = $order;
        $this->load->model('products');
        $data['product'] = $this->products->get_product($order->pid);
		$this->load->view('order/show', $data);
	}
	public function create() {
		if(! $this->aauth->is_loggedin()) {
			// not logged in
			redirect('user/login');
		}
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pid' , '商品编号', 'required|numeric');
		$this->form_validation->set_rules('payment' , '支付方式', 'required');
		$this->form_validation->set_rules('delivery', '配送方式', 'required');
		$this->form_validation->set_rules('receiver' , '收货人', 'required');
		$this->form_validation->set_rules('address' , '收件地址', 'required');
		$this->form_validation->set_rules('contact' , '联系方式', 'required');
		if($this->input->post() && $this->form_validation->run()) {
			// create product
			$data = $this->input->post();
            unset($data['recaptcha']);
			$data['fromid'] = $this->aauth->get_user_id();
            $this->load->model('products');
            $product = $this->products->get_product($this->input->post('pid'));
            $data['toid'] = $product->uid;
			$data['created'] = date("Y-m-d H:i:s");
            $data['state'] = 'create';
			$data['ip'] = $this->input->ip_address();
			$data['ua'] = $this->input->user_agent();
			$this->load->model('orders');
			$oid = $this->orders->create_order($data);
			redirect('order/show/' . $oid);
		} else {
            $pid = $this->uri->segment(3);
            $this->load->model('products');
            $data['product'] = $this->products->get_product($pid);
			$this->load->view('order/create', $data);
		}
	}
	public function affirm() {
		$oid = $this->uri->segment(3);
		$this->load->model('orders');
		$this->orders->affirm_order($oid);
		redirect('order/index/to');
	}
	public function cancel() {
		$oid = $this->uri->segment(3);
		$this->load->model('orders');
		$this->orders->cancel_order($oid);
		redirect('order/index/to');
	}
	public function complete() {
		$oid = $this->uri->segment(3);
		$this->load->model('orders');
		$this->orders->complete_order($oid);
		redirect('order/index/from');
	}
	public function delete() {
		$oid = $this->uri->segment(3);
		$this->load->model('orders');
		$this->orders->delete_order($oid);
		redirect('order/index/from');
	}
    public function comment() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('oid', 'required');
        $this->form_validation->set_rules('comment', 'required');
        if($this->input->post() && $this->form_validation->run()) {
            $oid = $this->input->post('oid');
            $comment = $this->input->post('comment');
            $this->load->model('orders');
            $this->orders->add_comment($oid, $comment);
            redirect('order/show/' . $oid);
        } else {
            redirect('order/show/' . $oid);
        }
    }
}
