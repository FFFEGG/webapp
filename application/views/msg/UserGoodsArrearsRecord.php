<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>用户欠款信息</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script src="<?php echo base_url(); ?>res/js/sweetalert2.min.js"></script>
	<script src="<?php echo base_url(); ?>res/js/core.js"></script>
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
<style>
	.btn-success {
		background: blue;
		padding: 10px;
		color: #F2F2F2;
		border-radius: 3px;
		margin: 0 5px;
	}

	.btn-danger {
		background: red;
		padding: 10px;
		color: #F2F2F2;
		border-radius: 3px;
		margin: 0 5px;
	}
</style>
<div class="oapd">
	<blockquote class="layui-elem-quote layui-text" style="font-weight: bold;font-size: 20px;color: #222;">
		用户<?= $this->input->get('memberid') ?>- <?php echo $name; ?> 用户欠款信息
	</blockquote>
	<div class="layui-form-item layui-form">
		<form action="" method="get">
			<div class="layui-inline">
				<input type="hidden" name="userid" value="<?php echo $_GET['userid'] ?>">
				<input type="hidden" name="name" value="<?php echo $_GET['name'] ?>">
				<input type="hidden" name="memberid" value="<?php echo $_GET['memberid'] ?>">
				<label class="layui-form-label" style="padding: 9px 0;text-align: left">查询日期</label>
				<div class="layui-input-inline">
					<input type="text" name="begintime" id="begintime" lay-verify="date"
						   value="<?= $this->input->get('begintime') ? $this->input->get('begintime') : date('Y-m-d') ?>"
						   placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
				</div>
				<div class="layui-form-mid">-</div>
				<div class="layui-input-inline">
					<input type="text" name="endtime" id="endtime" lay-verify="date"
						   value="<?= $this->input->get('endtime') ? $this->input->get('endtime') : date('Y-m-d') ?>"
						   placeholder="yyyy-MM-dd" autocomplete="off"
						   class="layui-input">
				</div>

				<div class="layui-input-inline">
					<label class="layui-form-label">归属部门</label>
					<div class="layui-input-block" style="width: 140px !important;">
						<select name="department">
							<option <?php if ($this->input->get('department') == '' || $this->input->get('department') == '全部') {
								echo 'selected';
							} ?> value="全部">全部
							</option>
							<option <?php if ($this->input->get('department') == '商用气开发一部') {
								echo 'selected';
							} ?> value="商用气开发一部">商用气开发一部
							</option>

							<option <?php if ($this->input->get('department') == '商用气开发二部') {
								echo 'selected';
							} ?> value="商用气开发二部">商用气开发二部
							</option>

							<option <?php if ($this->input->get('department') == '商用气维护部') {
								echo 'selected';
							} ?> value="商用气维护部">商用气维护部
							</option>


						</select>
					</div>
				</div>
				<div class="layui-input-inline">
					<label class="layui-form-label">业务员</label>
					<div class="layui-input-block">
						<select name="salesman" lay-filter="aihao">
							<option value="">全部</option>
							<?php foreach ($_SESSION['initData']->Operator->info as $v) { ?>
								<?php if ($v->quartersid == 3) { ?>
									<option <?php if ($this->input->get('salesman') == $v->name) {
										echo 'selected';
									} ?> value="<?= $v->name ?>"><?= $v->name ?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="layui-input-inline">
					<label class="layui-form-label" style="width: 30px">状态</label>
					<div class="layui-input-block" style="margin-left: 62px">
						<select name="state" lay-filter="aihao">
							<option value="">全部</option>
							<option value="正常">正常</option>
							<option value="正常">已还款</option>
						</select>
					</div>
				</div>

				<div class="layui-input-inline" style="width: 300px">
					<label class="layui-form-label" style="width: 80px">商品类型</label>
					<div class="layui-input-block">
						<select name="goodstype" lay-filter="aihao">
							<option <?php if ($this->input->get('goodstype') == '' || $this->input->get('goodstype') == '全部') {
								echo 'selected';
							} ?> value="全部">全部
							</option>
							<option <?php if ($this->input->get('goodstype') == '液化气') {
								echo 'selected';
							} ?> value="液化气">液化气
							</option>
							<option <?php if ($this->input->get('goodstype') == '工业气') {
								echo 'selected';
							} ?> value="工业气">工业气
							</option>
							<option <?php if ($this->input->get('goodstype') == '桶装水') {
								echo 'selected';
							} ?> value="桶装水">桶装水
							</option>
						</select>
					</div>
				</div>


				<div class="layui-input-inline" style="width: 300px">
					<label class="layui-form-label" style="width: 80px">欠款类型</label>
					<div class="layui-input-block">
						<select name="type" lay-filter="aihao">
							<option <?php if ($this->input->get('type') == '' || $this->input->get('type') == '全部') {
								echo 'selected';
							} ?> value="全部">全部
							</option>
							<option <?php if ($this->input->get('type') == '月结欠款') {
								echo 'selected';
							} ?> value="月结欠款">月结欠款
							</option>
							<option <?php if ($this->input->get('type') == '现结欠款') {
								echo 'selected';
							} ?> value="现结欠款">现结欠款
							</option>
						</select>
					</div>
				</div>

				<button class="layui-btn submitsss" type="submit">查询</button>
			</div>
		</form>

	</div>
	<div class="layui-form">
		<table class="layui-table" lay-size="sm">
			<thead>
			<tr>
				<?php if ($_SESSION['users']->logindepartmenttype == '信息中心') { ?>
					<th>会员号</th>
				<?php } ?>
				<th>生成时间</th>
				<th>类型</th>
				<th>商品名称</th>
				<th>商品类型</th>
				<th>单价</th>
				<th>数量</th>
				<th>金额</th>
				<th>还款时间</th>
				<th>还款金额</th>
				<th>业务员</th>
				<th>备注</th>
				<th>管理部门</th>
				<th>操作人</th>
				<th>状态</th>
				<th>操作</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $v) {
				?>
				<tr>
					<?php if ($_SESSION['users']->logindepartmenttype == '信息中心') { ?>
						<th><?= $v->memberid ?></th>
					<?php } ?>
					<td><?= substr($v->addtime, 0, 16) ?></td>
					<td><?= $v->type ?></td>
					<td><?= $v->goodsname ?></td>
					<td><?= $v->goodstype ?></td>
					<td><?= number_format($v->price, 2) ?></td>
					<td><?= (int)$v->num ?></td>
					<td><?= number_format($v->total, 2) ?></td>
					<td><?= substr($v->updatetime, 0, 16) ?></td>
					<td><?= number_format($v->repayment, 2) ?></td>
					<td><?= $v->salesman ?></td>
					<td><?= $v->remarks ?></td>
					<td><?= $v->attributiondepartment ?></td>

					<td><?= $v->operator ?></td>
					<td><?= getstate($v->state) ?></td>
					<td>
						<?php if ($_SESSION['users']->logindepartmenttype == '信息中心') { ?>
						<?php if ($v->state == 1) { ?>
							<button class="layui-btn layui-btn-sm"
									onclick="SplitUserArrears('<?= Myencode($v) ?>','<?= number_format($v->total, 2) ?>')">
								拆分
							</button>
							<button class="layui-btn layui-btn-sm" onclick="FeedbackArrears('<?= Myencode($v) ?>')">还款</button>
						<?php } ?>
						<?php } ?>
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
				, $ = layui.$;
		//日期
		laydate.render({
			elem: '#begintime'
		});
		laydate.render({
			elem: '#endtime'
		});

	});

	function SplitUserArrears(data, total) {
		swal({
			title: '确定拆分欠款操作？',
			input: 'textarea',
			text: '请填写拆分金额，多个回车分割,总金额：' + total,
			showCancelButton: true,
			confirmButtonText: '确认',
			cancelButtonText: '取消',
			confirmButtonClass: 'btn btn-success mr-3',
			cancelButtonClass: 'btn btn-danger',
			showLoaderOnConfirm: true,
			allowOutsideClick: false
		}).then(function (dismiss) {
			if (dismiss.value) {
				var total = dismiss.value
				$.ajax({
					url: '/index.php/api/SplitUserArrears',
					method: 'post',
					data: {
						info: data,
						total: total
					},
					dataType: 'json',
					success: function (rew) {
						if (rew.code == 200) {
							swal(
									'成功！',
									'',
									'success'
							);
						} else {
							swal(
									'失败！',
									'',
									'error'
							);
						}
						setTimeout(function () {
							$('form').submit()
						}, 1000)
					}
				})
			}
		})
	}

	function FeedbackArrears(data) {
		swal({
			title: '确定还款操作？',
			text: '',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: '确定',
			cancelButtonText: '取消',
			confirmButtonClass: 'btn btn-success',
			cancelButtonClass: 'btn btn-danger',
			buttonsStyling: false
		}).then(function (dismiss) {
			if (dismiss.value) {
				$.ajax({
					url: '/index.php/api/FeedbackArrears',
					method: 'post',
					data: {
						info: data
					},
					dataType: 'json',
					success: function (rew) {
						if (rew.code == 200) {
							swal(
									'成功！',
									'还款操作成功',
									'success'
							);
						} else {
							swal(
									'失败！',
									'',
									'error'
							);
						}
						setTimeout(function () {
							$('.submitsss').submit()
						}, 1000)
					}
				})
			}
		})
	}
</script>

</html>
