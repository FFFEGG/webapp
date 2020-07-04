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
	<title>门店可取消记录</title>
</head>
<body>
<div id="app" class=" p-3">
	<div class="flex">

		<div class="p-2">业务类型</div>
		<select name="" id="" class="border mx-3 p-2" v-model="type">
			<option value="安检业务">安检业务</option>
			<option value="办理促销方案业务">办理促销方案业务</option>
			<option value="业务气业务">业务气业务</option>
			<option value="职工气业务">职工气业务</option>
			<option value="收购钢瓶业务">收购钢瓶业务</option>
			<option value="抵押物业务">抵押物业务</option>
			<option value="运回用户钢瓶">运回用户钢瓶</option>
			<option value="商品直售">商品直售</option>
			<option value="会员充值">会员充值</option>
			<option value="办理预缴费用">办理预缴费用</option>
		</select>
		<button @click="submit" class="p-2 bg-teal-500 text-white px-4">查询</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th v-for="v in data.title" class=" border">{{ v }}</th>
			<th v-if="data.info"  class=" border">操作</th>
		</tr>
		</thead>
		<tbody>
		<template v-for="v in data.info">


			<tr >
				<td v-for="(vi,k) in v" class="border ">
					{{vi}}
				</td>
				<td v-if="data.info" class="border ">
					<button @click="DepartmentCancelBusiness(v)" class="p-3 py-2 bg-teal-500 text-white mx-auto">取消</button>
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
        data: [],
        type: '安检业务'
      }
    },
    methods: {
      DepartmentCancelBusiness (data) {
        if (confirm('确认操作？')) {
          var data = data
          data.type = this.type
          axios.post('/index.php/api/DepartmentCancelBusiness', data).then(rew => {
            if (rew.data.code == 200) {
              swal('取消成功')
              this.submit()
            } else {
              swal('操作失败')
            }
          })
		}
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
        axios.post('/index.php/api/DepartmentCanCancelBusinessRecord', {
          type: this.type
        }).then(rew => {
          this.data = rew.data.list
        })
      }
    },
    created () {

    }
  })
</script>
</html>
