<?php
class Wants extends CI_Model {
	public function create_want($data) {
		return $this->db->insert('wants', $data);
	}
	public function get_want($wid) {
		$r = $this->db->get_where('wants', ['wid' => $wid])->row();
		return $r;
	}
	public function get_wants($limit, $offset) {
		$r = $this->db->order_by('created', 'desc')->
				get_where('wants', ['state !=' => 'isdel'], $limit, $offset)->result();
        for($i = 0; $i < count($r); $i++) {
            $jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $r[$i]->uid);
            $r[$i]->sdnuinfo = json_decode($jsdnuinfo);
            $r[$i]->avatar = $this->aauth->get_user_var('avatar', $r[$i]->uid);
        }
		return $r;
	}
	public function get_wants_by_uid($uid, $limit, $offset) {
		$r = $this->db->order_by('created', 'desc')->
				get_where('wants', ['uid' => $uid, 'state !=' => 'isdel'], $limit, $offset)->result();
        for($i = 0; $i < count($r); $i++) {
            $jsdnuinfo = $this->aauth->get_user_var('sdnuinfo', $r[$i]->uid);
            $r[$i]->sdnuinfo = json_decode($jsdnuinfo);
            $r[$i]->avatar = $this->aauth->get_user_var('avatar', $r[$i]->uid);
        }
		return $r;
	}
	public function get_num() {
		return $this->db->where(['state !=' => 'isdel'])->count_all_results('wants');
	}
	public function get_num_by_uid($uid) {
		return $this->db->where(['uid' => $uid, 'state !=' => 'isdel'])->count_all_results('wants');
	}
	public function done_product($wid) {
        $want = $this->get_want($wid);
        if($want->uid != $this->aauth->get_user_id()) {
            return false;
        }
		$data['state'] = 'done';
		$this->db->where('wid', $wid);
        $this->db->update('wants', $data);
    }
    public function delete_want($wid) {
        $want = $this->get_want($wid);
        if($want->uid != $this->aauth->get_user_id()) {
            return false;
        }
        $data['state'] = 'isdel';
        $this->db->where('wid', $wid);
        $this->db->update('wants', $data);
    }
}
