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
	<title>门店-- 商品物资库存报表</title>
</head>
<body>
<div id="app" class=" p-3">
	<div class="flex">
		<div class="p-2">开始时间</div>
		<input v-model="startime" class="border mx-3 p-2" type="date">
		<div class="p-2">结束时间</div>
		<input v-model="endtime" class="border mx-3 p-2" type="date">


		<div class="p-2">查询方式</div>
		<select name="" id="" class="border mx-3 p-2" v-model="mode">
			<option value="理论">理论</option>
			<option value="记账">记账</option>
		</select>
		<div class="p-2">库存类型</div>
		<select name="" id="" class="border mx-3 p-2" v-model="type">
			<option value="液化气钢瓶">液化气钢瓶</option>
			<option value="桶装水">桶装水</option>
			<option value="销售品">销售品</option>
		</select>
		<button @click="submit" class="p-2 bg-teal-500 text-white px-4">查询</button>
		<button class="p-2 bg-teal-500 text-white px-4 ml-3">记账</button>
		<button class="p-2 bg-teal-500 text-white px-4 ml-3">删除记账</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border">商品</th>

			<th class=" border">类型</th>

			<th class=" border">包装物类型</th>
			<th class=" border">期初库存</th>
			<th class=" border">公司调入</th>
			<th class=" border">公司调出</th>
			<th class=" border">配送员调入</th>
			<th class=" border">配送员调出</th>
			<th class=" border">商品总销售</th>
			<th class=" border">商品分销</th>
			<th class=" border">销售回空</th>
			<th class=" border">收购钢瓶</th>
			<th class=" border">票据</th>
			<th class=" border">退瓶</th>
			<th class=" border">期末库存</th>
		</tr>
		</thead>
		<tbody>
		<template v-for="v in list">


			<tr>
				<td class="border ">{{v.goodsname}}</td>
				<td class="border ">{{v.type}}</td>
				<td class="border ">{{v.packingtype}}</td>

				<td class="border ">{{v.beginstock}}</td>
				<td class="border ">{{v.gsdr}}</td>
				<td class="border ">{{v.gsdc}}</td>
				<td class="border ">{{v.psydr}}</td>
				<td class="border ">{{v.psydc}}</td>
				<td class="border ">{{v.sale}}</td>
				<td class="border ">{{v.consignment}}</td>
				<td class="border ">{{v.returnempty}}</td>
				<td class="border ">{{v.buy}}</td>
				<td class="border ">{{v.bill}}</td>
				<td class="border ">{{v.usertp}}</td>
				<td class="border ">{{v.endstock}}</td>
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
        type: '液化气钢瓶',
        departmentid: '<?= $_SESSION['users']->logindepartmentid?>',
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
        axios.post('/index.php/api/DepartmentGoodsStock', {
          startime: this.startime,
          endtime: this.endtime,
          departmentid: this.departmentid,
          mode: this.mode,
          type: this.type,
        }).then(rew => {
          this.list = rew.data.list
        })
      }
    },
    created () {
      this.endtime = this.getQueryVariable('endtime')
      this.startime = this.getQueryVariable('endtime')
      axios.post('/index.php/api/getInitData').then(rew => {
        this.initData = rew.data.data
      })
    }
  })
</script>
</html>
