<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>修改地址</title>
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
	<input type="hidden" name="id" value="<?= $info['id'] ?>">
	<input type="hidden" name="companyid" value="<?= $info['companyid'] ?>">
	<input type="hidden" name="addtime" value="<?= $info['addtime'] ?>">
	<input type="hidden" name="updatetime" value="<?= date('Y-m-d H:i:s', time()) ?>">
	<input type="hidden" name="userid" value="<?= $info['userid'] ?>">
	<input type="hidden" name="longitude" value="<?= $info['longitude'] ?>">
	<input type="hidden" name="latitude" value="<?= $info['latitude'] ?>">

	<input type="hidden" name="state" value="<?= $info['state'] ?>">
	<input type="hidden" name="memberid" value="<?= $this->input->get('memberid') ?>">
	<div class="layui-form-item">
		<label class="layui-form-label"><span style="color: red">*</span>姓名</label>
		<div class="layui-input-block">
			<input type="text" name="name" value="<?= $info['name'] ?>" autocomplete="off"
				   placeholder="请输入姓名" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label"><span style="color: red">*</span>电话</label>
		<div class="layui-input-block">
			<input type="text" name="telephone" value="<?= $info['telephone'] ?>"
				   autocomplete="off" placeholder="请输入电话" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">工作单位</label>
		<div class="layui-input-block">
			<input type="text" name="workplace" value="<?= $info['workplace'] ?>"
				   autocomplete="off" placeholder="请输入工作单位" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">区域编码</label>
		<div class="layui-input-block">
			<input type="text" name="regionalcode" value="<?= $info['regionalcode'] ?>"
				   autocomplete="off" placeholder="请输入区域编码" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label"><span style="color: red">*</span>省</label>
		<div class="layui-input-block">
			<input type="text" name="province" value="<?= $info['province'] ?>"
				   autocomplete="off" placeholder="请输入输入省" class="layui-input">
		</div>
	</div>


	<div class="layui-form-item">
		<label class="layui-form-label"><span style="color: red">*</span>市</label>
		<div class="layui-input-inline">
			<select name="city" lay-filter="city">
				<?php foreach ($city as $v) { ?>
					<option <?php if ($info['city'] == $v['name']) {
						echo 'selected';
					} ?> value="<?= $v['name'] ?>"><?= $v['name'] ?></option>
				<?php } ?>

			</select>
		</div>
		<div class="layui-input-inline">
			<select name="area" class="area" lay-filter="area">
				<?php foreach ($select_area as $v) { ?>
					<option <?php if ($info['area'] == $v['name']) {
						echo 'selected';
					} ?> value="<?= $v['name'] ?>"><?= $v['name'] ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="layui-input-inline">
			<select name="town" class="town">
				<?php foreach ($select_twon as $v) { ?>
					<option <?php if ($info['town'] == $v['name']) {
						echo 'selected';
					} ?> value="<?= $v['name'] ?>"><?= $v['name'] ?></option>
				<?php } ?>
			</select>
		</div>
	</div>


	<div class="layui-form-item">
		<label class="layui-form-label"><span style="color: red">*</span>街道</label>
		<div class="layui-input-block">
			<input type="text" name="street" value="<?= $info['street'] ?>"
				   autocomplete="off" placeholder="请输入镇/街道办" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label"><span style="color: red">*</span>门牌号</label>
		<div class="layui-input-block">
			<input type="text" name="housenumber" value="<?= $info['housenumber'] ?>"
				   autocomplete="off" placeholder="请输入门牌号" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label"><span style="color: red">*</span>详细地址</label>
		<div class="layui-input-block">
			<input type="text" name="address" value="<?= $info['address'] ?>"
				   autocomplete="off" placeholder="请输入详细地址" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label"><span style="color: red">*</span>住所类型</label>
		<div class="layui-input-block">
			<select name="housingproperty" id="">
				<option <?php if ($info['housingproperty'] == '住宅小区') {
					echo 'selected';
				} ?> value="住宅小区">住宅小区
				</option>
				<option <?php if ($info['housingproperty'] == '私人房') {
					echo 'selected';
				} ?> value="私人房">私人房
				</option>
				<option <?php if ($info['housingproperty'] == '临街铺面') {
					echo 'selected';
				} ?> value="临街铺面">临街铺面
				</option>
			</select>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label"><span style="color: red">*</span>配送门店</label>
		<div class="layui-input-inline">
			<select name="departmentid">
				<?php foreach ($_SESSION['initData']->Department->info as $v) { ?>
					<?php if ($v->type == '业务公司' || $v->type == '业务门店') { ?>
						<option <?php if ($info['departmentid'] == $v->id) {
							echo 'selected';
						} ?> value="<?= $v->id ?>"><?= $v->name ?></option>
					<?php } ?>
				<?php } ?>

			</select>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label"><span style="color: red">*</span>状态</label>
		<div class="layui-input-block">
			<select name="state" id="">
				<option <?php if ($info['state'] == '1') {
					echo 'selected';
				} ?> value="正常">正常
				</option>
				<option <?php if ($info['state'] == '0') {
					echo 'selected';
				} ?> value="取消">取消
				</option>
			</select>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label"><span style="color: red">*</span>是否默认</label>
		<div class="layui-input-block">
			<select name="defaultoption" id="">
				<option <?php if ($info['defaultoption'] == '1') {
					echo 'selected';
				} ?> value="1">是
				</option>
				<option <?php if ($info['defaultoption'] == '0') {
					echo 'selected';
				} ?> value="0">否
				</option>
			</select>
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">备注</label>
		<div class="layui-input-block">
			<input type="text" name="remarks" value="<?= $info['remarks'] ?>"
				   autocomplete="off" placeholder="请输入备注" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<label class="layui-form-label">内部备注</label>
		<div class="layui-input-block">
			<input type="text" name="ope_remarks" value="<?= $info['ope_remarks'] ?>"
				   autocomplete="off" placeholder="请输入内部备注" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<button class="layui-btn" lay-submit="" lay-filter="demo2">确认修改</button>
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
			layer.msg('修改成功');
		});
	</script>
<?php } ?>
</body>
</html>
