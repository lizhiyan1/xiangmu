<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\News;
use Validator;
use Memcache;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        

        $id=$_GET['b_id']??5;
        $mem=new Memcache();
        $data=cache('data_'.$id);
        if (!$data) {
             $query=request()->all();
        $where=[];
        if ($query['n_title']??'') {
            $where[]=['n_title','like',"%$query[n_title]%"];
        }
         if ($query['b_id']??'') {
            $where['news.b_id']=$query['b_id'];
        }

      

       $pageSize=config('app.pageSize');
       echo "db";
       $data=DB::table('news')->where($where)->join('newsfl', 'news.b_id', '=', 'newsfl.b_id')->orderBy('n_id','desc')->paginate($pageSize);
        cache(['data_'.$id=>$data],5);
       // dd($data);
       $News_model = new News;
        $news = $News_model->all();
        
        }
        return view('news/list',['data'=>$data,'query'=>$query,'news'=>$news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$News_model = new News;
        $news = $News_model->all();
        // dd($news);
        return view('news/add',['news'=>$news]);
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	 $validator = Validator::make($request->all(), [
           'n_title' => 'required|unique:news',
           'b_id' => 'required',
           'n_zyx' => 'required',
           'is_show' => 'required',
         ],[
            'n_title.required'=>'文章标题必填',
            'n_title.unique'=>'文章标题不能重复',
            
            'b_id.required'=>'文章分类必填',
            'n_zyx.required'=>'文章重要性必填',
            'is_show.required'=>'是否显示必填',

         ]);
         if ($validator->fails()) {
         return redirect('news/add')
         ->withErrors($validator)
        ->withInput();
 }
         $data=$request->except(['_token','id']);

         //文件上传
          if ($request->hasFile('n_file')) {
          $res=$this->upload($request,'n_file');
          if ($res['code']) {
              $data['n_file']=$res['imgurl'];
          }
       }

         $res=DB::table('news')->insert($data);
         if ($res) {
           return redirect('/news/list');
       }
    }
     public function upload(Request $request, $file){
        if ($request->file($file)->isValid()) {
             $photo = $request->file($file);
            
             // $extension = $photo->extension();
             $store_result = $photo->store(date('Ymd'));
             // $store_result = $photo->storeAs('photo', 'test.jpg');
             // $output = [
             // 'extension' => $extension,
             // 'store_result' => $store_result
             // ];
             // print_r($output);exit();
              return ['code'=>1,'imgurl'=>$store_result];
        }else{
            return ['code'=>0,'message'=>'上传过程出错'];
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $res=DB::table('news')->where('n_id','=',$id)->delete();
      // $res=App\Brand::destroy($id);
       if ($res) {
            return redirect('/news/list');
    }
}
}
