<?php $this->load->view('layout/header', ['title' => '目录管理']) ?>
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
                目录管理
            </li>
        </ul>
    </div>
</div>
<div class="row">
<?php $i = 1 ?>
<?php foreach($categories as $cat) : ?>
    <div class="col-xs-6">
        <div class="well">
            <div class="row">
                <form method="post" action="<?= site_url('admin/category/' . $i++) ?>">
                    <div class="col-xs-3" id="category-icon-preview-<?= $i ?>">
                        <img src="<?= img_url($cat->icon . '?imageView2/1/w/100/h/100') ?>">
                        <input type="hidden" name="icon" value="<?= $cat->icon ?>">
                        <?php $this->load->view('admin/html5_upload') ?>
                    </div>
                    <div class="col-xs-9">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <input type="text" name="name" value="<?= $cat->name ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <a href="javascript:void(0)" onclick="javascript:myclick(<?= $i ?>)" class="btn btn-primary form-control">上传图片</a>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <input type="submit" value="提交修改" class="btn btn-danger form-control">
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <textarea name="detail" class="form-control"><?= $cat->detail ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
<?php $this->load->view('layout/footer') ?>
