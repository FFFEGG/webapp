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
	<title>获取档案信息</title>
</head>
<body>
<div id="app" class=" p-3">

	<div class="flex">
		<input v-model="regnumber" type="text" class="border rounded p-2 mr-2" placeholder="登记钢印号">
		<button @click="submit" class="bg-teal-500 text-white  rounded">搜索</button>
	</div>
	<div class="mt-2 p-2 leading-10 text-lg text-gray-700 flex">
		<div class="w-6/12">
			<p>录入时间: {{ data.addtime}}</p>
			<p>制造单位: {{ data.manufacturingunit}}</p>
			<p>设备品种: {{ data.equipmentvariety}}</p>
			<p>材料: {{ data.material}}</p>
			<p>气瓶类型:{{ data.bottletype}}</p>
			<p>充装介质:{{ data.fillingmedium}}</p>
			<p>出厂码:{{ data.productionnumber}}</p>
			<p>容积(L):{{ data.volume}}</p>
			<p>设计壁厚(mm):{{ data.wallthickness}}</p>
			<p>公称压力(Mpa):{{ data.nominalpressure}}</p>
			<p>重量(KG):{{ data.weight}}</p>
			<p>备注:{{ data.remarks}}</p>
			<p>出厂日期:{{ data.date4manufacture}}</p>
			<p>产权单位:{{ data.propertyunit}}</p>
		</div>
		<div>
			<p>登记码(钢印号):{{ data.regnumber}}</p>
			<p>检测日期:{{ data.date4testing}}</p>
			<p>下检日期:{{ data.date4nexttesting}}</p>
			<p>识别码:{{ data.code}}</p>
			<p>部门:{{ data.department}}</p>
			<p>操作员:{{ data.operator}}</p>
			<p>状态:{{ data.state}}</p>
		</div>

	</div>
</div>
</body>
<script>

  new Vue({
    el: '#app',
    data() {
      return {
        regnumber: '',
        data: ''
      }
    },
    computed: {},
    methods: {

      submit() {
        if (!this.regnumber) {
          swal('请输入登记钢印号');
          return false
        }
        axios.post('/index.php/api/GetArchives', {
          regnumber: this.regnumber
        }).then(rew => {
          this.data = rew.data.data[0]
        })
      }
    }
  })
</script>
</html>
