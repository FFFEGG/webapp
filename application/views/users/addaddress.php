<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>添加地址</title>
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
	<input type="hidden" name="id" value="">
	<input type="hidden" name="companyid" value="">
	<input type="hidden" name="addtime" value="<?= date('Y-m-d H:i:s', time()) ?>">
	<input type="hidden" name="updatetime" value="<?= date('Y-m-d H:i:s', time()) ?>">
	<input type="hidden" name="userid" value="<?= $userinfo['id'] ?>">
	<input type="hidden" name="longitude" value="0">
	<input type="hidden" name="latitude" value="0">
	<input type="hidden" name="state" value="1">
	<input type="hidden" name="memberid" value="<?= $this->input->get('cardid') ?>">
	<div class="layui-form-item">
		<label class="layui-form-label">姓名</label>
		<div class="layui-input-block">
			<input type="text" name="name" value="<?= $this->input->get('name') ?>"  autocomplete="off"
				   placeholder="请输入姓名" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">电话</label>
		<div class="layui-input-block">
			<input type="text" name="telephone" value="" 
				   autocomplete="off" placeholder="请输入电话" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">工作单位</label>
		<div class="layui-input-block">
			<input type="text" name="workplace" value="" 
				   autocomplete="off" placeholder="请输入工作单位" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">区域编码</label>
		<div class="layui-input-block">
			<input type="text" name="regionalcode" value=""
				   autocomplete="off" placeholder="请输入区域编码" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">省</label>
		<div class="layui-input-block">
			<input type="text" name="province" value="广西壮族自治区" 
				   autocomplete="off" placeholder="请输入输入省" class="layui-input">
		</div>
	</div>


	<div class="layui-form-item">
		<label class="layui-form-label">市</label>
		<div class="layui-input-inline">
			<select name="city" lay-filter="city" >
				<option selected value="">请选择</option>
				<?php foreach ($city as $v) { ?>
					<option value="<?= $v['name'] ?>"><?= $v['name'] ?></option>
				<?php } ?>

			</select>
		</div>
		<div class="layui-input-inline">
			<select name="area" class="area" lay-filter="area" >

				<option value="">请选择</option>

			</select>
		</div>
		<div class="layui-input-inline">
			<select name="town" class="town" >
				<option value="">请选择</option>
			</select>
		</div>
	</div>


	<div class="layui-form-item">
		<label class="layui-form-label">街道</label>
		<div class="layui-input-block">
			<input type="text" name="street" value="" 
				   autocomplete="off" placeholder="请输入镇/街道办" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">门牌号</label>
		<div class="layui-input-block">
			<input type="text" name="housenumber" value="" 
				   autocomplete="off" placeholder="请输入门牌号" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">详细地址</label>
		<div class="layui-input-block">
			<input type="text" name="address" value="" 
				   autocomplete="off" placeholder="请输入详细地址" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">住所类型</label>
		<div class="layui-input-block">
			<select name="housingproperty" id="">
				<option value="私人房">私人房</option>
				<option value="住宅小区">住宅小区</option>
				<option value="临街铺面">临街铺面</option>
			</select>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">配送门店</label>
		<div class="layui-input-inline">
			<select name="departmentid">
				<?php foreach ($_SESSION['initData']->Department->info as $v) { ?>
					<?php if ($v->type == '业务门店' || $v->type == '业务公司') { ?>
						<option value="<?= $v->id ?>"><?= $v->name ?></option>
					<?php } ?>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">备注</label>
		<div class="layui-input-block">
			<input type="text" name="remarks" value=""
				    autocomplete="off" placeholder="请输入备注" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">内部备注</label>
		<div class="layui-input-block">
			<input type="text" name="ope_remarks" value=""
				    autocomplete="off" placeholder="请输入内部备注" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">是否默认</label>
		<div class="layui-input-block">
			<select name="defaultoption" id="">
				<option value="1">是</option>
				<option value="0">否</option>
			</select>
		</div>
	</div>

	<div class="layui-form-item">
		<button class="layui-btn" lay-submit="" lay-filter="demo2">确认添加</button>
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

		form.on('select(city)', function (data) {
			$.ajax({
				url: '/index.php/user/getarea',
				method: 'get',
				dataType: 'json',
				data: {
					city: data.value
				},
				success(res) {

					$('.area').empty()
					var str = '';
					var select_area = res.select_area
					for (i in select_area) {
						str += '<option  value="' + select_area[i]['name'] + '">' + select_area[i]['name'] + '</option>'
					}
					$('.area').append(str)

					$('.town').empty()
					var street_str = '';
					var select_twon = res.select_twon
					for (j in select_twon) {
						street_str += '<option  value="' + select_twon[j]['name'] + '">' + select_twon[j]['name'] + '</option>'
					}
					$('.town').append(street_str)


					form.render()
				}
			})

		});
		form.on('select(area)', function (data) {
			$.ajax({
				url: '/index.php/user/getTwon',
				method: 'get',
				dataType: 'json',
				data: {
					city: data.value
				},
				success(res) {

					$('.town').empty()
					var street_str = '';
					var select_twon = res.select_twon
					for (j in select_twon) {
						street_str += '<option  value="' + select_twon[j]['name'] + '">' + select_twon[j]['name'] + '</option>'
					}
					$('.town').append(street_str)


					form.render()
				}
			})
		})
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
		});
	</script>
<?php } ?>
</body>
</html>
