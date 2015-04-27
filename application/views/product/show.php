<?php $this->load->view('layout/header', ['title' => $product->title . ' - ' . $product->category->name]) ?>
<div class="col-xs-12">
	<ul class="breadcrumb">
		<li><a href="<?= site_url() ?>">跳蚤市场</a></li>
		<li><a href="<?= site_url('product/index/' . $product->category->cid) ?>"><?= $product->category->name ?></a></li>
		<li class="active"><?= $product->title ?></li>
	</ul>
</div>
<div class="col-xs-6">
	<div class="carousel slide" id="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li class="active" data-slide-to="0" data-target="#carousel"></li>
			<?php for($i = 1; $i < count($product->images); $i++) : ?>
			<li data-slide-to="<?= $i ?>" data-target="#carousel"></li>
			<?php endfor; ?>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			<?php $prefix = 'http://milkcu.qiniudn.com/sdnuflea/' ?>
			<?php $suffix = '?imageView2/1/w/540/h/540' ?>
			<div class="item active">
				<img src="<?= $prefix . $product->images[0] . $suffix ?>" alt="First slide">
			</div>
			<?php for($i = 1; $i < count($product->images); $i++) : ?>
			<div class="item">
				<img src="<?= $prefix . $product->images[$i] . $suffix ?>" alt="Another slide">
			</div>
			<?php endfor; ?>
		</div>

		<!-- Controls -->
		<a class="left carousel-control" data-slide="prev" href="#carousel">
			<span class="icon-prev"></span>
		</a>
		<a class="right carousel-control" data-slide="next" href="#carousel">
			<span class="icon-next"></span>
		</a>
	</div>
</div>
<div class="col-xs-6">
	<div class="row">
		<div class="col-xs-7">
			<div class="alert alert-info product-info">
				<div class="product-title"><h2><?= $product->title ?></h2></div>
				<div class="product-price">
					<div class="product-current">
						<span class="label label-danger">￥ <?= $product->current ?></span>
					</div>
					<div class="product-original">
						<span class="label label-default">原价 <?= $product->original ?> 元</span>
					</div>
				</div>
				<div class="product-statistics">
					<p><?= $product->views ?> 次浏览 · <?php $product->state ? print('已经') : print('尚未') ?>成交</p>
				</div>

				<div class="product-line">
					<div class="product-key"><span class="label label-primary">交易地点</span></div>
					<div class="product-value"><?= $product->place ?></div>
				</div>
				<div class="product-line">
					<div class="product-key"><span class="label label-primary">发布时间</span></div>
					<div class="product-value"><?= $product->created ?></div>
				</div>
				<div class="product-line">
					<div class="product-key"><span class="label label-primary">商品分类<span></div>
					<div class="product-value"><?= $product->category->name ?></div>
				</div>
				<div class="row">
					<div class="product-jiathis">
						<!-- JiaThis Button BEGIN -->
						<div class="jiathis_style_32x32">
							<a class="jiathis_button_qzone"></a>
							<a class="jiathis_button_tsina"></a>
							<a class="jiathis_button_tqq"></a>
							<a class="jiathis_button_weixin"></a>
							<a class="jiathis_button_renren"></a>
							<a href="http://www.jiathis.com/share?uid=1636645" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
							<a class="jiathis_counter_style"></a>
						</div>
						<script type="text/javascript">
						var jiathis_config = {data_track_clickback:'true'};
						</script>
						<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1636645" charset="utf-8"></script>
						<!-- JiaThis Button END -->
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-5">
			<div class="alert alert-success product-user">
				<div>
					<?php $prefix = 'http://milkcu.qiniudn.com/sdnuflea/' ?>
	    			<?php $suffix = '?imageView2/1/w/140/h/140' ?>
					<img class="img-circle" src="<?= $prefix . $avatar . $suffix ?>" alt=".img-circle">
				</div>
				<div class="product-user-name">
					<span><?= $sdnuinfo->name ?></span>
				</div>
				<div class="product-user-type">
					<span class="label label-success">
						<?php if($sdnuinfo->user_type == 0) : ?>
						本科生
						<?php elseif($sdnuinfo->user_type == 1) : ?>
						研究生
						<?php elseif($sdnuinfo->user_type == 2) : ?>
						教职工
						<?php endif; ?>
					</span>
				</div>
				<div class="product-user-organization">
					<p><?= $sdnuinfo->organization_name ?></p>
				</div>
				<div class="product-user-contact">
					<?php if($this->aauth->is_loggedin()) : ?>
					<p><i class="fa fa-phone"></i><?= $contact->phone ?></p>
					<p><i class="fa fa-qq"></i><?= $contact->qq ?></p>
					<p><?= $contact->email ?></p>
					<?php else : ?>
					<p><i class="fa fa-phone"></i><?= substr($contact->phone, 0, 7) ?>****</p>
					<p><i class="fa fa-qq"></i><?= substr($contact->qq, 0, 6) ?>****</p>
					<p><?= substr($contact->email, 0, 3) ?>****<?= strstr($contact->email, '@') ?></p>
					<?php endif; ?>
                    <p>联系方式登录才可查看</p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<form method="post" action="<?= site_url('message/send/outbox') ?>">
				<div class="panel panel-warning product-user-chat">
				    <div class="panel-heading">
				    	私信聊聊
				    	<?php if($this->aauth->is_loggedin()) : ?>
				    	<input type="submit" value="发送" class="btn btn-warning btn-xs pull-right">
				    	<?php else : ?>
				    	<a href="<?= site_url('user/login') ?>" class="btn btn-warning btn-xs pull-right">登录</a>
				    	<?php endif; ?>
				   </div>
				    <div class="panel-body">
				    	<input type="hidden" name="receiver_id" value="<?= $product->uid ?>">
				    	<input type="hidden" name="title" value="<?= $product->pid ?>">
				    	<?php if($this->aauth->is_loggedin()) : ?>
				    	<textarea name="message" class="form-control" placeholder="有什么不明白的可以向卖家咨询哦"></textarea>
				    	<?php else : ?>
				    	<div class="product-user-chat-unloggedin">
				    		<span class="label label-warning">登录后才可显示联系方式并使用私信功能</span>
				    	</div>
				    	<?php endif; ?>
				    </div>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="col-xs-12">
	<div class="well product-detail">
		<p><?= $product->detail ?></p>
	</div>
</div>
<?php $this->load->view('layout/footer') ?>
