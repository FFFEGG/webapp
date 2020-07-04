<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	<div style="margin-top: 10px">
		<p>id: <?= $project['id']?></p>
		<p>订单号: <?= $project['serial']?></p>
		<p>时间: <?= $project['addtime']?></p>
		<?php foreach ($project['projectlist'] as $ki=>$vi) { ?>
			<span style="font-weight: bold;margin-right: 20px;">项目<?= $ki+1 ?>：<?= $vi->project ?> <?= $vi->result ?></span>
			<br>
		<?php } ?>
	</div>
</body>
</html>
