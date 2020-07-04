<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>退物资</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>

</head>
<body>

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
	<legend>会员<?= $this->input->get('memberid') ?> - <?php echo $this->input->get('name'); ?>退抵押物物资</legend>
</fieldset>
<div class="oapd">


	<?php echo form_open('', 'class="layui-form" id="tdywform"'); ?>
	<input type="hidden" name="userid" value="<?= $this->input->get('userid') ?>">
	<input type="hidden" name="memberid" value="<?= $this->input->get('memberid') ?>">
	<input type="hidden" name="name" value="<?= $this->input->get('name') ?>">

	<div class="layui-form-item">
		<label class="layui-form-label">抵押物记录</label>
		<div class="layui-input-block">
			<table class="layui-table" lay-even="" lay-skin="row">
				<thead>
				<tr>
					<th>选择</th>
					<th>办理时间</th>
					<th>商品名称</th>
					<th>包装物</th>
					<th>价格</th>
					<th>数量</th>
					<th>票据号</th>
					<th>办理方式</th>
					<th>状态</th>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($warehouse as $v) {
					if (($v['state'] == 1 || $v['state'] == 8) && ($v['mode'] == '抵押物押金' || $v['mode'] == '抵押物借用')) { ?>

						<tr>

							<td>
								<input id="dywgoods_<?= $v['id'] ?>" type="radio" name="id"
									   value="<?= $v['id'] . '|' . $v['packingtype'] ?>">
							</td>
							<td><?= $v['addtime'] ?></td>
							<td><?= $v['name'] ?></td>
							<td><?= $v['packingtype'] ?></td>
							<td><?= $v['price'] ?></td>
							<td><?= $v['num'] ?></td>
							<td><?= $v['billno'] ?></td>
							<td><?= $v['mode'] ?></td>
							<td><?= getstate($v['state']) ?></td>
						</tr>
					<?php }
				} ?>
				</tbody>
			</table>


		</div>
	</div>


	<div class="layui-form-item">
		<label class="layui-form-label">钢瓶条码
		</label>
		<div class="layui-input-block">
			<input type="text" name="code" lay-verify="required" autocomplete="off" placeholder="钢瓶条码"
				   class="layui-input">
		</div>
	</div>


	<div class="layui-form-item">
		<div class="layui-input-block">

			<button type="submit" class="layui-btn" lay-submit="" lay-filter="gpsg">确认办理</button>
		</div>
	</div>
	</form>

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
			, $ = layui.$; //重点处
		//监听提交
		form.on('submit(gpsg)', function (data) {
			if (!data.field.id) {
				layer.msg('请选择抵押物');
				return false;
			}
			if (!data.field.code) {
				layer.msg('请填写钢瓶条码');
				return false;
			}
			layer.open({
				type: 1
				,
				title: false //不显示标题栏
				,
				closeBtn: false
				,
				area: '400px;'
				,
				shade: 0.8
				,
				id: 'LAY_layuipro' //设定一个id，防止重复弹出
				,
				btn: ['确认', '取消']
				,
				btnAlign: 'c'
				,
				moveType: 1 //拖拽模式，0或者1
				,
				content: '<div  style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">' +
					'<h3>信息确认</h3>' +
					'<p>抵押物:' + data.field.id + '</p>' +
					'<p>钢瓶条码:' + data.field.code + '</p>' +
					'</div>'
				,
				yes: function () {
					$('#tdywform').submit();
				}
				,
				btn2: function () {
					layer.closeAll();
				}

			});

			return false;
		});
	});


</script>
<?php if (get_cookie('mortgagedgoods')) { ?>
	<script>
		layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
			var form = layui.form
				, layer = layui.layer
				, layedit = layui.layedit
				, laydate = layui.laydate
				, element = layui.element
				, $ = layui.$; //重点处
			layer.msg('退抵押物物资成功！');
			return false
		});
	</script>
<?php } ?>
<?php if (get_cookie('errormortgagedgoods')) { ?>
	<script>
		layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
			var form = layui.form
				, layer = layui.layer
				, layedit = layui.layedit
				, laydate = layui.laydate
				, element = layui.element
				, $ = layui.$; //重点处
			layer.msg('无该钢瓶条码！');
			return false
		});
	</script>
<?php } ?>


<?php if (get_cookie('printinfo')) { ?>
	<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
	<script>
      const data = <?= get_cookie('printinfo') ?>;

      if (data.type == '退抵押物物资单') {

        var jsonp = {
          title: "南宁三燃公司退抵押物物资单",
          time: data.topinfo,
          memberid: "卡号 " + data.memberid,
          name: "姓名 " + data.name,
          tel: "电话 " + data.telephone,
          address: "地址 " + data.address,
          department: data.department,
          Memo1: data.zcode + data.other,
          Memo2: '注，本单据自填制日起两个月内有效。',
          Memo3: '经办人: ' + data.operator,
          Memo4: '',
          Memo5: '',
        }
        var data_infop = {
          PrintData: jsonp,
          Print: true
        }
        axios.get('http://127.0.0.1:8000/api/print/order/5/?data=' + JSON.stringify(data_infop)).then(rew => {
          console.log(rew)
        })
      }
	</script>
<?php } ?>
</html>
