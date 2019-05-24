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
       <!--  <style>
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
        </style> -->
    </head>
    <body>
       <form action="">
          <input type="text" name="brand_name" value="{{$query['brand_name']??''}}" id="" placeholder="请输入关键字">
       	<input type="text" name="brand_url" id="" value="{{$query['brand_url']??''}}" placeholder="请输入网址"><button>搜索</button>
       </form>

    <div class="content" id="con">
              
               	<table border="1">
               		
               		<tr>
               			<td>ID</td>
               			<td>品牌名称</td>
               			<td>品牌描述</td>
               			<td>品牌LOGO</td>
               			<td>品牌网址</td>
               			<td>删除</td>
               		</tr>
               		@if($data)
               		@foreach($data as $v)
               		<tr>
               			<td>{{$v->brand_id}}</td>
               			<td><a href="/brand/show/{{$v->brand_id}}">{{$v->brand_name}}</a></td>
               			<td>{{$v->brand_desc}}</td>
               			<td><img src="{{config('app.img_url')}}{{$v->brand_logo}}" width="50px" height="50px" alt=""></td>
               			<td>{{$v->brand_url}}</td>
               			<td>
               				<a href="/brand/del/{{$v->brand_id}}">删除</a>
               				<a href="/brand/edit/{{$v->brand_id}}">修改</a>

               			</td>
               		</tr>
               		@endforeach
               		@endif

               	</table>
                {{$data->appends($query)->links()}}
        
     </div>
   
    </body>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script>
      $(document).on('click', '.pagination a', function() {
        var url=$(this).attr('href');
        $.ajax({
          url: url,
          method: 'GET',
          data:''
        })
        .done(function(msg) {
          $('#con').html(msg);
        });
        return false;
        
      });
    </script>
</html>
