
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 基本的表格</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--第一步：引入Javascript / CSS （CDN）-->
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">


    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script src="/layer/layer.js"></script>
</head>
<body>

<!--第二步：添加如下 HTML 代码-->
<table id="table_id_example" class="display">
    <thead>
    <tr>
        <th>id</th>
        <th>文章标题</th>
        <th>文章作者</th>
        <th>文章封面</th>
        <th>文章摘要</th>
        <th>文章内容</th>
        <th>添加时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $val)
    <tr>
        <td>{{$val->id}}</td>
        <td>{{$val->title}}</td>
        <td>{{$val->name}}</td>
        <td>{{$val->file}}</td>
        <td>{{$val->desn}}</td>
        <td>{{$val->body}}</td>
        <td>{{$val->created_at}}</td>
        <td>
            <a href="{{url('del')}}" class="del" where="{{$val->id}}">删除</a>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>



</body>
</html>
<script>
    // <!--第三步：初始化Datatables-->

     var table=$('#table_id_example').DataTable();

    $(".del").click(function () {
        // 获取点击的url地址
        var url=$(this).attr('href')
       // 获取删除的id
        var id=$(this).attr('where')
        $.ajax({
            type: "delete",
            url,
            data: {
                id,
                _token:"{{csrf_token()}}"
            },
            success: function(msg){
                if(msg.code==200){
                    layer.msg('删除成功', {icon: 1});
                    location.reload()
                }
            }
        });
        return false
    })
    table.on( 'draw', function () {

    } );
</script>
