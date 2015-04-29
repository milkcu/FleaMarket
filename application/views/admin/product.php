<?php $this->load->view('layout/header', ['title' => '后台管理']) ?>
<div class="col-xs-12">
    <ul class="breadcrumb">
        <li>
            <a href="<?= site_url() ?>">跳蚤市场</a>
        </li>
        <li class="active">
            后台管理
        </li>
    </ul>
</div>
<div class="col-xs-12">
    <div class="panel panel-default">
        <div class="panel-heading">后台管理</div>
        <div class="panel-body">
            <span>在这里可以管理所有用户及其发布的宝贝，若只需要要对自己发布的宝贝进行管理请使用【宝贝管理】功能！</span>
        </div>
        <table class="table table-hover" style="table-layout: fixed;">
            <thead>
                <tr>
                    <th class="col-xs-2">宝贝名称</th>
                    <th class="col-xs-2">发布时间</th>
                    <th class="col-xs-1">宝贝分类</th>
                    <th class="col-xs-1">宝贝主人</th>
                    <th class="col-xs-2">发布者学院</th>
                    <th class="col-xs-2">发布者IP</th>
                    <th class="col-xs-1">用户冻结</th>
                    <th class="col-xs-1">宝贝删除</th>
                </tr>
            </thead>
            <tbody>
                <?php if( ! $products_num) : ?>
                <tr><td colspan="9">宝贝为空</td></tr>
                <?php else : ?>
                <?php foreach($products as $p) : ?>
                <tr>
                    <?php /*$jipinfo = file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip=' . $p->ip)*/ ?>
                    <?php /*$ipinfo = json_decode($jipinfo)*/ ?>
                    <td><a href="<?= site_url('product/show/' . $p->pid) ?>" title="<?= $p->title ?>"><?= $p->title ?></a></td>
                    <td><?= $p->created ?></td>
                    <td><?= $p->category->name ?></td>
                    <td><?= $p->sdnuinfo->name ?></td>
                    <td><?= $p->sdnuinfo->organization_name ?></td>
                    <td>
                        <?= $p->ip ?>
                    <td>
                        <?php if(! $this->aauth->is_banned($p->uid)) : ?>
                        <a class="btn btn-success btn-xs" href="#modal-ban-<?= $p->uid ?>" data-toggle="modal">点击冻结</a>
                        <?php else : ?>
                        <a class="btn btn-warning btn-xs" href="#modal-unban-<?= $p->uid ?>" data-toggle="modal">解除冻结</a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a class="btn btn-danger btn-xs" href="#modal-delete-<?= $p->pid ?>" data-toggle="modal">删除宝贝</a>
                    </td>
                </tr>
                <div id="modal-ban-<?= $p->uid ?>" class="modal fade" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" data-dismiss="modal" class="close">×</button>
                                <h4 class="modal-title">冻结用户提示</h4>
                            </div>
                            <div class="modal-body">
                                用户冻结后将无法登录和发布宝贝，确认冻结该用户吗？
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
                                <a href="<?= site_url('admin/ban/' . $p->uid) ?>" class="btn btn-primary">冻结用户</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="modal-unban-<?= $p->uid ?>" class="modal fade" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" data-dismiss="modal" class="close">×</button>
                                <h4 class="modal-title">解除冻结提示</h4>
                            </div>
                            <div class="modal-body">
                                用户冻结后将无法登录和发布宝贝，确认冻结该用户吗？
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
                                <a href="<?= site_url('admin/unban/' . $p->uid) ?>" class="btn btn-primary">解除冻结</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="modal-delete-<?= $p->pid ?>" class="modal fade" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" data-dismiss="modal" class="close">×</button>
                                <h4 class="modal-title">删除宝贝提示</h4>
                            </div>
                            <div class="modal-body">
                                您现在使用的是管理员后台管理功能，请慎重！确认删除宝贝吗？
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
                                <a href="<?= site_url('admin/delete/' . $p->pid) ?>" class="btn btn-primary">删除</a>
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
<div class="row">
	<div class="container list-pagination">
		<?php echo $this->pagination->create_links() ?>
	</div>
</div>
<?php $this->load->view('layout/footer') ?>
