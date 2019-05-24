<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>品牌添加</title>

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
    	
         <form action="{{url('/news/add_do')}}" method="post" enctype="multipart/form-data">
               	<table border="1">
               		{{csrf_field()}}
               		<tr>
               			<td>文章标题</td>
               			<td><input type="text" name="n_title" id=""></td>
               		</tr>
               		<tr>
               			<td>文章分类</td>
               			<td>
               				<select name="b_id" id="">
               					@foreach($news as $v)
			                    <option value="{{$v->b_id}}">{{$v->b_name}}</option>
			                    @endforeach
               				</select>
               			</td>
               		</tr>
               		<tr>
               			<td>文章重要性</td>
               			<td>
               				<input type="radio" name="n_zyx" value="1" id="" checked>普通
               				<input type="radio" name="n_zyx" value="0" id="">置顶
               			</td>
               		</tr>
               		<tr>
               			<td>是否显示</td>
               			<td>
               				<input type="radio" name="is_show" value="1" id="" checked>显示
               				<input type="radio" name="is_show" value="0" id="">不显示
               			</td>
               		</tr>
               		<tr>
               			<td>文章作者</td>
               			<td><input type="text" name="n_name" id=""></td>
               		</tr>
               		<tr>
               			<td>作者email</td>
               			<td><input type="text" name="n_email" id=""></td>
               		</tr>
               		<tr>
               			<td>关键字</td>
               			<td><input type="text" name="n_gjz" id=""></td>
               		</tr>
               		<tr>
               			<td>网页描述</td>
               			<td><textarea name="n_desc" rows="" cols=""></textarea></td>
               		</tr>
               		<tr>
               			<td>上传文件</td>
               			<td><input type="file" name="n_file" id=""></td>
               		</tr>
               		
               		<tr>
               			<td colspan="2"><button>提交</button> <input type="reset" value="重置" ></td>
               			
               		</tr>
               	</table>
         </form>
     </div>
     
    </body>
</html>


