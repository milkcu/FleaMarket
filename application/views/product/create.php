<?php $this->load->view('layout/header', ['title' => '发布宝贝']) ?>
<form method="post" action="create" name="creator">
    <div class="col-xs-8">
        <div class="row form-group">
            <div class="col-xs-10">
                <input name="title" value="<?= set_value('title') ?>" type="text" class="form-control" placeholder="请输入宝贝名称" autocomplete="off" required>
            </div>
            <div class="col-xs-2">
                <input type="submit" value="发布" class="form-control btn btn-primary">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-xs-3">
                <select name="cid" class="form-control">
                    <option value="0" <?= set_select('cid', '0', TRUE) ?>>请选择分类</option>
                    <option value="1" <?= set_select('cid', '1') ?>>图书教材</option>
                    <option value="2" <?= set_select('cid', '2') ?>>手机数码</option>
                    <option value="3" <?= set_select('cid', '3') ?>>电脑配件</option>
                    <option value="4" <?= set_select('cid', '4') ?>>运动户外</option>
                    <option value="5" <?= set_select('cid', '5') ?>>衣物百货</option>
                    <option value="6" <?= set_select('cid', '6') ?>>生活娱乐</option>
                </select>
            </div>
            <div class="col-xs-2">
                <div class="input-group">
                	<input name="original" value="<?= set_value('original') ?>" type="text" class="form-control" placeholder="原价" autocomplete="off" required>
                	<span class="input-group-addon">元</span>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="input-group">
                	<input name="current" value="<?= set_value('current') ?>" type="text" class="form-control" placeholder="现价" autocomplete="off" required>
                	<span class="input-group-addon">元</span>
                </div>
            </div>
            <div class="col-xs-3">
                <input name="place" value="<?= set_value('place') ?>" type="text" class="form-control" placeholder="交易地点" autocomplete="off" required>
            </div>
            <div class="col-xs-2">
                <a class="form-control btn btn-primary" href="javascript:void(0)" onclick="javascript:document.getElementById('product-image-upload').click()">上传图片</a>
            </div>
        </div>
        <div class="row form-group">
        	<div class="col-xs-12">
	        	<?php $this->load->view('product/kindeditor') ?>
	        	<!--
	            <textarea name="detail" rows="8" class="form-control" placeholder="请输入宝贝描述"></textarea>
	           -->
           </div>
        </div>
    </div>
    <div class="col-xs-4">
        <?php if(validation_errors() != '') : ?>
        <div class="alert alert-danger">
            <div class="product-create-sidebar-title">
                <label class="label label-danger">表单错误提示</label>
            </div>
        	<?= validation_errors() ?>
        </div>
        <?php endif; ?>
        <div class="alert alert-info product-image-progress">
            <div class="product-create-sidebar-title">
                <label class="label label-success">图片上传进度</label>
            </div>
            <div id="progress" class="progress">
                <div class="bar progress-bar progress-bar-success" style="width: 0%;"></div>
            </div>
            <div>
               拖动到这里快速上传，支持上传多张图片
            </div>
        </div>
        <div class="row" id="product-image-create">
            <?php $this->load->view('product/basic_upload') ?>
            <?php $images = set_value('images') ?>
            <?php if($images != '') : ?>
            <div class="col-xs-6" id="<?= $images ?>">
				<div class="media alert alert-success">
					<a href="http://milkcu.qiniudn.com/sdnuflea/<?= $images ?>" class="pull-left" target="_blank">
						<img src="http://milkcu.qiniudn.com/sdnuflea/<?= $images ?>?imageView2/1/w/100/h/100">
					</a>
                    <div class="media-body">
                    <button class="close" data-dismiss="modal" type="button" onclick="deldiv('<?= $images ?>')">×</button>
                        上传成功
                    </div>
					<input type="hidden" name="images[]" value="<?= $images ?>">
				</div>
			</div>
            <?php endif; ?>
        </div>
        <div class="alert alert-warning">
            这里是发布宝贝的注意事项。支持文件多选拖拽进度条跨域分块续传。几成新在描述里填写。danger
            为了保证交易安全，宝贝信息已经发布，不再支持修改。
        </div>
    </div>
</form>
<?php $this->load->view('layout/footer') ?>
