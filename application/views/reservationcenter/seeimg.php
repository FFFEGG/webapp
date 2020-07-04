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
	<img v-for="v in imglist"  class="w-64 cursor-pointer" :src="v.fileurl" alt="" @click="seeimgdata(v.fileurl)">
</div>
</body>
<script>
	new Vue({
		el: '#app',
		data() {
			return {
				imglist : []
			}
		},
		methods: {
			seeimgdata (data) {
				Win10_child.openUrl(data,'图片浏览')
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
			axios.post('/index.php/api/FileUrlList', {
				userid: this.getQueryVariable('userid'),
				serial: this.getQueryVariable('serial')
			}).then(rew => {
				this.imglist = rew.data.list
			})
		}
	})
</script>
</html>
