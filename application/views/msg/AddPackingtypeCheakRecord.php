<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>添加包装物判断信息</title>
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



	<div class="layui-form-item">
		<div class="layui-form-item">
			<label class="layui-form-label">添加时间</label>
			<div class="layui-input-block">
				<input type="text" name="addtime"  id="date1" value="<?= date('Y-m-d H:i:s')?>"
					   lay-verify="required" autocomplete="off" placeholder="添加时间"  class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
				<label class="layui-form-label">会员号</label>
				<div class="layui-input-block">
					<input type="text" name="memberid"  value="<?= $this->input->get('memberid') ?>"
						   lay-verify="required" autocomplete="off" placeholder="会员号" class="layui-input">
				</div>
			</div>


		<div class="layui-form-item">
			<label class="layui-form-label">原钢瓶号</label>
			<div class="layui-input-block">
				<input type="text"  name="former_code"  value=""
					   lay-verify="required"  autocomplete="off" placeholder="钢瓶号(6位)" class="layui-input">
			</div>
		</div>


		<div class="layui-form-item">
			<label class="layui-form-label">原包装物</label>
			<div class="layui-input-block">
				<input type="former_packingtype"  name="former_packingtype" value=""
					   lay-verify="required" autocomplete="off" placeholder="包装物类型"  class="layui-input">
			</div>
		</div>


		<div class="layui-form-item">
			<label class="layui-form-label">钢瓶号</label>
			<div class="layui-input-block">
				<input type="text" name="code" value=""
					   lay-verify="required" required autocomplete="off" placeholder="钢瓶号(6位)" class="layui-input">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">包装物类型</label>
			<div class="layui-input-block">
				<select name="packingtype" id="">
					<?php foreach ($_SESSION['initData']->Packingtype->info as $v) { ?>
						<option <?php if ($info['packingtype'] == $v->name) {
							echo 'selected';
						} ?> value="<?= $v->name ?>"><?= $v->name ?></option>
					<?php } ?>
				</select>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">方式</label>
			<div class="layui-input-block">
				<select name="mode" id="">
					<option <?php if ($info['mode'] == '送错补录') {echo 'selected';} ?> value="送错补录">送错补录</option>
					<option <?php if ($info['mode'] == '多卡混用') {echo 'selected';} ?> value="多卡混用">多卡混用</option>
					<option <?php if ($info['mode'] == '录错瓶号') {echo 'selected';} ?> value="录错瓶号">录错瓶号</option>
					<option <?php if ($info['mode'] == '等值兑换') {echo 'selected';} ?> value="等值兑换">等值兑换</option>
				</select>
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">配送员</label>
			<div class="layui-input-block">
				<input type="text" name="brokerage" value="未知"
					   lay-verify="required" autocomplete="off" placeholder="配送员"  class="layui-input">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">部门</label>
			<div class="layui-input-block">
				<input type="text"  name="department" value="<?= get_cookie('department') ?>"
					   lay-verify="required" autocomplete="off" placeholder="部门"  class="layui-input">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">操作员</label>
			<div class="layui-input-block">
				<input type="text" name="operator"  value="<?= $info['operator']?$info['operator']:$_SESSION['users']->name ?>"
					   lay-verify="required" autocomplete="off" placeholder="操作员"  class="layui-input">
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
			laydate.render({
				elem: '#date1'
			});
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
				layer.msg('成功');
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
