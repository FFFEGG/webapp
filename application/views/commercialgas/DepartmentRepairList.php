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
	<title>部门维修列表</title>
</head>
<body>
<div id="app" class=" p-3">
	<div class="flex">
		<div class="p-2">开始时间</div>
		<input v-model="startime" class="border mx-3 p-2" type="date">
		<div class="p-2">结束时间</div>
		<input v-model="endtime" class="border mx-3 p-2" type="date">
		<div class="p-2">部门</div>
		<select name="" id="" class="border mx-3 p-2" v-model="department">
			<option value="全部">全部</option>
			<option v-for="v in initData.Department.info" :value="v.name">{{v.name}}</option>
		</select>
		<button @click="submit" class="p-2 bg-teal-500 text-white px-4">查询</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border">时间-订单号</th>


			<th class=" border">录入人</th>
			<th class=" border">方式</th>

			<th class=" border">维修项目</th>
			<th class=" border">维修员</th>
			<th class=" border">上门时间</th>
			<th class=" border">地址</th>
			<th class=" border">备注</th>
			<th class=" border">业务部门</th>
			<th class=" border">操作员</th>
			<th class=" border">状态</th>
			<th class=" border">操作</th>
		</tr>
		</thead>
		<tbody>
		<template v-for="v in list">


			<tr v-if="v.state=='取消'" style="color: #ff86f2">
				<td class="border ">
					<p>{{v.addtime}}</p>
					<p>{{v.serial}}</p>
				</td>
				<td class="border ">{{v.inputperson}}</td>
				<td class="border ">{{v.mode}}</td>

				<td class="border ">{{v.object}}</td>
				<td class="border ">{{v.maintenanceman}}</td>
				<td class="border ">{{v.appointmenttime}}</td>
				<td class="border ">{{v.city}}{{v.area}}{{v.town}}{{v.street}}{{v.housenumber}}{{v.address}}
				</td>
				<td class="border ">{{v.remarks}}</td>
				<td class="border ">{{v.department}}</td>
				<td class="border ">{{v.operator}}</td>
				<td class="border ">{{v.state}}</td>
				<td class="border ">

				</td>
			</tr>
			<tr v-else-if="v.state=='已安排'" style="color: red">
				<td class="border ">
					<p>{{v.addtime}}</p>
					<p>{{v.serial}}</p>
				</td>
				<td class="border ">{{v.inputperson}}</td>
				<td class="border ">{{v.mode}}</td>

				<td class="border ">{{v.object}}</td>
				<td class="border ">{{v.maintenanceman}}</td>
				<td class="border ">{{v.appointmenttime}}</td>
				<td class="border ">{{v.city}}{{v.area}}{{v.town}}{{v.street}}{{v.housenumber}}{{v.address}}
				</td>
				<td class="border ">{{v.remarks}}</td>
				<td class="border ">{{v.department}}</td>
				<td class="border ">{{v.operator}}</td>
				<td class="border ">{{v.state}}</td>
				<td class="border ">
					<button @click="fk(v)" class="bg-teal-500 text-white p-1">反馈</button>
				</td>
			</tr>
			<tr v-else-if="v.state=='已汇总'" style="color: blue">
				<td class="border ">
					<p>{{v.addtime}}</p>
					<p>{{v.serial}}</p>
				</td>
				<td class="border ">{{v.inputperson}}</td>
				<td class="border ">{{v.mode}}</td>

				<td class="border ">{{v.object}}</td>
				<td class="border ">{{v.maintenanceman}}</td>
				<td class="border ">{{v.appointmenttime}}</td>
				<td class="border ">{{v.city}}{{v.area}}{{v.town}}{{v.street}}{{v.housenumber}}{{v.address}}
				</td>
				<td class="border ">{{v.remarks}}</td>
				<td class="border ">{{v.department}}</td>
				<td class="border ">{{v.operator}}</td>
				<td class="border ">{{v.state}}</td>
				<td class="border ">
				</td>
			</tr>
			<tr v-else>
				<td class="border ">
					<p>{{v.addtime}}</p>
					<p>{{v.serial}}</p>
				</td>
				<td class="border ">{{v.inputperson}}</td>
				<td class="border ">{{v.mode}}</td>

				<td class="border ">{{v.object}}</td>
				<td class="border ">{{v.maintenanceman}}</td>
				<td class="border ">{{v.appointmenttime}}</td>
				<td class="border ">{{v.city}}{{v.area}}{{v.town}}{{v.street}}{{v.housenumber}}{{v.address}}
				</td>
				<td class="border ">{{v.remarks}}</td>
				<td class="border ">{{v.department}}</td>
				<td class="border ">{{v.operator}}</td>
				<td class="border ">{{v.state}}</td>
				<td class="border ">
					<button @click="cancle(v)" class="bg-teal-500 text-white p-1">取消</button>
					<button @click="ap(v)" class="bg-teal-500 text-white p-1">安排</button>
				</td>
			</tr>
		</template>
		</tbody>
	</table>


	<div v-if="apshow" class="fixed px-4 w-64 h-64 py-3 bg-gray-400" style="top: 20%;left: 40%">
		<p class="my-3">安排维修业务</p>
		<p class="my-3">选择维修员</p>
		<select v-model="maintenanceman" name="" id="" class="my-3 w-full p-1">
			<option value="">选择</option>
			<option v-for="v in wxy" :value="v.name">{{ v.name }}</option>
		</select>
		<button @click="HandleUserDepartmentRepair" class="bg-teal-500 my-3  p-2 text-white block">确认安排</button>
		<div @click="close" class="absolute top-0 text-white cursor-pointer text-lg" style="right: 10px">X</div>
	</div>

	<div v-if="fkshow" class="fixed px-4 w-7/12  py-3 bg-gray-400" style="top: 20%;left: 15%;">
		<p class="my-3">反馈维修业务</p>
		<p class="my-3">备注</p>
		<input v-model="remarks" class="border p-2 w-8/12" type="text" placeholder="选填">
		<p class="my-3">评价</p>
		<input v-model="evaluate" class="border p-2 w-8/12" type="text" placeholder="选填">
		<button @click="FeedbackUserDepartmentRepair" class="bg-teal-500 my-3  p-2 text-white block">确认反馈</button>
		<div @click="close" class="absolute top-0 text-white cursor-pointer text-lg" style="right: 10px">X</div>
	</div>
</div>
</body>
<script>

  new Vue({
    el: '#app',
    data () {
      return {
        list: [],
        wxy: [],
        initData: '',
        endtime: '',
        remarks: '',
        evaluate: '',
        apshow: false,
        fkshow: false,
        maintenanceman: '',
        department: '<?= get_cookie('department')?>',
        order: '',
        startime: '2010-01-01'
      }
    },
    methods: {
      close () {
        this.apshow = false
        this.fkshow = false
        this.maintenanceman = ''
        this.remarks = ''
        this.evaluate = ''
        this.order = ''
      },
      HandleUserDepartmentRepair () {
        if (this.maintenanceman == '') {
          swal('请选择维修人员')
          return false
        }
        axios.post('/index.php/api/HandleUserDepartmentRepair', {
          order: this.order,
          maintenanceman: this.maintenanceman
        }).then(rew => {
          if (rew.data.code == 200) {
            swal('安排成功')
            this.close()
            this.submit()
          } else {
            swal('安排失败' + JSON.stringify(rew.data.msg))
          }
        })
      },
      FeedbackUserDepartmentRepair () {
        axios.post('/index.php/api/FeedbackUserDepartmentRepair', {
          order: this.order,
          remarks: this.remarks,
          evaluate: this.evaluate,
        }).then(rew => {
          if (rew.data.code == 200) {
            swal('反馈成功')
            this.close()
            this.submit()
          } else {
            swal('安排失败' + JSON.stringify(rew.data.msg))
          }
        })
      },
      ap (data) {
        if (data.state != '正常') {
          swal('该订单无法安排')
          return false
        }
        this.order = data
        this.apshow = true
      },
      fk (data) {
        if (data.state != '已安排') {
          swal('该订单无法反馈')
          return false
        }
        this.order = data
        this.fkshow = true
      },
      cancle (data) {
        if (data.state != '正常') {
          swal('该状态无法取消')
          return false
        }
        let that = this
        swal({
          title: '确定取消吗？',
          text: '填写取消备注！',
          input: 'text',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: '确定',
          cancelButtonText: '取消',
        }).then(function (diss) {

          if (diss.dismiss != 'cancel') {
            axios.post('/index.php/api/CancelUserDepartmentRepair', {
              order: data,
              remarks: diss.value
            }).then(rew => {
              if (rew.data.code == 200) {
                swal(
                  '取消成功！',
                  '订单已取消。',
                  'success'
                )
              } else {
                swal(
                  '取消失败！',
                  '',
                  'error'
                )
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
        axios.post('/index.php/api/getDepartmentRepairList', {
          startime: this.startime,
          endtime: this.endtime,
          department: this.department,
        }).then(rew => {
          this.list = rew.data.data
        })
      }
    },
    created () {
      this.endtime = this.getQueryVariable('endtime')
      this.startime = this.getQueryVariable('endtime')
      axios.post('/index.php/api/getInitData').then(rew => {
        this.initData = rew.data.data
        this.wxy = rew.data.AreaDeliverymanList
      })
    }
  })
</script>
</html>
