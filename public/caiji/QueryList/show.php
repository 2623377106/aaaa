<?php
//引入采集文件
require 'phpQuery.php';
require 'QueryList.php';
$pdo=new PDO('mysql:host=127.0.0.1;dbname=look','root','root');
//查询url那一列
$sql="select id,url from articles";
$a=$pdo->query($sql)->fetchAll(2);
foreach ($a as $val){
    $url="http://www.techweb.com.cn/newgame/";
//    设置采集的网址
    $rules=[
        'body'=>['.news_text>p','text'],
    ];
    $data=@\QL\QueryList::Query($url,$rules)->data;
    print_r($data);
    foreach ($data as $va){
        $pdo=new PDO('mysql:host=127.0.0.1;dbname=look','root','root');
//    写入sql语句
        $id=$val['id'];

        $sq="update articles set body=? where id=?";
        $sw=$pdo->prepare($sq);
        $sw->execute([$va['body'],$id]);
    }

}
