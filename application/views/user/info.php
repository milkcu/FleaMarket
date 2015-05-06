<?php $this->load->view('layout/header', ['title' => '个人信息']) ?>
<div class="row">
    <div class="col-xs-12">
        <div class="list-group">
            <span class="list-group-item">
                <?= $sdnuinfo->name ?>
                （第<?= $user->id ?>位用户）
            </span>
            <span class="list-group-item">
                用户编号：
                <?= $sdnuinfo->user_id ?>
            </span>
            <span class="list-group-item">
                学院：
                <?= $sdnuinfo->organization_name ?>
            </span>
            <span class="list-group-item">
                用户类别：
                <?php if($sdnuinfo->user_type == 0) : ?>
                本科生
                <?php elseif($sdnuinfo->user_type == 1) : ?>
                研究生
                <?php elseif($sdnuinfo->user_type == 2) : ?>
                教职工
                <?php endif; ?>
            </span>
        </div>
        <div class="list-group">
            <span class="list-group-item">邮箱： <?= $contact->email ?></span>
            <span class="list-group-item">手机： <?= $contact->phone ?></span>
            <span class="list-group-item">QQ： <?= $contact->qq ?></span>
        </div>
        <div class="list-group">
            <span class="list-group-item">登录IP：<?= $user->ip_address ?></span>
            <span class="list-group-item">注册时间：<?= $user->created_on ?></span>
            <span class="list-group-item">上次登录：<?= $user->last_login ?></span>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer', ['tab' => '3']) ?>
