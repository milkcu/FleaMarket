<?php $this->load->view('layout/header', ['title' => '免责声明']) ?>
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
                免责声明
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <form method="post" action="<?= site_url('admin/disclaimer') ?>" name="creator">
            <div class="form-group">
                <label>在这里修改免责声明（支持HTML标签）</label>
                <input type="submit" value="提交修改" class="btn btn-danger pull-right">
            </div>
            <div class="form-group">
                <?php $this->load->view('admin/kindeditor'); ?>
            </div>
        </form>
    </div>
</div>
<?php $this->load->view('layout/footer') ?>
