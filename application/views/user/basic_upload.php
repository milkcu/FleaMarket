<input id="user-avatar-upload" type="file" accept="image/*" capture="camera" data-url="upload" style="display: none"  multiple>  <!-- delete name="files[]" -->
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
    $('#user-avatar-upload').fileupload({
        dataType: 'json',
        disableImageResize: false,
        imageMaxWidth: 255,
        imageMaxHeight: 255,
        previewThumbnail: false,
        imageCrop: true,
        /*
        add: function(e, data) {
            var fileType = data.files[0].name.split('.').pop(), allowdtypes = 'jpeg,jpg,png,gif';
            if (allowdtypes.indexOf(fileType) < 0) {
                alert('请上传图片文件');
                return false;
            }
            data.submit();
        },
        */
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
            	//var divid = file.name;
            	var divid = 'avatar-upload';
            	var tmp = '\
            		<img src="http://milkcu.qiniudn.com/sdnuflea/' + file.name + '?imageView2/1/w/250/h/250" style="width: 100%; height: 100%">\
					<input type="hidden" name="avatar" value="' + file.name + '">';
                $('<div id="' + divid + '"/>').text('').appendTo(document.getElementById('user-avatar-preview'));
                document.getElementById(divid).innerHTML = tmp;
                console.log(file);
            });
        }
    });
});
</script>
