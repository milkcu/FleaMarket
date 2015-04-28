<link rel="stylesheet" href="<?= base_url('assets/kindeditor/themes/default/default.css') ?>" />
<link rel="stylesheet" href="<?= base_url('assets/kindeditor/plugins/code/prettify.css') ?>" />
<script charset="utf-8" src="<?= base_url('assets/kindeditor/kindeditor.js') ?>"></script>
<script charset="utf-8" src="<?= base_url('assets/kindeditor/lang/zh_CN.js') ?>"></script>
<script charset="utf-8" src="<?= base_url('assets/kindeditor/plugins/code/prettify.js') ?>"></script>
<script>
	KindEditor.ready(function(K) {
		var editor1 = K.create('textarea[name="detail"]', {
			height: '370px',
			cssPath : '<?= base_url('assets/kindeditor/plugins/code/prettify.css') ?>',
			//uploadJson : '<?= base_url('kindeditor/php/upload_json.php') ?>',
			uploadJson : '<?= site_url('product/kindeditor') ?>',
			fileManagerJson : '',
			allowFileManager : false,
            items : [
                'undo', 'redo','|', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', 'subscript', 'superscript',  '|', 'table', 'image', 'link', 'unlink', '|', 'preview', 'fullscreen'],
			afterCreate : function() {
				var self = this;
				K.ctrl(document, 13, function() {
					self.sync();
					K('form[name=creator]')[0].submit();
				});
				K.ctrl(self.edit.doc, 13, function() {
					self.sync();
					K('form[name=creator]')[0].submit();
				});
			}
		});
		prettyPrint();
	});
</script>
<textarea name="detail" class="form-control"><?= set_value('detail') ?></textarea>
