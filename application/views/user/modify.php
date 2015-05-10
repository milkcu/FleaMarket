<?php $this->load->view('layout/header' , ['title' => '资料修改']) ?>
<div class="row">
    <div class="col-lg-offset-4 col-lg-4 col-xs-offset-1 col-xs-10">
        <form method="post" action="modify">
           <div class="row form-group">
                <div class="col-lg-3 col-xs-3"><label>姓名</label></div>
                <div class="col-lg-9 col-xs-9"><input type="text" class="form-control" value="<?= $sdnuinfo->name ?>" disabled></div>
            </div>
            <div class="row form-group">
                <div class="col-lg-3 col-xs-3"><label>邮箱</label></div>
                <div class="col-lg-9 col-xs-9"><input name="email" value="<?= $contact->email ?>" type="text" class="form-control" autocomplete="off"></div>
            </div>
            <div class="row form-group">
                <div class="col-lg-3 col-xs-3"><label>手机</label></div>
                <div class="col-lg-9 col-xs-9"><input name="phone" value="<?= $contact->phone ?>" type="text" class="form-control" autocomplete="off"></div>
            </div>
            <div class="row form-group">
                <div class="col-xs-3 col-xs-3"><label>QQ</label></div>
                <div class="col-xs-9 col-xs-9"><input name="qq" value="<?= $contact->qq ?>" type="text" class="form-control" autocomplete="off"></div>
            </div>
            <div class="row form-group">
                <div class="col-xs-3 col-xs-3"><label>头像</label></div>
                <div class="col-xs-9 col-xs-9">
                    <?php $this->load->view('user/html5_upload') ?>
                    <input name="avatar" value="<?= $avatar ?>" type="hidden" class="form-control">
                    <a class="form-control btn btn-primary" href="javascript:void(0)" onclick="javascript:document.getElementById('user-avatar-upload').click()">上传新头像</a>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-9 col-lg-offset-3 col-xs-9 col-xs-offset-3" id="user-avatar-preview">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12 col-xs-12"><input type="submit" value="修改信息" class="form-control btn btn-primary"></div>
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
