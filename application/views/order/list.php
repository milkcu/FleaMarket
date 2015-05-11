<?php $this->load->view('layout/header', ['title' => '订单列表']) ?>
<div class="row">
    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
        <ul class="nav nav-tabs">
            <?php if($type == 'from') : ?>
            <li class="active">
                <a href="<?= site_url('order/index/from') ?>">买家中心<span class="badge"><?= $uncomplete_num_by_fromid ?></span></a>
            </li>
            <li>
                <a href="<?= site_url('order/index/to') ?>">卖家中心<span class="badge"><?= $uncomplete_num_by_toid ?></span></a>
            </li>
            <?php elseif($type == 'to') : ?>
            <li>
                <a href="<?= site_url('order/index/from') ?>">买家中心<span class="badge"><?= $uncomplete_num_by_fromid ?></span></a>
            </li>
            <li class="active">
                <a href="<?= site_url('order/index/to') ?>">卖家中心<span class="badge"><?= $uncomplete_num_by_toid ?></span></a>
            </li>
            <?php endif; ?>
            <a href="<?= site_url('order/index/' . $type) ?>" class="btn btn-success btn-sm pull-right"><i class="fa fa-refresh"></i> 刷新</a>
        </ul>
        <table class="table" style="table-layout: fixed;">
            <thead>
                <tr>
                    <?php if($type == 'from') : ?>
                    <th class="col-lg-1 col-md-1 col-sm-1 hidden-xs">卖家</th>
                    <th class="col-lg-2 col-md-2 col-sm-2 hidden-xs">卖家编号</th>
                    <?php elseif($type == 'to') : ?>
                    <th class="col-lg-1 col-md-1 col-sm-1 hidden-xs">买家</th>
                    <th class="col-lg-2 col-md-2 col-sm-2 hidden-xs">买家编号</th>
                    <?php endif; ?>
                    <th class="col-lg-3 col-md-3 col-sm-3 col-xs-7">订单标题</th>
                    <th class="col-lg-2 col-md-2 col-sm-2 hidden-xs">相关宝贝</th>
                    <th class="col-lg-2 col-md-2 col-sm-1 hidden-xs"><span class="hidden-sm">下单</span>时间</th>
                    <th class="col-lg-2 col-md-2 col-sm-3 col-xs-5">订单状态</th>
                </tr>
            </thead>
            <tbody>
                <?php if( ! $orders_num) : ?>
                <tr><td colspan="6">信息为空</td></tr>
                <?php else : ?>
                <?php foreach($orders as $order) : ?>
                <tr>
                    <?php if($type == 'from') : ?>
                    <td class="hidden-xs"><?= $order->to_sdnuinfo->name ?></td>
                    <td class="hidden-xs"><?= $order->to_sdnuinfo->user_id ?></td>
                    <?php elseif($type == 'to') : ?>
                    <td class="hidden-xs"><?= $order->from_sdnuinfo->name ?></td>
                    <td class="hidden-xs"><?= $order->from_sdnuinfo->user_id ?></td>
                    <?php endif; ?>
                    <td>
                        <a href="<?= site_url('order/show/' . $order->oid) ?>" title="来自【<?= $order->product->title ?>】的订单">
                            来自【<?= $order->product->title ?>】的订单
                        </a>
                    </td>
                    <td class="hidden-xs">
                        <a href="<?= site_url('product/show/' . $order->product->pid) ?>">
                            <?= $order->product->title ?>
                        </a>
                    </td>
                    <?php
                    $t = strtotime($order->created);
                    if(time() - $t < 86400) {
                        $time_show = date("H:i", $t);
                    } else {
                        $time_show = date("n月j日", $t);
                    }
                    ?>
                    <td class="hidden-xs">
                        <span class="hidden-sm hidden-xs"><?= date("Y-m-d H:i", $t) ?></span>
                        <span class="visible-sm visible-xs"><?= $time_show ?></span>
                    </td>
                    <td>
                        <?php if($order->fromid == $this->aauth->get_user_id()) : ?>
                            <!-- 作为买家 -->
                            <?php if($order->state == 'create') : ?>
                                <label class="label label-info">等待卖家确认接单</label>
                            <?php elseif($order->state == 'affirm') : ?>
                                <label class="label label-warning">卖家接单等待收货</label>
                            <?php elseif($order->state == 'complete') : ?>
                                <label class="label label-success">订单完成感谢使用</label>
                            <?php elseif($order->state == 'cancel') : ?>
                                <label class="label label-default">订单已被卖家取消</label>
                            <?php elseif($order->state == 'delete') : ?>
                                <label class="label label-default">订单已被买家删除</label>
                            <?php else : ?>
                                <label class="label label-default">状态未知</label>
                            <?php endif; ?>
                        <?php elseif($order->toid == $this->aauth->get_user_id()) : ?>
                            <!-- 作为卖家 -->
                            <?php if($order->state == 'create') : ?>
                                <label class="label label-info">请确认或取消订单</label>
                            <?php elseif($order->state == 'affirm') : ?>
                                <label class="label label-warning">等待买家确认收货</label>
                            <?php elseif($order->state == 'complete') : ?>
                                <label class="label label-success">订单完成感谢使用</label>
                            <?php elseif($order->state == 'cancel') : ?>
                                <label class="label label-default">订单已被卖家取消</label>
                            <?php elseif($order->state == 'delete') : ?>
                                <label class="label label-default">订单已被买家删除</label>
                            <?php else : ?>
                                <label class="label label-default">状态未知</label>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="list-pagination hidden-xs">
            <?php echo $this->pagination->create_links() ?>
        </div>
        <div class="list-pagination visible-xs">
            <?php $config['display_pages'] = FALSE ?>
            <?php $this->pagination->initialize($config) ?>
            <?php echo $this->pagination->create_links() ?>
        </div>
    </div>
    <div class="col-lg-3 hidden-md hidden-sm hidden-xs">
        <div class="alert alert-info">
            欢迎使用订单，订单系统能够有效保证交易安全哦！
            请点击订单标题，进入订单详情页面进行相关操作。
        </div>
         <div class="list-group">
            <?php if($type == 'from') : ?>
            <a href="<?= site_url('order/index/from') ?>" class="list-group-item active">买家中心</a>
            <a href="<?= site_url('order/index/to') ?>" class="list-group-item">卖家中心</a>
            <?php elseif($type == 'to') : ?>
            <a href="<?= site_url('order/index/from') ?>" class="list-group-item">买家中心</a>
            <a href="<?= site_url('order/index/to') ?>" class="list-group-item active">卖家中心</a>
            <?php elseif($type == 'all') : ?>
            <a href="<?= site_url('order/index/from') ?>" class="list-group-item">买家中心</a>
            <a href="<?= site_url('order/index/to') ?>" class="list-group-item">卖家中心</a>
            <?php endif; ?>
         </div>
    </div>
</div>
<?php $this->load->view('layout/footer', ['tab' => '3']) ?>
