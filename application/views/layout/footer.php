</div>
<div id="footer" class="hidden-xs">
	<div class="container">
		<p class="footer-content">
            <?= $this->settings->get_var('txtfooter') ?>
			<span class="hidden"><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1254732175'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/stat.php%3Fid%3D1254732175%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script></span>
		</p>
	</div>
</div>
<div id="footer-tab" class="visible-xs">
    <?php if( ! $this->aauth->is_loggedin()) : ?>
        <?php if($tab == 1) : ?>
            <a href="<?= site_url() ?>" style="background: #333333">宝贝浏览</a>
            <a href="<?= site_url('want/index') ?>" style="background: #222222">求购专区</a>
            <a href="#modal-login" data-toggle="modal" style="background: #222222">我的私信</a>
            <a href="#modal-login" data-toggle="modal" style="background: #222222">用户中心</a>
        <?php elseif($tab == 3) : ?>
            <a href="<?= site_url() ?>" style="background: #222222">宝贝浏览</a>
            <a href="<?= site_url('want/index') ?>" style="background: #222222">求购专区</a>
            <a href="#modal-login" data-toggle="modal" style="background: #222222">我的私信</a>
            <a href="#modal-login" data-toggle="modal" style="background: #333333">用户中心</a>
        <?php elseif($tab == 4) : ?>
            <a href="<?= site_url() ?>" style="background: #222222">宝贝浏览</a>
            <a href="<?= site_url('want/index') ?>" style="background: #333333">求购专区</a>
            <a href="#modal-login" data-toggle="modal" style="background: #222222">我的私信</a>
            <a href="#modal-login" data-toggle="modal" style="background: #222222">用户中心</a>
        <?php endif; ?>
    <?php else : ?>
        <?php $pmnum = $this->aauth->count_unread_pms() ?>
        <?php if( ! isset($tab)) : ?>
            <a href="<?= site_url() ?>">宝贝浏览</a>
            <a href="<?= site_url('want/index') ?>">求购专区</a>
            <a href="<?= site_url('message/index/inbox') ?>">我的私信
                <?= $pmnum > 0 ? '<span class="badge pm-nav" style="left: -5px;">' . $pmnum . '</span>' : '' ?>
            </a>
            <a href="<?= site_url('user/index') ?>">用户中心</a>
        <?php elseif($tab == 1) : ?>
            <a href="<?= site_url() ?>" style="background: #333333">宝贝浏览</a>
            <a href="<?= site_url('want/index') ?>" style="background: #222222">求购专区</a>
            <a href="<?= site_url('message/index/inbox') ?>" style="background: #222222">我的私信
                <?= $pmnum > 0 ? '<span class="badge pm-nav" style="left: -5px;">' . $pmnum . '</span>' : '' ?>
            </a>
            <a href="<?= site_url('user/index') ?>" style="background: #222222">用户中心</a>
        <?php elseif($tab == 2) : ?>
            <a href="<?= site_url() ?>" style="background: #222222">宝贝浏览</a>
            <a href="<?= site_url('want/index') ?>" style="background: #222222">求购专区</a>
            <a href="<?= site_url('message/index/inbox') ?>" style="background: #333333">我的私信
                <?= $pmnum > 0 ? '<span class="badge pm-nav" style="left: -5px;">' . $pmnum . '</span>' : '' ?>
            </a>
            <a href="<?= site_url('user/index') ?>" style="background: #222222">用户中心</a>
        <?php elseif($tab == 3) : ?>
            <a href="<?= site_url() ?>" style="background: #222222">宝贝浏览</a>
            <a href="<?= site_url('want/index') ?>" style="background: #222222">求购专区</a>
            <a href="<?= site_url('message/index/inbox') ?>" style="background: #222222">我的私信
                <?= $pmnum > 0 ? '<span class="badge pm-nav" style="left: -5px;">' . $pmnum . '</span>' : '' ?>
            </a>
            <a href="<?= site_url('user/index') ?>" style="background: #333333">用户中心</a>
        <?php elseif($tab == 4) : ?>
            <a href="<?= site_url() ?>" style="background: #222222">宝贝浏览</a>
            <a href="<?= site_url('want/index') ?>" style="background: #333333">求购专区</a>
            <a href="<?= site_url('message/index/inbox') ?>" style="background: #222222">我的私信
                <?= $pmnum > 0 ? '<span class="badge pm-nav" style="left: -5px;">' . $pmnum . '</span>' : '' ?>
            </a>
            <a href="<?= site_url('user/index') ?>" style="background: #222222">用户中心</a>
        <?php endif; ?>
    <?php endif; ?>
</div>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>
</html>
