<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>物资调运</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>

</head>
<body>
<style>
	.layui-form-label {
		width: 100px;
	}

	.layui-input-block {
		margin-left: 137px;
	}
</style>

<div class="oapd">


	<?php echo form_open('', 'class="layui-form" id="wzdywater"'); ?>

	<div class="layui-form-item">
		<label class="layui-form-label">对方门店
		</label>

		<div class="layui-input-block">
			<select name="receiver" id="">
				<option id="" value="水厂">水厂</option>
				<option id="" value="配送部">配送部</option>
				<?php foreach (object_array($_SESSION['initData']->Operator->info) as $v) { ?>
					<?php if ($v['departmentid'] == 17 && $v['quartersid'] == 7)  { ?>
						<option value="<?= $v['name'] ?>"><?= $v['name'] ?></option>
					<?php } ?>
				<?php } ?>
			</select>
		</div>
	</div>


	<div class="layui-form-item">
		<label class="layui-form-label">车号
		</label>
		<div class="layui-input-block">
			<input type="text" name="car_no" class="layui-input"  autocomplete="off"
				   placeholder="车号">
		</div>
	</div>
	<input type="hidden" name="brokerage" value="">



	<div class="layui-form-item">
		<label class="layui-form-label">模式
		</label>
		<div class="layui-input-block">
			<select name="mode" id="">
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
					<?php foreach ($_SESSION['initData']->Goods->info as $vi) { ?>
					<?php if (!$vi->isscan && $vi->stocktype =='桶装水') { ?>
						<option value="<?= $vi->id ?>"><?= $vi->name ?></option>
					<?php } ?>
					<?php } ?>
				</select>
			</div>
			<div class="layui-input-inline">
				<input type="text" name="num[]" value="" lay-verify="required" autocomplete="off"
					   placeholder="数量"
					   class="layui-input">
			</div>
		</div>
		<div class="layui-inline ">
			<input type="checkbox" name="type[]" checked lay-skin="switch" lay-text="重瓶|空瓶" value="1">
		</div>

		<div class="layui-inline">
			<button class="layui-btn add" type="button">增加商品</button>
		</div>

	</div>


	<div class="layui-form-item">
		<div class="layui-input-block">

			<button type="submit" class="layui-btn" lay-submit="" lay-filter="wzdywatersubmit">确认办理</button>
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
			, $ = layui.$; //重点处
		//监听提交
		form.on('submit(wzdywatersubmit)', function (data) {

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
					'<h3>提示</h3>' +
					'<p>正在进行物资调运操作</p>'
				,
				yes: function () {
					$('#wzdywater').submit();
				}
				,
				btn2: function () {
					layer.closeAll();
				}

			});

			return false;
		});
		$('.add').click(function () {

			var str = '';
			str += '<div class="layui-form-item">';
			str += '<div class="layui-inline">';
			str += '<label class="layui-form-label">商品</label>';
			str += '<div class="layui-input-inline">';
			str += '<select name="goodsid[]" lay-filter="aihao" lay-verify="required" lay-search="">';
			<?php foreach ($_SESSION['initData']->Goods->info as $v) { ?>
			<?php if (!$v->isscan && $v->stocktype =='桶装水') { ?>
			str += '<option value="<?= $v->id ?>"><?= $v->name ?></option>';
			<?php } ?>
			<?php } ?>
			str += '</select>';
			str += '</div>';
			str += '<div class="layui-input-inline">';
			str += '<input type="text" name="num[]" lay-verify="required" autocomplete="off" placeholder="数量"class="layui-input">';
			str += '</div>';
			str += '</div>';
			str += '<div class="layui-inline">' +
				'<input type="checkbox" name="type[]" checked lay-skin="switch" lay-text="重瓶|空瓶">' +
				'</div>';
			str += '<div class="layui-inline">' +
				'<button class="layui-btn layui-btn-danger del" type="button">删除</button>' +
				'</div>';
			str += '</div>';
			$('.goods').after(str);
			form.render()
		});
		$('#wzdywater').on('click', '.del', function () {
			$(this).parents('.layui-form-item').remove();
			form.render()
		})
		form.on('select(carchanqge)', function(data){
			var oper = (data.elem[data.elem.selectedIndex]).title
			$("#SJ").val(oper)
			$("#SJ").text(oper)
			form.render()
		});

	});


</script>
<?php if (get_cookie('dispatchwater')) { ?>
	<script>
		layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
			var form = layui.form
				, layer = layui.layer
				, layedit = layui.layedit
				, laydate = layui.laydate
				, element = layui.element
				, $ = layui.$; //重点处
			layer.msg('办理成功！');
			setTimeout(function () {
				Win10_child.close()
			}, 1000);
			return false
		});
	</script>
<?php } ?>
<?php if (get_cookie('errordispatchwater')) { ?>
	<script>
		layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
			var form = layui.form
				, layer = layui.layer
				, layedit = layui.layedit
				, laydate = layui.laydate
				, element = layui.element
				, $ = layui.$; //重点处
			layer.msg('办理失败！');
			return false
		});
	</script>
<?php } ?>
</html>
