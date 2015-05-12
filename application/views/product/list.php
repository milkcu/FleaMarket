<?php $this->load->view('layout/header', ['title' => $category->name]) ?>
<?php $prefix = img_url() ?>
<?php $suffix = '?imageView2/1/w/245/h/245' ?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ul class="breadcrumb">
            <li><a href="<?= site_url() ?>">跳蚤市场</a></li>
            <li class="active"><?= $category->name ?></li>
        </ul>
    </div>
</div>
<div class="row">
    <?php foreach($products as $p) : ?>
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
        <div class="thumbnail list-product-item">
            <a href="<?= site_url('product/show/' . $p->pid) ?>" title="<?= $p->title ?>">
                <img src="<?= $prefix . $p->images[0] . $suffix ?>" alt="thumbnail">
            </a>
            <div class="caption">
                <div class="list-product-title"><h3><?= $p->title ?></h3></div>
                <p>
                    <?php if($p->state) : ?>
                    <a class="btn btn-warning"><span class="hidden-xs">已</span>成交</a>
                    <?php else : ?>
                    <a class="btn btn-danger">￥<?= $p->current ?><span class="hidden-xs">元</span></a>
                    <?php endif; ?>
                    <!--
                    <a class="btn btn-default pull-right" href="#">关注 (<?= $p->follows ?>)</a>
                    -->
                    <a class="btn btn-primary  pull-right" href="<?= site_url('product/show/' . $p->pid) ?>">浏览<span class="hidden-xs"> (<?= $p->views ?>)</span></a>
                </p>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="list-pagination hidden-xs">
            <?php echo $this->pagination->create_links() ?>
        </div>
        <div class="list-pagination visible-xs">
            <?php $config['display_pages'] = FALSE ?>
            <?php $this->pagination->initialize($config) ?>
            <?php echo $this->pagination->create_links() ?>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer', ['tab' => '1']) ?>
