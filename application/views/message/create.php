<?php $this->load->view('layout/header') ?>
<div class="row">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="#">跳蚤市场</a></li>
			<li><a href="#">我的私信</a></li>
			<li>发新私信</li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="col-md-9">
		<div class="pm-info">
			<h3>发新私信</h3>
			<hr>
		</div>
		<form action="create" method="post">
			<div class="form-group">
				<input type="text" name="name" class="form-control" placeholder="收信人学号">
			</div>
			<div class="form-group">
				<input type="text" name="title" class="form-control" placeholder="信息标题">
			</div>
			<div class="form-group">
				<textarea name="message" rows="5" class="form-control" placeholder="信息内容"></textarea>
			</div>
			<div class="form-group">
				<input type="submit" value="发送" class="btn btn-primary">
			</div>
		</form>
	</div>
	<div class="col-md-3">
		<div class="list-group">
			<a class="list-group-item" href="#">我的私信</a>
			<a class="list-group-item active" href="#">我的私信</a>
			<a class="list-group-item" href="#">我的私信</a>
		</div>
	</div>
</div>
<?php $this->load->view('layout/footer') ?>
