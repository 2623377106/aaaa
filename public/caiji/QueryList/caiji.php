<?php
//引入采集文件
require 'phpQuery.php';
require 'QueryList.php';
//设置采集的网址
$url="http://www.techweb.com.cn/newgame/";
$rules=[
    'title'=>['.news_title>h3>a','text'],
    'name'=>['.keywords>a','text'],
    'desn'=>['.news_text>p','text'],
    'file'=>['.na_pic>img','src'],
    'url'=>['.news_title>h3>a','href'],
    'body'=>['.news_text>p','text'],
];
$data=@\QL\QueryList::Query($url,$rules)->data;

foreach ($data as $key=>&$val){
    if($key>19){
        unset($data[$key]);
    }
    if(empty($val['file'])){
        $val['file']="http://upload1.techweb.com.cn/s/250/2021/0128/1611843124313.png";
    }

//    获取文件后缀
    $hou=substr($val['file'],-4);
//    给保存在本地的文件起一个名字
    $file='./uploads/article/'.time().rand(1,99999999).$hou;
    $info=file_get_contents($val['file']);
//    使用函数读取文件
    file_put_contents($file,$info);
    $pdo=new PDO('mysql:host=127.0.0.1;dbname=look','root','root');
//    写入sql语句
    $sql="insert into articles (title,name,file,desn,body,url) values (?,?,?,?,?,?)";
    $sw=$pdo->prepare($sql);
    $sw->execute([$val['title'],$val['name'],$val['file'],$val['desn'],$val['body'],$val['url']]);
}




