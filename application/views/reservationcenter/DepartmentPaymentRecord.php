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
	<title>部门缴款记录</title>
</head>
<body>
<div id="app" class="p-3">
	<div class="flex">
		<div class="p-2">开始时间</div>
		<input v-model="startime" class="border mx-3 p-2" type="date">
		<div class="p-2">结束时间</div>
		<input v-model="endtime" class="border mx-3 p-2" type="date">

		<div class="p-2">	时间类型</div>
		<select name="" id="" class="border mx-3 p-2" v-model="timetype">
			<option value="录入时间">录入时间</option>
			<option value="缴款时间">缴款时间</option>
			<option value="收款时间">收款时间</option>
		</select>

		<button @click="submit" class="p-2 bg-teal-500 text-white px-4">查询</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border">录入时间</th>
			<th class=" border">收款时间</th>

			<th class=" border">缴款时间</th>

			<th class=" border">单据号</th>
			<th class=" border">项目</th>
			<th class=" border">合计金额</th>
			<th class=" border">银行</th>
			<th class=" border">部门</th>
			<th class=" border">录入人</th>
			<th class=" border">取消部门</th>
			<th class=" border">取消人</th>
			<th class=" border">取消时间</th>
			<th class=" border">状态</th>
			<th class=" border">操作</th>

		</tr>
		</thead>
		<tbody>
		<template v-for="v in list">


			<tr>
				<td class="border ">{{v.addtime}}</td>
				<td class="border ">{{v.receivablestime}}</td>
				<td class="border ">{{v.paymentyime}}</td>
				<td class="border ">{{v.serial}}</td>
				<td class="border ">{{v.project}}</td>
				<td class="border ">{{v.total}}</td>
				<td class="border ">{{v.bank}}</td>
				<td class="border ">{{v.department}}</td>
				<td class="border ">{{v.operator}}</td>
				<td class="border ">{{v.revoke_department}}</td>
				<td class="border ">{{v.revokeer}}</td>
				<td class="border ">{{v.revoketime}}</td>
				<td class="border ">{{v.state}}</td>
				<td class="border ">
					<button @click="cancle(v)" class="bg-teal-500 text-white p-2">取消</button>
				</td>
			</tr>

		</template>
		</tbody>
	</table>
</div>
</body>
<script>

  new Vue({
    el: '#app',
    data () {
      return {
        list: [],
        initData: '',
        endtime: '<?= date('Y-m-d')?>',
        timetype: '录入时间',
        startime: '<?= date('Y-m-d')?>'
      }
    },
    methods: {
      cancle (data) {
        let that = this;
        swal({
          title: '确定取消？',
          text: '',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          confirmButtonClass: 'btn btn-success',
          cancelButtonClass: 'btn btn-danger',
        }).then(function (dismiss) {
          if (dismiss.value) {
            axios.post('/index.php/api/CancelDepartmentPayment', {
        		info: data
            }).then(rew => {
              if (rew.data.code == 200) {
                swal('取消成功')
              } else {
                swal('取消失败')
              }
              that.submit()
            })
          }
        })
	  },
      getQueryVariable (variable) {
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
      submit () {
        axios.post('/index.php/api/DepartmentPaymentRecord', {
          begintime: this.startime,
          endtime: this.endtime,
          timetype: this.timetype,
        }).then(rew => {
          this.list = rew.data.list
        })
      }
    },
    created () {

      axios.post('/index.php/api/getInitData').then(rew => {
        this.initData = rew.data.data
      })
    }
  })
</script>
</html>
