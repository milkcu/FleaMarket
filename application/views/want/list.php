<?php $this->load->view('layout/header', ['title' => '求购列表']) ?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <ul class="nav nav-tabs" style="margin-bottom: 20px;">
            <li class="active">
                <a href="<?= site_url('want/index') ?>">求购圈</a>
            </li>
            <li>
                <?php if($this->aauth->is_loggedin()) : ?>
                <a href="<?= site_url('want/mine') ?>">我的求购</a>
                <?php else : ?>
                <a href="#modal-login" data-toggle="modal">我的求购</a>
                <?php endif; ?>
            </li>
            <?php if($this->aauth->is_loggedin()) : ?>
            <a href="#modal-want-create" data-toggle="modal" class="btn btn-success btn-sm pull-right">
                <i class="fa fa-plus"></i> 发布求购
            </a>
            <?php else : ?>
            <a href="#modal-login" data-toggle="modal" class="btn btn-success btn-sm pull-right">
                <i class="fa fa-plus"></i> 发布求购
            </a>
            <?php endif; ?>
        </ul>
    </div>
    <?php foreach($wants as $w) : ?>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-xs-2">
                <img src="<?= img_url($w->avatar . '?imageView2/1/w/48/h/48') ?>">
            </div>
            <div class="col-lg-10 col-md-10 col-xs-10">
                <div class="well well-sm" >
                    <strong><?= $w->sdnuinfo->name ?> 求购于 <?= $w->created ?></strong>
                    <br>
                    <div class="want-content-pc hidden-xs"><?= $w->content ?></div>
                    <div class="want-content-mobile visible-xs"><?= $w->content ?></div>
                    <?php if($w->state == 'wait') : ?>
                        <a class="btn btn-xs btn-success">正在求购</a>
                        <?php if($this->aauth->is_loggedin()) : ?>
                        <a href="#modal-want-pm-<?= $w->wid ?>" data-toggle="modal" class="btn btn-xs btn-primary pull-right">点击私信</a>
                        <?php else : ?>
                        <a href="#modal-login" data-toggle="modal" class="btn btn-xs btn-primary pull-right">点击私信</a>
                        <?php endif; ?>
                    <?php else : ?>
                        <a class="btn btn-xs btn-danger">求购完成</a>
                        <a class="btn btn-xs btn-default pull-right">私信聊聊</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-want-pm-<?= $w->wid ?>" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="<?= site_url('want/sendpm/' . $w->wid) ?>" method="post">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" class="close">×</button>
                        <h4 class="modal-title">私信聊聊</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label">收件人：</label>
                            <input type="text" value="<?= $w->sdnuinfo->name ?> (<?= $w->sdnuinfo->user_id ?>)" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label class="control-label">私信内容：</label>
                            <textarea name="message" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
                        <input type="submit" value="发送" class="btn btn-primary">
                    </div>
                </form>
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
    <div class="list-pagination visible-xs">
        <?php $config['display_pages'] = FALSE ?>
        <?php $this->pagination->initialize($config) ?>
        <?php echo $this->pagination->create_links() ?>
    </div>
</div>
<?php $this->load->view('layout/footer', ['tab' => '4']) ?>
