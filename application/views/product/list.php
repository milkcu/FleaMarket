<?php $this->load->view('layout/header', ['title' => $category->name]) ?>
<?php $prefix = 'http://milkcu.qiniudn.com/sdnuflea/' ?>
<?php $suffix = '?imageView2/1/w/245/h/245' ?>
<div class="col-md-12">
	<ul class="breadcrumb">
		<li><a href="<?= site_url() ?>">跳蚤市场</a></li>
		<li class="active"><?= $category->name ?></li>
	</ul>
</div>
<div class="row">
	<div class="container">
		<?php foreach($products as $p) : ?>
		<div class="col-md-3">
			<div class="thumbnail">
            <a href="<?= site_url('product/show/' . $p->pid) ?>" title="<?= $p->title ?>">
					<img style="width: 100%" src="<?= $prefix . $p->images[0] . $suffix ?>" alt="thumbnail">
				</a>
				<div class="caption">
					<div class="list-product-title"><h3><?= $p->title ?></h3></div>
					<p>
						<?php if($p->state) : ?>
						<a class="btn btn-warning">已成交</a>
						<?php else : ?>
						<a class="btn btn-danger">￥<?= $p->current ?>元</a>
						<?php endif; ?>
						<!--
						<a class="btn btn-default pull-right" href="#">关注 (<?= $p->follows ?>)</a>
						-->
						<a class="btn btn-primary  pull-right" href="<?= site_url('product/show/' . $p->pid) ?>">浏览 (<?= $p->views ?>)</a>
					</p>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<div class="row">
	<div class="container list-pagination">
		<?php echo $this->pagination->create_links() ?>
	</div>
</div>
<?php $this->load->view('layout/footer') ?>
