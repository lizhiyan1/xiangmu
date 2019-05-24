<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>品牌修改</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

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
       @if ($errors->any())
			 <div class="alert alert-danger">
			 <ul>
		@foreach ($errors->all() as $error)
			 <li>{{ $error }}</li>
		@endforeach
			 </ul>
			 </div>
		@endif

    <div class="content">
    	
         <form action="{{url('/brand/update/'.$data->brand_id)}}" method="post" enctype="multipart/form-data">
               	<table border="1">
               		{{csrf_field()}}
               		<tr>
               			<td>品牌名称</td>
               			<td><input type="text" name="brand_name" value="{{$data->brand_name}}"></td>
               		</tr>
               		<tr>
               			<td>品牌描述</td>
               			<td><textarea name="brand_desc" rows="" cols="">{{$data->brand_desc}}</textarea></td>
               		</tr>
               		<tr>
               			<td>品牌LOGO</td>
               			<td><img width="50px" height="50px" src="{{config('app.img_url')}}{{$data->brand_logo}}"><input type="file" name="brand_logo"></td>
               		</tr>
               		<tr>
               			<td>品牌网址</td>
               			<td><input type="text" name="brand_url" value="{{$data->brand_url}}"></td>
               		</tr>
               		<tr>
               			<td colspan="2"><button>提交</button></td>
               			
               		</tr>
               	</table>
         </form>
     </div>
     
    </body>
    <script>{{asset('js/jquery-3.3.1.min.js')}}</script>
    <script>
      
    </script>
</html>
