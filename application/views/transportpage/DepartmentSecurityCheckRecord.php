
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>部门安检记录信息</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
</head>
<body>
<div class="oapd">
	<div class="layui-form-item layui-form">
		<form action="" method="get">
			<div class="layui-inline">
				<input type="hidden" name="userid" value="<?php echo $_GET['userid'] ?>">
				<input type="hidden" name="name" value="<?php echo $_GET['name'] ?>">
				<input type="hidden" name="memberid" value="<?php echo $_GET['memberid'] ?>">
				<label class="layui-form-label" style="padding: 9px 0;text-align: left">查询日期</label>
				<div class="layui-input-inline">
					<input type="text" name="begintime" id="begintime" lay-verify="date" value="<?= $this->input->get('begintime')?$this->input->get('begintime'):date('Y-m-d')?>"
						   placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
				</div>
				<div class="layui-form-mid">-</div>
				<div class="layui-input-inline">
					<input type="text" name="endtime" id="endtime" lay-verify="date"
						   value="<?= $this->input->get('endtime')?$this->input->get('endtime'):date('Y-m-d')?>" placeholder="yyyy-MM-dd" autocomplete="off"
						   class="layui-input">
				</div>
				<div class="layui-input-inline">
					<label class="layui-form-label" style="width: 30px">状态</label>
					<div class="layui-input-block" style="margin-left: 62px">
						<select name="state" lay-filter="aihao">
							<option value="全部">全部</option>
							<option value="正常">正常</option>
						</select>
					</div>
				</div>
				<div class="layui-input-inline">
					<label class="layui-form-label">安检部门</label>
					<div class="layui-input-block">
						<select name="securitycheckdepartment" lay-filter="aihao">
							<option value="<?= get_cookie('department') ?>"><?= get_cookie('department') ?></option>
						</select>
					</div>
				</div>
				<button class="layui-btn" type="submit">查询</button>
			</div>
		</form>

	</div>
	<div class="layui-form">
		<table class="layui-table" lay-size="sm">
			<thead>
			<tr>
				<th>id</th>
				<th>订单号</th>
				<th>时间</th>
				<th>姓名</th>
				<th>电话</th>
				<th>地址</th>
				<th>用户类型</th>
				<th>归属部门</th>
				<th>业务员</th>
				<th>用户等级</th>
				<th>备注</th>
				<th>安检员</th>
				<th>安检部门</th>
				<th>操作员</th>
				<th>完成备注</th>
				<th>完成部门</th>
				<th>完成操作员</th>
				<th>状态</th>
				<th>操作</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $v) {?>
				<tr>
					<td><?= $v->id ?></td>
					<td><?= $v->serial ?></td>
					<td><?= $v->addtime ?></td>
					<td><?= $v->name ?></td>
					<td><?= $v->telephone ?></td>
					<td><?= $v->address ?></td>
					<td><?= $v->customertype ?></td>
					<td><?= $v->attributiondepartment ?></td>
					<td><?= $v->salesman ?></td>
					<td><?= $v->viplevel ?></td>
					<td><?= $v->remarks ?></td>
					<td><?= $v->securityinspector ?></td>
					<td><?= $v->department ?></td>
					<td><?= $v->operator ?></td>
					<td><?= $v->completeremarks ?></td>
					<td><?= $v->completedepartment ?></td>
					<td><?= $v->completeoperator ?></td>
					<td><?= getstate($v->state) ?></td>
					<?php if ($v->state == 1) {?>
					<td><button onclick="Win10_child.openUrl('/index.php/user/CompleteUserSecurityCheck?data=<?= Myencode($v)?>','完成安检记录')" class="layui-btn layui-btn-sm">完成安检</button></td>
						<?php }else {?>
						<td></td>
					<?php }?>
				</tr>
			<?php }?>
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
    function bindsns(data) {
		$.ajax({
			url: '/index.php/api/bindsns',
			method: 'post',
			data: {
				info: data
			},
			dataType: 'json',
			success:function (res) {
				if (res.code == 200) {
					alert('绑定成功')
				} else {
					alert('绑定失败')
				}
				setTimeout(function () {
					window.location.reload()
				}, 1000)
			}
		})
	}
</script>

</html>
