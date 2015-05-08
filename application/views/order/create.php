<?php $this->load->view('layout/header', ['title' => '创建订单']) ?>
<div class="row">
    <form method="post" action="create" name="creator">
        <div class="col-lg-8 col-xs-12 product-create-form">
            <div class="row">
                <div class="hidden-lg col-xs-12">
                    <div class="alert alert-info">
                        您将要订购的宝贝为：
                        <a href="<?= site_url('product/show/' . $product->pid) ?>" class="alert-link"><?= $product->title ?></a>
                    </div>
                </div>
                <div class="col-lg-offset-3 col-lg-6 col-xs-offset-0 col-xs-12">
                    <div class="row form-group">
                        <div class="col-lg-3 col-xs-3">
                            <label>支付方式</label>
                        </div>
                        <div class="col-lg-9 col-xs-9">
                            <select name="payment" class="form-control">
                                <option value="cash">货到付款</option>
                                <!--<option value="online">在线支付</option>-->
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-3 col-xs-3">
                            <label>配送方式</label>
                        </div>
                        <div class="col-lg-9 col-xs-9">
                            <select name="delivery" class="form-control">
                                <option value="deliver">送货上门</option>
                                <option value="self">用户自提</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-3 col-xs-3">
                            <label>收货人</label>
                        </div>
                        <div class="col-lg-9 col-xs-9">
                            <input type="text" name="receiver" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-3 col-xs-3">
                            <label>收件地址</label>
                        </div>
                        <div class="col-lg-9 col-xs-9">
                            <input type="text" name="address" value="<?= set_value('address') ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-3 col-xs-3">
                            <label>联系方式</label>
                        </div>
                        <div class="col-lg-9 col-xs-9">
                            <input type="text" name="contact" value="<?= set_value('contact') ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-3 col-xs-3">
                            <label>订单备注</label>
                        </div>
                        <div class="col-lg-9 col-xs-9">
                            <textarea name="remark" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <!--
                    <div class="row form-group">
                        <div class="col-lg-3 col-xs-3">
                            <label>验证码</label>
                        </div>
                        <div class="col-lg-9 col-xs-9">
                            <input type="text" name="recaptcha" class="form-control">
                        </div>
                    </div>
                    -->
                    <div class="row form-group">
                        <div class="col-lg-12 col-xs-12">
                            <input type="hidden" name="pid" value="<?= $product->pid ?>">
                            <input type="submit" value="提交订单" class="form-control btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <?php if(validation_errors() != '') : ?>
            <div class="alert alert-danger">
                <div class="product-create-sidebar-title">
                    <label class="label label-danger">表单错误提示</label>
                </div>
                <?= validation_errors() ?>
            </div>
            <?php endif; ?>
            <div class="alert alert-info hidden-xs">
                欢迎使用跳蚤市场订单系统！
                <br>
                您将要订购的宝贝为：
                <a href="<?= site_url('product/show/' . $product->pid) ?>" class="alert-link"><?= $product->title ?></a>
                <br>
                宝贝的原主人是：
                <strong><?= $product->sdnuinfo->name ?></strong>
                (<?= $product->sdnuinfo->organization_name ?>)
                <br>
                用户均通过实名认证，请放心使用！
            </div>
            <div class="alert alert-warning">
                <span class="hidden-xs">请填写订单相关信息，无关信息可能会被修改或删除。</span>
                为保证交易安全，订单一经提交，不再支持修改。
            </div>
        </div>
    </form>
</div>
<?php $this->load->view('layout/footer', ['tab' => '3']) ?>
