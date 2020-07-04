<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>用户基本信息</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>res/js/win10.child.js"></script>

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

	.tracking-in-expand {
		-webkit-animation: tracking-in-expand .7s cubic-bezier(.215, .61, .355, 1.000) both;
		animation: tracking-in-expand .7s cubic-bezier(.215, .61, .355, 1.000) both
	}

	@-webkit-keyframes tracking-in-expand {
		0% {
			letter-spacing: -.5em;
			opacity: 0
		}
		40% {
			opacity: .6
		}
		100% {
			opacity: 1
		}
	}

	@keyframes tracking-in-expand {
		0% {
			letter-spacing: -.5em;
			opacity: 0
		}
		40% {
			opacity: .6
		}
		100% {
			opacity: 1
		}
	}

</style>
<body>
<div class="oapd">
	<div class="demoTable" style="padding: 0 0 20px 0">
		<form action="" method="get">
			<span style="font-weight: bold;font-size: 20px">搜索用户卡号：</span>

			<div class="layui-inline">
				<input class="layui-input" name="cardid" id="add_demoReload" value="<?php echo $info['cardid']; ?>"
					   autocomplete="off">
			</div>
			<button class="layui-btn" type="submit" data-type="reload">搜索</button>
			<a style="color: blue;cursor: pointer;padding: 0 10px"
			   onclick="Win10_child.openUrl('/index.php/order/lists?cardid=<?= $info['cardid'] ?>','订单业务')">业务链接</a>
		</form>
	</div>

	<div class="layui-form layui-form-pane">

		<div class="layui-form-item">
			<div class="layui-inline">
				<label class="layui-form-label">姓名</label>
				<div class="layui-input-block">
					<input type="text" value="<?php echo $info['name']; ?>" autocomplete="off" disabled
						   class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">电话</label>
				<div class="layui-input-block">
					<input type="text" value="<?php echo $info['telephone']; ?>" autocomplete="off" disabled
						   class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">类型</label>
				<div class="layui-input-block">
					<input type="text" value="<?php echo $info['customertype']; ?>" autocomplete="off" disabled
						   class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">余额</label>
				<div class="layui-input-block">
					<input type="text" value="<?php echo $info['balance']; ?>" autocomplete="off" disabled
						   class="layui-input" style="color: red">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">状态</label>
				<div class="layui-input-block">
					<input type="text" value="<?php echo $info['state']; ?>" autocomplete="off" disabled
						   class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">单位</label>
				<div class="layui-input-block">
					<input type="text" value="<?php echo $info['workplace']; ?>" autocomplete="off" disabled
						   class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">信用额度</label>
				<div class="layui-input-block">
					<input type="text" value="<?php echo $info['quota']; ?>" autocomplete="off" disabled
						   class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">开户时间</label>
				<div class="layui-input-block">
					<input type="text" value="<?php echo $info['addtime']; ?>" autocomplete="off" disabled
						   class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">住所类型</label>
				<div class="layui-input-block">
					<input type="text" value="<?php echo $info['housingproperty']; ?>" autocomplete="off" disabled
						   class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">用户等级</label>
				<div class="layui-input-block">
					<input type="text" value="<?php echo $info['viplevel']; ?>" autocomplete="off" disabled
						   class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">归属部门</label>
				<div class="layui-input-block">
					<input type="text" value="<?php echo $info['attributiondepartment']; ?>" autocomplete="off" disabled
						   class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">业务员</label>
				<div class="layui-input-block">
					<input type="text" value="<?php echo $info['salesman']; ?>" autocomplete="off" disabled
						   class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">发卡人</label>
				<div class="layui-input-block">
					<input type="text" value="<?php echo $info['operator']; ?>" autocomplete="off" disabled
						   class="layui-input">
				</div>
			</div>

			<div class="layui-inline">
				<label class="layui-form-label">发卡点</label>
				<div class="layui-input-block">
					<input type="text" value="<?php echo $info['department']; ?>" autocomplete="off" disabled
						   class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">计费时间</label>
				<div class="layui-input-block">
					<input type="text" value="<?php echo $info['billingtime']; ?>" autocomplete="off" disabled
						   class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">备注</label>
				<div class="layui-input-block">
					<input type="text" value="<?php echo $info['remarks']; ?>" autocomplete="off" disabled
						   class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">地址</label>
				<div class="layui-input-inline">
					<select name="quiz1">
						<?php foreach ($addresses as $v) { ?>
							<option
									value="<?= $v->city . $v->area . $v->town . $v->street . $v->housenumber . $v->address ?>"><?= $v->city . $v->area . $v->town . $v->street . $v->housenumber . $v->address ?></option>
						<?php } ?>
					</select>

				</div>
				<div class="layui-inline" style="margin-left: 360px">
					<button class="layui-btn"
							onclick="Win10_child.openUrl('/index.php/user/address?userid=<?php echo $info['id'] ?>&name=<?php echo $info['name'] ?>&cardid=<?php echo $info['cardid']; ?>', '地址管理')">
						修改地址
					</button>
					<button class="layui-btn addremarks">添加备注</button>
				</div>
			</div>

		</div>
	</div>
	<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
		<ul class="layui-tab-title">
			<li class="layui-this">业务办理</li>

		</ul>
		<div class="layui-tab-content" style="height: 100px;">
			<div class="layui-tab-item layui-show">

				<div style="padding: 20px; background-color: #F2F2F2;">
					<?php if ($info['memberid']) { ?>
						<div class="layui-row layui-col-space15">

							<div class="layui-col-md4"
								 onclick="Win10_child.openUrl('/index.php/management/handleUserCollateral?userid=<?php echo $info['id'] ?>&name=<?php echo $info['name'] ?>&memberid=<?php echo $info['cardid']; ?>','抵押物办理')">
								<div class="layui-card yebl tracking-in-expand">
									抵押物办理
								</div>
							</div>
							<div class="layui-col-md4 "
								 onclick="Win10_child.openUrl('/index.php/management/Cylindercquisition?userid=<?php echo $info['id'] ?>&name=<?php echo $info['name'] ?>&memberid=<?php echo $info['cardid']; ?>','钢瓶收购')">
								<div class="layui-card yebl tracking-in-expand">
									钢瓶收购
								</div>
							</div>
							<div class="layui-col-md4 "
								 onclick="Win10_child.openUrl('/index.php/management/mortgagedgoods?userid=<?php echo $info['id'] ?>&name=<?php echo $info['name'] ?>&memberid=<?php echo $info['cardid']; ?>','退抵押物物资')">
								<div class="layui-card yebl tracking-in-expand">
									退抵押物物资
								</div>
							</div>
							<div class="layui-col-md4 "
								 onclick="Win10_child.openUrl('/index.php/management/RetreatUserCollateral?userid=<?php echo $info['id'] ?>&name=<?php echo $info['name'] ?>&memberid=<?php echo $info['cardid']; ?>','退抵押物款')">
								<div class="layui-card yebl tracking-in-expand">
									退抵押物款
								</div>
							</div>
							<?php if ($_SESSION['users']->logindepartmenttype == '信息中心') { ?>


								<div class="layui-col-md4 "
									 onclick="Win10_child.openUrl('/index.php/management/HandleUserZGQ?userid=<?php echo $info['id'] ?>&name=<?php echo $info['name'] ?>&memberid=<?php echo $info['cardid']; ?>','办理职工气')">
									<div class="layui-card yebl tracking-in-expand">
										办理职工气
									</div>
								</div>
								<div class="layui-col-md4 "
									 onclick="Win10_child.openUrl('/index.php/management/HandleUserYWQ?userid=<?php echo $info['id'] ?>&name=<?php echo $info['name'] ?>&memberid=<?php echo $info['cardid']; ?>','办理业务气')">
									<div class="layui-card yebl tracking-in-expand">
										办理业务气
									</div>
								</div>
							<?php } ?>
							<div class="layui-col-md4 "
								 onclick="Win10_child.openUrl('/index.php/management/preferential?userid=<?php echo $info['id'] ?>&name=<?php echo $info['name'] ?>&memberid=<?php echo $info['cardid']; ?>','申请优惠')">
								<div class="layui-card yebl tracking-in-expand">
									申请优惠
								</div>
							</div>
							<div class="layui-col-md4 "
								 onclick="Win10_child.openUrl('/index.php/management/HandleBuyUserRaffinate?userid=<?php echo $info['id'] ?>&name=<?php echo $info['name'] ?>&memberid=<?php echo $info['cardid']; ?>&salesman=<?= $info['salesman'] ?>','残液收购')">
								<div class="layui-card yebl tracking-in-expand">
									残液收购
								</div>
							</div>
							<div class="layui-col-md4 "
								 onclick="Win10_child.openUrl('/index.php/management/HandleUserSalesMashup?userid=<?php echo $info['id'] ?>&name=<?php echo $info['name'] ?>&memberid=<?php echo $info['cardid']; ?>','办理用户混搭方案')">
								<div class="layui-card yebl tracking-in-expand">
									办理用户混搭方案
								</div>
							</div>

							<div class="layui-col-md4 "
								 onclick="Win10_child.openUrl('/index.php/management/RetirementInventory?userid=<?php echo $info['id'] ?>&name=<?php echo $info['name'] ?>&memberid=<?php echo $info['cardid']; ?>','退用户仓库商品')">
								<div class="layui-card yebl tracking-in-expand">
									退用户仓库商品
								</div>
							</div>


							<div class="layui-col-md4 "
								 onclick="Win10_child.openUrl('/index.php/allocation/UserRefund?userid=<?php echo $info['id'] ?>&name=<?php echo $info['name'] ?>&memberid=<?php echo $info['cardid']; ?>','用户退款')">
								<div class="layui-card yebl tracking-in-expand">
									用户退款
								</div>
							</div>

							<div class="layui-col-md4 "
								 onclick="Win10_child.openUrl('/index.php/user/recharge?userid=<?php echo $info['id'] ?>&name=<?php echo $info['name'] ?>&cardid=<?php echo $info['cardid']; ?>','用户充值')">
								<div class="layui-card yebl tracking-in-expand">
									用户充值
								</div>
							</div>
							<div class="layui-col-md4 "
								 onclick="Win10_child.openUrl('/index.php/user/AdvancePayFee?userid=<?php echo $info['id'] ?>&name=<?php echo $info['name'] ?>&cardid=<?php echo $info['cardid']; ?>','用户预缴租赁费，检测费，年检费，使用费')">
								<div class="layui-card yebl tracking-in-expand">
									用户预缴费用
								</div>
							</div>

							<?php if ($info['customertype'] == '代销用户') { ?>
								<div class="layui-col-md4 "
									 onclick="Win10_child.openUrl('/index.php/user/UserFreight?userid=<?php echo $info['id'] ?>&name=<?php echo $info['name'] ?>&cardid=<?php echo $info['cardid']; ?>','用户运费')">
									<div class="layui-card yebl tracking-in-expand">
										用户运费
									</div>
								</div>
							<?php } ?>
						</div>
					<?php } else { ?>
						<div class="layui-row layui-col-space15">

							<div class="layui-col-md4">
								<div class="layui-card yebl tracking-in-expand">
									抵押物办理
								</div>
							</div>
							<div class="layui-col-md4 ">
								<div class="layui-card yebl tracking-in-expand">
									钢瓶收购
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
							<?php if ($_SESSION['users']->logindepartmenttype == '信息中心') { ?>


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
							<?php } ?>
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

							<div class="layui-col-md4 ">
								<div class="layui-card yebl tracking-in-expand">
									退用户仓库商品
								</div>
							</div>


							<div class="layui-col-md4 ">
								<div class="layui-card yebl tracking-in-expand">
									用户退款
								</div>
							</div>

							<div class="layui-col-md4 ">
								<div class="layui-card yebl tracking-in-expand">
									用户充值
								</div>
							</div>
							<div class="layui-col-md4 ">
								<div class="layui-card yebl tracking-in-expand">
									用户预缴费用
								</div>
							</div>

							<?php if ($info['customertype'] == '代销用户') { ?>
								<div class="layui-col-md4 ">
									<div class="layui-card yebl tracking-in-expand">
										用户运费
									</div>
								</div>
							<?php } ?>
						</div>
					<?php } ?>
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
		$('.addremarks').click(function () {
			var cardid = $("input[name='cardid']").val()
			if (!cardid) {
				layer.msg('请输入卡号')
				return false
			}
			layer.prompt(function (val, index) {
				$.ajax({
					url: '/index.php/api/addremarks',
					type: 'post',
					dataType: 'json',
					data: {
						snsuserid: <?= $info['id']?>,
						memberid: <?= $info['memberid']?>,
						remarks: val
					},
					success: function (res) {
						if (res.code == 200) {
							layer.msg('添加成功')
							layer.close(index);
							return false
						} else {
							layer.msg('添加失败')
							layer.close(index);
							return false
						}
					}
				})
			});
		})
	});
</script>

</body>
</html>
