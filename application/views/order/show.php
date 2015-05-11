<?php $this->load->view('layout/header', ['title' => '浏览订单']) ?>
<div class="row">
    <div class="visible-xs col-xs-12">
        <div class="alert alert-info">
            宝贝为：
            <a href="<?= site_url('product/show/' . $product->pid) ?>" class="alert-link"><?= $product->title ?></a>
            (编号<?= $product->pid ?>)
            <br>
            买家为： <b><?= $order->from_sdnuinfo->name ?></b> (<?= $order->from_sdnuinfo->user_id ?>)
            <br>
            卖家为： <b><?= $order->to_sdnuinfo->name ?></b> (<?= $order->to_sdnuinfo->user_id ?>)
        </div>
    </div>
    <div class="col-lg-8 col-md-8 col-xs-12 product-create-form">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">处理流程</h3>
            </div>
            <div class="panel-body">
                <div class="row" style="text-align: center">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="alert alert-warning">
                            <?php if($order->fromid == $this->aauth->get_user_id()) : ?>
                                <!-- 作为买家 -->
                                <?php if($order->state == 'create') : ?>
                                    订单创建成功，等待对方确认接单，卖家确认之前您可以选择
                                    <a href="#modal-order-delete" class="btn btn-xs btn-danger" data-toggle="modal">删除订单</a>
                                <?php elseif($order->state == 'affirm') : ?>
                                    对方已确认接单，请收货后
                                    <a href="#modal-order-complete" class="btn btn-xs btn-warning" data-toggle="modal">确认订单完成</a>
                                <?php elseif($order->state == 'complete') : ?>
                                    该订单已完成，欢迎再次使用
                                <?php elseif($order->state == 'cancel') : ?>
                                    该订单被卖家取消，欢迎下次使用
                                <?php elseif($order->state == 'delete') : ?>
                                    该订单被买家删除，欢迎下次使用
                                <?php else : ?>
                                    欢迎使用订单系统
                                <?php endif; ?>
                            <?php elseif($order->toid == $this->aauth->get_user_id()) :  ?>
                                <!-- 作为卖家 -->
                                <?php if($order->state == 'create') : ?>
                                    订单创建成功，请
                                    <a href="#modal-order-affirm" class="btn btn-xs btn-success" data-toggle="modal">确认接单</a>
                                    或 <a href="#modal-order-cancel" class="btn btn-xs btn-danger" data-toggle="modal">取消订单</a>
                                <?php elseif($order->state == 'affirm') : ?>
                                    请尽快发货，收货后等待对方确认订单完成
                                <?php elseif($order->state == 'complete') : ?>
                                    该订单已完成，
                                    <?php if($product->state == 0) : ?>
                                    记得在
                                    <a href="<?= site_url('user/show') ?>" class="alert-link">宝贝管理</a> 中点击
                                    <a href="#modal-done" class="btn btn-xs btn-success" data-toggle="modal">成交宝贝</a>
                                    <?php else : ?>
                                    欢迎再次使用
                                    <?php endif; ?>
                                <?php elseif($order->state == 'cancel') : ?>
                                    该订单已被卖家取消，欢迎下次使用
                                <?php elseif($order->state == 'delete') : ?>
                                    该订单已被买家删除，欢迎下次使用
                                <?php else : ?>
                                    欢迎使用订单系统
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-offset-3 col-lg-2 col-md-4 col-xs-4">
                        <div class="alert alert-success">
                            买家提交订单
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-xs-4">
                        <?php if($order->state == 'cancel') : ?>
                        <div class="alert alert-danger">
                            卖家取消订单
                        </div>
                        <?php elseif($order->state == 'delete') : ?>
                        <div class="alert alert-danger">
                            买家删除订单
                        </div>
                        <?php elseif(in_array($order->state, array('affirm', 'complete'))) : ?>
                        <div class="alert alert-success">
                            卖家确认接单
                        </div>
                        <?php else : ?>
                        <div class="alert alert-info">
                            卖家确认接单
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-2 col-md-4 col-xs-4">
                        <?php if($order->state == 'cancel' or $order->state == 'delete') : ?>
                        <div class="alert alert-danger">
                            交易无法完成
                        </div>
                        <?php elseif(in_array($order->state, array('complete'))) : ?>
                        <div class="alert alert-success">
                            买家确认收货
                        </div>
                        <?php else : ?>
                        <div class="alert alert-info">
                            买家确认收货
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <table class="table" style="margin-bottom: 0px;">
                    <thead>
                        <tr>
                            <th class="col-lg-3 col-md-4 col-xs-4">处理时间</th>
                            <th class="col-lg-9 col-md-8 col-xs-8">处理信息</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($order->logs as $key => $value) : ?>
                        <?php $key_display = date("n月j日H:i", strtotime($key)) ?>
                        <tr>
                            <td>
                                <span class="hidden-xs"><?= $key ?></span>
                                <span class="visible-xs"><?= $key_display ?></span>
                            </td>
                            <td>
                                <?= $value ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">订单信息</h3>
            </div>
            <div class="panel-body">
                <?php
                switch($order->payment) {
                case 'cash' :
                    $payment_display = '货到付款';
                    break;
                case 'online' :
                    $payment_display = '在线支付';
                    break;
                default :
                    $payment_display = '支付未知';
                    break;
                }
                switch($order->delivery) {
                case 'deliver' :
                    $delivery_display = '送货上门';
                    break;
                case 'self' :
                    $delivery_display = '用户自提';
                    break;
                default :
                    $delivery_display = '送货未知';
                    break;
                }
                ?>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <p>下单时间： <?= $order->created ?></p>
                    <p>支付方式： <?= $payment_display ?></p>
                    <p>配送方式： <?= $delivery_display ?></p>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <p>收货人： <?= $order->receiver ?></p>
                    <p>收货地址： <?= $order->address ?></p>
                    <p>联系方式： <?= $order->contact ?></p>
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <p>订单备注： <?= $order->remark ?></p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">用户留言</h3>
            </div>
            <div class="panel-body">
                <form action="<?= site_url('order/comment') ?>" method="post">
                    <?php if(count($order->comment) != 0) : ?>
                    <div>
                        <?php foreach($order->comment as $c) : ?>
                        <strong><?= $c->uname ?> 发送于 <?= $c->created ?></strong>
                        <br>
                        <?= $c->content ?>
                        <hr>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <textarea name="comment" rows="3" class="form-control"></textarea>
                        <input type="hidden" name="oid" value="<?= $order->oid ?>">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="发送留言" class="btn btn-primary pull-right">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-xs-12">
        <div class="alert alert-info hidden-xs">
            宝贝为：
            <a href="<?= site_url('product/show/' . $product->pid) ?>" class="alert-link"><?= $product->title ?></a>
            (编号<?= $product->pid ?>)
            <br>
            买家为： <b><?= $order->from_sdnuinfo->name ?></b> (<?= $order->from_sdnuinfo->user_id ?>)
            <br>
            卖家为： <b><?= $order->to_sdnuinfo->name ?></b> (<?= $order->to_sdnuinfo->user_id ?>)
        </div>
        <div class="alert alert-info hidden-lg hidden-xs">
            欢迎使用跳蚤市场订单系统！
            <br>
            该订单订购的宝贝为：
            <a href="<?= site_url('product/show/' . $product->pid) ?>" class="alert-link"><?= $product->title ?></a>
            <br>
            宝贝的原主人是：
            <strong><?= $product->sdnuinfo->name ?></strong>
            (<?= $product->sdnuinfo->organization_name ?>)
            <br>
                用户均通过实名认证，请放心使用！
        </div>
        <div class="alert alert-warning">
            1. 订单状态有五种：【创建】，【确认】，【完成】，【取消】，【删除】。
            <br>
            2. 买家提交订单，订单状态为【创建】，此时买家可以选择【删除】订单或等待卖家【确认】订单。
            <br>
            3. 卖家收到买家订单请求，可以选择【取消】订单或【确认】接受订单。
            <br>
            4. 卖家【确认】订单后要及时送货上门或通知用户自提，当买家确认收货时订单【完成】。
        </div>
    </div>
    <div id="modal-order-affirm" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" class="close">×</button>
                    <h4 class="modal-title">确认提示</h4>
                </div>
                <div class="modal-body">
                    确认接受该订单吗？
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
                    <a href="<?= site_url('order/affirm/' . $order->oid) ?>" class="btn btn-primary">确认接受</a>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-order-cancel" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" class="close">×</button>
                    <h4 class="modal-title">取消提示</h4>
                </div>
                <div class="modal-body">
                    确认取消该订单吗？
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
                    <a href="<?= site_url('order/cancel/' . $order->oid) ?>" class="btn btn-primary">确认取消</a>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-order-complete" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" class="close">×</button>
                    <h4 class="modal-title">完成提示</h4>
                </div>
                <div class="modal-body">
                    确认完成订单吗？
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
                    <a href="<?= site_url('order/complete/' . $order->oid) ?>" class="btn btn-primary">确认完成</a>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-order-delete" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" class="close">×</button>
                    <h4 class="modal-title">删除提示</h4>
                </div>
                <div class="modal-body">
                    确认删除订单吗？
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
                    <a href="<?= site_url('order/delete/' . $order->oid) ?>" class="btn btn-primary">确认删除</a>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-done" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" class="close">×</button>
                    <h4 class="modal-title">成交提示</h4>
                </div>
                <div class="modal-body">
                    确认成交宝贝吗？
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
                    <a href="<?= site_url('product/done/' . $order->product->pid) ?>" class="btn btn-primary">成交</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer', ['tab' => '3']) ?>
