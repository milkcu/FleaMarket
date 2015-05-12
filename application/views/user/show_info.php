<div class="row user-show-info hidden-xs">
    <div class="col-lg-2 col-md-2 col-sm-3">
        <?php $prefix = img_url() ?>
        <?php $suffix = '?imageView2/1/w/120/h/120' ?>
        <img class="img-thumbnail" src="<?= $prefix . $avatar . $suffix ?>" alt=".img-thumbnail">
    </div>
    <div class="col-lg-3 col-md-3 col-sm-4">
        <p>
            <span class="label label-info">用户姓名</span>&nbsp;
            <?= $sdnuinfo->name ?>
            <span class="label label-default">第<?= $user->id ?>位用户</span>
        </p>
        <p>
            <span class="label label-info">学院单位</span>&nbsp;
            <?= $sdnuinfo->organization_name ?>
        </p>
        <p>
            <span class="label label-info">用户邮箱</span>&nbsp;
            <?= isset($contact->email) ? $contact->email : '<a href="' . site_url('user/modify') . '">点击填写</a>' ?>
        </p>
        <p>
            <span class="label label-info">联系方式</span>&nbsp;
            <a href="<?= site_url('user/modify') ?>">点击查看或修改</a>
        </p>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-5">
        <p>
            <span class="label label-info">用户编号</span>&nbsp;
            <?= $sdnuinfo->user_id ?>
        </p>
        <p>
            <span class="label label-info">用户类别</span>&nbsp;
            <?php if($sdnuinfo->user_type == 0) : ?>
            本科生
            <?php elseif($sdnuinfo->user_type == 1) : ?>
            研究生
            <?php elseif($sdnuinfo->user_type == 2) : ?>
            教职工
            <?php endif; ?>
        </p>
        <p>
            <span class="label label-info">注册时间</span>&nbsp;
            <?= $user->created_on ?>
        </p>
        <p>
            <span class="label label-info">上次登录</span>&nbsp;
            <?= $user->last_login ?>
        </p>
    </div>
    <div class="col-lg-4 col-md-4 hidden-sm">
        <div class="alert alert-info" style="margin-bottom: 0px;">
            <h4>欢迎使用跳蚤市场</h4>
            <p>跳蚤市场<span class="hidden-md">（www.mysdnu.com）</span>是专门为山师同胞打造的校内二手交易平台，用户身份均已认证，请放心使用，并在使用过程中遵守相关规定。</p>
        </div>
    </div>
</div>
