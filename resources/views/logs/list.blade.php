@section('title', '日志管理')
@section('header')
    <div class="layui-inline">
        <div class="layui-btn layui-btn-small layui-btn-warm hidden-xs fresh" fresh-url="{{url('/logs')}}"><i class="layui-icon">&#x1002;</i></div>
    </div>
    <div class="layui-inline">
        <input type="text" lay-verify="title" value="{{ $input['title'] or '' }}" name="title" placeholder="请输入关键字" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <select name="status" lay-filter="status" lay-verify="status">
            <option value="">请选择一个内容</option>
            <option value="admin_id" {{isset($input['status'])&&$input['status']=='admin_id'?'selected':''}}>用户ID</option>
            <option value="log_url" {{isset($input['status'])&&$input['status']=='log_url'?'selected':''}}>URL</option>
            <option value="log_ip" {{isset($input['status'])&&$input['status']=='log_ip'?'selected':''}}>IP</option>
        </select>
    </div>
    <div class="layui-inline">
        <input class="layui-input" name="begin" placeholder="开始日期" onclick="layui.laydate({elem: this, festival: true})" value="{{ $input['begin'] or '' }}">
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
    </div>
@endsection
@section('table')
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="50">
            <col class="hidden-xs" width="80">
            <col>
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col width="200">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">ID</th>
            <th class="hidden-xs">用户ID</th>
            <th>内容</th>
            <th class="hidden-xs">URL</th>
            <th class="hidden-xs">IP</th>
            <th>创建时间</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pager as $list)
            <tr>
                <td class="hidden-xs">{{$list['id']}}</td>
                <td class="hidden-xs">{{$list['admin_id']}}</td>
                <td>{{$list['log_info']}}</td>
                <td class="hidden-xs">{{$list['log_url']}}</td>
                <td class="hidden-xs">{{$list['log_ip']}}</td>
                <td>{{$list['log_time']}}</td>
            </tr>
        @endforeach
        @if(!$pager[0])
            <tr><td colspan="6" style="text-align: center;color: orangered;">暂无数据</td></tr>
        @endif
        </tbody>
    </table>
    <div class="page-wrap">
        {{$pager->render()}}
    </div>
@endsection
@section('js')
    <script>
        layui.use(['form', 'jquery','laydate', 'layer','dialog'], function() {
            var form = layui.form(),
                $ = layui.jquery,
                laydate = layui.laydate,
                dialog = layui.dialog,
                layer = layui.layer
            ;
            form.render();
            laydate({istoday: true});
            $('.fresh').mouseenter(function() {
                dialog.tips('刷新页面', '.fresh');
            })
            form.verify({
                title:function(value){
                    var select_info = $("select[name='status']").val();
                    if(value&&select_info){
                        switch (select_info){
                            case 'log_url':
                                if(!(/^\/(.*)/).test(value))return '请输入正确格式的URL';
                                break;
                            case 'log_ip':
                                if((/^\/(.*)/).test(value))return '请输入正确格式的IP';
                                break;
                            case 'admin_id':
                                if(!(/^[0-9]$/).test(value))return '请输入正确格式的用户ID';
                                break;
                            default:
                                return '输入参数错误';
                                break;

                        }
                    }else if(!value&&select_info){
                        return '请输入关键字';
                    }
                },
                status: function(value) {
                    var keyword = $("input[name='title']").val();
                    if(keyword&&!value){
                        return '请选择一个内容';
                    }
                },
            });
            $('.fresh').click(function() {
                $("input[name='begin']").val('');
                $("input[name='title']").val('');
                $("select[name='status']").val('');
                $('form').submit();
            });
        });
    </script>
@endsection
@extends('common.list')