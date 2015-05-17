<?php $this->load->view('layout/header', ['title' => '系统设置']) ?>
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
                系统设置
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="well">
            <form method="post" action="<?= site_url('admin/setting/head') ?>">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-9">
                            <label>在这里更换首页顶部图片（图片原始宽度为1140）：</label>
                        </div>
                        <div class="col-xs-1">
                            <a href="javascript:void(0)" onclick="javascript:myclick(1)" class="btn btn-primary">上传图片</a>
                        </div>
                        <div class="col-xs-1">
                            <input type="submit" value="提交修改" class="btn btn-danger">
                        </div>
                    </div>
                </div>
                <div class="form-group" id="setting-img-preview-1">
                    <img src="<?= img_url($imghead) ?>" style="width: 100%">
                </div>
            </form>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="well">
            <form method="post" action="<?= site_url('admin/setting/qrcode') ?>">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-7">
                            <label>二维码</label>
                        </div>
                        <div class="col-xs-2">
                            <a href="javascript:void(0)" onclick="javascript:myclick(2)" class="btn btn-primary">上传图片</a>
                        </div>
                        <div class="col-xs-2">
                            <input type="submit" value="提交修改" class="btn btn-danger">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-6 col-xs-offset-3" id="setting-img-preview-2">
                            <img src="<?= img_url($imgqrcode) ?>" style="width: 100%;">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-xs-6">
        <pre>
        <?php print_r($settings) ?>
        </pre>
    </div>
</div>
<?php $this->load->view('admin/html5_upload2') ?>
<?php $this->load->view('layout/footer') ?>
