<?php $this->load->view('layout/header' , ['title' => '资料修改']) ?>
<div class="row">
    <div class="col-lg-offset-4 col-lg-4 col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-12">
        <form method="post" action="modify">
           <div class="row form-group">
                <div class="col-lg-2 col-xs-2"><label>姓名</label></div>
                <div class="col-lg-10 col-xs-10"><input type="text" class="form-control" value="<?= $sdnuinfo->name ?>" disabled></div>
            </div>
            <div class="row form-group">
                <div class="col-lg-2 col-xs-2"><label>邮箱</label></div>
                <div class="col-lg-10 col-xs-10">
                    <div class="input-group">
                        <input name="email" value="<?= isset($contact->email) ? $contact->email : '' ?>" type="text" class="form-control" autocomplete="off" placeholder="必填" required>
                        <label class="input-group-addon"><input type="checkbox" name="public[]" value="email"
                            <?php if(isset($contact->public) && in_array('email', $contact->public)) echo 'checked'; ?>> 公开</label>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-2 col-xs-2"><label>手机</label></div>
                <div class="col-lg-10 col-xs-10">
                    <div class="input-group">
                        <input name="phone" value="<?= isset($contact->phone) ? $contact->phone : '' ?>" type="text" class="form-control" autocomplete="off" placeholder="选填">
                        <label class="input-group-addon"><input type="checkbox" name="public[]" value="phone"
                            <?php if(isset($contact->public) && in_array('phone', $contact->public)) echo 'checked'; ?>> 公开</label>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-2 col-xs-2"><label>QQ</label></div>
                <div class="col-lg-10 col-xs-10">
                    <div class="input-group">
                        <input name="qq" value="<?= isset($contact->qq) ? $contact->qq : ''  ?>" type="text" class="form-control" autocomplete="off" placeholder="选填">
                        <label class="input-group-addon"><input type="checkbox" name="public[]" value="qq"
                            <?php if(isset($contact->public) && in_array('qq', $contact->public)) echo 'checked'; ?>> 公开</label>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-2 col-xs-2"><label>头像</label></div>
                <div class="col-lg-10 col-xs-10">
                    <?php $this->load->view('user/html5_upload') ?>
                    <input name="avatar" value="<?= $avatar ?>" type="hidden" class="form-control">
                    <a class="form-control btn btn-default" href="javascript:void(0)" onclick="javascript:document.getElementById('user-avatar-upload').click()">上传新头像</a>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-8 col-lg-offset-2 col-xs-8 col-xs-offset-2" id="user-avatar-preview">
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
