<input id="user-avatar-upload" type="file" data-url="upload" style="display: none"  multiple>  <!-- delete name="files[]" -->
<!-- use after jquery -->
<script src="<?= base_url('assets/js/vendor/jquery.ui.widget.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.iframe-transport.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.fileupload.js') ?>"></script>
<script>
$(function () {
    $('#user-avatar-upload').fileupload({
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
            	//var divid = file.name;
            	var divid = 'avatar-upload';
            	var tmp = '\
            		<img src="http://milkcu.qiniudn.com/sdnuflea/' + file.name + '?imageView2/1/w/250/h/250">\
					<input type="hidden" name="avatar" value="' + file.name + '">';
                $('<div id="' + divid + '"/>').text('').appendTo(document.getElementById('user-avatar-preview'));
                document.getElementById(divid).innerHTML = tmp;
                console.log(file);
            });
        }
    });
});
</script>
