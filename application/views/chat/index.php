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
	<title></title>
</head>
<body>
<div id="app" class="p-6">
	<div v-for="v in list">
		<div class="flex mb-3"  v-if="v.isme == false">
			<div class="w-10 mr-3">
				<img :src="v.avatar" alt="" class="rounded-full w-10 h-10">
			</div>
			<div class="w-8/12">
				<p>{{v.name }}   {{ v.time }}</p>
				<p class="bg-gray-100 rounded p-3">
					{{ v.content }}
					<img :src="v.img" alt="">
				</p>
			</div>
		</div>
		<div class="flex mb-3 text-right"  v-else>

			<div class="w-10/12">
				<p>{{v.name }}   {{ v.time }}</p>
				<p class=" rounded p-3 text-white" style="background: #5FB878">
					{{ v.content }}
					<img class="w-full" :src="v.img" alt="">
				</p>
			</div>
			<div class="w-10 ml-3">
				<img :src="v.avatar" alt="" class="rounded-full w-10 h-10">
			</div>

		</div>
	</div>
</div>
</body>
<script>
	new Vue({
		el: '#app',
		data() {
			return {
				id: '',
				list: []
			}
		},
		methods: {

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
			},
			getchatmsg () {
				axios.post('http://chat.sanrangas.com/getchatmsgbyseatno',{
					id: this.id,
					seatno: '<?= get_cookie('seatno')?>'
				}).then(rew=>{
					this.list = rew.data.data
				})
			}
		},
		created() {
			this.id = this.getQueryVariable('id')
			this.getchatmsg()
		}
	})
</script>
</html>
