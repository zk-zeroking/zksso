
@extends('common.common')
@section('body')
    <form class="layui-form" action="">
        @if ($app->id)
            <input hidden name="id" value="{{$app->id}}">
        @endif
        <div class="layui-form-item">
            <label class="layui-form-label">应用名称</label>
            <div class="layui-input-block">
                <input type="text" name="name" required value="{{$app->name}}" lay-verify="required" placeholder="例：管理系统" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">应用首页</label>
            <div class="layui-input-block">
                <input type="text" name="domain" required value="{{$app->domain}}"  lay-verify="required" placeholder="例：https://zkphp.com" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">管理员</label>
            <div class="layui-input-block">
                @foreach($users as $user)
                    @if($user->id == 1)
                        <input type="checkbox" checked disabled name="admin[]" value="{{$user->id}}" title="{{$user->name}}">
                    @else
                        <input type="checkbox"  name="admin[]" value="{{$user->id}}" title="{{$user->name}}">
                    @endif
                @endforeach
            </div>
        </div>
        {{csrf_field()}}
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>

    <script>
        //Demo
        layui.use('form', function(){
            var form = layui.form;
            form.render()
            //监听提交
            form.on('submit(formDemo)', function(data){
                layer.msg(JSON.stringify(data.field));
                if(data.field.id) {
                    var url = '/app/edit'
                } else  {
                    var url ='/app/create'
                }
                $.ajax({
                    url:url,
                    type:'POST',
                    data:data.field,
                    success:function (res) {
                        if(data.field.id) {
                            parent.layer.closeAll()
                        }
                    }
                })
            });
        });
    </script>
@stop
