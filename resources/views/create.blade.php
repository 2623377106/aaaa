<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 水平表单</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/utf8-php/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/utf8-php/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/utf8-php/lang/zh-cn/zh-cn.js"></script>
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">

    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
</head>
<body>

<form class="form-horizontal" role="form" action="{{url('save')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">文章标题</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname"
                  name="title">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">文章作者</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="lastname"
                  name="name" >
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">文章封面</label>
        <div class="col-sm-10">
            <div id="picker">选择文件</div>
            <img src="" alt="" id="img" hidden>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">文章摘要</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="lastname"
            name="desn">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">文章内容</label>
        <div class="col-sm-10">
            <textarea name="body" id="text" cols="30" rows="10">

            </textarea>
        </div>
    </div>
    <input type="hidden" name="file" value="" id="fi">
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">添加</button>
        </div>
    </div>
</form>

</body>
</html>
<script>
    UE.getEditor('text')
    // 初始化Web Uploader
    var uploader = WebUploader.create({
        // 选完文件后，是否自动上传。
        auto: true,
        // 只能选择一张图片
        multiple:false,
        // swf文件路径
        swf:  '/webuploader/Uploader.swf',
        // 文件接收服务端。
        server: 'http://www.kedemo.com/index.php/upfile',
        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        formData: {_token:"{{csrf_token()}}"},
        pick: '#picker',
        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        }

    });
    uploader.on( 'uploadSuccess', function( file,res ) {
        if(res.code==200){
            var src="http://www.kedemo.com/uploads/article/"+res.data
            $("#img").attr('src',src).show()
            $("#fi").val(src)
        }
    });
</script>
