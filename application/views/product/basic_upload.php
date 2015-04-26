<input id="product-image-upload" type="file" data-url="upload" multiple>  <!-- delete name="files[]" -->
<!-- use after jquery -->
<script src="<?= base_url('assets/js/vendor/jquery.ui.widget.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.iframe-transport.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.fileupload.js') ?>"></script>
<script>
$(function () {
    $('#product-image-upload').fileupload({
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
            	var divid = file.name;
            	var tmp = '\
<div class="media alert alert-success">\
	<a href="http://milkcu.qiniudn.com/sdnuflea/' + file.name + '" class="pull-left" target="_blank">\
		<img src="http://milkcu.qiniudn.com/sdnuflea/' + file.name + '?imageView2/1/w/100/h/100">\
	</a>\
	<div class="media-body"><h4>上传成功</h4>' + file.type + '</div>\
	<input type="hidden" name="images[]" value="' + file.name + '">\
</div>';
                $('<div class="col-md-4" id="' + divid + '"/>').text('').appendTo(document.getElementById('product-image-create'));
                document.getElementById(divid).innerHTML = tmp;
                console.log(file);
            });
        }
    });
});
</script>
