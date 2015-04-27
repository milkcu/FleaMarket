<?php $this->load->view('layout/header' , ['title' => '资料修改']) ?>
<form method="post" action="modify">
	<!--
    <div class="row form-group">
        <div class="col-md-1 col-md-offset-4"><label>学号</label></div>
        <div class="col-md-3"><input type="text" class="form-control" value="<?= $sdnuinfo->user_id ?>" disabled></div>
    </div>
    <div class="row form-group">
        <div class="col-md-1 col-md-offset-4"><label>学院</label></div>
        <div class="col-md-3"><input type="text" class="form-control" value="<?= $sdnuinfo->organization_name ?>" disabled></div>
    </div>
   -->
   <div class="row form-group">
        <div class="col-md-1 col-md-offset-4"><label>姓名</label></div>
        <div class="col-md-3"><input type="text" class="form-control" value="<?= $sdnuinfo->name ?>" disabled></div>
    </div>
    <div class="row form-group">
        <div class="col-md-1 col-md-offset-4"><label>邮箱</label></div>
        <div class="col-md-3"><input name="email" value="<?= $contact->email ?>" type="text" class="form-control" autocomplete="off"></div>
    </div>
    <div class="row form-group">
        <div class="col-md-1 col-md-offset-4"><label>手机</label></div>
        <div class="col-md-3"><input name="phone" value="<?= $contact->phone ?>" type="text" class="form-control" autocomplete="off"></div>
    </div>
    <div class="row form-group">
        <div class="col-md-1 col-md-offset-4"><label>QQ</label></div>
        <div class="col-md-3"><input name="qq" value="<?= $contact->qq ?>" type="text" class="form-control" autocomplete="off"></div>
    </div>
    <div class="row form-group">
        <div class="col-md-1 col-md-offset-4"><label>头像</label></div>
        <div class="col-md-3">
        	<?php $this->load->view('user/basic_upload') ?>
	        <input name="avatar" value="<?= $avatar ?>" type="hidden" class="form-control">
	        <a class="form-control btn btn-primary" href="javascript:void(0)" onclick="javascript:document.getElementById('user-avatar-upload').click()">上传新头像</a>
        </div>
    </div>
    <div class="row form-group">
    	<div class="col-md-3 col-md-offset-5" id="user-avatar-preview"></div>
	</div>
    <div class="row form-group">
        <div class="col-md-4 col-md-offset-4"><input type="submit" value="修改信息" class="form-control btn btn-primary"></div>
    </div>
    <div>
    	<?= validation_errors() ?>
    </div>
</form>

<?php $this->load->view('layout/footer') ?>
