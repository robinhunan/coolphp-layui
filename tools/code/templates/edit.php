<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>编辑</title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="<?=CDN?>/layui/2.5.6/css/layui.css" media="all">
<link rel="stylesheet" href="../static/style/admin.css" media="all">
</head>
<body>
<div class="layui-form">__fields__
	<div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认保存</button>
        </div>
    </div>
</div>
<script src="<?=CDN?>/layui/2.5.6/layui.all.js"></script>
<script>
 layui.config({
    base: '../static/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index'], function () {
	var form = layui.form,
		layer = layui.layer,
		$ = layui.$;

	//监听提交
	form.on('submit(saveBtn)', function (data) {
		$.post("?c=__table__&a=update&id=<?=$id?>",data.field,function (ret){
			 if(ret.code>0){
				 layer.msg('修改成功',function(){parent.location.reload();});
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