<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>__table__ 列表</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=CDN?>/layui/2.5.6/css/layui.css">
    <link rel="stylesheet" href="../static/ui/css/public.css">
</head>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">

        <fieldset class="table-search-fieldset">
            <legend>搜索信息</legend>
            <div style="margin: 10px 10px 10px 10px">
                <form class="layui-form layui-form-pane" action="">
                    <div class="layui-form-item">__search__
                        <div class="layui-inline">
                            <button type="submit" class="layui-btn layui-btn-primary"  lay-submit lay-filter="data-search-btn"><i class="layui-icon"></i> 搜 索</button>
                        </div>
                    </div>
                </form>
            </div>
        </fieldset>

        <script type="text/html" id="btna">
            <div class="layui-btn-container">
                <button class="layui-btn layui-btn-normal layui-btn-sm" lay-event="add"> 添加 </button>
                <button class="layui-btn layui-btn-sm layui-btn-danger" lay-event="delete"> 删除 </button>
            </div>
        </script>

        <table class="layui-hide" id="tbl" lay-filter="tblFilter"></table>

        <script type="text/html" id="btnu">
            <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit">编辑</a>
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delete">删除</a>
        </script>

    </div>
</div>
<script src="<?=CDN?>/layui/2.5.6/layui.js"></script>
<script src="../static/ui/js/lay-config.js"></script>
<script>
layui.use(['form', 'table'], function () {
	var $ = layui.jquery,
		form = layui.form,
		table = layui.table;

	table.render({
		elem: '#tbl',
		url: '?c=__table__&a=page',
		toolbar: '#btna',
		defaultToolbar: ['filter', 'exports', 'print'],
		cols: [[
			{type: "checkbox", width: 50}__tableTitle__ 
			,{title: '操作', width: 150, toolbar: '#btnu', align: "center"}
		]],
		limits: [10, 15, 20, 25, 50, 100],
		limit: 15,
		page: true,
		skin: 'line'
	});

	// 监听搜索操作
	form.on('submit(data-search-btn)', function (data) {
		var result = JSON.stringify(data.field);
		//执行搜索重载
		table.reload('tbl', {
			page: {
				curr: 1
			}
			, where: {
				key: result
			}
		});
		return false;
	});

	/**
	 * toolbar监听事件
	 */
	table.on('toolbar(tblFilter)', function (obj) {
		if (obj.event === 'add') {  // 监听添加操作
			var index = layer.open({
				title: '添加用户',
				type: 2,
				shade: 0.2,
				maxmin:true,
				shadeClose: true,
				area: ['100%', '100%'],
				content: '?c=__table__&a=add',
			});
			$(window).on("resize", function () {
				layer.full(index);
			});
		} else if (obj.event === 'delete') {  // 监听删除操作
			var checkStatus = table.checkStatus('tbl')
				, data = checkStatus.data;
			if(data.length<1){
				layer.msg('请先选择');
				return;
			}
			var ids = [];
		   for(var i=0; i<data.length; i++){
			  ids.push(data[i]['id']);
		   }
			layer.confirm('真的删除行么', function (index) {
				cz.load('?c=__table__&a=delete',{"id":ids.join(",")},function(ret){
					table.reload('tbl',{});
					layer.msg('删除成功');
				});
				layer.close(index);
			});
		}
	});

	//监听表格复选框选择
	table.on('checkbox(tblFilter)', function (obj) {
		console.log(obj)
	});

	table.on('tool(tblFilter)', function (obj) {
		var data = obj.data;
		if (obj.event === 'edit') {
			var index = layer.open({
				title: '编辑用户',
				type: 2,
				shade: 0.2,
				maxmin:true,
				shadeClose: true,
				area: ['100%', '100%'],
				content: '?c=__table__&a=edit&id='+data.id,
			});
			return false;
		} else if (obj.event === 'delete') {
			layer.confirm('真的删除行么', function (index) {
				cz.load('?c=__table__&a=delete',data,function(ret){
					table.reload('tbl',{});
					layer.msg('删除成功');
				});
				layer.close(index);
			});
		}
	});

});
</script>
</body>
</html>
