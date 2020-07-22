<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>代码生成</title>
<link rel="stylesheet" href="https://cdn.staticfile.org/layui/2.5.6/css/layui.css"  media="all">  
<script src="https://cdn.staticfile.org/layui/2.5.6/layui.js" charset="utf-8"></script>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Expires" content="0">
</head>
<script type="text/javascript">
function changeTable(table){
    location.href="?dsn=<?=$dsnName?>&table="+table;
}
</script>
<body>
<div style="max-width: 990px;margin: 0 auto;">
  <div class="navi">
    <p><a href="?dsn=<?=$dsnName?>&table=<?=$table?>"><h2>代码生成</h2></a> </p>
  </div>
  <div class="trh2">
    请选择表名:
     <select name="table" onchange="changeTable(this.value)" >
        <?php foreach ($tables as $v) {
				$sel = $v===$table ? ' selected' :'';
				echo  "<option value='$v' $sel>$v</option>\n";
        }
        ?>
     </select>
  </div>
  <form action="" method="post">
    <table class="layui-table" >
      <thead>
        <td width='20%' align="left" >字段名 </td>
        <td width="24%">中文字段名</td>
        <td><input type="checkbox" name="checkAll" data-id="add" />添加</td>
        <td><input type="checkbox" name="checkAll" data-id="edit" />修改</td>
        <td><input type="checkbox" name="checkAll" data-id="search" />搜索</td>
        <td><input type="checkbox" name="checkAll" data-id="index" />列表</td>
      </thead>
      <?php foreach((array)$rows AS $k=>$v){
          $checked = $k!=0 ? 'checked="checked"' : '';
      ?>
      <tr>
        <td ><?=$v['Field']?></td>
        <td>
         <input type="text" name="field[<?=$v['Field']?>]" value="<?php echo $v['Comment']?$v['Comment']:$v['Field']?>" />
         </td>
        <td ><input type="checkbox" <?=$checked?> name="add[<?=$v['Field']?>]" /></td>
        <td ><input type="checkbox" <?=$checked?> name="edit[<?=$v['Field']?>]" /></td>
        <td ><input type="checkbox" <?=$checked?> name="search[<?=$v['Field']?>]" /></td>
        <td ><input type="checkbox" <?=$checked?> name="index[<?=$v['Field']?>]" /></td>
      </tr>
      <?php }?>
       <tr> <td colspan=6 align="center"> <input  type="submit" class="layui-btn" value=" 确 定 "  /></td></tr>
    </table>
  </form>
</div>
<script>
layui.use(['form'], function(){
	var layer = layui.layer, $=layui.jquery;
    $('input[name="checkAll"]').click(function(){
        var id=$(this).data('id');
        var checked = !!this.checked;
		//console.log(this.checked);
        $('input[name*='+id+']').prop('checked',checked);
    });
	$('form').submit(function(){
		layer.msg('加载中...',{icon:16,time:800,shade:0.2});
		$.post("?dsn=<?=$dsnName?>&table=<?=$table?>&act=generate",$(this).serialize(),function (data){
			 if(data.code>0){
				layer.msg('生成代码成功',{icon:1,time:1500});
			 } else {
				layer.alert(data.msg);
			 }
		})
		return false;
	})
})
</script>
</body>
</html>