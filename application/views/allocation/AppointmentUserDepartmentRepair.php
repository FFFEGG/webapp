<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>预约用户维修业务</title>
	<script src="<?php echo base_url(); ?>res/js/vue.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
	<link href="<?php echo base_url(); ?>/res/css/tailwind-ui.min.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/datetime/script/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/datetime/script/components.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/datetime/script/leo-scroll.js"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/datetime/style/index.css">
	<script src="<?php echo base_url(); ?>res/js/sweetalert2.min.js"></script>
	<script src="<?php echo base_url(); ?>res/js/core.js"></script>
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">
</head>
<style>
	.sel-date {
		background: #f3f3f3 !important;
	}
</style>
<body>
<div id="app" class="font-bold">
	<div class="flex p-3">
		<input @keyup.enter="submit" v-model="memberid" class="border p-2" type="text" placeholder="用户卡号">
		<button @click="submit" class="bg-teal-500 p-2 ml-2 text-white px-3">搜索</button>
	</div>

	<div class="flex p-3">
		<p class="p-2 mr-3">方式:</p>
		<select v-model="mode" class="border p-2" name="" id="">
			<option value="钢瓶修漏">钢瓶修漏</option>
			<option value="安全检查">安全检查</option>
			<option value="清洗饮水机">清洗饮水机</option>
		</select>
		<p class="p-2 mx-3">对象:</p>
		<select v-model="object" class="border p-2" name="" id="">
			<option value="钢瓶">钢瓶</option>
			<option value="用气环境">用气环境</option>
			<option value="饮水机">饮水机</option>
		</select>
		<p class="p-2 mx-3">维修部门:</p>
		<select v-model="repairdepartment" class="border p-2" name="" id="">
			<option value="">请选择维修部门</option>
			<option v-for="v in initData.Department.info" :value="v.name">{{v.name}}</option>
		</select>
		<p class="p-2 mx-3">预约上门时间:</p>
		<leo-date class="border p-2" :date-type="5" :sel-obj="dateObj" :sel-key="'d5'">
	</div>

	<div class="flex p-3">
		<p class="p-2 mr-3">选择地址:</p>
		<select v-model="addindex" name="" id="" class="border p-2">
			<option v-for="(v,k) in address" :value="k"> {{ v.province }}{{ v.city }}{{ v.area }}{{ v.town }}{{ v.street }}{{ v.housenumber
				}}{{ v.address }}</option>
		</select>
	</div>

	<div class="flex p-3">
		<p class="p-2 mr-3">备注:</p>
		<input class="border p-2 w-3/5" type="text" v-model="appointmentremarks">
	</div>

	<div class="flex p-3">
		<button @click="yy" class="bg-teal-500 text-white px-3 py-2">确认预约</button>
	</div>


	<div class="border-t w-full" v-if="user.memberid"></div>
	<div class="p-3 font-bold" v-if="user.memberid">
		<div>用户信息:</div>
		<div>姓名: {{ user.name }}</div>
		<div>电话: {{ user.telephone }}</div>
		<div>地址: {{ user.province }}{{ user.city }}{{ user.area }}{{ user.town }}{{ user.street }}{{ user.housenumber
			}}{{ user.address }}
		</div>
		<div>住户类型: {{ user.housingproperty }}</div>
		<div>用户类型: {{ user.customertype }}</div>
	</div>

</div>
</body>
<script>

  let sl1 = [{Id: 11, Name: '选项一'}, {Id: 12, Name: '选项二'}, {Id: 13, Name: '选项三'}],
    sl2 = ['2019', '2018', '2017', '2016', '2015'],
    sl3 = ['html5', 'css3', 'javascript', 'cSharp', 'java', 'php', 'python']

  new Vue({
    el: '#app',
    data () {
      return {
        memberid: '',
        user: '',
        initData: '',
        appointmentremarks: '',
        repairdepartment: '',
        mode: '钢瓶修漏',
        object: '钢瓶',
        select: {list1: sl1, list2: sl2, list3: sl3},
        dateObj: {d1: '', d2: '', d3: '', d4: '', d5: ''},
        selObj: {s1: '', s2: '', s3: ''},
		address: [],
        addindex: 0
      }
    },
    computed: {
      appointmenttime () {
        return this.dateObj.d5
      },
      dateStr () {
        return JSON.stringify(this.dateObj)
      },
      selStr () {
        return JSON.stringify(this.selObj)
      }
    },
    methods: {
      yy () {
        if (!this.user.memberid) {
          swal('请输入卡号')
          return false
        }
        if (!this.appointmenttime) {
          swal('请选择预约时间')
          return false
        }
        if (!this.repairdepartment) {
          swal('请选维修部门')
          return false
        }

        axios.post('/index.php/api/AppointmentUserDepartmentRepair', {
          user: this.user,
		  address: this.address[this.addindex],
          appointmentremarks: this.appointmentremarks,
          appointmenttime: this.appointmenttime,
          repairdepartment: this.repairdepartment,
          mode: this.mode,
          object: this.object,
        }).then(rew => {
          if (rew.data.code == 200) {
            swal('预约成功')
			this.user = ''
			this.memberid = ''
			this.address = []
		  }
        })
      },
      submit () {
        if (this.memberid == '') {
          swal('请输入卡号')
          return false
        }
        axios.post('/index.php/api/getUserInfos', {
          cardid: this.memberid
        }).then(rew => {
          this.user = rew.data.data
          this.address = rew.data.addresses
          for (let i = 0; i < this.address.length; i++) {
			if (this.address[i].defaultoption == 1) {
				this.addindex = i
			}
          }
        })

      },
      dateC1 (v) {
        swal('时间选择值为 ' + v)
      },
      selC1 (v, t) {
        swal('下拉选择值为 ' + v + ',文本为 ' + t)
      }
    },
	created () {
      axios.post('/index.php/api/getInitData').then(rew=>{
        this.initData = rew.data.data

	  })
	}
  })
</script>
</html>
