
@extends('common.common')
@section('header')
    <style>
        .login{
            justify-content: center;
            display: flex;
        }
        .tab-width{
            width: 800px;
        }
    </style>
@stop
@section('body')
   <div class="login">
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
                   if (this.getAttribute('lay-id') == 'register') {
                       window.location = "{{ route('register') }}"
                   }
               });
                element.init()
               //…
           });
       </script>
   </div>
@stop
