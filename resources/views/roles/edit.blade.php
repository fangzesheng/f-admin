@section('title', '角色编辑')
@section('content')
    <div class="layui-form-item">
        <label class="layui-form-label">角色标识：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['name'] or ''}}" name="role_remark" required lay-verify="role_remark" placeholder="请输入2-12位字母" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">角色名称：</label>
        <div class="layui-input-block">
            <input type="text" value="{{$info['display_name'] or ''}}" name="role_name" required lay-verify="role_name" placeholder="请输入2-12位汉字" autocomplete="off" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">角色描述：</label>
        <div class="layui-input-block">
            <textarea name="role_desc" placeholder="请输入2-30位汉字" class="layui-textarea" required lay-verify="role_desc">{{$info['description'] or ''}}</textarea>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">角色权限：</label>
        <div class="layui-input-block">
            <input type="checkbox" name="" lay-skin="primary" lay-filter="pAllChoose" title="全选">
        </div>
        <div class="layui-input-block permission">
            @foreach($permission as $permise)
                <input type="checkbox" name="permission_list[]"
                       @if($info)
                       @foreach($info->perms as $perm){{$perm->id == $permise['id']?'checked':''}}@endforeach
                       @endif
                       value="{{$permise['id']}}" lay-skin="primary" title="{{$permise['display_name']}}">
            @endforeach
        </div>
    </div>
@endsection
@section('id',$id)
@section('js')
    <script>
        layui.use(['form','jquery','laypage', 'layer'], function() {
            var form = layui.form(),
                $ = layui.jquery;
            form.on('checkbox(pAllChoose)', function(data) {
                var child = $(".permission").find('input[type="checkbox"]');
                child.each(function(index, item) {
                    item.checked = data.elem.checked;
                });
                if(data.elem.checked)$(this).attr('title','全不选');
                else $(this).attr('title','全选');
                form.render('checkbox');
            });

            form.render();
            var layer = layui.layer;
            form.verify({
                role_desc: [/[a-zA-Z]{2,12}$/, '角色描述必须2到12位字母'],
                role_remark: [/[a-zA-Z]{2,12}$/, '角色标识必须2到12位字母'],
                role_name: [/[\u4e00-\u9fa5]{2,12}$/, '角色名称2到12位汉字'],
                role_desc: [/[\u4e00-\u9fa5]{2,30}$/, '角色描述2到30位汉字'],
            });
            form.on('submit(formDemo)', function(data) {
                var chk_value =[];
                $('input[name="permission_list[]"]:checked').each(function(){
                    chk_value.push($(this).val());
                });
                if($("input[type='permission_list[]']").length>0&&chk_value.length==0){
                    layer.msg('至少选择一个角色权限',{shift: 6,icon:5});
                    return false;
                }
                $.ajax({
                    url:"{{url('/roles')}}",
                    data:$('form').serialize(),
                    type:'post',
                    dataType:'json',
                    success:function(res){
                        if(res.status == 1){
                            layer.msg(res.msg,{icon:6});
                            var index = parent.layer.getFrameIndex(window.name);
                            setTimeout('parent.layer.close('+index+')',2000);
                        }else{
                            layer.msg(res.msg,{shift: 6,icon:5});
                        }
                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown) {
                        layer.msg('网络失败', {time: 1000});
                    }
                });
                return false;
            });
        });
    </script>
@endsection
@extends('common.edit')
