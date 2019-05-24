<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>品牌详情</title>

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
      <div class="content">
        <h3>show</h3><hr />
        
        <p>ID:{{$data['brand_id']}}</p>
        <p>名称:{{$data['brand_name']}}</p>
      
        <table>
                  
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                 
                  @foreach($arr as $v)
                  <tr>
                    <td>{{$v->p_email}}</td>
                    <td>{{$v->p_dj}}星</td>
                    <td>{{$v->p_desc}}</td>
                    <td>{{$v->p_desc}}</td>
                    <td>{{$v->add_time}}</td>
                    <td>
                     

                    </td>
                  </tr>
                  @endforeach
                 
                </table>
              {{ $arr->links() }}
      </div>
     
              
     

      <form action="/brand/add_do2" method="post">
        {{csrf_field()}}
        用户名：匿名用户<br>
        E-amil：<input type="text" name="p_email" id=""><br />
        评价等级：
         <input type="radio" name="p_dj" value="1">1级
         <input type="radio" name="p_dj" value="2">2级
         <input type="radio" name="p_dj" value="3">3级
         <input type="radio" name="p_dj" value="4">4级
         <input type="radio" name="p_dj" value="5">5级<br />
        评论内容：<textarea name="p_desc" rows="" cols=""></textarea><br>
        <input type="submit" value="发布">
      </form>
    </body>


</html>
