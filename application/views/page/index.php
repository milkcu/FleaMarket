<?php $this->load->view('layout/header', ['title' => '首页']) ?>
<div class="row visible-sm visible-xs">
    <div class="col-xs-12">
        <div class="well well-sm">
            <form action="<?= site_url('product/search') ?>" method="post">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="宝贝搜索" required>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row hidden-xs">
	<div class="col-lg-12 col-md-12 col-sm-12 index-sdnu-head">
        <img src="<?= img_url($imghead) ?>">
	</div>
</div>
<div class="row">
	<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
		<div class="well hidden-xs index-feature-all">
			<div class="row">
				<div class="col-lg-7 col-md-7 col-sm-6">
					<p class="index-feature-first">闲置市场，最爱跳蚤</p>
					<p class="index-feature-second hidden-sm">用着不对，卖了重配</p>
					<p class="index-feature-first visible-sm">用着不对，卖了重配</p>
				</div>
				<div class="col-lg-5 col-md-5 col-sm-6">
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
			<?php $prefix = img_url() ?>
			<?php $suffix = '?imageView2/1/w/100/h/100' ?>
			<?php foreach($categories as $c) : ?>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 index-category-all">
                <a href="<?= site_url('product/index/' . $c->cid) ?>">
                    <div class="well">
                        <img src="<?= $prefix . $c->icon . $suffix ?>">
                        <h2><?= $c->name ?></h2>
                        <p><?= $c->detail ?></p>
                    </div>
                </a>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="col-lg-3 hidden-md hidden-sm hidden-xs">
		<div class="well index-welcome">
			<h2>欢迎来到跳蚤市场</h2>
			<p>一个接地气的二手市场，专注于闲置物品的校园交易。</p>
			<?php if($this->aauth->is_loggedin()) : ?>
			<a href="<?= site_url('product/create') ?>" class="btn btn-primary">发布闲置&nbsp;&nbsp;快速出手</a>
			<?php else : ?>
			<a href="<?= site_url('user/login') ?>" class="btn btn-primary">使用智慧山师账号登录</a>
			<?php endif; ?>
		</div>
		<div class="well index-qrcode-app">
			<h4>安卓客户端扫一扫下载</h4>
            <img src="<?= img_url($imgqrcode) ?>?imageView2/1/h/208/w/208">
		</div>
		<div class="index-feedback">
            <div class="panel panel-default">
                <div class="panel-heading">
                     帮助中心
                </div>
                <div class="panel-body">
                    <!--
                    <p><i class="fa fa-qq"></i> <a href="tencent://message/?uin=184324224" style="font-weight: 700; color: #8a6d3b">184324224</a><p>
                    <p><i class="fa fa-home"></i> <a href="http://www.sintune.net/" target="_blank" style="font-weight: 700; color: #8a6d3b">www.sintune.net</a></p>
                    -->
                    <p>
                        <?php if($this->aauth->is_loggedin()) : ?>
                        <a href="#modal-feedback" data-toggle="modal">用户反馈</a> &&
                        <?php else : ?>
                        <a href="#modal-login" data-toggle="modal">用户反馈</a> &&
                        <?php endif; ?>
                        <a href="<?= site_url('page/service') ?>" target="_blank">服务条款</a> &&
                        <a href="<?= site_url('page/disclaimer') ?>" target="_blank">免责声明</a>
                    </p>
                    <p>
                        <a href="http://i.sdnu.edu.cn/" target="_blank">智慧山师开发小组</a>
                    </p>
                </div>
            </div>
		</div>
	</div>
</div>
<?php $this->load->view('layout/footer', ['tab' => '1']) ?>
