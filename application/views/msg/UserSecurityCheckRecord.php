
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>安检记录</title>
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
	.show {
		display: ;
	}
	.hidden {
		display: none;
	}
</style>
<div class="oapd">
	<blockquote class="layui-elem-quote layui-text" style="font-weight: bold;font-size: 20px;color: #222;">
		用户<?= $this->input->get('memberid') ?>-  <?php echo $name; ?> 安检记录信息
	</blockquote>
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
				<button class="layui-btn" type="submit">查询</button>
			</div>
		</form>

	</div>
	<div class="layui-form">
		<table class="layui-table" lay-size="sm">
			<thead>
			<tr>

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
				<tr class="show-projects" >
					<td onclick="showproject('<?= Myencode($v)?>')"><?= substr($v->addtime,0,16) ?></td>
					<td onclick="showproject('<?= Myencode($v)?>')"><?= $v->name ?></td>
					<td onclick="showproject('<?= Myencode($v)?>')"><?= $v->telephone ?></td>
					<td onclick="showproject('<?= Myencode($v)?>')"><?= $v->address ?></td>
					<td onclick="showproject('<?= Myencode($v)?>')"><?= $v->customertype ?></td>
					<td onclick="showproject('<?= Myencode($v)?>')"><?= $v->attributiondepartment ?></td>
					<td onclick="showproject('<?= Myencode($v)?>')"><?= $v->salesman ?></td>
					<td onclick="showproject('<?= Myencode($v)?>')"><?= $v->viplevel ?></td>
					<td onclick="showproject('<?= Myencode($v)?>')"><?= $v->remarks ?></td>
					<td onclick="showproject('<?= Myencode($v)?>')"><?= $v->securityinspector ?></td>
					<td onclick="showproject('<?= Myencode($v)?>')"><?= $v->department ?></td>
					<td onclick="showproject('<?= Myencode($v)?>')"><?= $v->operator ?></td>
					<td onclick="showproject('<?= Myencode($v)?>')"><?= $v->completeremarks ?></td>
					<td onclick="showproject('<?= Myencode($v)?>')"><?= $v->completedepartment ?></td>
					<td onclick="showproject('<?= Myencode($v)?>')"><?= $v->completeoperator ?></td>
					<td onclick="showproject('<?= Myencode($v)?>')"><?= getstate($v->state) ?></td>
					<td>
						<?php if ($v->state == 9999){?>
							<button onclick="Win10_child.openUrl('/index.php/user/CompleteUserSecurityCheck?data=<?= Myencode($v)?>','完成安检记录')" class="layui-btn layui-btn-sm">完成安检</button>
						<?php }?>
					</td>
				</tr>
				<tr class="show-project hidden">
					<td colspan="19">
						<div style="margin-top: 10px">
							<?php foreach ($v->projectlist as $ki=>$vi) { ?>
								<span style="font-weight: bold;margin-right: 20px;">项目<?= $ki+1 ?>：<?= $vi->project ?> <?= $vi->result ?></span>
							<?php } ?>
						</div>
					</td>
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
	function showproject (data) {
   		Win10_child.openUrl('/index.php/msg/showproject?data=' +data,'安检详情',[['60%','40%'],['200px','300px']])
    }
</script>

</html>
