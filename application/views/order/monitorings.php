<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>订单监控</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
</head>

<body>
<style>
	.ap {
		position: absolute;
		background: #f1f1f1;
		padding: 30px;
		top: 10%;
		left: 25%;
		z-index: 999;
	}

	.scale-up-center {
		-webkit-animation: scale-up-center .4s cubic-bezier(.39, .575, .565, 1.000) both;
		animation: scale-up-center .4s cubic-bezier(.39, .575, .565, 1.000) both
	}

	@-webkit-keyframes scale-up-center {
		0% {
			-webkit-transform: scale(.5);
			transform: scale(.5)
		}
		100% {
			-webkit-transform: scale(1);
			transform: scale(1)
		}
	}

	@keyframes scale-up-center {
		0% {
			-webkit-transform: scale(.5);
			transform: scale(.5)
		}
		100% {
			-webkit-transform: scale(1);
			transform: scale(1)
		}
	}

	.scale-out-center {
		-webkit-animation: scale-out-center .5s cubic-bezier(.55, .085, .68, .53) both;
		animation: scale-out-center .5s cubic-bezier(.55, .085, .68, .53) both
	}

	@-webkit-keyframes scale-out-center {
		0% {
			-webkit-transform: scale(1);
			transform: scale(1);
			opacity: 1
		}
		100% {
			-webkit-transform: scale(0);
			transform: scale(0);
			opacity: 1
		}
	}

	@keyframes scale-out-center {
		0% {
			-webkit-transform: scale(1);
			transform: scale(1);
			opacity: 1
		}
		100% {
			-webkit-transform: scale(0);
			transform: scale(0);
			opacity: 1
		}
	}

	.zz {
		position: fixed;
		width: 100%;
		height: 100%;
		background: rgba(0, 0, 0, 0.1);
		z-index: 99;
		top: 0;
	}

	.yap {
		color: red;
	}

	.yhz {
		color: blue;
	}

	.ft {
		font-size: 1.0rem;
	}

	.bodyft {
		font-size: 1.1rem;
	}

	.hz {
		width: 100%;
		height: 100%;
		background: rgba(0, 0, 0, 0.5);
		position: fixed;
		top: 0;
	}

	.dn {
		display: none;
	}

	::-webkit-scrollbar {
		width: 10px;
		background-color: #f2f2f2;
	}

	::-webkit-scrollbar-thumb {
		background-color: #c3cad4;
		border-radius: 10px;
		border: 2px solid #e1e5ea;
	}

	::-webkit-scrollbar-thumb:hover {
		background-color: #aab1bc;
	}

	::-webkit-scrollbar-thumb:active {
		border: 0;
		border-radius: 0;
		background-color: #737ed7
	}

	::-webkit-scrollbar-thumb:window-inactive {
		background-color: #4c97da
	}
</style>
<div class="oapd">

	<form class="layui-form layui-row" action="">
		<div class="layui-col-xs8">
			<div class="layui-inline">
				<label class="layui-form-label">开始时间</label>
				<div class="layui-input-inline">
					<input type="text" name="begintime" id="date1" value="2010-01-01" lay-verify="date"
						   placeholder="yyyy-MM-dd"
						   autocomplete="off" class="layui-input"></div>
			</div>
			<div class="layui-inline">
				<label class="layui-form-label">结束时间</label>
				<div class="layui-input-inline">
					<input type="text" name="endtime" id="date2" value="<?= date('Y-m-d') ?>" lay-verify="date"
						   placeholder="yyyy-MM-dd"
						   autocomplete="off" class="layui-input"></div>
			</div>

			<div class="layui-inline">
				<button type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">搜索</button>
			</div>
			<table class="layui-hide" id="order" lay-filter="order"></table>

			<script type="text/html" id="barDemo">
				<a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">取消订单</a>
				<a class="layui-btn layui-btn-xs" lay-event="edit">更改订单部门</a>
				<a class="layui-btn layui-btn-xs" lay-event="Reset">重置订单配送员</a>
				<a class="layui-btn layui-btn-xs" lay-event="band">用户ID绑定</a>
			</script>

		</div>
		<div class="layui-col-xs2">
			<div style="text-align: center;font-weight: bold">选择门店</div>
			<div id="department" class="demo-tree demo-tree-box"
				 style="width: 200px; height: 500px; overflow: scroll;overflow-x: hidden;float: right;clear: both"></div>
		</div>
		<div class="layui-col-xs2">
			<div style="text-align: center;font-weight: bold">选择商品</div>
			<div id="goods" class="demo-tree demo-tree-box"
				 style="width: 200px; height: 500px; overflow: scroll;overflow-x: hidden;float: right;clear: both"></div>
		</div>


	</form>
</div>

<script src="<?php echo base_url(); ?>/res/layui/layui.js" charset="utf-8"></script>
<script>
	layui.use(['jquery', 'form', 'layedit', 'laydate', 'element', 'tree', 'util', 'table'], function () {
		var form = layui.form
			, layer = layui.layer
			, layedit = layui.layedit
			, laydate = layui.laydate
			, table = layui.table
			, element = layui.element
			, $ = layui.$;
		var tree = layui.tree
			, util = layui.util;
		//监听行工具事件
		table.on('tool(order)', function (obj) {
			var data = obj.data;
			if (obj.event === 'del') {
				layer.confirm('确认取消订单？', function (index) {
					$.ajax({
						url: '/index.php/api/delorder',
						type: 'post',
						dataType: 'json',
						data: obj.data,
						success(res) {
							layer.close(index);
							if (res.code == 200) {
								layer.msg('取消成功');
								obj.update({
									stateshow: '取消'
								});
							} else {
								layer.msg('取消失败')
							}

						}
					})
				});
			} else if (obj.event === 'edit') {
				if ('<?php echo get_cookie('department');?>' == '预约中心' && obj.data.stateshow != '正常') {
					layer.msg('订单状态无法修改')
					return false
				} else {

					if (obj.data.department != '<?php echo get_cookie('department');?>') {
						layer.msg('无法修改其他门店订单')
						return false
					}
				}

				if (obj.data.department == '<?php echo get_cookie('department');?>' && obj.data.stateshow != '正常') {
					layer.msg('请先重置订单状态')
					return false
				}
				layer.open({
					type: 2,
					title: '修改订单部门',
					shadeClose: true,
					shade: 0.8,
					area: ['380px', '50%'],
					content: '/index.php/order/edirdeparment?department='+obj.data.department + '&serial_pay='+obj.data.serial_pay + '&id=' + obj.data.id + '&state=' + obj.data.stateshow
				});

			} else if (obj.event === 'Reset') {
				if ( obj.data.stateshow != '已安排') {
					layer.msg('订单状态无法重置')
					return false
				}
				if (obj.data.department != '<?php echo get_cookie('department');?>') {
					layer.msg('无法重置其他部门配送员')
					return false
				}
				layer.confirm('确认定重置配送员？', function (index) {
					$.ajax({
						url: '/index.php/api/resetorder',
						type: 'post',
						dataType: 'json',
						data: obj.data,
						success(res) {
							layer.close(index);
							if (res.code == 200) {
								layer.msg('重置成功');
								obj.update({
									deliveryman: '',
									stateshow: '正常',
								});
							} else {
								layer.msg('重置失败')
							}

						}
					})
				});
			} else if (obj.event === 'band') {
				alert(1)
			}
		});

		laydate.render({
			elem: '#date1'
		});
		laydate.render({
			elem: '#date2'
		});
		table.render({
			elem: '#order'
			, url: '/index.php/api/getorderjk'
			, toolbar: '#toolbarDemo' //开启头部工具栏，并为其绑定左侧模板
			, defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
				title: '提示'
				, layEvent: 'LAYTABLE_TIPS'
				, icon: 'layui-icon-tips'
			}]
			, page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
				layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'] //自定义分页布局
				, groups: 1 //只显示 1 个连续页码
				, first: false //不显示首页
				, last: false //不显示尾页
			}
			, height: 600
			, cols: [[
				{field: 'id', width: 80, title: 'ID', sort: true},
				{field: 'addtime', title: '时间', width: 200} //width 支持：数字、百分比和不填写。你还可以通过 minWidth 参数局部定义当前单元格的最小宽度，layui 2.2.1 新增
				, {field: 'mianname', title: '姓名', width: 200}
				, {field: 'department', title: '门店', width: 200}
				, {field: 'goodsname', title: '商品', width: 200}
				, {field: 'num', title: '数量', width: 200}
				, {field: 'mode', title: '方式', width: 200}
				, {field: 'miantelephone', title: '电话', width: 200}
				, {field: 'mianmemberid', title: '会员号', width: 200}
				, {field: 'mianaddress', title: '地址', width: 200} //单元格内容水平居中
				, {field: 'mianviplevel', title: '用户等级', width: 200} //单元格内容水平居中
				, {field: 'miancustomertype', title: '用户类型', width: 200}
				, {field: 'distributionmode', title: '安排方式', width: 200}
				, {field: 'deliveryman', title: '配送员', width: 200}
				, {field: 'arrangetime', title: '安排时间', width: 200}
				, {field: 'accepttime', title: '接收时间', width: 200}
				, {field: 'arrivetime', title: '送达时间', width: 200}
				, {field: 'feedbacktime', title: '汇总时间', width: 200}
				, {field: 'stateshow', title: '状态', fixed: 'right'}
				, {fixed: 'right', title: '操作', toolbar: '#barDemo', width: 400}
			]]
		});
		$.ajax({
			url: '/index.php/api/gettree',
			type: 'post',
			dataType: 'json',
			success: function (res) {
				//基本演示
				tree.render({
					elem: '#department'
					, data: res.data.department
					, showCheckbox: true  //是否显示复选框
					, accordion: true
					, id: 'demoId1'
					, isJump: true //是否允许点击节点时弹出新窗口跳转
					, click: function (obj) {
						var data = obj.data;  //获取当前点击的节点数据
						layer.msg('状态：' + obj.state + '<br>节点数据：' + JSON.stringify(data));
					}
				});
				tree.render({
					elem: '#goods'
					, data: res.data.goods
					, showCheckbox: true  //是否显示复选框
					, id: 'demoId2'
					, isJump: true //是否允许点击节点时弹出新窗口跳转
					, click: function (obj) {
						var data = obj.data;  //获取当前点击的节点数据
						layer.msg('状态：' + obj.state + '<br>节点数据：' + JSON.stringify(data));
					}
				});
			}
		})

	});
</script>

</body>
</html>

