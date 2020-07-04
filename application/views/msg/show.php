<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="<?php echo base_url(); ?>res/js/vue.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
	<link href="<?php echo base_url(); ?>/res/css/tailwind-ui.min.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>res/js/sweetalert2.min.js"></script>
	<script src="<?php echo base_url(); ?>res/js/core.js"></script>
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">
	<title>Document</title>
</head>
<body>
	<div class="container p-6">
		<h2 class="text-center text-xl font-bold"><?= $info['title'] ?></h2>
		<h2 class="text-center text-sm mt-3">发布人:<?= $info['issuer'] ?>  &nbsp;&nbsp;&nbsp;   时间:<?= $info['addtime']?></h2>

		<div class="mt-3">
			<?= $info['content']?>
		</div>
	</div>
</body>
<script>

</script>
</html>
