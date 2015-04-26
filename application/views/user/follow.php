<?php $this->load->view('layout/header') ?>
<div class="row">
	<div class="container user-show-info">
	    <div class="col-md-2">
	        <img class="img-thumbnail" src="http://milkcu.qiniudn.com/sdnuflea/2015040222395831-3.jpg?imageView2/1/w/140/h/140" alt=".img-thumbnail">
	    </div>
	    <div class="col-md-3">
	        <p><?= $sdnuinfo->name ?> （第<?= $user->id ?>位用户）</p>
	        <p>学院：<?= $sdnuinfo->organization_name ?></p>
	        <p>邮箱：<?= $contact->email ?></p>
	        <p>手机号：<?= $contact->phone ?></p>
	        <p>QQ：<?= $contact->qq ?></p>
	    </div>
	    <div class="col-md-3">
	        <p>用户编号：<?= $sdnuinfo->user_id ?></p>
	        <p>用户类别：
	        <?php if($sdnuinfo->user_type == 0) : ?>
			本科生
			<?php elseif($sdnuinfo->user_type == 1) : ?>
			研究生
			<?php elseif($sdnuinfo->user_type == 2) : ?>
			教职工
			<?php endif; ?>
	        </p>
	        <p>登录IP：<?= $user->ip_address ?></p>
	        <p>注册时间：<?= $user->created_on ?></p>
	        <p>最后登录：<?= $user->last_login ?></p>
	    </div>
	    <div class="col-md-4">
	        <div class="alert alert-info">
	        	<h4>这里是系统公告栏</h4>
	            <p>系统公告。系统公告。系统公告。系统公告。系统公告。系统公告。系统公告。系统公告。系统公告。</p>
	        </div>
	    </div>
    </div>
</div>
<div class="row" id='product-mng'>
	<div class="container">
		<div class="col-md-12">
			<ul class="nav nav-tabs nav-justified">
		        <li>
		            <a href="<?= site_url('user/show') ?>">发布的宝贝<span class="badge"><?= $products_num ?></span></a>
		        </li>
		        <li class="active">
		        	<a>关注的宝贝<span class="badge"><?= $products_num ?></span></a>
		        </li>
		        <li><a href="#">买到的宝贝<span class="badge">21</span></a></li>
		    </ul>
	        <table class="table table-hover" style="table-layout: fixed;">
	            <thead>
	                <tr>
	                    <th class="col-md-3">宝贝名称</th>
	                    <th class="col-md-2">发布时间</th>
	                    <th class="col-md-2">交易地点</th>
	                    <th class="col-md-1">分类</th>
	                    <th class="col-md-1">价格</th>
	                    <th class="col-md-1">关注/浏览</th>
	                    <th class="col-md-1">状态</th>
	                    <th class="col-md-1">删除</th>
	                </tr>
	            </thead>
	            <tbody>
	                <?php if( ! $products_num) : ?>
	                <tr><td colspan="9">宝贝为空</td></tr>
	                <?php else : ?>
	                <?php foreach($products as $p) : ?>
	                <tr>
	                    <td><a href="<?= site_url('product/show/' . $p->pid) ?>"><?= $p->title ?></a></td>
	                    <td><?= $p->created ?></td>
	                    <td><?= $p->place ?></td>
	                    <td><?= $p->category->name ?></td>
	                    <td><?= $p->current ?>元</td>
	                    <td><?= $p->follows ?> / <?= $p->views ?></td>
	                    <td><a class="btn btn-warning btn-xs" href="#">成交</a></td>
	                    <td><a class="btn btn-danger btn-xs" href="#">删除</a></td>
	                </tr>
	                <?php endforeach; ?>
	                <?php endif; ?>
	            </tbody>
	        </table>
	    </div>
    </div>
</div>
<div class="row">
	<div class="container list-pagination">
		<?php echo $this->pagination->create_links() ?>
	</div>
</div>
<?php $this->load->view('layout/footer') ?>
