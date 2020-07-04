<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>商品</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
</head>
<style>
	.layui-form-pane .layui-form-label {
		width: 200px !important;
	}
	.layui-form-pane .layui-input-block {
		margin-left: 200px !important;
		left: -1px;
	}
</style>
<body>
<div class="oapd">
	<?php echo form_open('', 'class="layui-form layui-form-pane"'); ?>
	<input type="hidden" name="action" value="<?= $this->input->get('action') ?>">
	<input type="hidden" name="id" value="<?= $info['id'] ?>">
	<div class="layui-form-item">
		<label class="layui-form-label">是否扫描</label>
		<div class="layui-input-block">
			<input type="radio" name="isscan" <?php if ($info['isscan'] == 1) {
				echo 'checked';
			} ?> value="1" title="是" checked="">
			<input type="radio" name="isscan" <?php if ($info['isscan'] == 0) {
				echo 'checked';
			} ?> value="0" title="否">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">是否回收</label>
		<div class="layui-input-block">
			<input type="radio" name="isrecovery" <?php if ($info['isrecovery'] == 1) {
				echo 'checked';
			} ?> value="1" title="是" checked="">
			<input type="radio" name="isrecovery" <?php if ($info['isrecovery'] == 0) {
				echo 'checked';
			} ?> value="0" title="否">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">类型ID</label>
		<div class="layui-input-block">
			<select name="catid" id="">
				<?php foreach ($_SESSION['initData']->GoodsCat->info as $v) { ?>
					<option <?php if ($info['catid'] == $v->id) {
						echo 'selected';
					} ?> value="<?= $v->id ?>"><?= $v->name ?></option>
				<?php } ?>
			</select>

		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">商品类型ID</label>
		<div class="layui-input-block">
			<select name="goodstypeid" id="">
				<?php foreach ($_SESSION['initData']->GoodsType->info as $v) { ?>
					<option <?php if ($info['goodstypeid'] == $v->id) {
						echo 'selected';
					} ?> value="<?= $v->id ?>"><?= $v->name ?></option>
				<?php } ?>
			</select>

		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">品牌ID</label>
		<div class="layui-input-block">
			<select name="brandid" id="">
				<?php foreach ($_SESSION['initData']->GoodsBrand->info as $v) { ?>
					<option <?php if ($info['brandid'] == $v->id) {
						echo 'selected';
					} ?> value="<?= $v->id ?>"><?= $v->name ?></option>
				<?php } ?>
			</select>

		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">线上销售</label>
		<div class="layui-input-block">

			<input type="radio" name="online" value="是" title="是" <?php if ($info['online'] == '是') {
				echo 'checked=""';
			} ?>>
			<input type="radio" name="online" value="否" title="否" <?php if ($info['online'] == '否' || !$info['online']) {
				echo 'checked=""';
			} ?>>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">商品名称</label>
		<div class="layui-input-block">
			<input type="text" name="name" required value="<?= $info['name'] ?>" autocomplete="off"
				   placeholder="商品名称" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">包装单位</label>
		<div class="layui-input-block">
			<input type="text" name="unit" required value="<?= $info['unit'] ?>" autocomplete="off"
				   placeholder="包装单位" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">容量单位</label>
		<div class="layui-input-block">
			<input type="text" name="capacityunit" required value="<?= $info['capacityunit'] ?>" autocomplete="off"
				   placeholder="容量单位" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">净重</label>
		<div class="layui-input-block">
			<input type="text" name="suttle" required value="<?= $info['suttle'] ?>" autocomplete="off"
				   placeholder="净重" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">自提优惠</label>
		<div class="layui-input-block">
			<input type="text" name="selfmentiondiscount" required value="<?= $info['selfmentiondiscount'] ?>" autocomplete="off"
				   placeholder="自提优惠" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">库存类型</label>
		<div class="layui-input-block">
			<input type="text" name="stocktype" required value="<?= $info['stocktype'] ?>" autocomplete="off"
				   placeholder="库存类型" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">包装物品</label>
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
		<label class="layui-form-label">单价</label>
		<div class="layui-input-block">
			<input type="text" name="price" required value="<?= $info['price'] ?>" autocomplete="off"
				   placeholder="单价" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">最低价（不含自提）</label>
		<div class="layui-input-block">
			<input type="text" name="floorprice" required value="<?= $info['floorprice'] ?>" autocomplete="off"
				   placeholder="最低价（不含自提）" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">商城链接</label>
		<div class="layui-input-block">
			<input type="text" name="url" required value="<?= $info['url'] ?>" autocomplete="off"
				   placeholder="商城链接" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">排序</label>
		<div class="layui-input-block">
			<input type="text" name="sort" required value="<?= $info['sort'] ?>" autocomplete="off"
				   placeholder="排序" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">状态</label>
		<div class="layui-input-block">

			<input type="radio" name="state" value="正常" title="正常" <?php if ($info['state'] == 1) {
				echo 'checked=""';
			} ?>>
			<input type="radio" name="state" value="取消" title="取消" <?php if ($info['state'] == 2) {
				echo 'checked=""';
			} ?>>
		</div>
	</div>
	<div class="layui-form-item">
		<div class="layui-input-block">
			<button class="layui-btn" type="submit">确认添加</button>
		</div>
	</div>

	</form>
</div>
</body>
<script src="<?php echo base_url(); ?>/res/layui/layui.js" charset="utf-8"></script>
<script>
	layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
		var form = layui.form
			, layer = layui.layer
			, layedit = layui.layedit
			, laydate = layui.laydate
			, element = layui.element
			, $ = layui.$;
		//日期
		laydate.render({
			elem: '#begintime'
		});
		laydate.render({
			elem: '#endtime'
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
			layer.msg('成功！');
			setTimeout(function () {
				Win10_child.close()
			}, 1000);
			return false
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
			layer.msg('失败！');
			setTimeout(function () {
				Win10_child.close()
			}, 1000);
			return false
		});
	</script>
<?php } ?>
</html>
