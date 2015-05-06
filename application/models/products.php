<?php
class Products extends CI_Model {
	public function add_product($data) {
		$data['images'] = json_encode($data['images']);
		$this->db->insert('products', $data);
		return $this->db->insert_id();
	}
	public function get_product($pid, $cnt = false) {
		$r = $this->db->get_where('products', ['pid' => $pid])->row();
		if($r->isdel != 0) {
			return false;
		}
		$r->images = json_decode($r->images);
		$this->load->model('categories');
		$r->category = $this->categories->get_category($r->cid);
		if($cnt) {
			$this->update_view_count($pid);
		}
		return $r;
	}
	public function get_products_by_cid($cid, $limit, $offset) {
		$r = $this->db->order_by('created', 'desc')->
				get_where('products', ['cid' => $cid, 'isdel' => 0], $limit, $offset)->result();
		$cnt = count($r);
		for($i = 0; $i < $cnt; $i++) {
			$r[$i]->images = json_decode($r[$i]->images);
		}
		return $r;
	}
	public function get_products_by_uid($uid, $limit, $offset) {
		$r = $this->db->order_by('created', 'desc')->
				get_where('products', ['uid' => $uid, 'isdel' => 0], $limit, $offset)->result();
		/*
		$q = $this->db->get('products');
		$q = $this->db->where(['uid' => $uid, 'isdel' => 0]);
		$q = $this->db->limit($limit, $offset);
		$q = $this->db->order_by('created', 'desc');
		$r = $q->result();
		*/
		$cnt = count($r);
		$this->load->model('categories');
		for($i = 0; $i < $cnt; $i++) {
			$r[$i]->category = $this->categories->get_category($r[$i]->cid);
		}
		return $r;
	}
	public function get_products_all($limit, $offset) {
		$r = $this->db->order_by('created', 'desc')->
				get_where('products', ['isdel' => 0], $limit, $offset)->result();
		$cnt = count($r);
		$this->load->model('categories');
		for($i = 0; $i < $cnt; $i++) {
            $r[$i]->images = json_decode($r[$i]->images);
			$r[$i]->category = $this->categories->get_category($r[$i]->cid);
            $jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $r[$i]->uid);
            $r[$i]->sdnuinfo = json_decode($jsdnuinfo);
		}
		return $r;
	}
	public function get_products_by_search($q, $limit, $offset) {
		$r = $this->db->order_by('created', 'desc')->like('title', $q)->or_like('detail', $q)->
				get_where('products', ['isdel' => 0], $limit, $offset)->result();
		$cnt = count($r);
		for($i = 0; $i < $cnt; $i++) {
			$r[$i]->images = json_decode($r[$i]->images);
		}
		return $r;
	}
	public function get_num_by_cid($cid) {
		return $this->db->where(['cid' => $cid, 'isdel' => 0])->count_all_results('products');
	}
	public function get_num_by_uid($uid = false) {
		if(! $uid) {
			$uid = $this->aauth->get_user_id();
		}
		return $this->db->where(['uid' => $uid, 'isdel' => 0])->count_all_results('products');
	}
	public function get_num_by_search($q) {
		return $this->db->like('title', $q)->or_like('detail', $q)->where(['isdel' => 0])->count_all_results('products');
	}
    public function get_num_all() {
        return $this->db->where(['isdel' => 0])->count_all_results('products');
    }
	public function done_product($pid) {
		$product = $this->get_product($pid);
		if($this->aauth->get_user_id() != $product->uid) {
			return;
		}
		$data['state'] = 1;
		$this->db->where('pid', $pid);
		$this->db->update('products', $data);
	}
	public function delete_product($pid) {
		$product = $this->get_product($pid);
		if($this->aauth->get_user_id() == $product->uid) {
		    $data['isdel'] = 1;
        } elseif($this->aauth->is_admin()) {
		    $data['isdel'] = $this->aauth->get_user_id();
        } else {
            return;
        }
		$this->db->where('pid', $pid);
		$this->db->update('products', $data);
	}
	public function update_view_count($pid) {
		$product = $this->get_product($pid);
		$views = $product->views + 1;
		$data['views'] = $views;
		$this->db->where('pid', $pid);
		$this->db->update('products', $data);
	}
}
