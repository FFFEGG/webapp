<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>完成案件记录</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>

	<!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<style>

</style>
<body>
<div class="oapd">
	<?php echo form_open('', 'class="layui-form layui-form-pane"'); ?>

	<input type="hidden" name="data" value="<?= $this->input->get('data') ?>">
	<input type="hidden" name="id" value="<?= $info['id'] ?>">
	<input type="hidden" name="serial" value="<?= $info['serial'] ?>">
	<input type="hidden" name="userid" value="<?= $info['userid'] ?>">
	<input type="hidden" name="securityinspector" value="<?= $info['securityinspector'] ?>">

	<div class="layui-form-item">
		<div class="layui-form-item">
			<label class="layui-form-label">安检内容</label>
			<div class="layui-input-block ">
				<?php foreach ($list as $k => $v) { ?>

						<input class="layui-input" value="类型：<?= $k ?>" style="color: #0f6674">
						<div style="margin-top: 10px">
							<?php foreach ($v as $ki=>$vi) { ?>
								<span style="font-weight: bold;margin-right: 20px;">项目<?= $ki+1 ?>：<?= $vi['project'] ?> <?= $vi['result']?></span>
							<?php } ?>
						</div>
				<?php } ?>
			</div>
		</div>
		<?php foreach ($filelist as $k => $v) { ?>
		<img src="<?= $v['fileurl'] ?>" alt="">
		<?php }?>
		<div class="layui-form-item">
			<label class="layui-form-label">备注</label>
			<div class="layui-input-block">
				<input type="text" name="remarks" value=" "
					   lay-verify="required" autocomplete="off" placeholder="请输入备注" class="layui-input">
			</div>
		</div>

		<div class="layui-form-item">
			<button class="layui-btn" type="submit" lay-filter="demo2">确认添加</button>
		</div>
		</form>
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
	</script>
	<?php if (get_cookie('success')) { ?>
		<script>
			layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
				var form = layui.form
					, layer = layui.layer
					, layedit = layui.layedit
					, laydate = layui.laydate
					, element = layui.element
					, $ = layui.$; //重点处
				layer.msg('添加成功');
				setTimeout(function () {
					Win10_child.close()
				}, 1000)
			});
		</script>
	<?php } ?>
	<?php if (get_cookie('error')) { ?>
		<script>
			layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
				var form = layui.form
					, layer = layui.layer
					, layedit = layui.layedit
					, laydate = layui.laydate
					, element = layui.element
					, $ = layui.$; //重点处
				layer.msg('失败');
				setTimeout(function () {
					Win10_child.close()
				}, 1000)
			});
		</script>
	<?php } ?>
</body>
</html>
