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


	<?php echo form_open('', 'class="layui-form" id="wzdy"'); ?>

	<div class="layui-form-item">
		<label class="layui-form-label">接收门店
		</label>
		<div class="layui-input-block">
			<select name="receiver" id="">
				<?php foreach ($_SESSION['initData']->Department->info as $v) { ?>
					<?php if ($v->type == '业务门店' || $v->type == '业务公司') { ?>
						<option <?php if ($this->input->get('department') == $v->name) {
							echo 'selected';
						} ?> value="<?= $v->name ?>"><?= $v->name ?></option>
					<?php } ?>
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">车号
		</label>
		<div class="layui-input-block">
			<select name="car_no" lay-filter="carchanqge">
				<?php foreach ($_SESSION['initData']->CarInfo->info as $v) { ?>
					<option value="<?= $v->name ?>" title="<?= $v->operator ?>"> <?= $v->name ?></option>
				<?php } ?>
			</select>
		</div>
	</div>


	<div class="layui-form-item">
		<label class="layui-form-label">司机
		</label>
		<div class="layui-input-block">
			<select name="brokerage" id="">
				<option id="SJ"
						value="<?= $_SESSION['initData']->CarInfo->info[0]->operator ?>"><?= $_SESSION['initData']->CarInfo->info[0]->operator ?></option>
				<?php foreach ($drivers as $v) { ?>
					<?php if ($v['departmentid'] !=17) { ?>
						<option value="<?= $v['name'] ?>"><?= $v['name'] ?></option>
					<?php } ?>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">类型
		</label>
		<div class="layui-input-block">
			<div class="layui-inline">
				<input type="checkbox" name="type" checked lay-skin="switch" lay-text="重瓶|空瓶" value="1">
			</div>
		</div>
	</div>



		<div class="layui-form-item goods">
			<div class="layui-inline">
				<label class="layui-form-label">商品</label>
				<div class="layui-input-inline">
					<select name="goodsid[]" lay-filter="aihao" lay-verify="required" lay-search="">
						<?php foreach ($_SESSION['initData']->Goods->info as $vi) { ?>
							<?php if ($vi->isscan) { ?>
								<option <?php if ($v['goodsname'] == $vi->name) {
									echo 'selected';
								} ?> value="<?= $vi->id ?>"><?= $vi->name ?></option>
							<?php } ?>
						<?php } ?>
					</select>
				</div>
				<div class="layui-input-inline">
					<input type="text" name="num[]" value="<?= $v['num'] ?>" lay-verify="required" autocomplete="off"
						   placeholder="数量"
						   class="layui-input">
				</div>
			</div>


				<div class="layui-inline">
					<button class="layui-btn add" type="button">增加商品</button>
				</div>


		</div>


	<div class="layui-form-item">
		<div class="layui-input-block">

			<button type="submit" class="layui-btn" lay-submit="" lay-filter="wzdysubmit">确认办理</button>
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
		form.on('submit(wzdysubmit)', function (data) {

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
					$('#wzdy').submit();
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
			str += '<option value="<?= $v->id ?>"><?= $v->name ?></option>';
			<?php } ?>
			str += '</select>';
			str += '</div>';
			str += '<div class="layui-input-inline">';
			str += '<input type="text" name="num[]" lay-verify="required" autocomplete="off" placeholder="数量"class="layui-input">';
			str += '</div>';
			str += '</div>';
			str += '<div class="layui-inline">' +
					'<button class="layui-btn layui-btn-danger del" type="button">删除</button>' +
					'</div>';
			str += '</div>';
			$('.goods').after(str);
			form.render()
		});
		$('#wzdy').on('click', '.del', function () {
			$(this).parents('.layui-form-item').remove();
			form.render()
		})
		form.on('select(carchanqge)', function (data) {
			var oper = (data.elem[data.elem.selectedIndex]).title
			$("#SJ").val(oper)
			$("#SJ").text(oper)
			form.render()
		});

	});


</script>
<?php if (get_cookie('dispatch')) { ?>
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
			}, 3000);
			return false
		});
	</script>
<?php } ?>
<?php if (get_cookie('errordispatch')) { ?>
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



<?php if (get_cookie('printinfo')) { ?>
	<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
	<script>

		const data = <?= get_cookie('printinfo') ?>;
		console.log(data)
		let goods = JSON.parse(data.goods)
		if (data.type == '钢瓶收发货单据') {

			var jsonp = {
				Memo2: "南宁三燃公司钢瓶收发货单据",
				Memo1: data.topinfo,
				Memo4: '发货地：   ' + data.department,
				Memo5: '收货地：   ' + data.address,
				Memo6: '司机：   ' + data.deliveryman,
				Memo7: '车号：   ' + data.remarks,
				Memo27: goods[0] ? goods[0].goodsname : '',
				Memo28: goods[1] ? goods[1].goodsname : '',
				Memo29: goods[2] ? goods[2].goodsname : '',
				Memo30: goods[0] ? goods[0].num : '',
				Memo31: goods[1] ? goods[1].num : '',
				Memo32: goods[2] ? goods[2].num : '',
				Memo69: '重瓶发货人：' + data.operator,
				Memo74: '',//补打时间：2020-5-21 11:37:51
				Memo8: '铅封编号',
				Memo9: '出厂（后门）',
				Memo10: '（边门）',
				Memo11: '门店（后门）',
				Memo12: '（边门）',
				Memo13: '规格',
				Memo17: '重瓶发货',
				Memo21: '本年原',
				Memo14: '本年检',
				Memo15: '混装',
				Memo16: '重瓶实收',
				Memo18: '本司空',
				Memo19: '非本司空',
				Memo20: '收购',
				Memo22: '补差',
				Memo23: '带瓶',
				Memo24: '其他',
				Memo25: '返空总数',
				Memo26: '退重数量',
				Memo33: '',
				Memo34: '',
				Memo35: '',
				Memo36: '',
				Memo37: '',
				Memo38: '',
				Memo39: '',
				Memo40: '',
				Memo41: '',
				Memo42: '',
				Memo43: '',
				Memo44: '',
				Memo45: '',
				Memo46: '',
				Memo47: '',
				Memo48: '',
				Memo49: '',
				Memo50: '',
				Memo51: '',
				Memo52: '',
				Memo53: '',
				Memo54: '',
				Memo55: '',
				Memo56: '',
				Memo57: '',
				Memo58: '',
				Memo59: '',
				Memo60: '',
				Memo61: '',
				Memo62: '',
				Memo63: '',
				Memo64: '',
				Memo65: '',
				Memo66: '',
				Memo67: '',
				Memo68: '',
				Memo70: '    重瓶收货人：',
				Memo71: '   返空发货人：',
				Memo72: '   返空收货人：',
				Memo73: '',
			}
			var data_infop = {
				PrintData: jsonp,
				Print: true
			}
			axios.get('http://127.0.0.1:8000/api/print/order/13/?data=' + JSON.stringify(data_infop)).then(rew => {
				console.log(rew)
			})
		}
	</script>
<?php } ?>
</html>
