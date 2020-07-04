<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>用户业务办理</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>

	<!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<style>
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
	<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
		<legend>用户业务办理</legend>
	</fieldset>

	<div style="padding: 20px; background-color: #F2F2F2;">
		<div class="layui-row layui-col-space15">
			<div class="layui-col-md4">
				<div class="layui-card">
					<div class="layui-card-header layui-card-body-title">姓名</div>
					<div class="layui-card-body layui-card-body-title">
						FuDDDDDDDDDDong
					</div>
				</div>
			</div>
			<div class="layui-col-md4">
				<div class="layui-card">
					<div class="layui-card-header layui-card-body-title">电话</div>
					<div class="layui-card-body layui-card-body-title">
						12345678901
					</div>
				</div>
			</div>
			<div class="layui-col-md4">
				<div class="layui-card">
					<div class="layui-card-header layui-card-body-title">卡号</div>
					<div class="layui-card-body layui-card-body-title">
						800001
					</div>
				</div>
			</div>
			<div class="layui-col-md4">
				<div class="layui-card yebl tracking-in-expand">
					抵押物办理
				</div>
			</div>
			<div class="layui-col-md4 ">
				<div class="layui-card yebl tracking-in-expand">
					抵押物收购
				</div>
			</div>
			<div class="layui-col-md4 ">
				<div class="layui-card yebl tracking-in-expand">
					退抵押物物资
				</div>
			</div>
			<div class="layui-col-md4 ">
				<div class="layui-card yebl tracking-in-expand">
					退抵押物款
				</div>
			</div>
			<div class="layui-col-md4 ">
				<div class="layui-card yebl tracking-in-expand">
					办理职工气
				</div>
			</div>
			<div class="layui-col-md4 ">
				<div class="layui-card yebl tracking-in-expand">
					办理业务气
				</div>
			</div>
			<div class="layui-col-md4 ">
				<div class="layui-card yebl tracking-in-expand">
					申请优惠
				</div>
			</div>
			<div class="layui-col-md4 ">
				<div class="layui-card yebl tracking-in-expand">
					残液收购
				</div>
			</div>
			<div class="layui-col-md4 ">
				<div class="layui-card yebl tracking-in-expand">
					办理用户混搭方案
				</div>
			</div>

		</div>
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
