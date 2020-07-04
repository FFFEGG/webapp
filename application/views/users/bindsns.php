<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>绑定sns</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>

	<!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
<div class="oapd">
	<form class="layui-form" action="" method="get">
		<div class="layui-form-item">
			<label class="layui-form-label">查询方式</label>
			<div class="layui-input-inline">
				<select name="keytype" lay-filter="aihao">
					<option <?php if($this->input->get('keytype') =='姓名'){ echo  'selected' ;} ?> value="姓名">姓名</option>
					<option <?php if($this->input->get('keytype') =='电话'){ echo  'selected' ;} ?> value="电话">电话</option>
					<option <?php if($this->input->get('keytype') =='地址'){ echo  'selected' ;} ?> value="地址">地址</option>
					<option <?php if($this->input->get('keytype') =='单位'){ echo  'selected' ;} ?> value="单位">单位</option>
					<option <?php if($this->input->get('keytype') =='会员号'){ echo  'selected' ;} ?> value="会员号">会员号</option>
				</select>
			</div>
			<div class="layui-input-inline">
				<input name="keyword" value="<?= $this->input->get('keyword') ?>" class="layui-input" type="text" placeholder="请输入查询信息">
			</div>
			<input type="hidden"  name="info" value="<?= $this->input->get('info') ?>">
			<button class="layui-btn">确认查询</button>
		</div>
	</form>
	<div class="layui-form">
		<table class="layui-table" lay-size="">
			<thead>
			<tr>
				<?php foreach ($title as $v) { ?>
					<th><?= $v ?></th>
				<?php } ?>
				<th>操作</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $v) { ?>
				<tr>
					<?php foreach ($key as $vo) { ?>
						<td ><?= $v->$vo ?></td>
					<?php } ?>
					<td>
						<button onclick="bindsns('<?= Myencode($v) ?>')" class="layui-btn">绑定SNS</button>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<script src="<?php echo base_url(); ?>/res/layui/layui.js" charset="utf-8"></script>
<script>
    layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
        var form = layui.form
            , layer = layui.layer
            , layedit = layui.layedit
            , laydate = layui.laydate
            , element = layui.element
            , $ = layui.$;
    });
	function bindsns(data) {
		if (confirm('确认绑定？')) {
			$.ajax({
				url: '/index.php/api/bindsns',
				method: 'post',
				data: {
					user: data,
					info: '<?= $this->input->get('info') ?>'
				},
				dataType: 'json',
				success:function (res) {
					if (res.code == 200) {
						alert('绑定成功')
					} else {
						alert('绑定失败')
					}
					setTimeout(function () {
						Win10_child.close()
					}, 1000)
				}
			})
		}

	}
</script>

</body>
</html>
