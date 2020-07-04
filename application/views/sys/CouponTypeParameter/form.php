<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>优惠券类型列表接口</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
</head>
<body>
<style>
	.layui-form-label {
		width: 180px !important;
	}
	.layui-form-pane .layui-input-block {
		margin-left: 180px !important;
		left: -1px;
	}
</style>
<div class="oapd">
	<?php echo form_open('', 'class="layui-form layui-form-pane"'); ?>
	<input type="hidden" name="action" value="<?= $this->input->get('action') ?>">
	<input type="hidden" name="id" value="<?= $info['id'] ?>">

	<div class="layui-form-item">
		<label class="layui-form-label">优惠券类型</label>
		<div class="layui-input-block">

			<select name="type" id="">
				<option <?php if ($info['type'] == '游戏活动') {echo 'selected';} ?> value="游戏活动">游戏活动</option>
				<option <?php if ($info['type'] == '正常领取') {echo 'selected';} ?> value="正常领取">正常领取</option>
				<option <?php if ($info['type'] == '积分兑换') {echo 'selected';} ?> value="积分兑换">积分兑换</option>
			</select>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">用户类型</label>
		<div class="layui-input-block">
			<input type="text" name="customertype" required value="<?= $info['customertype'] ?>" autocomplete="off"
				   placeholder="全部用户 或 工业用户,家庭用户,商业用户" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">优惠券名称</label>
		<div class="layui-input-block">
			<input type="text" name="name" required value="<?= $info['name'] ?>" autocomplete="off"
				   placeholder="优惠券名称" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">开始时间</label>
		<div class="layui-input-block">
			<input type="date" id="begintime" name="activitybegintime" required value="<?= substr($info['activitybegintime'],0,10) ?>" autocomplete="off"
				   placeholder="活动开始时间" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">结束时间</label>
		<div class="layui-input-block">
			<input type="date" id="endtime" name="activityendtime" required value="<?= substr($info['activityendtime'],0,10) ?>" autocomplete="off"
				   placeholder="活动结束时间" class="layui-input">
		</div>
	</div>


	<div class="layui-form-item">
		<label class="layui-form-label">券使用开始时间</label>
		<div class="layui-input-block">
			<input type="date" id="starttime" name="starttime" required value="<?= substr($info['starttime'],0,10) ?>" autocomplete="off"
				   placeholder="券使用开始时间" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">有效天数</label>
		<div class="layui-input-block">
			<input type="number" name="effectivedays" value="<?= $info['effectivedays'] ?>" autocomplete="off"
				   placeholder="有效天数" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">有效日期</label>
		<div class="layui-input-block">
			<input type="date" name="effectivedate"  id="effectivedate" required value="<?= substr($info['effectivedate'],0,10) ?>" autocomplete="off"
				   placeholder="有效日期" class="layui-input">
		</div>
	</div>



	<div class="layui-form-item">
		<label class="layui-form-label">重复间隔时间</label>
		<div class="layui-input-block">
			<input type="number" name="repeat" value="<?= $info['repeat'] ?>" autocomplete="off"
				   placeholder="重复间隔时间" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">图片地址</label>
		<div class="layui-input-block">
			<input type="text" name="imgpath" required value="<?= $info['imgpath'] ?>" autocomplete="off"
				   placeholder="图片地址" class="layui-input">
		</div>
	</div>


	<div class="layui-form-item">
		<label class="layui-form-label">商品ID</label>
		<div class="layui-input-block">
			<input type="number" name="goodsid" value="<?= $info['goodsid'] ?>" autocomplete="off"
				   placeholder="商品ID" class="layui-input">
		</div>
	</div>


	<div class="layui-form-item">
		<label class="layui-form-label">商品名称</label>
		<div class="layui-input-block">
			<input type="text" name="goodsname" required value="<?= $info['goodsname'] ?>" autocomplete="off"
				   placeholder="商品名称" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">券面金额</label>
		<div class="layui-input-block">
			<input type="text" name="price" required value="<?= $info['price'] ?>" autocomplete="off"
				   placeholder="券面金额" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">低消金额</label>
		<div class="layui-input-block">
			<input type="number" name="minconsumption" required value="<?= $info['minconsumption'] ?>" autocomplete="off"
				   placeholder="低消金额" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">剩余数量</label>
		<div class="layui-input-block">
			<input type="number" name="total"  value="<?= $info['total'] ?>" autocomplete="off"
				   placeholder="剩余数量" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">下标值</label>
		<div class="layui-input-block">
			<input type="text" name="subscript"  value="<?= $info['subscript'] ?>" autocomplete="off"
				   placeholder="下标值" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">兑换积分</label>
		<div class="layui-input-block">
			<input type="number" name="redeempoints"  value="<?= $info['redeempoints'] ?>" autocomplete="off"
				   placeholder="兑换积分" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">备注</label>
		<div class="layui-input-block">
			<input type="text" name="remarks" required value="<?= $info['remarks'] ?>" autocomplete="off"
				   placeholder="备注" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">三方平台</label>
		<div class="layui-input-block">
			<input type="text" name="sns" required value="<?= $info['sns'] ?>" autocomplete="off"
				   placeholder="三方平台" class="layui-input">
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
		<label class="layui-form-label">排序</label>
		<div class="layui-input-block">
			<input type="text" name="sort" required value="<?= $info['sort'] ?>" autocomplete="off"
				   placeholder="排序" class="layui-input">
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
		laydate.render({
			elem: '#effectivedate'
		});
		laydate.render({
			elem: '#starttime'
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
