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
	<title>部门-- 管理新用户销售报表</title>
</head>
<body>
<div id="app" class=" p-3">
	<div class="flex">
		<div class="w-10/12">
			<div class="flex ">
				<div class="p-2">开户开始时间</div>
				<input v-model="newuserbegintime" class="border mx-3 p-2" type="date">
				<div class="p-2">开户结束时间</div>
				<input v-model="newuserendtime" class="border mx-3 p-2" type="date">


			</div>
			<div class="flex mt-2">

				<div class="p-2">销售开始时间</div>
				<input v-model="salebegintime" class="border mx-3 p-2" type="date">
				<div class="p-2">销售结束时间</div>
				<input v-model="saleendtime" class="border mx-3 p-2" type="date">

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
					<th class=" border">业务员</th>
					<th class=" border">液化气45KG数量</th>
					<th class=" border">液化气45KG折吨</th>
					<th class=" border">液化气12G数量</th>
					<th class=" border">液化气12KG折吨</th>
					<th class=" border">液化气4KG数量</th>
					<th class=" border">液化气4KG折吨</th>
					<th class=" border">液化气1.9KG数量</th>
					<th class=" border">液化气1.9KG折吨</th>
					<th class=" border">丙烷45KG数量</th>
					<th class=" border">丙烷45KG折吨</th>
					<th class=" border">丙烷14KG数量</th>
					<th class=" border">丙烷14KG折吨</th>
					<th class=" border">丙烷28KG数量</th>
					<th class=" border">丙烷28KG折吨</th>
					<th class=" border">丁烷49KG数量</th>
					<th class=" border">丁烷49KG折吨</th>
					<th class=" border">残液量</th>
					<th class=" border">实际销量</th>
				</tr>
				</thead>
				<tbody>
				<template v-for="v in list">
					<tr>
						<td class="border ">{{v.memberid}}</td>
						<td class="border ">{{v.salesman}}</td>
						<td class="border ">{{v.YHQ45KGSL}}</td>
						<td class="border ">{{v.YHQ45KGCZL}}</td>
						<td class="border ">{{v.YHQ12KGSL}}</td>
						<td class="border ">{{v.YHQ12KGCZL}}</td>
						<td class="border ">{{v.YHQ4KGSL}}</td>
						<td class="border ">{{v.YHQ4KGCZL}}</td>
						<td class="border ">{{v.YHQ1_9KGSL}}</td>
						<td class="border ">{{v.YHQ1_9KGCZL}}</td>
						<td class="border ">{{v.BW45KGSL}}</td>
						<td class="border ">{{v.BW45KGCZL}}</td>
						<td class="border ">{{v.BW14KGSL}}</td>
						<td class="border ">{{v.BW14KGCZL}}</td>
						<td class="border ">{{v.BW28KGSL}}</td>
						<td class="border ">{{v.BW28KGCZL}}</td>
						<td class="border ">{{v.DW49KGSL}}</td>
						<td class="border ">{{v.DW49KGCZL}}</td>
						<td class="border ">{{v.raffinate}}</td>
						<td class="border ">{{v.xl}}</td>
					</tr>
				</template>
				</tbody>
			</table>
		</div>
		<div class="w-2/12 pl-3">
			<div class="p-2">业务员</div>
				<div v-for="(v,k) in ywy">
					<label class="p-2 w-full text-xl" :for="'salesman_' + k" >
						<input v-model="v.ischeck" @click="" :id="'salesman_' + k" type="checkbox" :value="v.name">
						<span>{{ v.name }}</span>
					</label>
				</div>
		</div>
	</div>




</div>
</body>
<script>

  new Vue({
    el: '#app',
    computed: {
      salesmane () {
        var arr = []
        for (let i = 0; i < this.ywy.length; i++) {
          if (this.ywy[i].ischeck) {
            arr = arr.concat(this.ywy[i].name)
          }
        }
        return arr
      }
    },
    data () {
      return {
        list: [],
        ywy: [],
        newuserendtime: '',
        saleendtime: '',
        initData: '',
        type: '正常支付',
        newuserbegintime: '2010-01-01',
        salebegintime: '2010-01-01'
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
        axios.post('/index.php/api/CommercialSalesmanNewUserSale', {
          newuserbegintime: this.newuserbegintime,
          newuserendtime: this.newuserendtime,
          salebegintime: this.salebegintime,
          saleendtime: this.saleendtime,
          salesman: this.salesmane,
          type: this.type,
        }).then(rew => {
          this.list = rew.data.list
        })
      }
    },
    created () {
      this.saleendtime = this.getQueryVariable('endtime')
      this.newuserendtime = this.getQueryVariable('endtime')
      axios.post('/index.php/api/getInitData').then(rew => {
        this.initData = rew.data.data
        this.ywy = rew.data.ywy
      })

      axios.post('/index.php/api/getXsYwy').then(rew => {

      })
    }
  })
</script>
</html>
