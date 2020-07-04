<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>门店报表</title>
	<script src="<?php echo base_url(); ?>res/js/win10.child.js"></script>
	<script src="<?php echo base_url(); ?>res/js/vue.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>res/mydatepick/mydate.js" charset="utf-8"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>res/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>res/mydatepick/mydate.css">
	<script src="<?php echo base_url(); ?>res/js/sweetalert2.min.js"></script>
	<script src="<?php echo base_url(); ?>res/js/core.js"></script>
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
<div class="p-4">
	<div class="row py-3">
		<form action="" method="get">
			<div>&nbsp;&nbsp;&nbsp;&nbsp;时间
				<input name="begintime" value="<?= $this->input->get('begintime') ? $this->input->get('begintime') : '2010-01-01' ?>" type="date">
				-
				<input name="endtime" value="<?= $this->input->get('endtime') ? $this->input->get('endtime') : date('Y-m-d') ?>"  type="date">
				<select name="type" id="">
					<option <?php if ($this->input->get('type') == '液化气钢瓶') { echo 'selected';}?> value="液化气钢瓶">液化气钢瓶</option>
					<option <?php if ($this->input->get('type') == '桶装水') { echo 'selected';}?> value="桶装水">桶装水</option>
					<option <?php if ($this->input->get('type') == '销售品') { echo 'selected';}?> value="销售品">销售品</option>
				</select>
				<button>搜索</button>
			</div>
		</form>


	</div>
	<table class="table table-bordered table-sm" style="width: 100%">
		<thead>
		<tr>
			<th scope="col">类型</th>
			<th scope="col">包装物类型</th>
			<th scope="col">期初库存</th>
			<th scope="col">公司调入</th>
			<th scope="col">公司调出</th>
			<th scope="col">配送员调入</th>
			<th scope="col">配送员调出</th>
			<th scope="col">商品总销售</th>
			<th scope="col">商品分销</th>
			<th scope="col">销售回空</th>
			<th scope="col">收购钢瓶</th>
			<th scope="col">票据</th>
			<th scope="col">退瓶</th>
			<th scope="col">期末库存</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<th rowspan="4">重瓶</th>
			<td>12kg</td>
			<td>Otto</td>
			<td>Otto</td>
			<td>Otto</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>

		</tr>
		<tr>
			<td>4kg</td>
			<td>Thornton</td>
			<td>Thornton</td>
			<td>Thornton</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
		</tr>
		<tr>

			<td>45kg</td>
			<td>Larry the Bird</td>
			<td>Larry the Bird</td>
			<td>Larry the Bird</td>

			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
		</tr>
		<tr>
			<td>2kg</td>
			<td>Larry the Bird</td>
			<td>Larry the Bird</td>
			<td>Larry the Bird</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
		</tr>
		<tr>
			<th rowspan="4">空瓶</th>
			<td>12kg</td>
			<td>Otto</td>
			<td>Otto</td>
			<td>Otto</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
		</tr>
		<tr>
			<td>4kg</td>
			<td>Thornton</td>
			<td>Thornton</td>
			<td>Thornton</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
		</tr>
		<tr>

			<td>45kg</td>
			<td>Larry the Bird</td>
			<td>Larry the Bird</td>
			<td>Larry the Bird</td>

			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
		</tr>
		<tr>
			<td>2kg</td>
			<td>Larry the Bird</td>
			<td>Larry the Bird</td>
			<td>Larry the Bird</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
			<td>@mdo</td>
		</tr>
		</tbody>
	</table>
</div>
</body>
</html>
