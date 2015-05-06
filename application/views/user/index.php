<?php $this->load->view('layout/header', ['title' => '个人主页']) ?>
<div class="row">
    <div class="col-xs-12">
        <div class="well well-sm">
            <div class="row">
                <div class="col-xs-4">
                    <img src="http://milkcu.qiniudn.com/sdnuflea/<?= $avatar ?>?imageView2/1/w/100/h/100" class="pull-left img-rounded" style="width: 100%; height: 100%">
                </div>
                <div class="col-xs-8">
                    <h3><?= $sdnuinfo->name ?></h3>
                    <p><?= $sdnuinfo->organization_name ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="list-group">
            <a href="<?= site_url('product/create') ?>" class="list-group-item">发布宝贝</a>
            <a href="<?= site_url('user/show') ?>" class="list-group-item">宝贝管理</a>
            <a href="<?= site_url('user/modify') ?>" class="list-group-item">资料修改</a>
            <a href="<?= site_url('user/info') ?>" class="list-group-item">信息查看</a>
            <a href="<?= site_url('user/logout') ?>" class="list-group-item">用户退出</a>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer', ['tab' => '3']) ?>
