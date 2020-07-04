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
<div class="container pt-4">
	<div class="row py-3">
		<div class="col">站点：鲤湾店</div>
		<div class="col">品名:气/钢瓶</div>
		<div class="col">统计日期：2019-11-01至2019-11-30</div>
	</div>
	<table class="table table-bordered">
		<thead>
		<tr>
			<th scope="col">规格</th>
			<th scope="col">规格</th>
			<th scope="col">上期结存数量</th>
			<th scope="col">储灌调入数量</th>
			<th scope="col">收购钢瓶数量</th>
			<th scope="col">销售收回钢瓶数量</th>
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
		</tr>
		<tr>
			<td>4kg</td>
			<td>Thornton</td>
			<td>Thornton</td>
			<td>Thornton</td>
			<td>@fat</td>
		</tr>
		<tr>

			<td>45kg</td>
			<td>Larry the Bird</td>
			<td>Larry the Bird</td>
			<td>Larry the Bird</td>

			<td>@twitter</td>
		</tr>
		<tr>
			<td>2kg</td>
			<td>Larry the Bird</td>
			<td>Larry the Bird</td>
			<td>Larry the Bird</td>
			<td>@twitter</td>
		</tr>
		<tr>
			<th rowspan="4">空瓶</th>
			<td>12kg</td>
			<td>Otto</td>
			<td>Otto</td>
			<td>Otto</td>
			<td>@mdo</td>
		</tr>
		<tr>
			<td>4kg</td>
			<td>Thornton</td>
			<td>Thornton</td>
			<td>Thornton</td>
			<td>@fat</td>
		</tr>
		<tr>

			<td>45kg</td>
			<td>Larry the Bird</td>
			<td>Larry the Bird</td>
			<td>Larry the Bird</td>

			<td>@twitter</td>
		</tr>
		<tr>
			<td>2kg</td>
			<td>Larry the Bird</td>
			<td>Larry the Bird</td>
			<td>Larry the Bird</td>
			<td>@twitter</td>
		</tr>
		</tbody>
	</table>
</div>
</body>
</html>
