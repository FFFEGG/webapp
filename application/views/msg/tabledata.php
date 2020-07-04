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
<div id="app" class="p-6">
	<table class="table-auto mt-6 w-full">
		<thead>
		<tr>
			<th v-for="v in list.title" class=" border">{{v}}</th>

		</tr>
		</thead>
		<tbody>
		<template v-for="v in list.info">
			<tr class="text-center">
				<td v-for="vi in list.key" class="border ">{{ v[vi] }}</td>
			</tr>
		</template>
		</tbody>
	</table>


	<p class="mt-4 text-2xl">合计: {{ ztotal }} 数量 ： {{ znum }}</p>
</div>
</body>
<script>
	new Vue({
		el: '#app',
		computed: {
			ztotal() {
				var num = 0
				for (let i = 0; i < this.list.info.length; i++) {
					num += Number(this.list.info[i].total ? this.list.info[i].total : 0)
				}
				return num
			},
			znum() {
				var num = 0
				for (let i = 0; i < this.list.info.length; i++) {
					num += Number(this.list.info[i].num ? this.list.info[i].num : 0)
				}
				return num
			}
		},
		data() {
			return {
				list: ''
			}
		},
		created() {
			this.list = JSON.parse(localStorage.getItem('tabledata'))
		}
	})
</script>
</html>
