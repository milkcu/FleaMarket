<?php
class Categories extends CI_Model {
	public function get_category($cid) {
		$r = $this->db->get_where('categories', ['cid' => $cid])->row();
		return $r;
	}
	public function get_categories() {
		$r = $this->db->get('categories')->result();
		return $r;
	}
    public function modify_category($cid, $data) {
		$this->db->where('cid', $cid);
		$this->db->update('categories', $data);
        return;
    }
}
