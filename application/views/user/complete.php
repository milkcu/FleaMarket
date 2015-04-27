<?php $this->load->view('layout/header', ['title' => '完成登录']) ?>
<form method="post" action="complete">
    <div class="row form-group">
        <div class="col-md-1 col-md-offset-4"><label>学号</label></div>
        <div class="col-md-3"><input type="text" class="form-control" value="<?= $user_id ?>" disabled></div>
    </div>
    <div class="row form-group">
        <div class="col-md-1 col-md-offset-4"><label>姓名</label></div>
        <div class="col-md-3"><input type="text" class="form-control" value="<?= $name ?>" disabled></div>
    </div>
    <div class="row form-group">
        <div class="col-md-1 col-md-offset-4"><label>学院</label></div>
        <div class="col-md-3"><input type="text" class="form-control" value="<?= $organization_name ?>" disabled></div>
    </div>
    <div class="row form-group">
        <div class="col-md-1 col-md-offset-4"><label>邮箱</label></div>
        <div class="col-md-3"><input name="email" type="text" value="<?= set_value('email') ?>" class="form-control" required autocomplete="off"></div>
    </div>
    <div class="row form-group">
        <div class="col-md-1 col-md-offset-4"><label>手机</label></div>
        <div class="col-md-3"><input name="phone" type="text" value="<?= set_value('phone') ?>" class="form-control" required autocomplete="off"></div>
    </div>
    <div class="row form-group">
        <div class="col-md-1 col-md-offset-4"><label>QQ</label></div>
        <div class="col-md-3"><input name="qq" type="text" value="<?= set_value('qq') ?>" class="form-control" required autocomplete="off"></div>
    </div>
    <input type="hidden" name="avatar" value="user_avatar_default.jpg">
    <div class="row form-group">
        <div class="col-md-4 col-md-offset-4"><input type="submit" value="完善信息并登陆" class="form-control btn btn-primary"></div>
    </div>
    <div>
    	<?= validation_errors() ?>
    </div>
</form>
<?php $this->load->view('layout/footer') ?>
