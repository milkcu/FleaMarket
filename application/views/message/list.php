<?php $this->load->view('layout/header', ['title' => '私信列表']) ?>
<div class="col-xs-9">
	<ul class="nav nav-tabs">
		<?php if($type == 'outbox') : ?>
        <li>
            <a href="<?= site_url('message/index/inbox') ?>">收件箱<span class="badge"><?= $unread_num ?></span></a>
        </li>
        <li class="active">
        	<a href="<?= site_url('message/index/outbox') ?>">发件箱</a>
        </li>
        <?php elseif($type == 'inbox') : ?>
        <li class="active">
            <a href="<?= site_url('message/index/inbox') ?>">收件箱<span class="badge"><?= $unread_num ?></span></a>
        </li>
        <li>
        	<a href="<?= site_url('message/index/outbox') ?>">发件箱</a>
        </li>
        <?php endif; ?>
        <a href="<?= site_url('message/index/' . $type) ?>" class="btn btn-success btn-sm pull-right">刷新</a>
    </ul>
    <table class="table" style="table-layout: fixed;">
        <thead>
            <tr>
            	<?php if($type == 'inbox') : ?>
                <th class="col-xs-1">发件人</th>
                <th class="col-xs-2">发件人编号</th>
                <?php elseif($type == 'outbox') : ?>
                <th class="col-xs-1">收件人</th>
                <th class="col-xs-2">收件人编号</th>
                <?php endif; ?>
                <th class="col-xs-4">标题</th>
                <th class="col-xs-2">相关宝贝</th>
                <th class="col-xs-3">发送时间</th>
            </tr>
        </thead>
        <tbody>
            <?php if( ! $pms_num) : ?>
            <tr><td colspan="5">信息为空</td></tr>
            <?php else : ?>
            <?php foreach($pms as $pm) : ?>
            <?php if($pm->read == 0) : ?>
            <tr class="active">
            <?php elseif($pm->read == 1) : ?>
            <tr>
            <?php endif; ?>
            	<?php if($type == 'outbox') : ?>
                <td><?= $pm->receiver_sdnuinfo->name ?></td>
                <td><?= $pm->receiver_sdnuinfo->user_id ?></td>
                <td><a href="<?= site_url('message/show/outbox/' . $pm->id) ?>"><?= $pm->new_title ?></a></td>
                <?php elseif($type == 'inbox') : ?>
                <td><?= $pm->sender_sdnuinfo->name ?></td>
                <td><?= $pm->sender_sdnuinfo->user_id ?></td>
                <td><a href="<?= site_url('message/show/inbox/' . $pm->id) ?>"><?= $pm->new_title ?></a></td>
                <?php endif; ?>
                <td><a href="<?= site_url('product/show/' . $pm->product->pid) ?>"><?= $pm->product->title ?></a></td>
                <td><?= $pm->date ?></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
	<div class="list-pagination">
		<?php echo $this->pagination->create_links() ?>
	</div>
</div>
<div class="col-xs-3">
	 <div class="list-group">
	 	<?php if($type == 'inbox') : ?>
	 	<a href="<?= site_url('message/index/inbox') ?>" class="list-group-item active">收件箱</a>
	 	<a href="<?= site_url('message/index/outbox') ?>" class="list-group-item">发件箱</a>
	 	<?php elseif($type == 'outbox') : ?>
	 	<a href="<?= site_url('message/index/inbox') ?>" class="list-group-item">收件箱</a>
	 	<a href="<?= site_url('message/index/outbox') ?>" class="list-group-item active">发件箱</a>
	 	<?php endif; ?>
	 </div>
</div>
<?php $this->load->view('layout/footer') ?>
