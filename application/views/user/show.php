<?php $this->load->view('layout/header', ['title' => '我的宝贝']) ?>
<?php $this->load->view('user/show_info') ?>
<div class="row" id='product-mng'>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a href="<?= site_url('product/create') ?>" class="btn btn-primary btn-sm pull-right">
            <i class="fa fa-plus"></i> 发布宝贝
        </a>
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
                        <th class="col-lg-3 col-md-3 col-sm-2 col-xs-6">宝贝名称</th>
                        <th class="col-lg-2 col-md-2 hidden-sm hidden-xs">交易地点</th>
                        <th class="col-lg-2 col-md-2 col-sm-2 hidden-xs">发布时间</th>
                        <th class="col-lg-1 col-md-1 col-sm-2 hidden-xs">宝贝分类</th>
                        <th class="col-lg-1 col-md-1 col-sm-1 hidden-xs"><span class="hidden-sm">现在</span>价格</th>
                        <th class="col-lg-1 col-md-1 col-sm-1 hidden-xs">浏览<span class="hidden-sm">次数</span></th>
                        <th class="col-lg-1 col-md-1 col-sm-2 col-xs-3">状态操作</th>
                        <th class="col-lg-1 col-md-1 col-sm-2 col-xs-3">宝贝操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if( ! $products_num) : ?>
                    <tr><td colspan="8">宝贝为空</td></tr>
                    <?php else : ?>
                    <?php foreach($products as $p) : ?>
                    <tr>
                        <td><a href="<?= site_url('product/show/' . $p->pid) ?>" title="<?= $p->title ?>"><?= $p->title ?></a></td>
                        <td class="hidden-sm hidden-xs"><?= $p->place ?></td>
                        <td class="hidden-xs">
                            <span class="hidden-sm"><?= $p->created ?></span>
                            <span class="visible-sm-inline"><?= date('m月d日H:i', strtotime($p->created)) ?></span>
                        </td>
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
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="list-pagination hidden-xs">
            <?php echo $this->pagination->create_links() ?>
        </div>
        <div class="list-pagination visible-xs">
            <?php $config['display_pages'] = FALSE ?>
            <?php $this->pagination->initialize($config) ?>
            <?php echo $this->pagination->create_links() ?>
        </div>
	</div>
</div>
<?php $this->load->view('layout/footer', ['tab' => '3']) ?>
