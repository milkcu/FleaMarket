<?php $this->load->view('layout/header', ['title' => '后台管理']) ?>
<div class="row">
    <div class="col-xs-12">
        <ul class="breadcrumb">
            <li>
                <a href="<?= site_url() ?>">跳蚤市场</a>
            </li>
            <li class="active">
                后台管理
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="well">
            <a href="<?= site_url('admin/product') ?>">宝贝管理</a>
        </div>
        <div class="well">
            <a href="<?= site_url('admin/category') ?>">目录管理</a>
        </div>
        <div class="well">
            <a href="<?= site_url('admin/setting') ?>">系统设置</a>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer') ?>
