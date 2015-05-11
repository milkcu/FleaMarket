<?php $this->load->view('layout/header', ['title' => '我的求购']) ?>
<div class="row">
    <div class="col-xs-12">
        <ul class="nav nav-tabs" style="margin-bottom: 20px;">
            <li>
                <a href="<?= site_url('want/index') ?>">求购圈</a>
            </li>
            <li class="active">
                <a href="<?= site_url('want/mine') ?>">我的求购</a>
            </li>
            <a href="#modal-want-create" data-toggle="modal" class="btn btn-success btn-sm pull-right">
                <i class="fa fa-plus"></i> 发布求购
            </a>
        </ul>
    </div>
</div>
<div class="row">
    <?php foreach($wants as $w) : ?>
    <div class="col-lg-4 col-xs-12">
        <div class="row">
            <div class="col-lg-2 col-xs-2">
                <img src="<?= img_url($w->avatar . '?imageView2/1/w/48/h/48') ?>">
            </div>
            <div class="col-lg-10 col-xs-10">
                <div class="well well-sm" >
                    <strong><?= $w->sdnuinfo->name ?> 求购于 <?= $w->created ?></strong>
                    <span class="hidden-xs">[<?= $w->wid ?>号]</span>
                    <br>
                    <div class="want-content-pc hidden-xs"><?= $w->content ?></div>
                    <div class="want-content-mobile hidden-lg">[<?= $w->wid ?>号] <?= $w->content ?></div>
                    <?php if($w->state == 'wait') : ?>
                        <a href="#modal-want-done-<?= $w->wid ?>" data-toggle="modal" class="btn btn-xs btn-warning">点击结束</a>
                        <a href="#modal-want-delete-<?= $w->wid ?>" data-toggle="modal" class="btn btn-xs btn-primary pull-right">点击删除</a>
                    <?php else : ?>
                        <a class="btn btn-xs btn-danger">求购完成</a>
                        <a href="#modal-want-delete-<?= $w->wid ?>" data-toggle="modal" class="btn btn-xs btn-danger pull-right">点击删除</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-want-delete-<?= $w->wid ?>" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" class="close">×</button>
                    <h4 class="modal-title">删除提示</h4>
                </div>
                <div class="modal-body">
                    确认删除求购信息吗？
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
                    <a href="<?= site_url('want/delete/' . $w->wid) ?>" class="btn btn-primary">删除</a>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-want-done-<?= $w->wid ?>" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" class="close">×</button>
                    <h4 class="modal-title">结束提示</h4>
                </div>
                <div class="modal-body">
                    确认结束求购吗？结束后将无法接受来自该求购信息的私信。
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
                    <a href="<?= site_url('want/done/' . $w->wid) ?>" class="btn btn-primary">删除</a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <div id="modal-want-create" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="<?= site_url('want/create') ?>" method="post">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" class="close">×</button>
                        <h4 class="modal-title">发布求购</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label">请输入求购信息（70字以内）：</label>
                            <textarea name="content" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
                        <input type="submit" value="发布" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="list-pagination hidden-xs">
        <?php echo $this->pagination->create_links() ?>
    </div>
    <div class="list-pagination hidden-lg">
        <?php $config['display_pages'] = FALSE ?>
        <?php $this->pagination->initialize($config) ?>
        <?php echo $this->pagination->create_links() ?>
    </div>
</div>
<?php $this->load->view('layout/footer', ['tab' => '4']) ?>
