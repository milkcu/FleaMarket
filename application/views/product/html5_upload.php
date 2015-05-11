<input id="product-image-upload" type="file" accept="image/*" capture="camera" data-url="upload" multiple>  <!-- delete name="files[]" -->
<canvas id="cvs" width="0" height="0" class="hidden"></canvas>
<script>
//绑定input change事件
$("#product-image-upload").unbind("change").on("change",function(){
    $('#progress .bar').css('width', '0%');
    var file = this.files[0];
    if(file){
        //验证图片文件类型
        if(file.type && !/image/i.test(file.type)){
            return false;
        }
        var reader = new FileReader();
        reader.onload = function(e){
            //readAsDataURL后执行onload，进入图片压缩逻辑
            //e.target.result得到的就是图片文件的base64 string
            render(file,e.target.result);
        };
        //以dataurl的形式读取图片文件
        reader.readAsDataURL(file);
    }
});

//定义照片的最大高度
var MAX_HEIGHT = 1440;
var render = function(file,src){
    var image = new Image();
    image.onload = function(){
        var cvs = document.getElementById("cvs");
        var w = image.width;
        var h = image.height;
        //计算压缩后的图片长和宽
        if(h>MAX_HEIGHT){
            w *= MAX_HEIGHT/h;
            h = MAX_HEIGHT;
        }
        var ctx = cvs.getContext("2d");
        cvs.width = w;
        cvs.height = h;
        //将图片绘制到Canvas上，从原点0,0绘制到w,h
        ctx.drawImage(image,0,0,w,h);

        //进入图片上传逻辑
        sendImg();
    };
    image.src = src;
};
// upload image to qiniu using putb64
function putb64(pic){
    var url = "http://up.qiniu.com/putb64/-1";
	var xhr = new XMLHttpRequest();

	xhr.onreadystatechange=function(){
		if (xhr.readyState==4){
            //document.getElementById("myDiv").innerHTML=xhr.responseText;
            var obj = eval("(" + xhr.responseText + ")");
            filename = obj.key;
            console.log(filename);
            var divid = filename;
            var tmp = '\
<div class="media alert alert-success" style="text-align: center;">\
    <img src="<?= img_url() ?>' + filename + '?imageView2/1/w/100/h/100" alt="上传成功">\
    <div class="media-body" style="margin-top: -10px; margin-right: -10px; float: right;">\
        <button class="close" data-dismiss="modal" type="button" onclick="del_div(\'' + filename + '\')">×</button>\
    </div>\
	<input type="hidden" name="images[]" value="' + filename + '">\
</div>';
            $('<div class="col-lg-6 col-md-4 col-sm-4 col-xs-6" id="' + divid + '"/>').text('').appendTo(document.getElementById('product-image-create'));
            document.getElementById(divid).innerHTML = tmp;
            $('#progress .bar').css('width', '100%');
		}
	}
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-Type", "application/octet-stream");
    xhr.setRequestHeader("Authorization", "UpToken <?= $token ?>");
	xhr.send(pic);
}

//上传图片到服务器
var sendImg = function(){
    var cvs = document.getElementById("cvs");
    //调用Canvas的toDataURL接口，得到的是照片文件的base64编码string
    var data = cvs.toDataURL("image/jpeg");
    //base64 string过短显然就不是正常的图片数据了，过滤の。
    if(data.length<48){
        console.log("data error.");
        return;
    }
    //图片的base64 string格式是data:/image/jpeg;base64,xxxxxxxxxxx
    //是以data:/image/jpeg;base64,开头的，我们在服务端写入图片数据的时候不需要这个头！
    //所以在这里只拿头后面的string
    //当然这一步可以在服务端做，但让闲着蛋疼的客户端帮着做一点吧~~~（稍微减轻一点服务器压力）
    data = data.split(",")[1];
    putb64(data);
    return;
    console.log('toqiniu');
    $.post("<?= site_url('test/post') ?>",{
        fileName:"xxx.jpeg",
        fileData:data
    },function(data){
        console.log(data);
        if(data.status==200){
            // some code here.
            console.log("commit image success.");
        }else{
            console.log("commit image failed.");
        }
    },"json");
    console.log('end');
};
function del_div(divid) {
    div = document.getElementById(divid);
    div.parentNode.removeChild(div);
    var progress = 0;
    $('#progress .bar').css('width', '0%')
}
</script>
