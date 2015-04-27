<header class="navbar navbar-inverse navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<a href="<?php echo site_url(); ?>" class="navbar-brand">跳蚤市场</a>
		</div>
		<nav>
			<ul class="nav navbar-nav">
				<li><a href="<?= site_url('product/index/1') ?>">图书教材</a></li>
				<li><a href="<?= site_url('product/index/2') ?>">手机数码</a></li>
				<li><a href="<?= site_url('product/index/3') ?>">电脑配件</a></li>
				<li><a href="<?= site_url('product/index/4') ?>">运动户外</a></li>
				<li><a href="<?= site_url('product/index/5') ?>">衣物百货</a></li>
				<li><a href="<?= site_url('product/index/6') ?>">生活娱乐</a></li>
			</ul>

			<form class="navbar-form pull-left" action="<?= site_url('product/search') ?>" method="post">
				<div class="input-group">
					<input type="text" name="q" class="form-control" placeholder="宝贝搜索" required>
					<span class="input-group-btn">
						<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
					</span>
				</div>
			</form>

			<ul class="nav navbar-nav navbar-right nav-user-manager">
				<?php if(! $this->aauth->is_loggedin()) : ?>
				<li class="active"><a href="<?= site_url('user/login') ?>"><i class="fa fa-sign-in"></i>登录</a></li>
				<?php else : ?>
                <li class="">
                <a href="<?= site_url('message/index/inbox') ?>">
                    <i class="fa fa-envelope-o"></i>
                    <?php $pmnum = $this->aauth->count_unread_pms() ?>
                    <?php if($pmnum > 0) : ?>
                    <span class="badge pm-nav"><?= $pmnum ?></span>
                    <?php endif; ?>
                </a>
                </li>
				<li class="dropdown active">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<?php $jsdnuinfo = $this->aauth->get_user_var('sdnuinfo') ?>
						<?php $sdnuinfo = json_decode($jsdnuinfo) ?>
						<?= $sdnuinfo->name ?>
						<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?= site_url('product/create') ?>"><i class="fa fa-pencil"></i>发布宝贝</a></li>
						<li><a href="<?= site_url('user/show') ?>"><i class="fa fa-book"></i>宝贝管理</a></li>
						<li><a href="<?= site_url('message/index/inbox') ?>"><i class="fa fa-envelope"></i>我的私信</a></li>
						<li><a href="<?= site_url('user/modify') ?>"><i class="fa fa-user"></i>资料修改</a></li>
						<li><a href="<?= site_url('user/logout') ?>"><i class="fa fa-sign-out"></i>用户退出</a></li>
					</ul>
				</li>
				<?php endif; ?>
			</ul>

		</nav>
	</div>
</header>
