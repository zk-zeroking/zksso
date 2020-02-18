
@extends('common.common')
@section('body')
    <table id="app-list"></table>
    <script>
        var table;
        layui.use('table', function(){
            table = layui.table;

            //第一个实例
            table.render({
                elem: '#app-list'
                ,height: 312
                ,url: '/app/list/data' //数据接口
                ,page: true //开启分页
                ,cols: [[ //表头
                    {field: 'name', title: '应用名称', width:120, sort: true, fixed: 'left'}
                    ,{field: 'uuid', title: '应用ID', width:380}
                    ,{field: 'domain', title: '应用网址', width:380}
                    ,{field: 'opt', title: '操作', width: 120}
                ]]
                ,parseData:function (res) {
                    for (var i in res.data) {
                        res.data[i].domain = "<a href='"+res.data[i].domain+"'>"+res.data[i].domain+"</a>"
                        res.data[i].opt = creatBtn("edit",res.data[i].id,'编辑') + creatBtn("del",res.data[i].id,'删除')
                    }
                    return res
                }
            });

        });
        function creatBtn(onclickFun,args,title) {
            var c = onclickFun +'('+args+')'
            return "<button class='layui-btn layui-btn-xs' onclick='"+c+"'>"+title+"</button>"
        }

        function edit(id) {
            layer.open({
                type: 2,
                title: '编辑应用',
                shadeClose: true,
                shade: false,
                maxmin: true, //开启最大化最小化按钮
                area: ['893px', '600px'],
                content: '/app/edit?id='+id,
                end:function () {
                    location.reload()
                }
            });
        }
        function del(id) {
            layer.confirm('确定要删除此应用吗？', {
                btn: ['取消','确定'] //按钮
            }, function(){
                layer.closeAll();
            }, function(){
                $.ajax({
                    url:'/app/del',
                    type:'post',
                    data:{id:id,_token:"<?php echo csrf_token()?>"},
                    success:function (res) {
                        location.reload()
                    }(table)
                })
            });
        }
    </script>
@stop
