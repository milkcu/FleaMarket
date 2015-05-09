<?php $this->load->view('layout/header', ['title' => '发布求购']) ?>
<div class="row">
    <div class="col-xs-12">
        <ul class="nav nav-tabs" style="margin-bottom: 20px;">
            <li>
                <a href="<?= site_url('want/index') ?>">求购圈</a>
            </li>
            <li class="active">
                <a href="<?= site_url('want/create') ?>">我的求购</a>
            </li>
            <a href="<?= site_url('want/create') ?>" class="btn btn-success btn-sm pull-right">
                <i class="fa fa-plus"></i> 发布
            </a>
        </ul>
        <form method="post" action="create" name="creator">
            <div class="form-group">
                <label>请输入求购信息：</label>
            </div>
            <div class="form-group">
                <textarea name="content" rows="4" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="发布求购信息" class="btn btn-primary form-control">
            </div>
        </form>
    </div>
    <div class="col-xs-12">
        <?php if(validation_errors() != '') : ?>
        <div class="alert alert-danger">
            <?= validation_errors() ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <?php foreach($wants as $w) : ?>
    <div class="col-xs-2">
        <img src="<?= img_url($w->avatar . '?imageView2/1/w/48/h/48') ?>">
    </div>
    <div class="col-xs-10">
        <div class="well well-sm">
            <strong><?= $w->sdnuinfo->name ?> 求购于 <?= $w->created ?></strong>
            <br>
            <p><?= $w->content ?></p>
            <?php if($w->state == 'wait') : ?>
                <a href="#modal-want-done-<?= $w->wid ?>" data-toggle="modal" class="btn btn-xs btn-primary">结束求购</a>
                <a href="#modal-want-delete-<?= $w->wid ?>" data-toggle="modal" class="btn btn-xs btn-danger pull-right">删除信息</a>
            <?php else : ?>
                <span class="label label-success">求购完成</span>
                <a href="#modal-want-delete-<?= $w->wid ?>" data-toggle="modal" class="btn btn-xs btn-danger pull-right">删除信息</a>
            <?php endif; ?>
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
