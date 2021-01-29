<?php

namespace App\Http\Controllers;

use App\Article;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class ArticleController extends Controller
{
    //展示文章列表
    public function index(){
        //    查询数据
        $data=Article::get();
        return view('index',compact('data'));
    }
//    渲染添加表单
    public function create(){
        return view('create');
    }
//    图片异步上传的方法
   public function upfile(Request $request){
     $data=$request->file('file')->store('','upfile');
//     图片压缩
       $url='uploads/article/'.$data;
        $file= Image::make($url)->resize(100, 100)->text('2021/1/28')->save();
       $accessKey ="VEahUYz0rivkJsfe7wP_p8VlgMMT0JfBtDySt6Hk";     //AK值
       $secretKey ="AnG6wmPNhBDSphPA3BndAtr2Jh8rf7LEmVEkFbDX";     //SK值
       $bucket = "axd1";     //空间名称
       $uploadMgr = new UploadManager();
       $auth = new Auth($accessKey, $secretKey);
       $key=date('Y-m-d').time();
       $token = $auth->uploadToken($bucket);
//        $uploadMgr->putFile($token, $key, $url);
         return ['code'=>200,'msg'=>'上传成功','data'=>$data];
   }
   public function save(Request $request){
        Log::info('添加操作');
        $data=$request->except('_token');
        if(Article::create($data)){
            return redirect(url('index'));
        }
   }
   public function del(Request $request){
        Log::info('删除操作');
       $data=$request->except('_token');
//       根据id删除数
       Article::destroy($data['id']);
       return ['code'=>200,'msg'=>'删除成功','data'=>null];
   }
   public function indexs(){
        $data=Article::get();
        return ['code'=>200,'data'=>$data];
   }
   public function show(Request $request){
//       根据id查询详细数据
       $id=$request->get('id');
       $data=Article::where('id',$id)->first();
       return ['code'=>200,'data'=>$data];
   }
}
