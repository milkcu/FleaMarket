<?php $this->load->view('layout/header', ['title' => '发布求购']) ?>
<div class="row">
    <div class="col-xs-12">
        <ul class="nav nav-tabs" style="margin-bottom: 20px;">
            <li>
                <a href="<?= site_url('want/index') ?>">求购圈</a>
            </li>
            <li class="active">
                <a href="<?= site_url('want/mine') ?>">我的求购</a>
            </li>
            <a href="<?= site_url('want/create') ?>" class="btn btn-success btn-sm pull-right">
                <i class="fa fa-plus"></i> 发布
            </a>
        </ul>
        <form method="post" action="create" name="creator">
            <div class="form-group">
                <label>请输入求购信息：</label>
            </div>
            <div class="form-group">
                <textarea name="content" rows="4" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="发布求购信息" class="btn btn-primary form-control">
            </div>
        </form>
    </div>
    <div class="col-xs-12">
        <?php if(validation_errors() != '') : ?>
        <div class="alert alert-danger">
            <?= validation_errors() ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $this->load->view('layout/footer', ['tab' => '4']) ?>
