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
	<script src="<?php echo base_url(); ?>res/js/win10.child.js"></script>
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">
	<title>容检物资流转录入（运输公司代录）</title>
</head>
<body>
<div id="app" class="p-6">
	<div class="flex">
		<p class="p-2 border-2 border-r-0 rounded-l">方式</p>
		<select class="p-2 border-2 rounded-r"  name="" id="" v-model="mode">
			<option value="新购调入">新购调入</option>
			<option value="调出容检">调出容检</option>
		</select>
		<p class="p-2 border-2 border-r-0 rounded-l ml-3">包装物类型</p>
		<select class="p-2 border-2 rounded-r"  name="" id="" v-model="packingtype">
			<option value="">选择包装物类型</option>
			<option value="调出容检">调出容检</option>
		</select>
		<input type="num" class="p-2 border-2 rounded ml-3" v-model="num" placeholder="数量">
		<p class="p-2 border-2 border-r-0 rounded-l ml-3">结束时间</p>
		<input class="p-2 border-2 rounded-r" type="date" v-model="endtime">
		<button @click="submit" class="p-1 px-5 mx-5 bg-teal-500 text-white rounded">搜索</button>
	</div>
</div>
</body>
<script>
	new Vue({
		el: '#app',
		data() {
			return {

				mode: '新购调入',
				packingtype: '',
				num: '',
				remarks: '',
				department: ''
			}
		},
		methods: {
			submit() {
				axios.post('/index.php/api/ReprintCodeRecord', {
					begintime: this.begintime,
					endtime: this.endtime,
				}).then(rew => {
					console.log(rew.data)
				})
			},
			getQueryVariable(variable) {
				var query = window.location.search.substring(1)
				var vars = query.split('&')
				for (var i = 0; i < vars.length; i++) {
					var pair = vars[i].split('=')
					if (pair[0] == variable) {
						return pair[1]
					}
				}
				return ''
			}
		},
		created() {
			 
		}
	})
</script>
</html>
