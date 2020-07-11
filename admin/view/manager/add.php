<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>add</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="../static/ui/lib/layui-v2.5.5/css/layui.css" media="all">
    <link rel="stylesheet" href="../static/ui/css/public.css" media="all">
</head>
<body>
<div class="layui-form layuimini-form">
				<div class="layui-form-item">						 
					<label class="layui-form-label required">用户名</label>
					<div class="layui-input-block">
						<input type="text" name="userName"  class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">						 
					<label class="layui-form-label required">密码</label>
					<div class="layui-input-block">
						<input type="text" name="userPass"  class="layui-input">
					</div>
				</div>
	<div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认保存</button>
        </div>
    </div>
</div>
<script src="../static/ui/lib/layui-v2.5.5/layui.js" charset="utf-8"></script>
<script>
layui.use(['form'], function () {
	var form = layui.form,
		layer = layui.layer,
		$ = layui.$;

	//监听提交
	form.on('submit(saveBtn)', function (data) {
		layer.msg('请稍后...',{icon:16,time:800,shade:0.2});
		$.post("?c=manager&a=insert",data.field,function (ret){
			 if(ret.code>0){
				 layer.msg('增加成功',function(){parent.location.reload();});
			 } else {
				layer.alert(ret.msg);
			 }
		});
		return false;
	});

});
</script>
</body>
</html>

