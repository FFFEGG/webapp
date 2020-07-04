<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>调拨计划</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>

</head>
<body>
<div class="oapd">


	<?php echo form_open('', 'class="layui-form" id="planform"'); ?>

	<div class="layui-form-item">
		<label class="layui-form-label">方式</label>
		<div class="layui-input-block">
			<select name="mode" lay-filter="aihao" lay-verify="required">
				<option value="调入">调入</option>
				<option value="调出">调出</option>
			</select>
		</div>
	</div>


	<div class="layui-form-item goods">
		<div class="layui-inline">
			<label class="layui-form-label">商品</label>
			<div class="layui-input-inline">
				<select name="goodsid[]" lay-filter="aihao" lay-verify="required" lay-search="">
					<?php foreach ($_SESSION['initData']->Goods->info as $v) { ?>
						<?php if ($v->goodstypeid==1 || $v->goodstypeid ==2) { ?>
							<option value="<?= $v->id ?>"><?= $v->name ?></option>
						<?php } ?>
					<?php } ?>

				</select>
			</div>
		</div>
		<div class="layui-inline">
			<label class="layui-form-label">数量
			</label>
			<div class="layui-input-block">
				<input type="text" name="num[]" lay-verify="required" autocomplete="off" placeholder="数量"
					   class="layui-input">
			</div>
		</div>
		<div class="layui-inline">
			<button class="layui-btn add" type="button">增加商品</button>
		</div>

	</div>

<!--	<div class="layui-form-item">-->
<!--		<label class="layui-form-label">对方部门-->
<!--		</label>-->
<!--		<div class="layui-input-block">-->
<!--			<input type="text" name="otherparty" value="运输公司" disabled lay-verify="required" autocomplete="off"-->
<!--				   placeholder="对方部门"-->
<!--				   class="layui-input">-->
<!--			<input type="hidden" name="otherparty" value="运输公司">-->
<!--		</div>-->
<!--	</div>-->
	<input type="hidden" name="otherparty" value="otherparty">

	<div class="layui-form-item">
		<label class="layui-form-label">备注
		</label>
		<div class="layui-input-block">
			<input type="text" name="remarks" autocomplete="off" placeholder="备注(可选)"
				   class="layui-input">
		</div>
	</div>


	<div class="layui-form-item">
		<div class="layui-input-block">

			<button type="submit" class="layui-btn" lay-submit="" lay-filter="plan">确认办理</button>
		</div>
	</div>
	</form>


	调拨记录
	<div class="layui-form">
		<table class="layui-table">
			<thead>
			<tr>
				<th>时间</th>
				<th>门店</th>
				<th>方式</th>
				<th>备注</th>
				<th>状态</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $v) { ?>
				<tr>
					<td><?= $v['addtime'] ?></td>
					<td><?= $v['source'] ?></td>
					<td><?= $v['mode'] ?></td>
					<td><?= $v['remarks'] ?></td>
					<td><?= getstate($v['state']) ?></td>
				</tr>
				<tr>
					<td colspan="5">
						<?php foreach ($v['goodslist'] as $vi) { ?>
							<?= $vi['goodsname'] ?> X    <?= $vi['num'] ?>
						<?php } ?>
					</td>

				</tr>
				<tr>
					<td colspan="5">

					</td>

				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>

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
				, $ = layui.$; //重点处
		//监听提交
		form.on('submit(plan)', function (data) {
			layer.open({
				type: 1
				,
				title: false //不显示标题栏
				,
				closeBtn: false
				,
				area: '400px;'
				,
				shade: 0.8
				,
				id: 'LAY_layuipro' //设定一个id，防止重复弹出
				,
				btn: ['确认', '取消']
				,
				btnAlign: 'c'
				,
				moveType: 1 //拖拽模式，0或者1
				,
				content: '<div  style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">' +
						'<h3>信息确认</h3>' +
						'<p>正在进行' + data.field.mode + '</p>'
				,
				yes: function () {
					$('#planform').submit();
				}
				,
				btn2: function () {
					layer.closeAll();
				}

			});

			return false;
		});
		form.on('radio(goods)', function (data) {
			var arr = data.value.split("|");
			$('.price_dyw').attr('value', arr[1]);
		});


		$('.add').click(function () {
			var str = '';
			str += '<div class="layui-form-item">';
			str += '<div class="layui-inline">';
			str += '<label class="layui-form-label">商品</label>';
			str += '<div class="layui-input-inline">';
			str += '<select name="goodsid[]" lay-filter="aihao" lay-verify="required" lay-search="">';
			<?php foreach ($_SESSION['initData']->Goods->info as $v) { if ($v->goodstypeid==1 || $v->goodstypeid ==2) { ?>

			str += '<option value="<?= $v->id ?>"><?= $v->name ?></option>';
			<?php }} ?>
			str += '</select>';
			str += '</div>';
			str += '</div>';
			str += '<div class="layui-inline">';
			str += '<label class="layui-form-label">数量';
			str += '</label>';
			str += '<div class="layui-input-block">';
			str += '<input type="text" name="num[]" lay-verify="required" autocomplete="off" placeholder="数量"class="layui-input">';
			str += '</div>';
			str += '</div>';
			str += '</div>';

			$('.goods').after(str);
			form.render()
		})
	});


</script>
<?php if (get_cookie('plan')) { ?>
	<script>
		layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
			var form = layui.form
					, layer = layui.layer
					, layedit = layui.layedit
					, laydate = layui.laydate
					, element = layui.element
					, $ = layui.$; //重点处
			layer.msg('办理成功！');
			return false;
		});
	</script>
<?php } ?>

</html>
