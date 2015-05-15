<?php $this->load->view('layout/header', ['title' => '欢迎私信']) ?>
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
                欢迎私信
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <form method="post" action="<?= site_url('admin/initpm') ?>" name="creator">
            <div class="form-group">
                <label>请输入用户第一次登录时向用户发送的欢迎私信</label>
                <input type="submit" value="提交修改" class="btn btn-danger pull-right">
            </div>
            <div class="form-group">
                <textarea name="txt" rows="6" class="form-control"><?= $txt ?></textarea>
            </div>
        </form>
    </div>
</div>
<?php $this->load->view('layout/footer') ?>
