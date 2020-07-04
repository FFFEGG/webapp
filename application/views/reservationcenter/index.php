<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
	<title>NNGAS</title>
	<link rel='Shortcut Icon' type='image/x-icon' href=''>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<link href="<?php echo base_url(); ?>/res/css/animate.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/component/layer-v3.0.3/layer/layer.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/component/font-awesome-4.7.0/css/font-awesome.min.css">
	<link href="<?php echo base_url(); ?>/res/css/default.css" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/win10.js"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layim/dist/css/layui.css">
	<style>
		* {
			font-family: "Microsoft YaHei", 微软雅黑, "MicrosoftJhengHei", 华文细黑, STHeiti, MingLiu
		}

		/*磁贴自定义样式*/
		.win10-block-content-text {
			line-height: 44px;
			text-align: center;
			font-size: 16px;
		}

		.oper {
			position: fixed;
			bottom: 60px;
			right: 10px;
			background: white;
			background: rgba(255, 255, 255, 0.4);
			border-radius: 3px;
			z-index: 88;
			padding: 20px;
			font-weight: bold;
			border: 3px dashed white;
			box-shadow: 1px 1px 2px #333;
		}

		.layui-row {
			display: flex;
			padding: 5px 0;

		}

		.layui-col-lg6 {
			opacity: 1;
			color: white;
			min-width: 100px;
			text-align: left;
			padding-bottom: 5px;
			text-shadow: 0px 0px 1px black;
		}

		.fbgg {
			position: fixed;
			right: 10px;
			top: 380px;
			background: rgba(255, 109, 46, 0.88);
			border-radius: 3px;
			text-align: justify;
			padding: 10px 30px;
			font-size: 20px;
			font-weight: bold;
			color: #b3d7ff;
			box-shadow: 1px 1px 1px white;
			z-index: 100;
		}

		.sxgg {
			position: fixed;
			right: 170px;
			top: 380px;
			background: rgba(217, 108, 255, 0.88);
			border-radius: 3px;
			text-align: justify;
			padding: 10px 30px;
			font-size: 20px;
			font-weight: bold;
			color: #b3d7ff;
			box-shadow: 1px 1px 1px white;
			z-index: 100;
		}

		.slide-in-bottom {
			-webkit-animation: slide-in-bottom 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
			animation: slide-in-bottom 0.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
		}

		@-webkit-keyframes slide-in-bottom {
			0% {
				-webkit-transform: translateY(1000px);
				transform: translateY(1000px);
				opacity: 0;
			}
			100% {
				-webkit-transform: translateY(0);
				transform: translateY(0);
				opacity: 1;
			}
		}

		@keyframes slide-in-bottom {
			0% {
				-webkit-transform: translateY(1000px);
				transform: translateY(1000px);
				opacity: 0;
			}
			100% {
				-webkit-transform: translateY(0);
				transform: translateY(0);
				opacity: 1;
			}
		}

		.msg {
			position: fixed;
			background: white;
			bottom: 100px;
			right: 10px;
			z-index: 99;
			width: 200px;
			height: 150px;
			padding: 40px
		}

		.hidden {
			display: none;
		}
	</style>
	<script>
      Win10.onReady(function () {

        //设置壁纸
        Win10.setBgUrl({
          main: '<?php echo base_url();?>/res/img/wallpapers/main.jpg',
          mobile: '<?php echo base_url();?>/res/img/wallpapers/mobile.jpg',
        });

        Win10.setAnimated([
          'animated flip',
          'animated bounceIn',
        ], 0.01)
      })
	</script>
</head>
<body>
<div id="win10">
	<!--	<div class="fbgg" onclick="Win10.openUrl('/index.php/msg/gg','发布公告')">-->
	<!--		发布公告-->
	<!--	</div>-->

	<div class="desktop">
		<div id="win10-shortcuts" class="shortcuts-hidden">


			<div class="shortcut" onclick="Win10.openUrl('/index.php/user/open_account','开户办卡')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/opencard.png"/>
				<div class="title">开户办卡</div>
			</div>
			<div class="shortcut" onclick="Win10.openUrl('/index.php/order/lists','预约下单','max')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/msgicon%20(2).png"/>
				<div class="title">预约下单</div>
			</div>

			<div class="shortcut" onclick="Win10.openUrl('/index.php/users/info','用户基本信息')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/users.png"/>
				<div class="title">用户查询</div>
			</div>


			<div class="shortcut" onclick="Win10.openUrl('/index.php/order/monitoring','订单监控')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">订单监控</div>
			</div>

			<div class="shortcut" onclick="Win10.openUrl('/index.php/user/likeslink','模糊查询')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/userinfo.png"/>
				<div class="title">模糊查询</div>
			</div>

			<div class="shortcut" onclick="Win10.openUrl('/index.php/user/CallRecord','用户来电信息')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">用户来电信息</div>
			</div>


			<div class="shortcut" onclick="Win10.openUrl('/index.php/msg/snslist','SNS绑定列表')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">SNS绑定列表</div>
			</div>



			<div class="shortcut" onclick="Win10.openUrl('/index.php/msg/SnsUserRepairList','三方平台用户维修信息')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">三方平台用户维修信息</div>
			</div>





			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/GPxiulou?endtime=<?= date('Y-m-d') ?>','钢瓶修漏查询')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">钢瓶修漏查询</div>
			</div>
			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/reservationcenter/DepartmentRepairList?endtime=<?= date('Y-m-d') ?>','部门维修列表')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">部门维修列表</div>
			</div>


			<div class="shortcut" onclick="Win10.openUrl('/index.php/appointment/repair','客服中心维修列表')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/wx.png"/>
				<div class="title">客服中心维修列表</div>
			</div>


			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/reservationcenter/PackingtypeCirculationInfo','钢瓶流转信息')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">钢瓶流转信息</div>
			</div>

			<div class="shortcut" onclick="Win10.openUrl('/index.php/user/UserInvoiceRecord','开电子发票')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">开电子发票</div>
			</div>


			<div class="shortcut"
				 onclick="Win10.openUrl('/index.php/msg/ReservationCenterCQCS?endtime=<?= date('Y-m-d') ?>',' 催气催水统计')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title"> 催气催水统计</div>
			</div>



			<div class="shortcut" onclick="Win10.openUrl('/index.php/reservationcenter/userManagement','员工管理')">
				<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/db5.png"/>
				<div class="title">员工管理</div>
			</div>



			<?php if ($_SESSION['users']->quarters == '管理人员') {?>

				<div class="shortcut" onclick="Win10.openUrl('/index.php/msg/editgg','修改公告')">
					<img class="icon" src="<?php echo base_url(); ?>/res/img/icon/wx.png"/>
					<div class="title">公告管理</div>
				</div>

			<?php }?>





			<a onclick="logout()" class="shortcut">
				<svg t="1586848384998" class="icon" viewBox="0 0 1024 1024" version="1.1"
					 xmlns="http://www.w3.org/2000/svg" p-id="1801" width="200" height="200">
					<path
						d="M173 873.3c-11 0-20-9-20-20V173.9c0-11 9-20 20-20h320.7c11 0 20-9 20-20v-15c0-11-9-20-20-20H153h-35c-11 0-20 9-20 20v809.3h395.7c11 0 20-9 20-20v-15c0-11-9-20-20-20H173z"
						fill="#2680F0" p-id="1802"></path>
					<path
						d="M609.3 273.3c-7.8-7.8-7.8-20.5 0-28.3l10.6-10.6c7.8-7.8 20.5-7.8 28.3 0l264.9 264.9c7.8 7.8 7.8 20.5 0 28.3L648.4 792.8c-7.8 7.8-20.5 7.8-28.3 0l-10.6-10.6c-7.8-7.8-7.8-20.5 0-28.3l199-199c7.8-7.8 5.1-14.1-5.9-14.1H326.1c-11 0-20-9-20-20v-15c0-11 9-20 20-20h475.7c11 0 13.6-6.4 5.9-14.1L609.3 273.3z"
						fill="#2680F0" p-id="1803"></path>
				</svg>
				<div class="title">退出登录</div>
			</a>

		</div>
		<div id="win10-desktop-scene"></div>
	</div>

	<div id="win10-menu" class="hidden">
		<div class="list win10-menu-hidden animated animated-slideOutLeft">

			<div class="item"
				 onclick="window.location.href='<?php echo base_url(); ?>/res/hiprint%2064bit%20Setup%201.0.0.exe'">
				<i class="black icon fa fa-download"></i><span class="title">下载打印插件</span>
			</div>

			<div class="item"
				 onclick="Win10.openUrl('/index.php/user/editpassword','修改密码')">
				<i class="black icon fa fa-assistive-listening-systems"></i><span class="title">修改密码</span>
			</div>

		</div>

		<div id="win10-menu-switcher"></div>
	</div>
	<div id="win10_command_center" class="hidden_right">
		<div class="title">
			<h4 style="float: left">来电记录 </h4>
			<span id="win10_btn_command_center_clean_all">全部清除</span>
		</div>
		<div class="msgs" id="telmsgs">

		</div>
	</div>
	<div id="win10_task_bar">
		<div id="win10_btn_group_left" class="btn_group">
			<div id="win10_btn_win" class="btn"><span class="fa fa-windows"></span></div>
			<div class="btn" id="win10-btn-browser"><span class="fa fa-internet-explorer"></span></div>
		</div>
		<div id="win10_btn_group_middle" class="btn_group"></div>
		<div id="win10_btn_group_right" class="btn_group">
			<div class="btn" id="win10_btn_time"></div>
			<div class="btn" id="win10_btn_command"><span id="win10-msg-nof" class="fa fa-comment-o"></span></div>
			<div class="btn" id="win10_btn_show_desktop"></div>
		</div>
	</div>
	<div
		style="width: 300px;height: 300px;position: fixed;right: 10px;top: 10px;background: rgba(255,255,255,0.8);border-radius: 3px;overflow-y: scroll;">
		<p style="background: black;color: white;margin: 0;padding: 5px"><i class="fa fa-newspaper-o icon red"></i> 最新公告
		</p>
		<div class="ggcontent" style="padding: 3px 15px;font-size: 13px;">
			<?php foreach ($_SESSION['bulletinboard'] as $v) { ?>
				<p onclick="Win10.openUrl('/index.php/msg/ggshow?info=<?= Myencode($v) ?>','公告')"
				   style="border-bottom: 1px dashed #999;padding-bottom: 2px;display: flex; justify-content: space-between;cursor: pointer">
					<span style="overflow: hidden"><?= $v->title ?></span>
					<span style="display: flex;width: 100px"><?= substr($v->addtime, 0, 10) ?></span>
				</p>
			<?php } ?>
		</div>

	</div>


	<div class="oper">
		<div class="layui-row" style="margin-left: 15px">
			<div class="layui-col-lg6">所属公司:</div>
			<div class="layui-col-lg6"><?= $_SESSION['company']['name'] ?></div>
		</div>

		<div class="layui-row" style="margin-left: 15px">
			<div class="layui-col-lg6">部门:</div>
			<div class="layui-col-lg6"><?= get_cookie('department') ?></div>
		</div>
		<div class="layui-row" style="margin-left: 15px">
			<div class="layui-col-lg6">工号:</div>
			<div class="layui-col-lg6"><?= $_SESSION['users']->opeid ?></div>
		</div>
		<div class="layui-row" style="margin-left: 15px">
			<div class="layui-col-lg6">姓名:</div>
			<div class="layui-col-lg6"><?= $_SESSION['users']->name ?></div>
		</div>
		<?php if (get_cookie('seatno')) { ?>
			<div class="layui-row" style="margin-left: 15px">
				<div class="layui-col-lg6">坐席号:</div>
				<div class="layui-col-lg6"><?= get_cookie('seatno') ?></div>
			</div>
		<?php } ?>

	</div>
</div>
<div class="slide-in-bottom msg hidden">
	<span onclick="closemsg()" style="position: fixed;right: 12px;bottom: 200px;cursor: pointer">X</span>
	<div>
		消息提醒
		<p class="msgtitle"></p>
	</div>
	<a href="#" onclick="myopen()">立即查看>></a>
</div>
<input type="hidden" value="<?= $page ?>" class="page">
<input type="hidden" value="<?= $count ?>" class="count">
</body>


<script>
  tellist();//电话列表
  var ws = new WebSocket('<?= $this->config->item('ws_url')?>');
  //心跳检测
  var heartCheck = {
    timeout: 30000, //9分钟发一次心跳
    timeoutObj: null,
    serverTimeoutObj: null,
    reset: function () {
      clearTimeout(this.timeoutObj);
      clearTimeout(this.serverTimeoutObj);
      return this
    },
    start: function () {
      var self = this;
      this.timeoutObj = setTimeout(function () {
        //这里发送一个心跳，后端收到后，返回一个心跳消息，
        //onmessage拿到返回的心跳就说明连接正常
        ws.send('ping');
        console.log('ping!');
        self.serverTimeoutObj = setTimeout(function () { //如果超过一定时间还没重置，说明后端主动断开了
          console.log('try=close');
          ws.close() //这里为什么要在send检测消息后，倒计时执行这个代码呢，因为这个代码的目的时为了触发onclose方法，这样才能实现onclose里面的重连方法
          //所以这个代码也很重要，没有这个方法，有些时候发了定时检测消息给后端，后端超时（我们自己设定的时间）后，不会自动触发onclose方法。我们只有执行ws.close()代码，让ws触发onclose方法
          //的执行。如果没有这个代码，连接没有断线的情况下而后端没有正常检测响应，那么浏览器时不会自动超时关闭的（比如谷歌浏览器）,谷歌浏览器会自动触发onclose
          //是在断网的情况下，在没有断线的情况下，也就是后端响应不正常的情况下，浏览器不会自动触发onclose，所以需要我们自己设定超时自动触发onclose，这也是这个代码的
          //的作用。

        }, self.timeout)
      }, this.timeout)
    }
  };

  //申请一个WebSocket对象，参数是服务端地址，同http协议使用http://开头一样，WebSocket协议的url使用ws://开头，另外安全的WebSocket协议使用wss://开头
  ws.onopen = function () {
    //当WebSocket创建成功时，触发onopen事件
    ws.send(JSON.stringify({Type: '请求绑定', Code: "<?= $_SESSION['wskey']?>"})); //将消息发送到服务端
    heartCheck.reset().start() //心跳检测重置
  };
  ws.onmessage = function (e) {
    heartCheck.reset().start(); //拿到任何消息都说明当前连接是正常的
    //当客户端收到服务端发来的消息时，触发onmessage事件，参数e.data包含server传递过来的数据
    let data = JSON.parse(e.data);
    console.log(data);
    if (data.Type && data.Type == '电话提醒' && '<?= get_cookie('department')?>' == '预约中心') {
      var lasttel = JSON.parse(localStorage.getItem('lasttel'));
      if (lasttel && ((Date.parse(new Date()) - lasttel.time) <= 5000)) {
        return false
      }
      data.time = Date.parse(new Date());
      Win10.openUrl('/index.php/user/likeslink?keytype=电话&keyword=' + data.TelePhone, '用户查询');
      let arr = localStorage.getItem('telmsgs') ? JSON.parse(localStorage.getItem('telmsgs')) : [];
      arr = arr.concat(data);
      localStorage.setItem('lasttel', JSON.stringify(data));
      localStorage.setItem('telmsgs', JSON.stringify(arr));
      tellist()
    }

    if (data.Type == '推送消息' && data.title) {
      document.getElementsByClassName("msg")[0].classList.remove("hidden");
      document.getElementsByClassName("msgtitle")[0].innerHTML = data.title;
      localStorage.setItem('msgtitle', data.title);
    }
  };
  ws.onclose = function (e) {
    //当客户端收到服务端发送的关闭连接请求时，触发onclose事件
    console.log('close');
    alert('连接断开，F5刷新尝试重新连接');
    window.location.href = '/index.php/login'
  };
  ws.onerror = function (e) {
    //如果出现连接、处理、接收、发送数据失败的时候触发onerror事件
    console.log('error' + error);
    alert('连接断开，F5刷新尝试重新连接');
    window.location.href = '/index.php/login'
  };

  function timetrans(date) {
    var date = new Date(date);//如果date为13位不需要乘1000
    var Y = date.getFullYear() + '-';
    var M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';
    var D = (date.getDate() < 10 ? '0' + (date.getDate()) : date.getDate()) + ' ';
    var h = (date.getHours() < 10 ? '0' + date.getHours() : date.getHours()) + ':';
    var m = (date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes()) + ':';
    var s = (date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds());
    return Y + M + D + h + m + s
  }

  function userinfo(tel) {
    Win10.openUrl('/index.php/user/likeslink?keytype=电话&keyword=' + tel, '用户查询')
  }

  function tellist() {
    var list = JSON.parse(localStorage.getItem('telmsgs')) ? JSON.parse(localStorage.getItem('telmsgs')) : [];
    var str = '';
    var listreverse = list.reverse();
    for (let i = 0; i < listreverse.length; i++) {
      str += '<div onclick="userinfo(' + listreverse[i].TelePhone + ')" style="padding: 10px;background: #555;margin-bottom: 3px">';
      str += ' <text>电话：' + listreverse[i].TelePhone + '</text>';
      str += '<br>';
      str += '<text>时间：' + timetrans(listreverse[i].time) + '</text>';
      str += ' </div>'
    }

    var div = document.getElementById('telmsgs');
    div.innerHTML = str;

    if (list.length > 200) {
      list.slice(199, list.length - 200);
      localStorage.setItem('telmsgs', JSON.stringify(list))
    }
  }

  function closemsg() {
    document.getElementsByClassName("msg")[0].classList.add("hidden")
  }

  function myopen() {
    var title = localStorage.getItem("msgtitle");

    if (title == '用户请求绑定提醒') {
      Win10.openUrl('/index.php/msg/snslist', 'SNS绑定列表')
    }
    if (title == '门店新维修订单提醒') {
      Win10.openUrl('/index.php/allocation/DepartmentRepairList?endtime=<?= date('Y-m-d')?>', '门店新维修订单提醒')
    }
    if (title == '订单未知门店提醒') {
      Win10.openUrl('/index.php/order/monitoring', '订单监控')
    }
    if (title == '三方平台用户预约维修提醒') {
      Win10.openUrl('/index.php/msg/SnsUserRepairList', '三方平台用户维修信息')
    }
    closemsg()
  }
</script>


<script>
  $('.s').click(function () {
    var page = $('.page').val();
    var count = $('.count').val();
    if (page == 0) {
      alert('第一页');
      return false
    }

    $.ajax({
      url: '/index.php/api/getgg',
      method: 'POST',
      dataType: 'json',
      data: {
        page: Number(page) - 1
      },
      success: function (rew) {
        adddata(rew.data);
        $('.page').val(Number(page) - 1)
      }
    })
  });

  $('.x').click(function () {
    var page = $('.page').val();
    var count = $('.count').val();
    if (count - page == 1) {
      alert('最后一页');
      return false
    }

    $.ajax({
      url: '/index.php/api/getgg',
      method: 'POST',
      dataType: 'json',
      data: {
        page: Number(page) + 1
      },
      success: function (rew) {
        adddata(rew.data);
        $('.page').val(Number(page) + 1)
      }
    })
  });

  function adddata(data) {
    var str = '';
    str += '<p>' + data.title + '</p>';
    str += '<p style="font-size: 12px;font-weight: bold">' + data.content + '</p>';
    str += '<p>' + data.addtime + '</p>';
    str += '<p>' + data.issuer + '发布</p>';
    $('.ggcontent').html(str)
  }

  function logout() {
    $.ajax({
      url: '/index.php/api/logout',
      method: 'post',
      success: function (rew) {
        window.location.reload()
      }
    })
  }
</script>

<?php if (get_cookie('seatno') == 107 || get_cookie('seatno') == 116) {?>
<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>/res/layim/dist/layui.js"></script>
<script>


	layui.use('layim', function(layim){
		var socket = new WebSocket('ws://10.9.1.35:7272');


		//监听收到的消息
		socket.onmessage = function(res){
			//字符串转json
			let data = JSON.parse(res.data)
			//console.log(data)

			//如果没有类型，就为空
			let type = data.type || ''

			switch (type) {
				case 'init':
					axios.post('http://10.9.1.35:8600/kfinit', {client_id: data.client_id, seatno: <?= get_cookie('seatno')?>}).then(rew=>{

						layim.config({

							// //初始化接口
							// init: {
							// 	url: '/res/layim/exm/json/getList.json'
							// 	,data: {}
							// }

							//或采用以下方式初始化接口

							init: {
								mine: {
									"username": "客服<?= get_cookie('seatno')?>" //我的昵称
									,"id": rew.data.mineid //我的ID
									,"status": "online" //在线状态 online：在线、hide：隐身
									,"remark": "" //我的签名
									,"avatar": "/res/img/avatar.jpg" //我的头像
								}
								,friend: [
									{
										"groupname": "APP用户"
										,"id": 1
										,"online": 5
										,"list": rew.data.friend
									}
								]
							}



							//查看群员接口
							,members: {
								url: 'json/getMembers.json'
								,data: {}
							}

							//上传图片接口
							,uploadImage: {
								url: 'http://10.9.1.35:8600/kfphpoto' //（返回的数据格式见下文）
								,type: '' //默认post
							}

							//上传文件接口
							,uploadFile: {
								url: '/upload/file' //（返回的数据格式见下文）
								,type: '' //默认post
							}

							,isAudio: true //开启聊天工具栏音频
							,isVideo: true //开启聊天工具栏视频

							//扩展工具栏
							,tool: [{
								alias: 'code'
								,title: '代码'
								,icon: '&#xe64e;'
							}]

							//,brief: true //是否简约模式（若开启则不显示主面板）

							//,title: 'WebIM' //自定义主面板最小化时的标题
							,right: '190px' //主面板相对浏览器右侧距离
							,bottom: '100px'
							,minRight: '90px' //聊天面板最小化时相对浏览器右侧距离
							,initSkin: '6.jpg' //1-5 设置初始背景
							//,skin: ['aaa.jpg'] //新增皮肤
							//,isfriend: false //是否开启好友
							,isgroup: false //是否开启群组
							,min: true //是否始终最小化主面板，默认false
							,notice: true //是否开启桌面消息提醒，默认false
							,voice: false //声音提醒，默认开启，声音文件为：default.mp3

							//,msgbox: layui.cache.dir + 'css/modules/layim/html/msgbox.html' //消息盒子页面地址，若不开启，剔除该项即可
							//,find: layui.cache.dir + 'css/modules/layim/html/find.html' //发现页面地址，若不开启，剔除该项即可
							,chatLog: '/index.php/chat/index' //聊天记录页面地址，若不开启，剔除该项即可

						});
					})
					break;

				case 'history':
					axios.post('http://10.9.1.35:8600/mydecrypt', {
						data: data.data
					}).then(rew => {
						this.messages = rew.data;
					})
					break;
				case 'online':

					axios.post('http://10.9.1.35:8600/checkusers', {
						seaton: 101
					}).then(rew => {
						this.users = rew.data;
					})
					break;
				case 'logout':
					axios.post('http://10.9.1.35:8600/checkusers', {
						seaton: 101
					}).then(rew => {
						this.users = rew.data;
					})
					break;

				case 'ping':
					socket.send('pong');
					break;
				default:
					console.log(data)
			}
			//基础配置

		};



		/*
		layim.chat({
		  name: '在线客服-小苍'
		  ,type: 'kefu'
		  ,avatar: 'http://tva3.sinaimg.cn/crop.0.0.180.180.180/7f5f6861jw1e8qgp5bmzyj2050050aa8.jpg'
		  ,id: -1
		});
		layim.chat({
		  name: '在线客服-心心'
		  ,type: 'kefu'
		  ,avatar: 'http://tva1.sinaimg.cn/crop.219.144.555.555.180/0068iARejw8esk724mra6j30rs0rstap.jpg'
		  ,id: -2
		});
		layim.setChatMin();*/

		//监听在线状态的切换事件
		layim.on('online', function(data){
			//console.log(data);
		});

		//监听签名修改
		layim.on('sign', function(value){
			//console.log(value);
		});

		//监听自定义工具栏点击，以添加代码为例
		layim.on('tool(code)', function(insert){
			layer.prompt({
				title: '插入代码'
				,formType: 2
				,shade: 0
			}, function(text, index){
				layer.close(index);
				insert('[pre class=layui-code]' + text + '[/pre]'); //将内容插入到编辑器
			});
		});

		//监听layim建立就绪
		layim.on('ready', function(res){

			//监听添加列表的socket事件，假设你服务端emit的事件名为：addList
			socket.onmessage = function(res){
				//字符串转json

				let data = JSON.parse(res.data)
				console.log(data)
				//如果没有类型，就为空
				let type = data.type || ''

				switch (type) {
					case 'online':
						axios.post('http://10.9.1.35:8600/checkusers', {
							seaton: <?= get_cookie('seatno')?>
						})
						break;
					case 'logout':
						axios.post('http://10.9.1.35:8600/checkusers', {
							seaton: <?= get_cookie('seatno')?>
						})
						break;
					case 'say':
						axios.post('http://10.9.1.35:8600/mydecrypt', {
							data: data.data
						}).then(rew => {
							// this.messages.push(rew.data);
							// this.$nextTick(function () {
							// 	$('.panel-body').animate({scrollTop: $('.messages').height()});
							// })

							if (rew.data.name  != '客服'+<?= get_cookie('seatno')?>) {
								layim.getMessage({
									username: rew.data.name //消息来源用户名
									,avatar: rew.data.avatar //消息来源用户头像
									,id: rew.data.id //消息的来源ID（如果是私聊，则是用户id，如果是群聊，则是群组id）
									,type: "friend" //聊天窗口来源类型，从发送消息传递的to里面获取
									,content: rew.data.content.replace('http://10.9.1.35:8600','http://116.10.197.126:8600') //消息内容
									,cid: 0 //消息id，可不传。除非你要对消息进行一些操作（如撤回）
									,mine: false //是否我发送的消息，如果为true，则会显示在右方
									,fromid: rew.data.id //消息的发送者id（比如群组中的某个消息发送者），可用于自动解决浏览器多窗口时的一些问题
									,timestamp: rew.data.timestamp //服务端时间戳毫秒数。注意：如果你返回的是标准的 unix 时间戳，记得要 *1000
								});
							}


						})

						break;
					case 'users':
						axios.post('http://10.9.1.35:8600/mydecrypt', {
							data: data.data
						}).then(rew => {
							let list = rew.data
							for (let i = 0; i < list.length; i++) {
								layim.removeList({
									type: 'friend' //或者group
									,id: list[i].id //好友或者群组ID
								});
								layim.addList(list[i]);
							}
						})
						break;

				}
			};

		});

		//监听发送消息
		layim.on('sendMessage', function(data){

			var To = data.to;
			var mine = data.mine;
			console.log(data);
			axios.post('http://10.9.1.35:8600/myencrypt', {
				data: JSON.stringify({content: mine.content  , user_id:  To.id , seatno: <?= get_cookie('seatno')?>})
			}).then(rew => {
				axios.post('http://10.9.1.35:8600/say', {encryptmsg: rew.data})
			})

			//
			// if(To.type === 'friend'){
			// 	layim.setChatStatus('<span style="color:#FF5722;">对方正在输入。。。</span>');
			// }
		});

		//监听查看群员
		layim.on('members', function(data){
			//console.log(data);
		});

		//监听聊天窗口的切换
		layim.on('chatChange', function(res){
			var type = res.data.type;
			if (res.data.seatno) {
				layim.setChatStatus('<span style="color:#FF5722;">客服'+res.data.seatno+'正在接待</span>');
			} else {
				axios.post('http://10.9.1.35:8600/bindseatno',{
					seatno: <?= get_cookie('seatno')?>,
					user_id: res.data.id
				})
			}

			if(type === 'friend'){
				//模拟标注好友状态
				//layim.setChatStatus('<span style="color:#FF5722;">在线</span>');
			} else if(type === 'group'){
				//模拟系统消息
				layim.getMessage({
					system: true
					,id: res.data.id
					,type: "group"
					,content: '模拟群员'+(Math.random()*100|0) + '加入群聊'
				});
			}
		});



	});
</script>

<?php } ?>
</html>
