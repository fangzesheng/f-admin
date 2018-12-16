<ul class="layui-nav layui-nav-tree" lay-filter="leftNav">
    @foreach ($menus as $menu)
        <li class="layui-nav-item">
            <a href="javascript:;"><i class="layui-icon">{{$menu['icon']}}</i>&nbsp;&nbsp;&nbsp;{{$menu['title']}}</a>
            <dl class="layui-nav-child {{ $menu['id'] == $parent_id ? 'layui-nav-itemed' : '' }}">
                @if (isset($menu['children']) && !empty($menu['children']))
                    @foreach ($menu['children'] as $child)
                        <dd><a href="javascript:;" data-url="{{url($child['uri'])}}" data-id='{{$child['id']}}' data-text="{{ $child['title'] }}"><i class="layui-icon layui-btn-small">{{$child['icon']}}</i>  {{ $child['title'] }}</a></dd>
                    @endforeach
                @endif
            </dl>
        </li>
    @endforeach
</ul>