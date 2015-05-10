<?php $this->load->view('layout/header', ['title' => $product->title . ' - ' . $product->category->name]) ?>
<div class="row">
    <div class="col-lg-12 col-xs-12">
        <ul class="breadcrumb">
            <li><a href="<?= site_url() ?>">跳蚤市场</a></li>
            <li><a href="<?= site_url('product/index/' . $product->category->cid) ?>"><?= $product->category->name ?></a></li>
            <li class="active"><?= $product->title ?></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-xs-12">
        <div class="carousel slide" id="carousel">
            <div>
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li class="active" data-slide-to="0" data-target="#carousel"></li>
                    <?php for($i = 1; $i < count($product->images); $i++) : ?>
                    <li data-slide-to="<?= $i ?>" data-target="#carousel"></li>
                    <?php endfor; ?>
                </ol>
                <!-- Wrapper for slides on PC -->
                <div class="carousel-inner product-show-carousel-pc hidden-xs">
                    <?php $suffix = '?imageView2/1/w/555/h/555' ?>
                    <div class="item active">
                        <img src="<?= img_url() . $product->images[0] . $suffix ?>" alt="First slide">
                    </div>
                    <?php for($i = 1; $i < count($product->images); $i++) : ?>
                    <div class="item">
                        <img src="<?= img_url() . $product->images[$i] . $suffix ?>" alt="Another slide">
                    </div>
                    <?php endfor; ?>
                </div>
                <!-- Wrapper for slides on Mobile -->
                <div class="carousel-inner product-show-carousel-mobile hidden-lg">
                    <?php $suffix = '?imageView2/1/w/555/h/555' ?>
                    <div class="item active">
                        <img src="<?= img_url() . $product->images[0] . $suffix ?>" alt="First slide">
                    </div>
                    <?php for($i = 1; $i < count($product->images); $i++) : ?>
                    <div class="item">
                        <img src="<?= img_url() . $product->images[$i] . $suffix ?>" alt="Another slide">
                    </div>
                    <?php endfor; ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" data-slide="prev" href="#carousel">
                    <span class="icon-prev"></span>
                </a>
                <a class="right carousel-control" data-slide="next" href="#carousel">
                    <span class="icon-next"></span>
                </a>
            </div>
        </div>  <!-- end of div.carousel -->
    </div>  <!-- end of div.col -->
    <div class="col-lg-4 col-xs-12">
        <div class="alert alert-info product-info">
            <div class="product-title"><h2><?= $product->title ?></h2></div>
            <div class="product-price">
                <div class="product-current">
                    <span class="label label-danger">￥ <?= $product->current ?></span>
                </div>
                <div class="product-original">
                    <span class="label label-default">原价 <?= $product->original ?> 元</span>
                </div>
            </div>
            <div class="product-statistics">
                <p><?= $product->views ?> 次浏览 · <?php $product->state ? print('已经') : print('尚未') ?>成交</p>
            </div>

            <div class="product-line">
                <div class="product-key"><span class="label label-primary">交易地点</span></div>
                <div class="product-value"><?= $product->place ?></div>
            </div>
            <div class="product-line">
                <div class="product-key"><span class="label label-primary">发布时间</span></div>
                <div class="product-value"><?= $product->created ?></div>
            </div>
            <div class="product-line">
                <div class="product-key"><span class="label label-primary">商品分类<span></div>
                <div class="product-value"><?= $product->category->name ?></div>
            </div>
            <div class="row hidden-xs hidden-lg">
                <div class="product-jiathis">
                    <!-- JiaThis Button BEGIN -->
                    <div class="jiathis_style_32x32">
                        <a class="jiathis_button_qzone"></a>
                        <a class="jiathis_button_tsina"></a>
                        <a class="jiathis_button_tqq"></a>
                        <a class="jiathis_button_weixin"></a>
                        <a class="jiathis_button_renren"></a>
                        <a href="http://www.jiathis.com/share?uid=1636645" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
                        <a class="jiathis_counter_style"></a>
                    </div>
                    <script type="text/javascript">
                    var jiathis_config = {data_track_clickback:'true', title: '#来自mysdnu跳蚤市场的分享#',
                        summary: '我发现了二手宝贝【<?= $product->title ?>】，快来看看吧！', shortUrl: false};
                    </script>
                    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=1636645" charset="utf-8"></script>
                    <!-- JiaThis Button END -->
                </div>
            </div>  <!-- end of row jiathis -->
            <div class="row" style="text-align: center">
                <div class="col-lg-3 col-xs-3">
                    <a href="#" class="btn btn-info">分享</a>
                </div>
                <div class="col-lg-3 col-xs-3">
                    <?php if( ! $in_collect) : ?>
                    <a href="<?= site_url('user/addcollect/' . $product->pid) ?>" class="btn btn-primary">收藏</a>
                    <?php else : ?>
                    <span class="btn btn-default">已收藏</a>
                    <?php endif; ?>
                </div>
                <div class="col-lg-3 col-xs-3">
                    <?php if($product->state == 0 && $product->uid != $this->aauth->get_user_id()) : ?>
                    <a href="<?= site_url('order/create/' . $product->pid) ?>" class="btn btn-danger">订购</a>
                    <?php else : ?>
                    <span class="btn btn-default">已订购</span>
                    <?php endif; ?>
                </div>
                <div class="col-lg-3 col-xs-3">
                    <a href="#" class="btn btn-warning">举报</a>
                </div>
            </div>
        </div>  <!-- end of alert -->
    </div>  <!-- end of col -->
    <div class="col-lg-2 hidden-xs">
        <div class="alert alert-success product-user">
            <div>
                <?php $suffix = '?imageView2/1/w/140/h/140' ?>
                <img class="img-circle" src="<?= img_url() . $avatar . $suffix ?>" alt=".img-circle">
            </div>
            <div class="product-user-name">
                <span><?= $sdnuinfo->name ?></span>
            </div>
            <div class="product-user-type">
                <span class="label label-success">
                    <?php if($sdnuinfo->user_type == 0) : ?>
                    本科生
                    <?php elseif($sdnuinfo->user_type == 1) : ?>
                    研究生
                    <?php elseif($sdnuinfo->user_type == 2) : ?>
                    教职工
                    <?php endif; ?>
                </span>
            </div>
            <div class="product-user-organization">
                <p><?= $sdnuinfo->organization_name ?></p>
            </div>
            <div class="product-user-contact">
                <?php if($this->aauth->is_loggedin()) : ?>
                <p><i class="fa fa-phone"></i><?= $contact->phone ?></p>
                <p><i class="fa fa-qq"></i><?= $contact->qq ?></p>
                <p><?= $contact->email ?></p>
                <?php else : ?>
                <p><i class="fa fa-phone"></i><?= substr($contact->phone, 0, 7) ?>****</p>
                <p><i class="fa fa-qq"></i><?= substr($contact->qq, 0, 6) ?>****</p>
                <p><?= substr($contact->email, 0, 3) ?>****<?= strstr($contact->email, '@') ?></p>
                <?php endif; ?>
                <p>（推荐使用私信）</p>
            </div>
        </div>  <!-- end of alert -->
    </div>  <!-- end of col -->
    <div class="col-lg-6 col-xs-12">
        <form method="post" action="<?= site_url('message/send/outbox') ?>">
            <div class="panel panel-warning product-user-chat">
                <div class="panel-heading">
                    私信聊聊
                    <?php if($this->aauth->is_loggedin()) : ?>
                    <input type="submit" value="发送" class="btn btn-warning btn-xs pull-right">
                    <?php else : ?>
                    <a href="<?= site_url('user/login') ?>" class="btn btn-warning btn-xs pull-right">登录</a>
                    <?php endif; ?>
               </div>
                <div class="panel-body">
                    <input type="hidden" name="receiver_id" value="<?= $product->uid ?>">
                    <input type="hidden" name="title" value="<?= $product->pid ?>">
                    <?php if($this->aauth->is_loggedin()) : ?>
                    <textarea name="message" class="form-control" placeholder="有什么不明白的可以向卖家咨询哦"></textarea>
                    <?php else : ?>
                    <div class="product-user-chat-unloggedin">
                        <a href="#modal-login" data-toggle="modal">
                            <span class="label label-warning hidden-xs">登录后才可显示联系方式并使用私信功能</span>
                            <span class="label label-warning hidden-lg">请登录使用私信功能</span>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>  <!-- end of panel -->
        </form>
    </div>  <!-- end of col -->
</div>
<div class="row">
    <div class="col-lg-12 col-xs-12">
        <div class="well product-detail">
            <p><?= nl2br($product->detail) ?></p>
        </div>
    </div>
</div>
<div class="row">
    <div class="hidden-lg col-xs-12">
        <div class="list-group">
            <span class="list-group-item active" style="z-index: auto">主人信息</span>
            <span class="list-group-item">姓名： <?= $sdnuinfo->name ?></span>
            <span class="list-group-item">学院： <?= $sdnuinfo->organization_name ?></span>
            <span class="list-group-item">邮箱： <?= $contact->email ?></span>
            <span class="list-group-item">手机： <?= $contact->phone ?></span>
            <span class="list-group-item">QQ： <?= $contact->qq ?></span>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer', ['tab' => '1']) ?>
