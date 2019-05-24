
    <div class="content">
       
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
         
     </div>
   {{$data->appends($query)->links()}}
  