<?php
class Collects extends CI_Model {
    public function add_collect($pid, $uid) {
        if($uid == false) {
            return false;
        }
        if($uid != $this->aauth->get_user_id()) {
            return false;
        }
        if($this->in_collect($pid, $uid)) {
            return false;
        }
        $c['created'] = date('Y-m-d H:i:s');
        $c['pid'] = $pid;
        $jcollect = $this->aauth->get_user_var('collect');
        $collect = (array) json_decode($jcollect);
        $collect[] = $c;
        $jcollect = json_encode($collect);
        $this->aauth->set_user_var('collect', $jcollect, $uid);
    }
    public function del_collect($pid, $uid) {
        if($uid == false) {
            return false;
        }
        $collects = $this->get_collects($uid);
        $i = 0;
        foreach($collects as $c) {
                $i++;
            if($c->pid == $pid) {
                break;
            }
        }
        unset($collects[$i - 1]);
        $jcollects = json_encode($collects);
        $this->aauth->set_user_var('collect', $jcollects, $uid);
    }
    public function in_collect($pid, $uid) {
        $collects = $this->get_collects($uid);
        foreach($collects as $c) {
            if($c->pid == $pid) {
                return true;
            }
        }
        return false;
    }
    public function get_collects($uid) {
        $jcollect = $this->aauth->get_user_var('collect', $uid);
        $collect = (array) json_decode($jcollect);
        return $collect;
    }
    public function get_num($uid = false) {
        return count($this->get_collects($uid));
    }
    public function get_collects_by_page($uid, $limit, $offset) {
        $collect = $this->get_collects($uid);
        $r = array_slice($collect, $offset, $limit);
        return $r;
    }
}
