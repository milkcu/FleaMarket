<?php $this->load->view('layout/header', ['title' => '私信列表']) ?>
<div class="row">
    <div class="col-lg-9 col-xs-12">
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
            <a href="<?= site_url('message/index/' . $type) ?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-refresh"></i> 刷新</a>
        </ul>
        <table class="table" style="table-layout: fixed;">
            <thead>
                <tr>
                    <?php if($type == 'inbox') : ?>
                    <th class="col-lg-1 col-xs-3">发件人</th>
                    <th class="col-lg-2 hidden-xs">发件人编号</th>
                    <?php elseif($type == 'outbox') : ?>
                    <th class="col-lg-1 col-xs-3">收件人</th>
                    <th class="col-lg-2 hidden-xs">收件人编号</th>
                    <?php endif; ?>
                    <th class="col-lg-4 col-xs-6">会话标题</th>
                    <th class="col-lg-2 hidden-xs">相关宝贝</th>
                    <th class="col-lg-3 col-xs-3">发送时间</th>
                </tr>
            </thead>
            <tbody>
                <?php if( ! $pms_num) : ?>
                <tr><td colspan="5">信息为空</td></tr>
                <?php else : ?>
                <?php foreach($pms as $pm) : ?>
                <?php if($pm->isread == 0) : ?>
                <tr class="active">
                <?php elseif($pm->isread == 1) : ?>
                <tr>
                <?php endif; ?>
                    <?php if($type == 'outbox') : ?>
                    <td><?= $pm->receiver_sdnuinfo->name ?></td>
                    <td class="hidden-xs"><?= $pm->receiver_sdnuinfo->user_id ?></td>
                    <td><a href="<?= site_url('message/show/outbox/' . $pm->id) ?>" title="<?= $pm->new_title ?>"><?= $pm->new_title ?></a></td>
                    <?php elseif($type == 'inbox') : ?>
                    <td><?= $pm->sender_sdnuinfo->name ?></td>
                    <td class="hidden-xs"><?= $pm->sender_sdnuinfo->user_id ?></td>
                    <td><a href="<?= site_url('message/show/inbox/' . $pm->id) ?>" title="<?= $pm->new_title ?>"><?= $pm->new_title ?></a></td>
                    <?php endif; ?>
                    <td class="hidden-xs">
                        <?php if(isset($pm->product)) : ?>
                        <a href="<?= site_url('product/show/' . $pm->product->pid) ?>"><?= $pm->product->title ?></a>
                        <?php else : ?>
                        求购专区
                        <?php endif; ?>
                    </td>
                    <?php
                    $t = strtotime($pm->date);
                    if(time() - $t < 86400) {
                        $time_show = date("H:i", $t);
                    } else {
                        $time_show = date("n月j日", $t);
                    }
                    ?>
                    <td><span class="hidden-xs"><?= $pm->date ?></span><span class="hidden-lg"><?= $time_show ?></span></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="list-pagination hidden-xs">
            <?php echo $this->pagination->create_links() ?>
        </div>
        <div class="list-pagination hidden-lg">
            <?php $config['display_pages'] = FALSE ?>
            <?php $this->pagination->initialize($config) ?>
            <?php echo $this->pagination->create_links() ?>
        </div>
    </div>
    <div class="col-lg-3 col-xs-12 hidden-xs">
        <div class="alert alert-info">
            欢迎使用私信功能，私信交流能够有效保证交易安全哦！
        </div>
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
</div>
<?php $this->load->view('layout/footer', ['tab' => '2']) ?>
