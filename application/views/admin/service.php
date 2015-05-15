<?php $this->load->view('layout/header', ['title' => '服务条款']) ?>
<div class="row">
    <div class="col-xs-12">
        <ul class="breadcrumb">
            <li>
                <a href="<?= site_url() ?>">跳蚤市场</a>
            </li>
            <li>
                <a href="<?= site_url('admin/index') ?>">后台管理</a>
            </li>
            <li class="active">
                服务条款
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <form method="post" action="<?= site_url('admin/service') ?>" name="creator">
            <div class="form-group">
                <label>请输入服务条款（支持HTML标签）</label>
                <input type="submit" value="提交修改" class="btn btn-danger pull-right">
            </div>
            <div class="form-group">
                <?php $this->load->view('admin/kindeditor'); ?>
            </div>
        </form>
    </div>
</div>
<?php $this->load->view('layout/footer') ?>
