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
	<title>部门-- 管理用户销售报表</title>
</head>
<body>
<div id="app" class=" p-3">
	<div class="flex">
		<div class="p-2">开始时间</div>
		<input v-model="startime" class="border mx-3 p-2" type="date">
		<div class="p-2">结束时间</div>
		<input v-model="endtime" class="border mx-3 p-2" type="date">
		<div class="p-2">业务员</div>
		<select name="" id="" class="border mx-3 p-2" v-model="salesman">

			<option v-for="v in ywy" :value="v.name">{{v.name}}</option>
		</select>
		<div class="p-2">查询方式</div>
		<select name="" id="" class="border mx-3 p-2" v-model="type">
			<option value="正常支付">正常支付</option>
			<option value="月结支付">月结支付</option>
		</select>

		<button @click="submit" class="p-2 bg-teal-500 text-white px-4">查询</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border">商品名称</th>
			<th class=" border">单价</th>

			<th class=" border">优惠</th>

			<th class=" border">数量</th>
			<th class=" border">合计金额</th>
			<th class=" border">方式</th>
			<th class=" border">配送员</th>
			<th class=" border">配送部门</th>


		</tr>
		</thead>
		<tbody>
		<template v-for="v in list">


			<tr>
				<td class="border ">{{v.goodsname}}</td>
				<td class="border ">{{v.price}}</td>
				<td class="border ">{{v.sale}}</td>
				<td class="border ">{{v.num}}</td>
				<td class="border ">{{v.total}}</td>
				<td class="border ">{{v.payment}}</td>
				<td class="border ">{{v.salesmansalesman}}</td>
				<td class="border ">{{v.department}}</td>
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
        ywy: [],
        initData: '',
        endtime: '',
        type: '正常支付',
        salesman: '',
        startime: '2010-01-01'
      }
    },
    methods: {
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
        axios.post('/index.php/api/CommercialManageSale', {
          startime: this.startime,
          endtime: this.endtime,
          type: this.type,
          salesman: this.salesman,
        }).then(rew => {
          this.list = rew.data.list
        })
      }
    },
    created () {
      this.endtime = this.getQueryVariable('endtime')
      axios.post('/index.php/api/getInitData').then(rew => {
        this.initData = rew.data.data
        this.ywy = rew.data.ywy
      })
    }
  })
</script>
</html>
