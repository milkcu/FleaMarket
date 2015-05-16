<?php $this->load->view('layout/header', ['title' => '帮助中心']) ?>
<div class="row">
    <div class="col-xs-12">
        <div class="alert alert-info">
            欢迎来到用户中心，遇到问题请反馈给我们，谢谢！
        </div>
        <div class="list-group">
            <a href="#modal-feedback" data-toggle="modal" class="list-group-item">用户反馈</a>
            <a href="<?= site_url('page/service') ?>" class="list-group-item">服务条款</a>
            <a href="<?= site_url('page/disclaimer') ?>" class="list-group-item">免责声明</a>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer', ['tab' => '3']) ?>
