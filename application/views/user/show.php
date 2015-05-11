<?php $this->load->view('layout/header', ['title' => '我的宝贝']) ?>
<div class="row user-show-info hidden-xs">
    <div class="col-lg-2">
        <?php $prefix = img_url() ?>
        <?php $suffix = '?imageView2/1/w/140/h/140' ?>
        <img class="img-thumbnail" src="<?= $prefix . $avatar . $suffix ?>" alt=".img-thumbnail">
    </div>
    <div class="col-lg-3">
        <p><?= $sdnuinfo->name ?> （第<?= $user->id ?>位用户）</p>
        <p>学院：<?= $sdnuinfo->organization_name ?></p>
        <p>邮箱：<?= $contact->email ?></p>
        <p>手机号：<?= $contact->phone ?></p>
        <p>QQ：<?= $contact->qq ?></p>
    </div>
    <div class="col-lg-3">
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
        <p>上次登录：<?= $user->last_login ?></p>
    </div>
    <div class="col-lg-4">
        <div class="alert alert-info">
            <h4>欢迎使用跳蚤市场</h4>
            <p>跳蚤市场（www.mysdnu.com）是专门为山师同胞打造的校内二手交易平台，用户身份均已认证，请放心使用，并在使用过程中遵守相关规定。</p>
        </div>
    </div>
</div>
<div class="row" id='product-mng'>
    <div class="col-lg-12 col-xs-12">
        <a href="<?= site_url('product/create') ?>" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> 发布宝贝</a>
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="<?= site_url('user/show') ?>">我的宝贝</a>
            </li>
            <li>
                <a href="<?= site_url('user/collect') ?>">我的收藏</a>
            </li>
        </ul>
        <div>
            <table class="table table-hover" style="table-layout: fixed;">
                <thead>
                    <tr>
                        <th class="col-lg-3 col-xs-6">宝贝名称</th>
                        <th class="col-lg-2 hidden-xs">交易地点</th>
                        <th class="col-lg-2 hidden-xs">发布时间</th>
                        <th class="col-lg-1 hidden-xs">宝贝分类</th>
                        <th class="col-lg-1 hidden-xs">现在价格</th>
                        <th class="col-lg-1 hidden-xs">浏览次数</th>
                        <th class="col-lg-1 col-xs-3">状态操作</th>
                        <th class="col-lg-1 col-xs-3">宝贝操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if( ! $products_num) : ?>
                    <tr><td colspan="8">宝贝为空</td></tr>
                    <?php else : ?>
                    <?php foreach($products as $p) : ?>
                    <tr>
                        <td><a href="<?= site_url('product/show/' . $p->pid) ?>" title="<?= $p->title ?>"><?= $p->title ?></a></td>
                        <td class="hidden-xs"><?= $p->place ?></td>
                        <td class="hidden-xs"><?= $p->created ?></td>
                        <td class="hidden-xs"><?= $p->category->name ?></td>
                        <td class="hidden-xs"><?= $p->current ?>元</td>
                        <td class="hidden-xs"><?= $p->views ?>次</td>
                        <td>
                            <?php if($p->state == 0) : ?>
                            <a class="btn btn-success btn-xs" href="#modal-done-<?= $p->pid ?>" data-toggle="modal">点击成交</a>
                            <?php elseif($p->state == 1) : ?>
                            <a class="btn btn-warning btn-xs">已经成交</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a class="btn btn-danger btn-xs" href="#modal-delete-<?= $p->pid ?>" data-toggle="modal">点击删除</a>
                        </td>
                    </tr>
                    <div id="modal-done-<?= $p->pid ?>" class="modal fade" style="display: none;" aria-hidden="true">
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
                                    <a href="<?= site_url('product/done/' . $p->pid) ?>" class="btn btn-primary">成交</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="modal-delete-<?= $p->pid ?>" class="modal fade" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" data-dismiss="modal" class="close">×</button>
                                    <h4 class="modal-title">删除提示</h4>
                                </div>
                                <div class="modal-body">
                                    确认删除宝贝吗？
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
                                    <a href="<?= site_url('product/delete/' . $p->pid) ?>" class="btn btn-primary">删除</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="list-pagination hidden-xs">
            <?php echo $this->pagination->create_links() ?>
        </div>
        <div class="list-pagination hidden-lg">
            <?php $config['display_pages'] = FALSE ?>
            <?php $this->pagination->initialize($config) ?>
            <?php echo $this->pagination->create_links() ?>
        </div>
	</div>
</div>
<?php $this->load->view('layout/footer', ['tab' => '3']) ?>
