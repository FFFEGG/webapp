<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>会员充值</title>
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
		<form action="" method="get" class="search">
			<span style="font-weight: bold;font-size: 20px">搜索用户卡号：</span>

			<div class="layui-inline">
				<input class="layui-input cardid" name="cardid" id="add_demoReload"
					   value="<?php echo $info['cardid']; ?>"
					   autocomplete="off">
			</div>
			<button class="layui-btn" type="submit" data-type="reload">搜索</button>
		</form>
	</div>

	<div class="layui-form layui-form-pane">
		<input type="hidden" class="memberid" name="memberid" value="<?php echo $info['cardid']; ?>">
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
			</div>

		</div>
	</div>
	<input type="hidden" class="userid" value="<?= $info['id'] ?>">
	<div action="" method="post" class="layui-form layui-form-pane">
		<div class="layui-form-item">
			<label class="layui-form-label">充值金额</label>
			<div class="layui-input-block">
				<input type="number" value="" autocomplete="off"
					   class="layui-input recharge_price">
			</div>
		</div>

		<button class="layui-btn recharge" type="button">确认充值</button>
	</div>


</div>
<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>/res/layui/layui.js" charset="utf-8"></script>
<script>
  layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
    var form = layui.form
      , layer = layui.layer
      , layedit = layui.layedit
      , laydate = layui.laydate
      , element = layui.element
      , $ = layui.$
    $('.recharge').click(function () {
      var price = $('.recharge_price').val()
      var cardid = $('.memberid').val()
      var userid = $('.userid').val()

      if (!cardid) {
        layer.msg('请输入卡号')
        return false
      }
      if (!price) {
        layer.msg('请填写充值金额')
        return false
      }
      $.ajax({
        url: '/index.php/api/recharge',
        type: 'POST',//方法类型
        dataType: 'json',//预期服务器返回的数据类型
        data: {
          total: price,
          userid: userid,
          memberid: cardid
        },
        success: function (res) {
          if (res.code == 200) {
            layer.msg('充值成功')
            var data = res.printinfo
            var jsonp = {
              title: '南宁三燃公司会员充值订单',
              time: data.topinfo,
              memberid: '卡号 ' + data.memberid,
              name: '姓名 ' + data.name,
              Memo1: '原存款：' + (Number(data.balance) - Number(data.pay_cash)),
              Memo2: '充值：' + Number(data.pay_cash),
              Memo3: '账户余额：' + Number(data.balance),
              Memo4: '操作员: ' + data.operator,
              Memo5: '用户签名：'
            }
            var data_infop = {
              PrintData: jsonp,
              Print: true
            }
            axios.get('http://127.0.0.1:8000/api/print/order/7/?data=' + JSON.stringify(data_infop)).then(rew => {
              console.log(rew)
            })
            $('.recharge_price').val('')
            setTimeout(function () {
              $('.search').submit()
            }, 1500)

          } else {
            layer.msg('充值失败')
          }
        }
      })

    })
  })
</script>

</body>
</html>
