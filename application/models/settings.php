<?php
class Settings extends CI_Model {
    public function set_var($key, $value) {
        if($this->get_var($key) === false) {
            $data = array(
                'setkey' => $key,
                'value' => $value
            );
            return $this->db->insert('settings', $data);
        } else {
            $data = array(
                'value' => $value
            );
            $this->db->where('setkey', $key);
            return $this->db->update('settings', $data);
        }
    }
    public function get_var($key) {
        $this->db->where('setkey', $key);
        $q = $this->db->get('settings');
        if($q->num_rows < 1) {
            return false;
        } else {
            $r = $q->row();
            return $r->value;
        }
    }
    public function list_var() {
        return $this->db->get('settings')->result();
    }
}
