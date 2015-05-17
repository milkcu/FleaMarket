<?php $this->load->view('layout/header', ['title' => '首页滚动图片设置']) ?>
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
                首页滚动图片设置
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <form method="post" action="<?= site_url('admin/carousel') ?>">
            <div class="well">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-9">
                            <label>在这里更换首页顶部图片（图片原始宽度为1140）：</label>
                        </div>
                        <div class="col-xs-1">
                            <a href="javascript:void(0)" onclick="javascript:document.getElementById('admin-imgshead-upload').click()" class="btn btn-primary">上传图片</a>
                        </div>
                        <div class="col-xs-1">
                            <input type="submit" value="提交修改" class="btn btn-danger">
                        </div>
                    </div>
                </div>
                <div id="progress" class="progress">
                    <div class="bar progress-bar progress-bar-success" style="width: 0%;"></div>
                </div>
            </div>
            <div class="row" id="admin-imgshead-preview">
                <?php foreach($imgshead as $img) : ?>
                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-6" id="<?= $img ?>">
                    <div class="media alert alert-success" style="text-align: center;">
                        <img src="<?= img_url($img) ?>" alt="上传成功" style="width: 96%">
                        <div class="media-body" style="margin-top: -10px; margin-right: -10px; float: right;">
                            <button class="close" data-dismiss="modal" type="button" onclick="del_div('<?= $img ?>')">×</button>
                        </div>
                        <input type="hidden" name="imgs[]" value="<?= $img ?>">
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </form>
    </div>
</div>
<?php $this->load->view('admin/imgshead_upload') ?>
<?php $this->load->view('layout/footer') ?>
