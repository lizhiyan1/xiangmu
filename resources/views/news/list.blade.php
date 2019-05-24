<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>品牌添加</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
         <link href="{{asset('css/page.css')}}" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
       <form action="">
         <select name="b_id">
            
			@foreach($news as $v)
            <option value="{{$v->b_id}}">{{$v->b_name}}</option>
             @endforeach
            
              
        </select>
       	<input type="text" name="n_title" id="" value="{{$query['n_title']??''}}" placeholder="请输入关键字"><button>搜索</button>
       </form>

    <div class="content">
       
               	<table border="1">
               		
               		<tr>
               			<td>ID</td>
               			<td>文章标题</td>
               			<td>文章分类</td>
               			<td>文章重要性</td>
               			<td>是否显示</td>
               			<td>文章作者</td>
               			<td>作者email</td>
               			<td>关键字</td>
               			<td>网页描述</td>
               			<td>上传文件</td>
               			<td>操作</td>
               		</tr>
               		 @if($data) 
               		@foreach($data as $v)
               		<tr>
               			<td>{{$v->n_id}}</td>
               			<td>{{$v->n_title}}</td>
               			<td>{{$v->b_name}}</td>
               			<td>{{$v->n_zyx=='1'?'普通':'置顶'}}</td>
               			<td>{{$v->is_show=='1'?'显示':'不显示'}}</td>
               			<td>{{$v->n_name}}</td>
               			<td>{{$v->n_email}}</td>
               			<td>{{$v->n_gjz}}</td>
               			<td>{{$v->n_desc}}</td>
               			<td><img src="{{config('app.img_url')}}{{$v->n_file}}" width="50px" height="50px" alt=""></td>
               			
               			<td>
               				<a href="/news/del/{{$v->n_id}}">删除</a>
               				<a href="">修改</a>

               			</td>
               		</tr>
               		@endforeach
               		 @endif
               	</table>
         
     </div>
   {{ $data->appends($query)->links() }}
    </body>
</html>
