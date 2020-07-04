<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>用户地址管理</title>
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
	.layui-tab-item-scroll {
		overflow-y: scroll;
		float: left;
		height: 600px;
		width: 100%;
	}
	.layui-form-pane .layui-form-label {
		text-align: left;
	}
	.layui-unselect {
		width: 526px;
	}

	.layui-input {
		color: #222;
		font-weight: bolder;
	}

	.shortcut {
		width: 156px;
		overflow: hidden;
		cursor: pointer;
		padding: 15px 0;
		transition: all 0.5s;
		border: 1px solid #eee;
		float: left;
		margin-right: 30px;
		margin-bottom: 10px;
	}

	.shortcut > .icon {
		width: 50px;
		height: 50px;
		overflow: hidden;
		margin: 0 auto;
		color: white;
		box-sizing: border-box;
		margin-bottom: 5px;
		margin-top: 5px;
		text-align: center;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		display: block;
		font-size: 37px;
		line-height: 50px;
	}

	.shortcut .title {
		color: grey;
		font-size: 12px;
		text-align: center;
		line-height: 18px;
		margin-bottom: 5px;
		font-weight: bold;
	}
	.layui-card-body-title {
		font-size: 20px;
		font-weight: bold;
	}
	.layui-card {
		padding: 10px;
	}
	.yebl {
		font-weight: bold;
		text-align: center;
		padding: 30px 0;
		font-size: 25px;
		flex-basis: content-box;
		cursor: pointer;
	}

	.tracking-in-expand{-webkit-animation:tracking-in-expand .7s cubic-bezier(.215,.61,.355,1.000) both;animation:tracking-in-expand .7s cubic-bezier(.215,.61,.355,1.000) both}
	@-webkit-keyframes tracking-in-expand{0%{letter-spacing:-.5em;opacity:0}40%{opacity:.6}100%{opacity:1}}@keyframes tracking-in-expand{0%{letter-spacing:-.5em;opacity:0}40%{opacity:.6}100%{opacity:1}}

</style>
<body>
<div class="oapd">
	<div class="demoTable" style="padding: 0 0 20px 0">
		<form action="" method="get">
			<span style="font-weight: bold;font-size: 20px">搜索用户卡号：</span>

			<div class="layui-inline">
				<input class="layui-input" name="cardid" id="add_demoReload" value="<?php echo $this->input->get('cardid'); ?>"
					   autocomplete="off">
			</div>
			<div class="layui-inline" style="width: 100px">

					<select name="state" id="" class="layui-input">
						<option <?php if ($this->input->get('state') == '正常') { echo 'selected';} ?> value="正常">正常</option>
						<option <?php if ($this->input->get('state') == '取消') { echo 'selected';} ?> value="取消">取消</option>
					</select>

			</div>
			<button class="layui-btn" type="submit" data-type="reload">搜索</button>
			<?php if($this->input->get('cardid')) {?>
				<button class="layui-btn" type="button" onclick="Win10_child.openUrl('/index.php/user/addaddress?cardid=<?= $this->input->get('cardid') ?>&name=<?= $this->input->get('name') ?>','添加地址')" data-type="reload">添加新地址</button>
			<?php }?>
		</form>
	</div>
	<div class="layui-form">
		<table class="layui-table">
			<thead>
			<tr>
				<th>id</th>
				<th>姓名</th>
				<th>电话</th>
				<th>工作单位</th>
				<th>省</th>
				<th>市</th>
				<th>区/县</th>
				<th>镇/街道办</th>
				<th>街道</th>
				<th>门牌号</th>
				<th>详细地址</th>
				<th>住所类型</th>
				<th>操作</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($addresses as $v) {?>
			<tr>

				<td><?= $v['id'] ?></td>
				<td><?= $v['name'] ?></td>
				<td><?= $v['telephone'] ?></td>
				<td><?= $v['workplace'] ?></td>
				<td><?= $v['province'] ?></td>
				<td><?= $v['city'] ?></td>
				<td><?= $v['area'] ?></td>
				<td><?= $v['town'] ?></td>
				<td><?= $v['street'] ?></td>
				<td><?= $v['housenumber'] ?></td>
				<td><?= $v['address'] ?></td>
				<td><?= $v['housingproperty'] ?></td>

				<td><button onclick="Win10_child.openUrl('/index.php/user/updateaddress?info=<?php echo Myencode($v) ?>&memberid=<?= $this->input->get('cardid') ?>','地址修改')" class="layui-btn">修改</button></td>

			</tr>
			<?php }?>
			</tbody>
		</table>
	</div>


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
    });
</script>

</body>
</html>
