<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Su extends CI_Controller {
	function __construct() {
		parent::__construct();
		if( ! $this->aauth->is_admin()) {
			redirect();
		}
	}
    public function index() {
        echo '<h1>hello, super user.</h1>';
        echo '<p>you can access here with admin's Permission.</p>'
    }
    public function add_member() {
        $user_id = $this->uri->segment(3);
        $group_par = $this->uri->segment(4);
        $this->aauth->add_member($user_id, $group_par);
        echo "add member $user_id to $group_par.";
    }
}
