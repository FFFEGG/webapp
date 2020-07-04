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
	<script src="<?php echo base_url(); ?>res/js/echarts.js"></script>
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">
	<title>Document</title>
</head>
<body>
<div id="app" class="p-4">
	<div class="flex px-10 mb-10">
		<p class="p-2">开始时间</p> <input  @keyup.enter="submit" v-model="begintime" type="date" class="p-2 border">
		<p class="p-2">时间段</p><input  @keyup.enter="submit" v-model="time" type="text" class="p-2 border">
		<button  @click="submit" class="bg-red-500 text-sm text-white rounded p-2 w-20 ml-3">查询</button>
	</div>
	<div class="px-12 mb-8">
		<div class="grid grid-cols-5 mb-4 text-2xl">
			<p class="">总共预约:  {{ num }} </p>
			<p class="">总安排:  {{ num - znohandle }}</p>
			<p class="">未安排:  {{ znohandle }}</p>
		</div>

		<div class="grid grid-cols-10">
			<p v-for="v in order" class="mr-2">{{v.date}}:  {{v.aggregateorder}}</p>
		</div>
	</div>

	<!-- 为 ECharts 准备一个具备大小（宽高）的 DOM -->
	<div id="main" class="w-full" style="height:550px;"></div>
</div>
</body>
<script>
  new Vue({
    el: '#app',
    data() {
      return {
        option: {
          tooltip: {
            trigger: 'axis',
            axisPointer: {            // 坐标轴指示器，坐标轴触发有效
              type: 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
            }
          },
          legend: {
            data: ['未安排', '已安排'],
          },
          grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
          },
          xAxis: [
            {
              type: 'category',
              data: []
            }
          ],
          yAxis: [
            {
              type: 'value'
            }
          ],
          series: [
            {
              name: '未安排',
              type: 'bar',
              stack: '未安排',
              data: [320, 332, 301, 334, 390, 330, 320],
			  color: 'pink'
            },
            {
              name: '已安排',
              type: 'bar',
			  stack: '未安排',
              data: [120, 132, 101, 134, 90, 230, 210],
              color: 'green'
            }
          ]
        },
        num: 0,
        znohandle: 0,
        order: [],
		begintime: '2020-02-02',
		time: '<?= date('H:i',time())?>'
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
      submit() {
        this.getlist()
	  },
      getlist() {
        axios.post('/index.php/api/SimultaneousSegmentOrder',{
          begintime: this.begintime,
		  time: this.time
		}).then(rew => {
          this.option.xAxis[0].data = rew.data.list.xAxis;
          this.option.series[0].data = rew.data.list.nohandle;
          this.option.series[1].data = rew.data.list.handle;
          this.num = rew.data.list.num;
          this.znohandle = rew.data.list.znohandle;
          this.order = rew.data.order;
          // 基于准备好的dom，初始化echarts实例
          var myChart = echarts.init(document.getElementById('main'));
          // 使用刚指定的配置项和数据显示图表。
          myChart.setOption(this.option);
        })
      }
    },
    created() {
      this.begintime = this.getQueryVariable('begintime')
      this.getlist()
    }
  })
</script>
</html>
