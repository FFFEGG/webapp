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
	<title>已申请配送员补贴记录</title>
</head>
<body>
<div id="app" class=" p-3">
	<div class="flex">
		<div class="p-2">开始时间</div>
		<input v-model="begintime" class="border mx-3 p-2" type="date">
		<div class="p-2">结束时间</div>
		<input v-model="endtime" class="border mx-3 p-2" type="date">
		<select name="" id="" v-model="type" class="border mx-3 p-2">
			<option value="">申请类型</option>
			<option value="售后换重补贴">售后换重补贴</option>
			<option value="普通放空补贴">普通放空补贴</option>
			<option value="安全放空补贴">安全放空补贴</option>
			<option value="应急补贴">应急补贴</option>
			<option value="超远费补贴">超远费补贴</option>
			<option value="装卸费补贴">装卸费补贴</option>
			<option value="安装胶管补贴">安装胶管补贴</option>
		</select>


		<button @click="submit" class="p-2 bg-teal-500 text-white px-4">查询</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border">头部信息</th>
			<template  v-for="v in list.title" v-if="v == 'ID'">
			</template>
			<template  v-for="v in list.title" v-else-if="v == '类型'">
			</template>
			<template  v-for="v in list.title" v-else-if="v == '订单号'">
			</template>
			<template  v-for="v in list.title" v-else-if="v == '申请时间'">
			</template>
			<template  v-for="v in list.title" v-else-if="v == '业务发生时间'">
			</template>
			<template v-else>

				<th  class=" border">
					{{ v }}
				</th>
			</template>

			<th class=" border">操作</th>
		</tr>
		</thead>
		<tbody>
		<template v-for="v in list.info">
			<tr>
				<td class="border ">
					<p>ID: {{ v.id }}   类型: {{ v.type }}</p>
					<p>订单号: {{ v.serial }}</p>
					<p>申请时间: {{ v.addtime }}</p>
					<p>业务发生时间: {{ v.raddtime }}</p>
				</td>
				<td v-for="vi in list.key" v-if="vi !== 'ID' && vi !=='addtime' && vi !=='type' && vi !=='serial' && vi !=='raddtime'" class="border ">{{ v[vi] }}</td>


				<td class="border "><button @click="sq(v)" class="p-2 bg-teal-500 text-white mr-2 mb-2">授权</button> <button @click="cancle(v)"  class="p-2 bg-teal-500 text-white">取消</button></td>
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
        type: '',
        endtime: '',
        begintime: '2010-01-01'
      }
    },
    methods: {
      sq (data) {
        axios.post('/index.php/api/AuthorizeDeliverymanSubsidy',{
          id: data.ID,
          serial: data.serial,
          type: this.type,
        }).then(rew => {
			if (rew.data.code == 200) {
			  swal('授权成功')
			} else {
              swal('授权失败')
			}
			this.submit()
        })
	  },
      submit () {
        axios.post('/index.php/api/DepartmentApplyeDeliverymanSubsidyRecord',{
          begintime: this.begintime,
          type: this.type,
		  endtime: this.endtime
		}).then(rew => {
          this.list = rew.data.list
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
      cancle (data) {
        let that = this
        swal({
          title: '取消操作',
          input: 'text',
          text: '填写备注',
          showCancelButton: true,
          confirmButtonText: '确认',
          cancelButtonText: '取消',
          confirmButtonClass: 'btn btn-success mr-3',
          cancelButtonClass: 'btn btn-danger',
          showLoaderOnConfirm: true,
          allowOutsideClick: false
        }).then(function (remarks) {
          if (remarks.value) {
            axios.post('/index.php/api/CancelDeliverymanSubsidy',{
              id: data.ID,
              serial: data.serial,
              type: that.type,
              remarks: remarks.value,
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
	  }
    },
    created () {
      this.endtime = this.getQueryVariable('endtime')
      this.begintime = this.getQueryVariable('endtime')
    }
  })
</script>
</html>
