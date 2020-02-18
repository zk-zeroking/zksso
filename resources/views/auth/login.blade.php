
@extends('common.common')
@section('header')
    <style>
        .login{
            justify-content: center;
            display: flex;
        }
        .tab-width{
            width: 400px;
        }
    </style>
@stop
@section('body')
   <div class="login">
       <div class="layui-tab layui-tab-brief" lay-filter="tab">
           <ul class="layui-tab-title">
               <li class="layui-this">账号登录</li>
               @if(!isset($open_id))
               <li>第三方登录{{$open_id ?? 'xx'}}</li>
               @endif
               <li lay-id="register">注册</li>
           </ul>
           <div class="layui-tab-content">
               <div class="layui-tab-item layui-show tab-width">
                   <form class="layui-form" method="POST" action="{{ route('login') }}">
                       @csrf
                       <div class="layui-form-item">
                           <label class="layui-form-label">邮箱</label>
                           <div class="layui-input-inline">
                               <input type="email" name="email" required  lay-verify="required" placeholder="请输入邮箱地址" autocomplete="off" class="layui-input">
                           </div>
                           @error('email')
                           <div class="layui-form-mid layui-word-aux" style="color: red !important;">{{ $message }}</div>
                           @enderror

                       </div>
                       <div class="layui-form-item">
                           <label class="layui-form-label">密码</label>
                           <div class="layui-input-inline">
                               <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                           </div>
                           @error('password')
                           <div class="layui-form-mid layui-word-aux" style="color: red !important;">{{ $message }}</div>
                           @enderror
                       </div>

                       <div class="layui-form-item">
                           <div class="layui-input-block">
                               <input type="checkbox" name="remember" title="记住我" lay-skin="primary" {{ old('remember') ? 'checked' : '' }}>

                           </div>
                       </div>

                       <div class="layui-form-item">
                           <div class="layui-input-block">
                               <button class="layui-btn layui-btn-radius" type="submit">登录</button>
                               @if (Route::has('password.request'))
                                   <a class="layui-btn layui-btn-radius layui-btn-primary" href="{{ route('password.request') }}">
                                       忘记密码？
                                   </a>
                               @endif
                           </div>
                       </div>
                   </form>
               </div>
               @if(!isset($open_id))
               <div class="layui-tab-item tab-width">
                   <a class="layui-btn layui-btn-radius layui-btn-primary" onclick="qq_login()">QQ登录</a>
               </div>
               @endif
               <div class="layui-tab-item tab-width">
                   <form class="layui-form" method="POST" action="{{ route('register') }}">
                       @csrf
                       <div class="layui-form-item">
                           <label class="layui-form-label">姓名</label>
                           <div class="layui-input-inline">
                               <input type="text" name="name" value="{{ old('name') }}" required  lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
                           </div>
                           @error('name')
                           <div class="layui-form-mid layui-word-aux" style="color: red !important;">{{ $message }}</div>
                           @enderror

                       </div>
                       <div class="layui-form-item">
                           <label class="layui-form-label">邮箱</label>
                           <div class="layui-input-inline">
                               <input type="email" name="email" required  lay-verify="required" placeholder="请输入邮箱地址" autocomplete="off" class="layui-input">
                           </div>
                           @error('email')
                           <div class="layui-form-mid layui-word-aux" style="color: red !important;">{{ $message }}</div>
                           @enderror

                       </div>
                       <div class="layui-form-item">
                           <label class="layui-form-label">密码</label>
                           <div class="layui-input-inline">
                               <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                           </div>
                           @error('password')
                           <div class="layui-form-mid layui-word-aux" style="color: red !important;">{{ $message }}</div>
                           @enderror
                       </div>
                       <div class="layui-form-item">
                           <label class="layui-form-label">确认密码</label>
                           <div class="layui-input-inline">
                               <input type="password" name="password_confirmation" required lay-verify="required" placeholder="请再次输入密码" autocomplete="off" class="layui-input">
                           </div>
                           @error('password')
                           <div class="layui-form-mid layui-word-aux" style="color: red !important;">{{ $message }}</div>
                           @enderror
                       </div>

                       <div class="layui-form-item">
                           <div class="layui-input-block">
                               <button class="layui-btn layui-btn-radius" type="submit">注册</button>
                           </div>
                       </div>
                   </form>
               </div>
           </div>
       </div>


       <script>
           //Demo
           layui.use('form', function(){
               var form = layui.form;

               //监听提交
               form.on('submit(formDemo)', function(data){
                   layer.msg(JSON.stringify(data.field));
                   return false;
               });
               form.render()
           });
           layui.use('element', function(){
               var element = layui.element;
               element.on('tab(tab)', function(){
                   {{--if (this.getAttribute('lay-id') == 'register') {--}}
                       {{--window.location = "{{ route('register') }}"--}}
                   {{--}--}}
               });
                element.init()
               //…
           });
           function qq_login() {
               window.location = "/qq/login"
           }
       </script>
   </div>
@stop
