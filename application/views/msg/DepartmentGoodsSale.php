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
	<title>门店-- 商品物资销售报表</title>
</head>
<body>
<div id="app" class=" p-3">
	<div class="flex">
		<div class="p-2">开始时间</div>
		<input v-model="startime" class="border mx-3 p-2" type="date">
		<div class="p-2">结束时间</div>
		<input v-model="endtime" class="border mx-3 p-2" type="date">
		<div class="p-2">部门</div>
		<select name="" id="" class="border mx-3 p-2" v-model="departmentid">
			<option value="全部">全部</option>
			<option v-for="v in initData.Department.info" :value="v.id">{{v.name}}</option>
		</select>
		<div class="p-2">查询方式</div>
		<select name="" id="" class="border mx-3 p-2" v-model="mode">
			<option value="理论">理论</option>
			<option value="记账">记账</option>
		</select>

		<button @click="submit" class="p-2 bg-teal-500 text-white px-4">查询</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border">门店</th>
			<th class=" border">方式</th>

			<th class=" border">品牌</th>

			<th class=" border">商品类型</th>
			<th class=" border">商品名称</th>
			<th class=" border">数量</th>
			<th class=" border">余额支付</th>
			<th class=" border">现金支付</th>
			<th class=" border">微信支付</th>
			<th class=" border">支付宝支付</th>
			<th class=" border">月结支付</th>
			<th class=" border">混合支付</th>
			<th class=" border">库存款支付</th>
			<th class=" border">小计</th>

		</tr>
		</thead>
		<tbody>
		<template v-for="v in list">


			<tr>
				<td class="border ">{{v.department}}</td>
				<td class="border ">{{v.mode}}</td>
				<td class="border ">{{v.brand}}</td>
				<td class="border ">{{v.goodstype}}</td>
				<td class="border ">{{v.goodsname}}</td>
				<td class="border ">{{v.num}}</td>
				<td class="border ">{{v.pay_balance}}</td>
				<td class="border ">{{v.pay_cash}}</td>
				<td class="border ">{{v.pay_weixin}}</td>
				<td class="border ">{{v.pay_alipay}}</td>
				<td class="border ">{{v.pay_arrears}}</td>
				<td class="border ">{{v.pay_blend}}</td>
				<td class="border ">{{v.pay_stock}}</td>
				<td class="border ">{{v.total}}</td>

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
        endtime: '',
        mode: '理论',
        departmentid: 1,
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
        axios.post('/index.php/api/DepartmentGoodsSale', {
          startime: this.startime,
          endtime: this.endtime,
          departmentid: this.departmentid,
          mode: this.mode,
        }).then(rew => {
          this.list = rew.data.list
        })
      }
    },
    created () {
      this.endtime = this.getQueryVariable('endtime')
      axios.post('/index.php/api/getInitData').then(rew => {
        this.initData = rew.data.data
      })
    }
  })
</script>
</html>
