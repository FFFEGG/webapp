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
	<title>用户退款</title>
</head>
<body>
<div id="app" class="p-4">
<!--	<div class="flex">-->
<!--		<input v-model="memberid" @keyup.enter="submit" class="p-2 mr-3 border" type="text" placeholder="用户卡号">-->
<!--		<button @click="submit" class="py-2 px-4 bg-teal-500 text-white">搜索</button>-->
<!--	</div>-->
	<div class="p-3 font-bold grid grid-cols-3 " v-if="user.memberid">
		<div class="p-3 m-2 border-2">姓名: {{ user.name }}</div>
		<div class="p-3 m-2 border-2">电话: {{ user.telephone }}</div>
		<div class="p-3 m-2 border-2">地址: {{ user.province }}{{ user.city }}{{ user.area }}{{ user.town }}{{ user.street }}{{ user.housenumber
			}}{{ user.address }}
		</div class="p-3 m-2 border-2">
		<div class="p-3 m-2 border-2">住户类型: {{ user.housingproperty }}</div>
		<div class="p-3 m-2 border-2">用户类型: {{ user.customertype }}</div>
		<div class="text-red-500 font-bold p-3 m-2 border-2">余额: {{ user.balance }}</div>
	</div>

	<div class="mt-4 ml-5">
		<input v-model="total" type="text" placeholder="退款金额" class="p-2 border-2 w-64" >
	</div>
	<div class="mt-4 ml-5">
		<button @click="tk" class="py-2 px-4 bg-teal-500 text-white">确认退款</button>
	</div>

<!---->
<!--	<div class="border-t w-full mt-4" v-if="user.memberid"></div>-->

</div>
</body>
<script>
  new Vue({
    el: '#app',
	data () {
      return {
        memberid: '<?= $this->input->get('memberid')?>',
		user: '',
        total: ''
	  }
	},
	methods : {
      submit () {
        if (this.memberid == '') {
          swal('请输入卡号')
		  return false
		}
        axios.post('/index.php/api/getUserInfos', {
          cardid: this.memberid
        }).then(rew => {
          this.user = rew.data.data
        })
	  },
	  tk () {
		if (!this.user.memberid) {
		  swal('没有找到用户')
		  return false
		}

        if (this.total <= 0) {
          swal('请输入金额')
          return false
        }


        if (this.total > Number(this.user.balance)) {
          swal('不能超过用户余额')
          return false
        }
        let that = this
        swal({
          title: '确定退款？',
          text: '将退款给用户' + this.total + '元',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: '确定',
		  cancelButtonText: '取消'
        }).then(function(data){
          if (data.value) {
            axios.post('/index.php/api/UserRefund',{
              userid: that.user.id,
              memberid: that.user.memberid,
              total: that.total
            }).then(rew=>{
              if (rew.data.code == 200) {
                var data = rew.data.printinfo
                var jsonp = {
                  title: '南宁三燃公司会员退预存款订单',
                  time: data.topinfo,
                  memberid: '卡号 ' + data.memberid,
                  name: '姓名 ' + data.name,
                  Memo1: '原存款：' + (Number(data.balance) + Number(data.pay_cash)),
                  Memo2: '退款：' + Number(data.pay_cash),
                  Memo3: '账户余额：' + Number(data.balance),
                  Memo4: '操作员: ' + data.operator,
                  Memo5: '用户签名：'
                }
                var data_infop = {
                  PrintData: jsonp,
                  Print: true
                }
                axios.get('http://127.0.0.1:8000/api/print/order/7/?data=' + JSON.stringify(data_infop)).then(rew => {
                  console.log(rew)
                })



                swal('退款成功')
                that.submit()
                that.total = ''
              } else {
                swal('退款失败')
              }
            })
		  }
        })

	  }
	},
	mounted () {
		this.submit()
	}
  })
</script>
</html>
