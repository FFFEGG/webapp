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
	<title>催气催水统计</title>
</head>
<body>
<div id="app" class=" p-3">
	<div class="flex">
		<div class="p-2">开始时间</div>
		<input v-model="startime" class="border mx-3 p-2" type="date">
		<div class="p-2">结束时间</div>
		<input v-model="endtime" class="border mx-3 p-2" type="date">

		<button @click="submit" class="p-2 bg-teal-500 text-white px-4">查询</button>
	</div>

	<table class="table-auto mt-6 w-full text-xs">
		<thead>
		<tr>
			<th class=" border">日期</th>
			<th class=" border">门店</th>
			<th class=" border">催气</th>
			<th class=" border">催水</th>


		</tr>
		</thead>
		<tbody>
		<template v-for="v in list">


			<tr >
				<td class="border ">
					{{v.date}}
				</td>
				<td class="border ">{{v.department}}</td>
				<td class="border ">{{v.CQ}}</td>

				<td class="border ">{{v.CS}}</td>

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
        endtime: '',
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
        axios.post('/index.php/api/ReservationCenterCQCS', {
          startime: this.startime,
          endtime: this.endtime,
          department: this.deparment,
        }).then(rew => {
          this.list = rew.data.list
        })
      }
    },
    created () {
      this.endtime = this.getQueryVariable('endtime')
    }
  })
</script>
</html>
