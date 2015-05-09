<?php $this->load->view('layout/header', ['title' => '求购列表']) ?>
<div class="row">
    <div class="col-xs-12">
        <ul class="nav nav-tabs" style="margin-bottom: 20px;">
            <li class="active">
                <a href="<?= site_url('want/index') ?>">求购圈</a>
            </li>
            <li>
                <a href="<?= site_url('want/create') ?>">我的求购</a>
            </li>
            <a href="<?= site_url('want/create') ?>" class="btn btn-success btn-sm pull-right">
                <i class="fa fa-plus"></i> 发布
            </a>
        </ul>
    </div>
    <?php foreach($wants as $w) : ?>
    <div class="col-xs-2">
        <img src="<?= img_url($w->avatar . '?imageView2/1/w/48/h/48') ?>">
    </div>
    <div class="col-xs-10">
        <div class="well well-sm">
            <strong><?= $w->sdnuinfo->name ?> 求购于 <?= $w->created ?></strong>
            <br>
            <p><?= $w->content ?></p>
            <?php if($w->state == 'wait') : ?>
                <span class="label label-success">正在求购</span>
                <a href="" class="btn btn-xs btn-primary pull-right">私信聊聊</a>
            <?php else : ?>
                <span class="label label-danger">求购完成</span>
                <span class="label label-default pull-right">私信聊聊</span>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="list-pagination hidden-xs">
        <?php echo $this->pagination->create_links() ?>
    </div>
    <div class="list-pagination hidden-lg">
        <?php $config['display_pages'] = FALSE ?>
        <?php $this->pagination->initialize($config) ?>
        <?php echo $this->pagination->create_links() ?>
    </div>
</div>
<?php $this->load->view('layout/footer', ['tab' => '4']) ?>
