<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
    public function post() {
        //header('Content-Type: application/json');
        //header('HTTP/1.0 200 ok');
        echo 'test/post';
        print_r($_FILES);
        print_r($_POST);
        print_r($_GET);
    }
    public function qiniu() {
        $conf = array('ak' => 'A2o1e1u2qqPQECn3VWxL5BcGGmSWX3n2KhXgK7Rx',
                        'sk' => 'EUkbMnHf2BNrqOx49-VGz7cUhiwd52Y82mne1zaL',
                        'bucket' => 'milkcu',
                        'auth' => 'public');
        $this->load->library('qiniu', $conf);
        $this->qiniu->put_policy->init();
        //使用批量设置
        $arr = array(
            Qiniu_put_policy::QINIU_PP_SCOPE => 'milkcu',
            Qiniu_put_policy::QINIU_PP_DEADLINE => time()+7200,
            Qiniu_put_policy::QINIU_PP_SAVE_KEY => 'mysdnutestbase64.jpg'
            );
        $this->qiniu->put_policy->set_policy_array($arr);
        $token = $this->qiniu->put_policy->get_token();
        print_r($arr);
        ?>
        <form method="post" action="http://upload.qiniu.com/" enctype="multipart/form-data">
            <input name="token" type="hidden" value="<?php echo $token;?>">
          <input name="file" type="file" />
          <input type="submit" />
        </form>
        <?php
    }
}
