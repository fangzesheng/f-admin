layui.config({
	base: '../../static/admin/js/module/'
}).extend({
	dialog: 'dialog',
});

layui.use(['form', 'jquery', 'laydate', 'layer', 'laypage', 'dialog',   'element'], function() {
	var form = layui.form(),
		layer = layui.layer,
		$ = layui.jquery,
		dialog = layui.dialog;
	//获取当前iframe的name值
	var iframeObj = $(window.frameElement).attr('name');
	//全选
	form.on('checkbox(allChoose)', function(data) {
		var child = $(data.elem).parents('table').find('tbody input[type="checkbox"]');
        child.each(function(index, item) {
			item.checked = data.elem.checked;
		});
		form.render('checkbox');
	});
	//渲染表单
	form.render();	
	//顶部添加
	$('.addBtn').click(function() {
		var url=$(this).attr('data-url');
		var desc=$(this).attr('data-desc');
		//将iframeObj传递给父级窗口,执行操作完成刷新
		parent.page(desc, url, iframeObj, w = "700px", h = "620px");
		return false;

	}).mouseenter(function() {

		dialog.tips($(this).attr('data-desc'), '.addBtn');

	})

    //顶部刷新
    $('.freshBtn').click(function() {
    	location.reload();
    }).mouseenter(function() {

        dialog.tips('刷新页面', '.freshBtn');

    })

	//列表添加
	$('#table-list').on('click', '.add-btn', function() {
		var url=$(this).attr('data-url');
		//将iframeObj传递给父级窗口
		parent.page("菜单添加", url, iframeObj, w = "700px", h = "620px");
		return false;
	})
	//列表删除
	$('#table-list').on('click', '.del-btn', function() {
		var that = $(this);
		var url=$(this).attr('data-url');
		var token = $("input[name='_token']").val();
		dialog.confirm({
			message:'您确定要进行删除吗？',
			success:function(){
                $.ajax({
                    url:url,
                    data:{_method: 'DELETE',_token:token},
                    type:'post',
                    dataType:'json',
                    success:function(res){
                        if(res.status == 1){
                            that.parent().parent().parent().remove();
                            $("[parentid='"+that.attr('data-id')+"']").remove();
                            layer.msg(res.msg,{icon:6});
                        }else{
                            layer.msg(res.msg,{shift: 6,icon:5});
                        }
                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown) {
                        layer.msg('网络失败', {time: 1000});
                    }
                });

			},
			cancel:function(){
				layer.msg('取消了')
			}
		})
		return false;
	})
	//列表跳转
	$('#table-list,.tool-btn').on('click', '.go-btn', function() {
		var url=$(this).attr('data-url');
		var id = $(this).attr('data-id');
		window.location.href=url+"?id="+id;
		return false;
	})
	//编辑栏目
	$('#table-list').on('click', '.edit-btn', function() {
		var That = $(this);
		var url=That.attr('data-url');
		var desc=That.attr('data-desc');
		//将iframeObj传递给父级窗口
		parent.page(desc, url, iframeObj, w = "700px", h = "620px");
		return false;
	})
});

/**
 * 控制iframe窗口的刷新操作
 */
var iframeObjName;

//父级弹出页面
function page(title, url, obj, w, h) {
	if(title == null || title == '') {
		title = false;
	};
	if(url == null || url == '') {
		url = "404.html";
	};
	if(w == null || w == '') {
		w = '700px';
	};
	if(h == null || h == '') {
		h = '350px';
	};
	iframeObjName = obj;
	//如果手机端，全屏显示
	if(window.innerWidth <= 768) {
		var index = layer.open({
			type: 2,
			title: title,
			area: [320, h],
			fixed: false, //不固定
			content: url,
			end:function(){
                refresh();
			}
		});
		layer.full(index);
	} else {
		var index = layer.open({
			type: 2,
			title: title,
			area: [w, h],
			fixed: false, //不固定
			content: url,
            end:function(){
                if(title!='管理员信息')refresh();
            }
		});
	}
}

/**
 * 刷新子页,关闭弹窗
 */
function refresh() {
	//根据传递的name值，获取子iframe窗口，执行刷新
	if(window.frames[iframeObjName]) {
		window.frames[iframeObjName].location.reload();

	} else {
		window.location.reload();
	}

	layer.closeAll();
}

/**
 * 刷新排序
 */
function changeSort(name,obj) {
    layui.use(['jquery'], function() {
        var $ = layui.jquery;
        $.ajax({
            url:$(obj).attr('data-url'),
            data:{name: name,val:$(obj).val(),id:$(obj).attr('data-id'),_token:$("input[name='_token']").val()},
            type:'post',
            dataType:'json',
            success:function(res){
                layer.msg(res.msg);
            },
            error : function(XMLHttpRequest, textStatus, errorThrown) {
                layer.msg('网络失败', {time: 1000});
            }
        });
    });
}