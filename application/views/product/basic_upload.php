<input id="product-image-upload" type="file" accept="image/*" data-url="upload" multiple>  <!-- delete name="files[]" -->
<!-- use after jquery -->
<script src="<?= base_url('assets/js/vendor/jquery.ui.widget.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.iframe-transport.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.fileupload.js') ?>"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?= base_url('assets/js/load-image.all.min.js') ?>"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?= base_url('assets/js/canvas-to-blob.min.js') ?>"></script>
<!-- The File Upload processing plugin -->
<script src="<?= base_url('assets/js/jquery.fileupload-process.js') ?>"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?= base_url('assets/js/jquery.fileupload-image.js') ?>"></script>
<script>
$(function () {
    $('#product-image-upload').fileupload({
        dataType: 'json',
        disableImageResize: false,
        imageMaxWidth: 1024,
        imageMaxHeight: 1024,
        previewThumbnail: false,
        acceptFileTypes: /(\.|\/)(jpg)$/i,
        //disableImageHead: true,
        //imageCrop: true,
        add: function (e, data) {
            var progress = 0;
            $('#progress .bar').css(
                'width',
                progress + '%'
            );
            var fileType = data.files[0].name.split('.').pop(), allowdtypes = 'jpeg,jpg,png,gif';
            if (allowdtypes.indexOf(fileType) < 0) {
                alert('请上传图片文件');
                return false;
            }
            data.submit();
        },
        progress: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .bar').css(
                'width',
                progress + '%'
            );
        },
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
            	var divid = file.name;
            	var tmp = '\
<div class="media alert alert-success">\
	<a href="http://milkcu.qiniudn.com/sdnuflea/' + file.name + '" class="pull-left" target="_blank">\
		<img src="http://milkcu.qiniudn.com/sdnuflea/' + file.name + '?imageView2/1/w/100/h/100">\
	</a>\
    <div class="media-body">\
        <button class="close" data-dismiss="modal" type="button" onclick="deldiv(\'' + file.name + '\')">×</button>\
        上传成功\
    </div>\
	<input type="hidden" name="images[]" value="' + file.name + '">\
</div>';
                $('<div class="col-xs-6" id="' + divid + '"/>').text('').appendTo(document.getElementById('product-image-create'));
                document.getElementById(divid).innerHTML = tmp;
                console.log(file);
            });
            $('#progress .bar').css('width', '0%')
        }
    });
});
</script>
<script>
function deldiv(divid) {
    div = document.getElementById(divid);
    div.parentNode.removeChild(div);
    var progress = 0;
    $('#progress .bar').css('width', '0%')
}
</script>
