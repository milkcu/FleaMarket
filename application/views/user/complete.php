<?php $this->load->view('layout/header', ['title' => '完成登录']) ?>
<div class="row">
    <div class="col-lg-offset-4 col-lg-4 col-xs-12">
        <form method="post" action="complete">
            <div class="row form-group">
                <div class="col-lg-2 col-xs-2"><label>学号</label></div>
                <div class="col-lg-10 col-xs-10"><input type="text" class="form-control" value="<?= $user_id ?>" disabled></div>
            </div>
            <div class="row form-group">
                <div class="col-lg-2 col-xs-2"><label>姓名</label></div>
                <div class="col-lg-10 col-xs-10"><input type="text" class="form-control" value="<?= $name ?>" disabled></div>
            </div>
            <div class="row form-group">
                <div class="col-lg-2 col-xs-2"><label>学院</label></div>
                <div class="col-lg-10 col-xs-10"><input type="text" class="form-control" value="<?= $organization_name ?>" disabled></div>
            </div>
            <div class="row form-group">
                <div class="col-lg-2 col-xs-2"><label>邮箱</label></div>
                <div class="col-lg-10 col-xs-10">
                    <div class="input-group">
                        <input name="email" type="text" value="<?= set_value('email') ?>" class="form-control" required autocomplete="off" placeholder="必填">
                        <label class="input-group-addon"><input type="checkbox" name="public[]" value="email"> 公开</label>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-2 col-xs-2"><label>手机</label></div>
                <div class="col-lg-10 col-xs-10">
                    <div class="input-group">
                        <input name="phone" type="text" value="<?= set_value('phone') ?>" class="form-control" required autocomplete="off" placeholder="必填">
                        <label class="input-group-addon"><input type="checkbox" name="public[]" value="phone"> 公开</label>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-2 col-xs-2"><label>QQ</label></div>
                <div class="col-lg-10 col-xs-10">
                    <div class="input-group">
                        <input name="qq" type="text" value="<?= set_value('qq') ?>" class="form-control" autocomplete="off" placeholder="选填">
                        <label class="input-group-addon"><input type="checkbox" name="public[]" value="qq"> 公开</label>
                    </div>
                </div>
            </div>
            <input type="hidden" name="avatar" value="mysdnu-user-avatar-default.jpg">
            <div class="row form-group">
                <div class="col-lg-12 col-xs-12"><input type="submit" value="完善信息并登陆" class="form-control btn btn-primary"></div>
            </div>
            <?php if(validation_errors() != '') : ?>
            <div class="alert alert-danger">
                <?= validation_errors() ?>
            </div>
            <?php endif; ?>
        </form>
    </div>
</div>
<?php $this->load->view('layout/footer', ['tab' => '3']) ?>
