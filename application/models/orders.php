<?php
class Orders extends CI_Model {
	public function create_order($data) {
        $data['logs'] = array(date("Y-m-d H:i:s") => '买家创建订单');
		$data['logs'] = json_encode($data['logs']);
		$this->db->insert('orders', $data);
		return $this->db->insert_id();
	}
	public function get_order($oid) {
		$r = $this->db->get_where('orders', ['oid' => $oid])->row();
		if($r->state == 'isdel') {
			return false;
		}
		$r->logs = json_decode($r->logs);
        $r->comment = (array) json_decode($r->comment);
		$this->load->model('products');
		$r->product = $this->products->get_product($r->pid);
        $from_jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $r->fromid);
        $to_jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $r->toid);
        $r->from_sdnuinfo = json_decode($from_jsdnuinfo);
        $r->to_sdnuinfo = json_decode($to_jsdnuinfo);
		return $r;
	}
	public function get_orders_by_fromid($fromid, $limit, $offset) {
		$r = $this->db->order_by('created', 'desc')->
				get_where('orders', ['fromid' => $fromid, 'state !=' => 'isdel'], $limit, $offset)->result();
		$cnt = count($r);
		for($i = 0; $i < $cnt; $i++) {
			$r[$i]->logs = json_decode($r[$i]->logs);
            $from_jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $r[$i]->fromid);
            $to_jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $r[$i]->toid);
            $r[$i]->from_sdnuinfo = json_decode($from_jsdnuinfo);
            $r[$i]->to_sdnuinfo = json_decode($to_jsdnuinfo);
            $this->load->model('products');
            $r[$i]->product = $this->products->get_product($r[$i]->pid);
		}
		return $r;
	}
	public function get_orders_by_toid($toid, $limit, $offset) {
		$r = $this->db->order_by('created', 'desc')->
				get_where('orders', ['toid' => $toid, 'state !=' => 'isdel'], $limit, $offset)->result();
		$cnt = count($r);
		for($i = 0; $i < $cnt; $i++) {
			$r[$i]->logs = json_decode($r[$i]->logs);
            $from_jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $r[$i]->fromid);
            $to_jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $r[$i]->toid);
            $r[$i]->from_sdnuinfo = json_decode($from_jsdnuinfo);
            $r[$i]->to_sdnuinfo = json_decode($to_jsdnuinfo);
            $this->load->model('products');
            $r[$i]->product = $this->products->get_product($r[$i]->pid);
		}
		return $r;
	}
	public function get_orders_by_uid($uid, $limit, $offset) {
        $q = $this->db->order_by('created', 'desc');
        $q = $this->db->where("(toid = $uid or fromid = $uid) and state != 'isdel'");
        $q = $this->db->get('orders', $limit, $offset);
        $r = $q->result();
        /*
		$r = $this->db->order_by('created', 'desc')->
				get_where('orders', ['toid' => $toid, 'state !=' => 'isdel'], $limit, $offset)->result();
         */
		$cnt = count($r);
		for($i = 0; $i < $cnt; $i++) {
			$r[$i]->logs = json_decode($r[$i]->logs);
            $from_jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $r[$i]->fromid);
            $to_jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $r[$i]->toid);
            $r[$i]->from_sdnuinfo = json_decode($from_jsdnuinfo);
            $r[$i]->to_sdnuinfo = json_decode($to_jsdnuinfo);
            $this->load->model('products');
            $r[$i]->product = $this->products->get_product($r[$i]->pid);
		}
		return $r;
	}
	public function get_orders_all($limit, $offset) {
		$r = $this->db->order_by('created', 'desc')->
				get_where('orders', ['state !=' => 'isdel'], $limit, $offset)->result();
		$cnt = count($r);
		for($i = 0; $i < $cnt; $i++) {
            $r[$i]->logs = json_decode($r[$i]->logs);
            $from_jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $r[$i]->formid);
            $to_jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $r[$i]->toid);
            $r[$i]->from_sdnuinfo = json_decode($from_jsdnuinfo);
            $r[$i]->to_sdnuinfo = json_decode($to_jsdnuinfo);
            $this->load->model('products');
            $r[$i]->product = $this->products->get_product($r[$i]->pid);
		}
		return $r;
	}
	public function get_num_by_fromid($fromid) {
		return $this->db->where(['fromid' => $fromid, 'state !=' => 'isdel'])->count_all_results('orders');
	}
	public function get_num_by_toid($toid) {
		return $this->db->where(['toid' => $toid, 'state !=' => 'isdel'])->count_all_results('orders');
	}
    public function get_num_all() {
        return $this->db->where(['state !=' => 'isdel'])->count_all_results('orders');
    }
	public function affirm_order($oid) {
		$order = $this->get_order($oid);
		if($this->aauth->get_user_id() != $order->toid) {
			return false;
		}
        // 确认订单状态
        if($order->state != 'create') {
            return false;
        }
        $logs = (array) $order->logs;
        $logs = $logs + array(date("Y-m-d H:i:s") => '卖家确认接单');
        $data['logs'] = json_encode($logs);
		$data['state'] = 'affirm';
		$this->db->where('oid', $oid);
		$this->db->update('orders', $data);
	}
	public function cancel_order($oid) {
		$order = $this->get_order($oid);
		if($this->aauth->get_user_id() != $order->toid) {
			return false;
		}
        // 确认订单状态
        if($order->state != 'create') {
            return false;
        }
        $logs = (array) $order->logs;
        $logs = $logs + array(date("Y-m-d H:i:s") => '卖家取消订单');
        $data['logs'] = json_encode($logs);
		$data['state'] = 'cancel';
		$this->db->where('oid', $oid);
		$this->db->update('orders', $data);
	}
    public function complete_order($oid) {
		$order = $this->get_order($oid);
		if($this->aauth->get_user_id() != $order->fromid) {
			return false;
		}
        // 确认订单状态
        if($order->state != 'affirm') {
            return false;
        }
        $logs = (array) $order->logs;
        $logs = $logs + array(date("Y-m-d H:i:s") => '买家确认订单完成');
        $data['logs'] = json_encode($logs);
		$data['state'] = 'complete';
		$this->db->where('oid', $oid);
		$this->db->update('orders', $data);
    }
	public function delete_order($oid) {
		$order = $this->get_order($oid);
		if($this->aauth->get_user_id() != $order->fromid) {
			return false;
		}
        if($order->state != 'create') {
            return false;
        }
        $logs = (array) $order->logs;
        $logs = $logs + array(date("Y-m-d H:i:s") => '买家已经删除订单');
        $data['logs'] = json_encode($logs);
		$data['state'] = 'delete';
		$this->db->where('oid', $oid);
		$this->db->update('orders', $data);
	}
    public function add_comment($oid, $comment) {
        $order = $this->get_order($oid);
		if($this->aauth->get_user_id() != $order->fromid && $this->aauth->get_user_id() != $order->toid) {
			return false;
		}
        $c = array();
        $c['uid'] = $this->aauth->get_user_id();
        $jsdnuinfo = $this->aauth->get_user_var('sdnuinfo');
        $sdnuinfo = json_decode($jsdnuinfo);
        $c['uname'] = $sdnuinfo->name;
        $c['content'] = $comment;
        $c['created'] = date("Y-m-d H:i:s");
        $oc = $order->comment;
        $oc[count($oc) + 1] = $c;
        $data['comment'] = json_encode($oc);
        $this->db->where('oid', $oid);
        $this->db->update('orders', $data);
    }
    public function get_uncomplete_num_by_fromid($fromid) {
        if($this->aauth->get_user_id() != $fromid) {
            return false;
        }
		return $this->db->where("fromid = $fromid  and (state = 'create' or state = 'affirm')")->count_all_results('orders');
    }
    public function get_uncomplete_num_by_toid($toid) {
        if($this->aauth->get_user_id() != $toid) {
            return false;
        }
		return $this->db->where("toid = $toid  and (state = 'create' or state = 'affirm')")->count_all_results('orders');
    }
}
