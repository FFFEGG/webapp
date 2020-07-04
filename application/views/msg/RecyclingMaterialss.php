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
	<title>门店收回用户钢瓶物资</title>
</head>
<body>
<div id="app" class="p-4">
	<div class="flex">
		<input v-model="memberid" @keyup.enter="submit" class="p-2 mr-3 border" type="text" placeholder="用户卡号">
		<button @click="submit" class="py-2 px-4 bg-teal-500 text-white">搜索</button>
	</div>
	<div class="mt-4">
		<div class="flex items-center">

			<select name="" id="" class="p-2 border" v-model="packingtype">
				<option value="">选择钢瓶包装物类型</option>
				<option v-for="v in initData.Packingtype.info" :value="v.name">{{v.name}}</option>

			</select>

			<select name="" id="" class="p-2 border ml-3" v-model="brokerage">
				<option value="">选择经手人</option>
				<option v-for="v in AreaDeliverymanList" :value="v.name">{{v.name}}</option>
			</select>

			<input v-model="num" type="text" class="p-2 border ml-3" placeholder="数量">


		</div>
	</div>
	<div class="mt-4">
		<button @click="comfi_sub" class="py-2 px-4 bg-teal-500 text-white">确认办理</button>
	</div>


	<div class="border-t w-full mt-4" v-if="user.memberid"></div>
	<div class="p-3 font-bold grid grid-cols-3 " v-if="user.memberid">
		<div class="p-3 m-2 border-2">姓名: {{ user.name }}</div>
		<div class="p-3 m-2 border-2">电话: {{ user.telephone }}</div>
		<div class="p-3 m-2 border-2">地址: {{ user.province }}{{ user.city }}{{ user.area }}{{ user.town }}{{ user.street }}{{ user.housenumber
			}}{{ user.address }}
		</div>
		<div class="p-3 m-2 border-2">住户类型: {{ user.housingproperty }}</div>
		<div class="p-3 m-2 border-2">用户类型: {{ user.customertype }}</div>
		<div class="text-red-500 font-bold p-3 m-2 border-2">余额: {{ user.balance }}</div>
	</div>

</div>
</body>
<script>
  new Vue({
    el: '#app',
    data() {
      return {
        memberid: '<?= $this->input->get('cardid')?>',
        user: '',
        total: '',
        num: '',
        brokerage: '',
        packingtype: '',
        initData: '',
        AreaDeliverymanList: []
      }
    },
    methods: {
      comfi_sub () {
		if (!this.user.id) {
          swal('请输入卡号');
          return false
		}
		if (!this.brokerage || !this.packingtype || !this.num) {
          swal('请填写完整参数');
          return false
		}
		axios.post('/index.php/api/RecyclingMaterials',{
		  userid: this.user.id,
          memberid: this.user.memberid,
          customertype: this.user.customertype,
          attributiondepartment: this.user.attributiondepartment,
          packingtype: this.packingtype,
          num: this.num,
          brokerage: this.brokerage,
		}).then(rew=>{
		  if (rew.data.code == 200) {
		    swal('办理成功')
		  } else {
            swal('办理失败')
		  }
		  this.user = ''
		  this.memberid = ''
		  this.packingtype = ''
		  this.num = ''
		  this.brokerage = ''
		})

	  },
      submit() {
        if (this.memberid == '') {
          swal('请输入卡号');
          return false
        }
        axios.post('/index.php/api/getUserInfos', {
          cardid: this.memberid
        }).then(rew => {
          this.user = rew.data.data
        })
      }
    },
    mounted() {
      axios.post('/index.php/api/getInitData').then(rew => {
        this.initData = rew.data.data;
        this.AreaDeliverymanList = rew.data.AreaDeliverymanList
      })
    }
  })
</script>
</html>
