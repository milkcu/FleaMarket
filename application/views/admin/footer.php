<?php $this->load->view('layout/header', ['title' => '页脚编辑']) ?>
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
                页脚编辑
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <form method="post" action="<?= site_url('admin/footer') ?>">
            <div class="form-group">
                <label>页脚修改（支持HTML标签）</label>
                <input type="submit" value="提交修改" class="btn btn-danger pull-right">
            </div>
            <div class="form-group">
                <textarea name="txt" rows="6" class="form-control"><?= $txt ?></textarea>
            </div>
        </form>
    </div>
</div>
<?php $this->load->view('layout/footer') ?>
