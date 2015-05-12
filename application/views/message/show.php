<?php $this->load->view('layout/header', ['title' => '私信详情']) ?>
<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 pm-show">
        <?php //print_r($pm) ?>
        <div class="pm-title">
            <h3><?= $new_title ?></h3>
            <hr>
        </div>
        <div class="row">
        <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
            <?php $prefix = img_url() ?>
            <?php $suffix = '?imageView2/1/w/48/h/48' ?>
            <img src="<?= $prefix . $other_avatar . $suffix ?>" class="img-rounded">
        </div>
        <div class="col-lg-11 col-md-11 col-sm-10 col-xs-10">
            <form method="post" action="<?= site_url('message/send/inbox') ?>">
                <div class="pm-info">
                    <!--
                    <span>与 <?= $other_sdnuinfo->name ?>(<?= $other_sdnuinfo->user_id ?>) 的私信对话</span>
                    -->
                    <span>与 <strong><?= $other_sdnuinfo->name ?></strong> 的私信对话</span>
                    <?php if($type == 'inbox') : ?>
                    <input type="submit" value="回复消息" class="btn btn-primary form-group">
                    <?php elseif($type == 'outbox') : ?>
                    <input type="submit" value="继续追问" class="btn btn-primary form-group">
                    <?php endif; ?>
                </div>
                <textarea name="message" rows="4" class="form-control form-group" placeholder="请输入信息内容"></textarea>
            </form>
            <div class="well well-sm"><?= $pm->message ?></div>
        </div>
    </div>
    </div> <!-- end of row -->
    <div class="col-lg-3 col-md-3 col-sm-4 hidden-xs">
        <div class="alert alert-info">
            欢迎使用私信功能，私信交流能够有效保证交易安全哦！
        </div>
        <div class="list-group">
            <a href="<?= site_url('message/index/inbox') ?>" class="list-group-item">收件箱</a>
            <a href="<?= site_url('message/index/outbox') ?>" class="list-group-item">发件箱</a>
         </div>
    </div>
</div>
<?php $this->load->view('layout/footer', ['tab' => '2']) ?>
