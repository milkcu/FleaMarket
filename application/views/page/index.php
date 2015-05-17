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
	<div class="col-lg-12 col-md-12 col-sm-12">
        <!--
        <img src="<?= img_url($imghead) ?>" class="index-sdnu-head-img">
        -->
        <?php $imgshead = json_decode($this->settings->get_var('imgshead')) ?>
        <div class="carousel slide" id="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li class="active" data-slide-to="0" data-target="#carousel"></li>
                <?php for($i = 1; $i < count($imgshead); $i++) : ?>
                <li data-slide-to="<?= $i ?>" data-target="#carousel"></li>
                <?php endfor; ?>
            </ol>
            <!-- Wrapper for slides on PC -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="<?= img_url($imgshead[0]) ?>" alt="First slide">
                </div>
                <?php for($i = 1; $i < count($imgshead); $i++) : ?>
                <div class="item">
                    <img src="<?= img_url($imgshead[$i]) ?>" alt="Another slide">
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
        </div>  <!-- end of div.carousel -->
	</div>
</div>
<div class="row">
	<div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
        <div class="row hidden">
            <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs">
                <div class="well">
                    <div class="row index-feature-all hidden">
                        <div class="col-lg-7 col-md-7 col-sm-6 index-feature-slogan">
                            <p class="index-feature-first">闲置市场，最爱跳蚤</p>
                            <p class="index-feature-second hidden-sm">用着不对，卖了重配</p>
                            <p class="index-feature-first visible-sm">用着不对，卖了重配</p>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-6">
                            <ul>
                                <li class="list-unstyled index-feature-quick">
                                    <i class="fa fa-clock-o"></i>
                                    快速：随手发布告别蹲点守候
                                </li>
                                <li class="list-unstyled index-feature-secure">
                                    <i class="fa fa-shield"></i>
                                    安全：学号登录保证交易安全
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
                    <div class="row index-product-latest">
                        <div class="col-lg-12 col-md-2 col-sm-2">
                        <p class="pull-left">最<br>新<br>宝<br>贝</p>
                        <?php foreach($products as $p) : ?>
                            <a href="<?= site_url('product/show/' . $p->pid) ?>" title="<?= $p->title ?>">
                                <img src="<?= img_url($p->images[0] . '?imageView2/1/w/100/h/100') ?>" class="img-rounded">
                            </a>
                        <?php endforeach; ?>
                        </div>
                    </div>
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
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs">
                <div class="well">
                    <div class="row index-product-latest">
                        <div class="col-lg-12 col-md-2 col-sm-2">
                        <p class="pull-left">最<br>新<br>宝<br>贝</p>
                        <?php foreach($products as $p) : ?>
                            <a href="<?= site_url('product/show/' . $p->pid) ?>" title="<?= $p->title ?>">
                                <img src="<?= img_url($p->images[0] . '?imageView2/1/w/100/h/100') ?>" class="img-rounded">
                            </a>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
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
			<h4>扫一扫下载Android客户端</h4>
            <img src="<?= img_url($imgqrcode) ?>?imageView2/1/h/220/w/220">
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
                        <?= $this->settings->get_var('txthelper') ?>
                    </p>
                    <p>
                        <?php if($this->aauth->is_loggedin()) : ?>
                        <a href="#modal-feedback" data-toggle="modal">用户反馈</a> &&
                        <?php else : ?>
                        <a href="#modal-login" data-toggle="modal">用户反馈</a> &&
                        <?php endif; ?>
                        <a href="<?= site_url('page/service') ?>" target="_blank">服务条款</a> &&
                        <a href="<?= site_url('page/disclaimer') ?>" target="_blank">免责声明</a>
                    </p>
                </div>
            </div>
		</div>
	</div>
</div>
<?php $this->load->view('layout/footer', ['tab' => '1']) ?>
