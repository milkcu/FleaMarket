<?php $this->load->view('layout/header', ['title' => '私信详情']) ?>
<div class="col-xs-9 pm-show">
	<?php //print_r($pm) ?>
	<div class="col-xs-12 pm-title">
		<h3><?= $new_title ?></h3>
		<hr>
	</div>
	<div class="col-xs-1">
		<?php $prefix = 'http://milkcu.qiniudn.com/sdnuflea/' ?>
	    <?php $suffix = '?imageView2/1/w/48/h/48' ?>
		<img src="<?= $prefix . $other_avatar . $suffix ?>" class="thumbnail">
	</div>
	<div class="col-xs-11">
		<form method="post" action="<?= site_url('message/send/inbox') ?>">
			<div class="pm-info">
				<span>与 <?= $other_sdnuinfo->name ?>(<?= $other_sdnuinfo->user_id ?>) 的私信对话</span>
				<?php if($type == 'inbox') : ?>
				<input type="submit" value="回复消息" class="btn btn-primary form-group">
				<?php elseif($type == 'outbox') : ?>
				<input type="submit" value="继续追问" class="btn btn-primary form-group">
				<?php endif; ?>
			</div>
			<!--
			<?php if($type == 'inbox') : ?>
			<input type="hidden" name="receiver_id" value="<?= $pm->sender_id ?>">
			<?php elseif($type == 'outbox') : ?>
			<input type="hidden" name="receiver_id" value="<?= $pm->receiver_id ?>">
			<?php endif; ?>
			-->
			<?php
			if($type == 'inbox') {
				$new_receiver_id = $pm->sender_id;
			} elseif($type == 'outbox') {
				$new_receiver_id = $pm->receiver_id;
			}
			?>
			<input type="hidden" name="receiver_id" value="<?= $new_receiver_id ?>">
			<input type="hidden" name="title" value="<?= $pm->title ?>">
			<input type="hidden" name="old_id" value="<?= $pm->id ?>">
			<input type="hidden" name="old_message" value="<?= $pm->message ?>">
			<textarea name="message" rows="4" class="form-control form-group" placeholder="请输入信息内容"></textarea>
		</form>
		<div class="well well-sm"><?= $pm->message ?></div>
	</div>
</div>
<div class="col-xs-3">
	<div class="list-group">
	 	<a href="<?= site_url('message/index/inbox') ?>" class="list-group-item">收件箱</a>
	 	<a href="<?= site_url('message/index/outbox') ?>" class="list-group-item">发件箱</a>
	 </div>
</div>
<?php $this->load->view('layout/footer') ?>
