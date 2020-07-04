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
	<title>同组区域</title>
</head>
<body>
<div id="app" class=" p-3">


	<table class="table-auto  w-full text-xs">
		<thead>
		<tr>
			<th class=" border">选择</th>
			<th class=" border">姓名</th>
			<th class=" border">现工作门店</th>




		</tr>
		</thead>
		<tbody>
		<template v-for="v in list">


			<tr>
				<td  class=" border text-center">
					<input v-model="v.ischeck" type="checkbox" class="w-5 h-5">
				</td>
				<td class="border ">
					{{v.name}}
				</td>
				<td class="border ">{{v.workdepartment}}</td>

			</tr>

		</template>
		</tbody>
	</table>
	<div class="flex mt-6">
		<button @click="ap" class="p-2 bg-teal-500 text-white px-4">确认分配</button>
	</div>
</div>
</body>
<script>

  new Vue({
    el: '#app',
    data () {
      return {
        list: [],
        initData: '',
        endtime: '',
        startime: '2010-01-01'
      }
    },
	computed : {
      deliverylist () {
        var arr = []
        for (let i = 0; i < this.list.length; i++) {
		  if (this.list[i].ischeck == true) {
		    arr = arr.concat(this.list[i].name)
		  }
        }
        return arr
	  }
	},
    methods: {
      ap () {
        axios.post('/index.php/api/SubmissionWorkDeliverymanList',{
          deliverylist: this.deliverylist
		}).then(rew=>{
		  if (rew.data.code == 200) {
		    swal('安排成功')
		  } else {
            swal('安排失败')
		  }
		  this.submit()
		})
	  },
      submit () {
        axios.post('/index.php/api/AreaDeliverymanList').then(rew => {
          this.list = rew.data.list
          for (let i = 0; i < this.list.length; i++) {
			this.list[i].ischeck = false
          }
        })
      }
    },
    created () {
      this.submit()
    }
  })
</script>
</html>
