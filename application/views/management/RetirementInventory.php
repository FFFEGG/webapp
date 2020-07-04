<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>商品库存信息</title>
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
	<blockquote class="layui-elem-quote layui-text" style="font-weight: bold;font-size: 20px;color: #222;">
		用户<?= $this->input->get('memberid') ?>- <?php echo $name; ?> 商品库存信息
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
						   value="<?= $this->input->get('begintime') ? $this->input->get('begintime') : '2010-01-01' ?>"
						   placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
				</div>
				<div class="layui-form-mid">-</div>
				<div class="layui-input-inline">
					<input type="text" name="endtime" id="endtime" lay-verify="date"
						   value="<?= $this->input->get('endtime') ? $this->input->get('endtime') : date('Y-m-d') ?>"
						   placeholder="yyyy-MM-dd" autocomplete="off"
						   class="layui-input">
				</div>

				<button class="layui-btn" type="submit">查询</button>
			</div>
		</form>

	</div>
	<div class="layui-form">
		<table class="layui-table" lay-size="sm">
			<thead>
			<tr>
				<?php foreach ($title as $v) { ?>
					<th><?= $v ?></th>
				<?php } ?>
				<th>退款总金额</th>
				<th>操作</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($list as $v) { ?>
				<tr>
				<?php if ($v->state == 1 && $v->num > 0) { ?>
					<?php foreach ($key as $vo) { ?>
						<?php if ($vo == 'state') { ?>
							<td><?= getstate($v->$vo) ?></td>
						<?php } elseif ($vo == 'goodsid') { ?>
							<td><?= getoneGoodsById($v->$vo)['name'] ?></td>
						<?php } else { ?>
							<td><?= $v->$vo ?></td>
						<?php } ?>
					<?php } ?>
					<td style="font-weight: bold;color: red;font-size: 15px"><?= $v->price * $v->num ?></td>
					<td><button onclick="tkc('<?= Myencode($v)?>')" class="layui-btn layui-btn-sm">退库存</button></td>
				<?php } ?>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
</body>
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
    //日期
    laydate.render({
      elem: '#begintime'
    })
    laydate.render({
      elem: '#endtime'
    })

  })
	function tkc (data) {
      if (confirm('确认操作？')) {
        $.ajax({
          url:'/index.php/api/RetirementInventory',
          method: 'post',
          dataType: 'json',
          data: {
            info: data,
			memberid: '<?= $this->input->get('memberid')?>'
          },
          success:function (rew) {
            if (rew.code == 200) {
              var data = rew.printinfo
              var jsonp = {
                title: '南宁三燃公司会员退指标订单',
                time: data.topinfo,
                memberid: '卡号 ' + data.memberid,
                name: '姓名 ' + data.name,
                Memo1: '退指标款：' + Number(data.pay_cash),
                Memo2: 	data.goods,
                Memo3: '账户余额：' + Number(data.balance),
                Memo4: '操作员: ' + data.operator,
                Memo5: '用户签名：'
              }
              var data_infop = {
                PrintData: jsonp,
                Print: true
              }
              axios.get('http://127.0.0.1:8000/api/print/order/8/?data=' + JSON.stringify(data_infop)).then(rew => {
                console.log(rew)
              })
              alert('操作成功')
              $('form').submit()
            }
          }
        })
      }
	}
</script>

</html>
