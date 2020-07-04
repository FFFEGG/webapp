<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="<?php echo base_url(); ?>res/js/vue.js" charset="utf-8"></script>
	<script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>

	<script src="<?php echo base_url(); ?>res/js/sweetalert2.min.js"></script>
	<script src="<?php echo base_url(); ?>res/js/core.js"></script>
	<script src="<?php echo base_url(); ?>res/js/win10.child.js"></script>
	<link href="<?php echo base_url(); ?>res/css/sweetalert2.min.css" rel="stylesheet">


	<link rel="stylesheet" href="<?php echo base_url(); ?>res/css/index.css">
	<!-- 引入组件库 -->
	<script src="<?php echo base_url(); ?>res/js/index.js"></script>
	<link href="<?php echo base_url(); ?>/res/css/tailwind-ui.min.css" rel="stylesheet">
	<title></title>
</head>
<style>
	.el-form-item {
		margin-bottom: 0px !important;
	}
	.el-input-group__append, .el-input-group__prepend {
		background-color: #F5F7FA;
		color: #000;
		font-weight: bold;
		vertical-align: middle;
		display: table-cell;
		position: relative;
		border: 1px solid #DCDFE6;
		border-radius: 4px;
		padding: 0 20px;
		width: 1px;
		white-space: nowrap;
	}
</style>
<body>
<div id="app" class="p-2 px-6 text-sm">
	<el-form  :inline="true" class="demo-form-inline" @submit.native.prevent>
		<el-form-item>
			<el-input type="text"  placeholder="输入卡号" v-model="memberid"></el-input>
		</el-form-item>
		<el-form-item>
			<el-button type="primary" >搜索</el-button>
		</el-form-item>
	</el-form>
	<div class="grid grid-cols-4"  >
		<div class="flex">
			<el-input  placeholder="姓名" value="111">
				<template slot="prepend" >姓名</template>
			</el-input>
		</div>
		<div class="flex">
			<el-input  placeholder="电话">
				<template slot="prepend">电话</template>
			</el-input>
		</div>
		<div class="flex">
			<el-input  placeholder="类型">
				<template slot="prepend">类型</template>
			</el-input>
		</div>
		<div class="flex">
			<el-input  placeholder="余额">
				<template slot="prepend">余额</template>
			</el-input>
		</div>
		<div class="flex">
			<el-input  placeholder="状态">
				<template slot="prepend">状态</template>
			</el-input>
		</div>
		<div class="flex">
			<el-input  placeholder="单位">
				<template slot="prepend">单位</template>
			</el-input>
		</div>
		<div class="flex">
			<el-input  placeholder="信用额度">
				<template slot="prepend">信用额度</template>
			</el-input>
		</div>
		<div class="flex">
			<el-input  placeholder="开户时间">
				<template slot="prepend">开户时间</template>
			</el-input>
		</div>

		<div class="flex">
			<el-input  placeholder="住所类型">
				<template slot="prepend">住所类型</template>
			</el-input>
		</div>
		<div class="flex">
			<el-input  placeholder="用户等级">
				<template slot="prepend">用户等级</template>
			</el-input>
		</div>
		<div class="flex">
			<el-input  placeholder="归属部门">
				<template slot="prepend">归属部门</template>
			</el-input>
		</div>
		<div class="flex">
			<el-input  placeholder="业务员">
				<template slot="prepend">业务员</template>
			</el-input>
		</div>
		<div class="flex">
			<el-input  placeholder="发卡人">
				<template slot="prepend">发卡人</template>
			</el-input>
		</div>
		<div class="flex">
			<el-input  placeholder="发卡点">
				<template slot="prepend">发卡点</template>
			</el-input>
		</div>
		<div class="flex">
			<el-input  placeholder="计费时间">
				<template slot="prepend">计费时间</template>
			</el-input>
		</div>
		<div class="flex">
			<el-input  placeholder="备注">
				<template slot="prepend">备注</template>
			</el-input>
		</div>
		<div class="flex">
			<el-input  placeholder="下单时间">
				<template slot="prepend">下单时间</template>
			</el-input>
		</div>
		<div class="flex">
			<el-input  placeholder="下单商品">
				<template slot="prepend">下单商品</template>
			</el-input>
		</div>
		<div class="flex">
			<el-input  placeholder="地址">
				<template slot="prepend">地址</template>
			</el-input>
		</div>

	</div>
</div>
</body>
<script>
	new Vue({
		el: '#app',
		data() {
			return {
				memberid: '<?= $this->input->get('memberid')?>'
			}
		},
		methods: {},
		created() {
		}
	})
</script>
</html>
