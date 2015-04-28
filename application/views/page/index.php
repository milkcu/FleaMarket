<?php $this->load->view('layout/header', ['title' => '首页']) ?>
<div class="container">
	<div class="col-xs-12 index-sdnu-head">
		<img src="http://milkcu.qiniudn.com/sdnuflea/2015040518504149-3.jpg">
		<span>跳蚤市场</span>
	</div>
</div>
<div class="container">
	<div class="col-xs-9">
		<div class="well">
			<div class="row index-feature-all">
				<div class="col-xs-7">
					<p class="index-feature-first">闲置市场，最爱跳蚤</p>
					<p class="index-feature-second">用着不对，卖了重配</p>
				</div>
				<div class="col-xs-5">
					<ul>
						<li class="list-unstyled index-feature-quick">
							<i class="fa fa-clock-o"></i>
							快速：一键发布告别蹲点守候
						</li>
						<li class="list-unstyled index-feature-secure">
							<i class="fa fa-shield"></i>
							安全：身份认证保证交易安全
						</li>
						<li class="list-unstyled index-feature-profession">
							<i class="fa fa-graduation-cap"></i>
							专业：专注于闲置物品的交易
						</li>
						<li class="list-unstyled index-feature-chance">
							<i class="fa fa-institution"></i>
							机会：给你一次当老板的机会
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<?php $prefix = 'http://milkcu.qiniudn.com/sdnuflea/' ?>
			<?php $suffix = '?imageView2/1/w/100/h/100' ?>
			<?php foreach($categories as $c) : ?>
			<div class="col-xs-6">
				<div class="well index-category-all">
					<a href="<?= site_url('product/index/' . $c->cid) ?>">
						<img src="<?= $prefix . $c->icon . $suffix ?>">
					</a>
					<h2><?= $c->name ?></h2>
					<p><?= $c->detail ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="col-xs-3">
		<div class="well index-welcome">
			<!--
			<ul class="list-group">
				<li class="list-group-item"><a>宝贝管理</a></li>
				<li class="list-group-item"><a>发布宝贝</a></li>
				<li class="list-group-item"><a>我的宝贝</a></li>
				<li class="list-group-item"><a>我的私信</a></li>
				<li class="list-group-item"><a>资料修改</a></li>
			</ul>
			-->
			<h2>欢迎来到跳蚤市场</h2>
			<p>一个接地气的二手市场，专注于闲置物品的校园交易。</p>
			<?php if($this->aauth->is_loggedin()) : ?>
			<a href="<?= site_url('product/create') ?>" class="btn btn-primary">发布闲置&nbsp;&nbsp;快速出手</a>
			<?php else : ?>
			<a href="<?= site_url('user/login') ?>" class="btn btn-primary">使用智慧山师账号登录</a>
			<?php endif; ?>
		</div>
		<div class="loggedin">

		</div>
		<div class="well index-qrcode-app">
			<h4>移动客户端正在开发中</h4>
			<img src="http://milkcu.qiniudn.com/sdnuflea/2015040623253232-3.jpg?imageView2/1/h/208/w/208">
		</div>
		<div class="index-feedback">
			<form>
				<div class="panel panel-warning">
					<div class="panel-heading">
						 用户反馈
						<input class="btn btn-warning btn-xs pull-right" type="submit" value="发送">
					</div>
					<div class="panel-body">
						<input type="hidden" value="3" name="receiver_id">
						<input type="hidden" value="来自首页的用户反馈" name="title">
						<textarea class="form-control" placeholder="不足之处请反馈" name="message"></textarea>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $this->load->view('layout/footer') ?>
