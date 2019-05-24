<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreBlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Memcache;
use DB;
use Validator;
use App\Brand;
class BrandController extends Controller
{
    public function logindo(){
         $email =  request()->email;
         $password =  request()->password;
         // echo $email;
         // echo $password;
       if(Auth::attempt(['email'=>$email,'password'=>$password])){
        // dump(Auth::user());
        // dd(Auth::id());
        return redirect()->intended('/');
       }else{
        return "登陆失败";
       }
    }
    //发送邮件
    public function sendemail(){
        $email =  request()->email;
        
        $this->send($email);
        // echo "111";
        
    }
 
    public function send($email){
        \Mail::send('email' , ['name'=>$email] ,function($message)use($email){
        //设置主题
            $message->subject("欢迎注册滕浩有限公司121");
        //设置接收方
            $message->to($email);
        });
}
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $page=request()->page??1;
       // dd($page);
       $query=request()->all();
       $brand_name=$query['brand_name']??'';
       $brand_url=$query['brand_url']??'';
      //dd('list_'.$page.'_'.$brand_name.'_'.$brand_url);
       $data=cache('list_'.$page.'_'.$brand_name.'_'.$brand_url);
       //dd($data);
       if (!$data) {
        
        // echo "db";
        $where=[];
        if ($brand_name) {
            $where[]=['brand_name','like',"%$brand_name%"];
        }
         if ($brand_url) {
            $where['brand_url']=$brand_url;
        }
        $pageSize=config('app.pageSize');
        // DB::connection()->enableQueryLog();
        // $data=DB::table('brand')->where($where)->orderBy('brand_id','desc')->paginate($pageSize);
        $data=Brand::where($where)->orderBy('brand_id','desc')->paginate($pageSize);

        // $logs = DB::getQueryLog();
        // dd($logs);
        cache(['list_'.$page.'_'.$brand_name.'_'.$brand_url=>$data],5);
          }

          if (request()->ajax()) {
           return view('brand/ajaxlist',['data'=>$data,'query'=>$query]);
          }


       return view('brand/list',['data'=>$data,'query'=>$query]);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     //$data=cache('data_'.$id);
      //dd($data);
      //if (!$data) {
        //echo "db";
       $data=Brand::find($id);
      // cache(['data_'.$id=>$data],5);
        

       $pageSize=config('app.pageSize');
       $arr=DB::table('comment')->paginate($pageSize);
       // dd($data);
      
      //}

     
        
        return view('brand/show',['data'=>$data,'arr'=>$arr]);
    }
    public function add_do2(Request $request){
      $data=$request->except(['_token','id']);
      //$id=$_GET('p_id');
      $data['add_time']=date('Y-m-d H:i:s',time());
      $res=DB::table('comment')->insert($data);
      if ($res) {
           return redirect('/brand/show/{{$id}}');
       }
    }

    /**
     * Show the form for creating a new resource.
     *添加
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Cookie::queue('author','学一问我',1);
       //return response('hi')->cookie('name','1811',12);
       return view('brand/add');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    // 第二种验证
     // public function store(StoreBlogPost $request)
    {
        //第三种验证
    $validator = Validator::make($request->all(), [
           'brand_name' => 'required|unique:brand|max:10',
           'brand_logo' => 'required',
           'brand_url' => 'required',
           'brand_desc' => 'required',
         ],[
            'brand_name.required'=>'品牌名称必填',
            'brand_name.unique'=>'品牌名称不能重复',
            'brand_name.max'=>'品牌名称字节不能超过10个',
            'brand_logo.required'=>'品牌LOGO必填',
            'brand_url.required'=>'品牌网址必填',
            'brand_desc.required'=>'品牌描述必填',

         ]);
         if ($validator->fails()) {
         return redirect('brand/add')
         ->withErrors($validator)
        ->withInput();
 }
       //获取所有
       $data=$request->except(['_token','id']);
       //第一种验证
 //       $validatedData = $request->validate([
 //       'brand_name' => 'required|unique:brand|max:10',
 //       'brand_logo' => 'required',
 //       'brand_url' => 'required',
 //       'brand_desc' => 'required',
 // ],[    
 //        'brand_name.required'=>'品牌名称必填',
 //        'brand_name.unique'=>'品牌名称不能重复',
 //        'brand_name.max'=>'品牌名称字节不能超过10个',
 //        'brand_logo.required'=>'品牌LOGO必填',
 //        'brand_url.required'=>'品牌网址必填',
 //        'brand_desc.required'=>'品牌描述必填',

 // ]);
       //文件上传
       if ($request->hasFile('brand_logo')) {
          $res=$this->upload($request,'brand_logo');
          if ($res['code']) {
              $data['brand_logo']=$res['imgurl'];
          }
       }
       // $Brand  = new Brand;
       // dd($Brand);
       $res=Brand::create($data);
       // $res=DB::table('brand')->insert($data);
       // dd($res);
       if ($res) {
           return redirect('/brand/list');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Brand::find($id);
        //dd($data);
        return view("brand/edit",compact('data'));
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
        $data=$request->except('_token');

             //第三种验证
    $validator = Validator::make($data, [
        'brand_name'=>[
        'required',
        'max:10',
        Rule::unique('brand')->ignore($id,'brand_id'),
    ],
           // 'brand_logo' => '',
           'brand_url' => 'required',
           'brand_desc' => 'required',
         ],[
            'brand_name.required'=>'品牌名称必填',
            'brand_name.unique'=>'品牌名称不能重复',
            'brand_name.max'=>'品牌名称字节不能超过10个',
            'brand_logo.required'=>'品牌LOGO必填',
            'brand_url.required'=>'品牌网址必填',
            'brand_desc.required'=>'品牌描述必填',

         ]);
          if ($validator->fails()) {
         return redirect('brand/edit/'.$id)
         ->withErrors($validator)
        ->withInput();
        }

         //文件上传
       if ($request->hasFile('brand_logo')) {
          $res=$this->upload($request,'brand_logo');
          if ($res['code']) {
              $data['brand_logo']=$res['imgurl'];
          }
       }

       $res=Brand::where('brand_id',$id)->update($data);
       if ($res) {
           return redirect('/brand/list');
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
       $res=DB::table('brand')->where('brand_id','=',$id)->delete();
      // $res=App\Brand::destroy($id);
       if ($res) {
            return redirect('/brand/list');
       }
    }
}
