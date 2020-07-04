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

	.tracking-in-expand{-webkit-animation:tracking-in-expand .7s cubic-bezier(.215,.61,.355,1.000) both;animation:tracking-in-expand .7s cubic-bezier(.215,.61,.355,1.000) both}
	@-webkit-keyframes tracking-in-expand{0%{letter-spacing:-.5em;opacity:0}40%{opacity:.6}100%{opacity:1}}@keyframes tracking-in-expand{0%{letter-spacing:-.5em;opacity:0}40%{opacity:.6}100%{opacity:1}}

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
			<?php if ($_SESSION['users']->logindepartmenttype == '业务门店' || $_SESSION['users']->logindepartmenttype == '预约中心') {?>
			<a style="color: blue;cursor: pointer;padding: 0 10px" onclick="Win10_child.openUrl('/index.php/order/lists?cardid=<?= $info['cardid']?>','订单业务')">业务链接</a>
			<?php }?>
<!--			<a style="color: blue;cursor: pointer;padding: 0 10px" onclick="Win10_child.openUrl('/index.php/user/info2','用户查询')">新版入口</a>-->
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
				<label class="layui-form-label">其他人员</label>
				<div class="layui-input-block">
					<input type="text" value="<?php echo $info['commissionofficer']; ?>" autocomplete="off" disabled
						   class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">下单时间</label>
				<div class="layui-input-block">
					<input type="text" value="<?php echo $info['lasttransactiontime']; ?>" autocomplete="off" disabled
						   class="layui-input">
				</div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">下单商品</label>
				<div class="layui-input-block">
					<input type="text" value="<?php echo $info['lasttransactiondetails']; ?>" autocomplete="off" disabled
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
					<button class="layui-btn" onclick="Win10_child.openUrl('/index.php/user/address?userid=<?php echo $info['id']?>&name=<?php echo $info['name']?>&cardid=<?php echo $info['cardid']; ?>', '地址管理')">修改地址</button>
					<button class="layui-btn addremarks" >添加备注</button>
					<button class="layui-btn" onclick="Win10_child.openUrl('/index.php/user/updateuser?info=<?= Myencode($info)?>', '修改用户资料')">修改用户资料</button>
				</div>
			</div>

		</div>
	</div>
	<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
		<ul class="layui-tab-title">
			<li class="layui-this">信息查询</li>
			<li>备注信息</li>
		</ul>
		<div class="layui-tab-content" style="height: 100px;">
			<div class="layui-tab-item layui-show">
				<div class="shortcut" onclick="Win10_child.openUrl('/index.php/msg/receivables?userid=<?php echo $info['id']?>&name=<?php echo $info['name']?>&memberid=<?= $this->input->get('cardid')?>','<img  class=\'icon\' src=\'https://res.layui.com/static/images/layui/logo.png\'//>收款信息')">
					<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/msgicon%20(1).png"/>
					<div class="title">收款信息</div>
				</div>


				<div class="shortcut" onclick="Win10_child.openUrl('/index.php/msg/sale?userid=<?php echo $info['id']?>&name=<?php echo $info['name']?>&memberid=<?= $this->input->get('cardid')?>','销售信息','max')">
					<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/msgicon%20(2).png"/>
					<div class="title">销售信息</div>
				</div>


				<div class="shortcut" onclick="Win10_child.openUrl('/index.php/msg/order?userid=<?php echo $info['id']?>&name=<?php echo $info['name']?>&memberid=<?= $this->input->get('cardid')?>','订单信息')">
					<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/msgicon%20(3).png"/>
					<div class="title">订单信息</div>
				</div>

				<div class="shortcut" onclick="Win10_child.openUrl('/index.php/msg/charge?userid=<?php echo $info['id']?>&name=<?php echo $info['name']?>&memberid=<?= $this->input->get('cardid')?>','抵押物收费信息')">
					<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/msgicon%20(4).png"/>
					<div class="title">抵押物收费信息</div>
				</div>

				<div class="shortcut" onclick="Win10_child.openUrl('/index.php/msg/chargeSalespromotion?userid=<?php echo $info['id']?>&name=<?php echo $info['name']?>&memberid=<?= $this->input->get('cardid')?>','抵押物费用优惠信息')">
					<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/msgicon%20(5).png"/>
					<div class="title">抵押物费用优惠信息</div>
				</div>

				<div class="shortcut" onclick="Win10_child.openUrl('/index.php/msg/salespromotion?userid=<?php echo $info['id']?>&name=<?php echo $info['name']?>&memberid=<?= $this->input->get('cardid')?>','抵押物优惠信息')">
					<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/msgicon%20(6).png"/>
					<div class="title">抵押物优惠信息</div>
				</div>

				<div class="shortcut" onclick="Win10_child.openUrl('/index.php/msg/warehouse?userid=<?php echo $info['id']?>&name=<?php echo $info['name']?>&memberid=<?= $this->input->get('cardid')?>','抵押物库存信息')">
					<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/msgicon%20(7).png"/>
					<div class="title">抵押物库存信息</div>
				</div>

				<div class="shortcut" onclick="Win10_child.openUrl('/index.php/msg/goodsSalespromotion?userid=<?php echo $info['id']?>&name=<?php echo $info['name']?>&memberid=<?= $this->input->get('cardid')?>','各类价格优惠信息')">
					<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/msgicon%20(8).png"/>
					<div class="title">各类价格优惠信息</div>
				</div>

				<div class="shortcut" onclick="Win10_child.openUrl('/index.php/msg/goodswarehouse?userid=<?php echo $info['id']?>&name=<?php echo $info['name']?>&memberid=<?= $this->input->get('cardid')?>','商品库存信息')">
					<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/msgicon%20(9).png"/>
					<div class="title">商品库存信息</div>
				</div>

				<div class="shortcut" onclick="Win10_child.openUrl('/index.php/msg/raffinateInfo?userid=<?php echo $info['id']?>&name=<?php echo $info['name']?>&memberid=<?= $this->input->get('cardid')?>','残液信息')">
					<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/msgicon%20(10).png"/>
					<div class="title">残液信息</div>
				</div>
				<div class="shortcut" onclick="Win10_child.openUrl('/index.php/msg/inforepair?userid=<?php echo $info['id']?>&name=<?php echo $info['name']?>&memberid=<?= $this->input->get('cardid')?>','维修记录信息')">
					<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/msgicon%20(11).png"/>
					<div class="title">维修记录信息</div>
				</div>
				<div class="shortcut" onclick="Win10_child.openUrl('/index.php/msg/retreatCollateralInfo?userid=<?php echo $info['id']?>&name=<?php echo $info['name']?>&memberid=<?= $this->input->get('cardid')?>','退瓶（物资）信息')">
					<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/msgicon%20(12).png"/>
					<div class="title">退瓶（物资）信息</div>
				</div>
				<div class="shortcut" onclick="Win10_child.openUrl('/index.php/msg/UserSecurityCheckRecord?userid=<?php echo $info['id']?>&name=<?php echo $info['name']?>&memberid=<?= $this->input->get('cardid')?>','安检记录')">
					<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/msgicon%20(12).png"/>
					<div class="title">安检记录</div>
				</div>
				<div class="shortcut" onclick="Win10_child.openUrl('/index.php/msg/UserSnsBindingInfo?userid=<?php echo $info['id']?>&name=<?php echo $info['name']?>&memberid=<?= $this->input->get('cardid')?>','SNS绑定信息')">
					<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/msgicon%20(12).png"/>
					<div class="title">SNS绑定信息</div>
				</div>
				<div class="shortcut" onclick="Win10_child.openUrl('/index.php/msg/UserGoodsArrearsRecord?userid=<?php echo $info['id']?>&name=<?php echo $info['name']?>&memberid=<?= $this->input->get('cardid')?>','欠款信息')">
					<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/msgicon%20(12).png"/>
					<div class="title">欠款信息</div>
				</div>

				<div class="shortcut" onclick="Win10_child.openUrl('/index.php/allocation/UserDepartmentRepairInfo?userid=<?php echo $info['id']?>&name=<?php echo $info['name']?>&memberid=<?= $this->input->get('cardid')?>&endtime=<?=date('Y-m-d')?>','部门维修记录')">
					<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/msgicon%20(12).png"/>
					<div class="title">部门维修记录</div>
				</div>

			</div>

			<div class="layui-tab-item">
				<ul class="layui-timeline">
					<?php foreach (object_array($info['remarkslist']) as $v) {?>
					<li class="layui-timeline-item">
						<i class="layui-icon layui-timeline-axis"></i>
						<div class="layui-timeline-content layui-text">
							<p class="layui-timeline-title"><?= $v['department'] ?>（<?= $v['operator'] ?>）--  <?= $v['addtime'] ?></>
							<h3>
								<?= $v['remarks'] ?>
							</h3>
						</div>
					</li>
					<?php }?>
					<li class="layui-timeline-item">
						<i class="layui-icon layui-timeline-axis"></i>
						<div class="layui-timeline-content layui-text">
							<div class="layui-timeline-title">没有了</div>
						</div>
					</li>
				</ul>
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
			layer.prompt(function(val, index){
				$.ajax({
					url: '/index.php/api/addremarks',
					type: 'post',
					dataType: 'json',
					data: {
						snsuserid: <?= $info['id']?>,
						memberid: <?= $info['memberid']?>,
						remarks: val
					},
					success:function (res) {
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
