<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>开户办卡</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>

	<!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<style>
	.layui-col-md3 {
		margin-bottom: 20px;
	}
</style>
<body>
<div class="oapd">
	<?php echo form_open('', 'class="layui-form layui-form-pane"'); ?>
	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label"><span style="color:red;font-size:20px;">*</span>会员号</label>
		<div class="layui-input-inline">
			<input type="text" name="memberid" value="" lay-verify="required" autocomplete="off"
				   placeholder="请输入会员号" class="layui-input memberid">
		</div>
	</div>


	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label"><span style="color:red;font-size:20px;">*</span>姓名</label>
		<div class="layui-input-inline">
			<input type="text" name="name" value="<?= $this->input->get('name') ?>" lay-verify="required" autocomplete="off"
				   placeholder="请输入姓名" class="layui-input">
		</div>
	</div>
	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label"><span style="color:red;font-size:20px;">*</span>电话</label>
		<div class="layui-input-inline">
			<input type="text" name="telephone" value="<?= $this->input->get('telephone') ?>" lay-verify="required"
				   autocomplete="off" placeholder="请输入电话" class="layui-input">
		</div>
	</div>

	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label">工作单位</label>
		<div class="layui-input-inline">
			<input type="text" name="workplace" value=""
				   autocomplete="off" placeholder="请输入工作单位" class="layui-input">
		</div>
	</div>


	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label"><span style="color:red;font-size:20px;">*</span>省</label>
		<div class="layui-input-inline">
			<input type="text" name="province" value="广西壮族自治区" lay-verify="required"
				   autocomplete="off" placeholder="请输入输入省" class="layui-input">
		</div>
	</div>

	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label"><span style="color:red;font-size:20px;">*</span>市</label>
		<div class="layui-input-inline">
			<select name="city" lay-filter="city" lay-verify="required">
				<option selected value="">请选择</option>
				<?php foreach ($city as $v) { ?>
					<option <?php if ($this->input->get('city') == $v['name']) { echo 'selected';}?> value="<?= $v['name'] ?>"><?= $v['name'] ?></option>
				<?php } ?>

			</select>
		</div>
	</div>
	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label"><span style="color:red;font-size:20px;">*</span>区</label>
		<div class="layui-input-inline">
			<select name="area" class="area" lay-filter="area" lay-verify="required">

				<option value="">请选择</option>

			</select>
		</div>
	</div>
	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label"><span style="color:red;font-size:20px;">*</span>街道办</label>
		<div class="layui-input-inline">
			<select name="town" class="town" lay-verify="required">
				<option value="">请选择</option>
			</select>
		</div>
	</div>


	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label"><span style="color:red;font-size:20px;">*</span>街道</label>
		<div class="layui-input-inline">
			<input type="text" name="street" value="<?= $this->input->get('street') ?>" lay-verify="required"
				   autocomplete="off" placeholder="请输入街道" class="layui-input">
		</div>
	</div>

	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label">区域编码</label>
		<div class="layui-input-inline">
			<input type="text" name="regionalcode" value=""
				   autocomplete="off" placeholder="请输入区域编码" class="layui-input">
		</div>
	</div>

	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label">门牌号</label>
		<div class="layui-input-inline">
			<input type="text" name="housenumber" value=""
				   autocomplete="off" placeholder="请输入门牌号" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label"><span style="color:red;font-size:20px;">*</span>详细地址</label>
		<div class="layui-input-block">
			<input type="text" name="address" value="<?= $this->input->get('address') ?>" lay-verify="required"
				   autocomplete="off" placeholder="请输入详细地址" class="layui-input">
		</div>
	</div>
	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label"><span style="color:red;font-size:20px;">*</span>住所类型</label>
		<div class="layui-input-inline">
			<select name="housingproperty" id="">
				<option <?php if ($this->input->get('housingproperty') == '住宅小区') { echo 'selected';}?> value="住宅小区">住宅小区</option>
				<option <?php if ($this->input->get('housingproperty') == '私人房') { echo 'selected';}?> value="私人房">私人房</option>
				<option <?php if ($this->input->get('housingproperty') == '临街铺面') { echo 'selected';}?> value="临街铺面">临街铺面</option>
			</select>
		</div>
	</div>

	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label"><span style="color:red;font-size:20px;">*</span>用户类型</label>
		<div class="layui-input-inline">
			<select name="customertype" id="">
				<option <?php if ($this->input->get('customertype') == '工业用户') { echo 'selected';}?> value="工业用户">工业用户</option>
				<option <?php if ($this->input->get('customertype') == '商业用户') { echo 'selected';}?> value="商业用户">商业用户</option>
				<option <?php if ($this->input->get('customertype') == '家庭用户') { echo 'selected';}?> value="家庭用户">家庭用户</option>
				<option <?php if ($this->input->get('customertype') == '代销用户') { echo 'selected';}?> value="代销用户">代销用户</option>
			</select>
		</div>
	</div>
	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label">业务员</label>
		<div class="layui-input-inline">
			<select name="salesman" id="">
				<option value=""></option>
				<?php foreach ($salesman as $v) { ?>
					<option  value="<?= $v['name'] ?>"><?= $v['name'] ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label">用户等级</label>
		<div class="layui-input-inline">
			<select name="viplevel" id="" disabled>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option selected value="5">5</option>
			</select>
			<input type="hidden" name="viplevel" value="5">
		</div>
	</div>
	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label">计费月日</label>
		<div class="layui-input-inline">
			<input type="text" name="billingtime" id="billingtime" value="<?= date('Y-m-d', time()) ?>"
				   lay-verify="date" disabled placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
		</div>
		<input type="hidden" name="billingtime" value="<?= date('Y-m-d', time()) ?>">
	</div>
	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label"><span style="color:red;font-size:20px;">*</span>归属部门</label>
		<div class="layui-input-inline">
			<select name="attributiondepartment">
				<?php foreach ($_SESSION['initData']->Department->info as $v) { ?>
					<?php if ($v->area == '用户归属') {?>
					<option <?php if ($this->input->get('attributiondepartment') == $v->name) { echo 'selected';}?> value="<?= $v->name ?>"><?= $v->name ?></option>
					<?php } ?>
				<?php } ?>
			</select>
		</div>
	</div>

	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label"><span style="color:red;font-size:20px;">*</span>业务门店</label>
		<div class="layui-input-inline">
			<select name="distributiondepartmentid">
				<?php foreach ($_SESSION['initData']->Department->info as $v) {
					if ($v->type == '业务门店') { ?>

						<option <?php if ($this->input->get('department') == $v->name) { echo 'selected';}?> value="<?= $v->id ?>"><?= $v->name ?></option>
					<?php }
				} ?>
			</select>
		</div>
	</div>

	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label">其他人员</label>
		<div class="layui-input-inline">
			<input type="text" name="commissionofficer" autocomplete="off" class="layui-input">
		</div>
	</div>
	<input type="hidden" name="quota" value="0">
	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label">信用额度</label>
		<div class="layui-input-inline">
			<input disabled type="text" style="color: red" name="quota" value="0" lay-verify="required"
				   autocomplete="off" placeholder="请输入额度" class="layui-input">
		</div>
	</div>
	<div class="layui-inline layui-col-md3">
		<label class="layui-form-label">密码</label>
		<div class="layui-input-inline">
			<input type="text" name="password" value="" autocomplete="off"
				   placeholder="密码(可选)" class="layui-input">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">备注</label>
		<div class="layui-input-block">
			<input type="text" name="remarks" value=""
				   autocomplete="off" placeholder="请输入备注" class="layui-input">
		</div>
	</div>

	<div class="layui-form-item">
		<button class="layui-btn" lay-submit="" lay-filter="demo2">确认添加</button>
	</div>
	</form>
</div>
<script src="<?php echo base_url(); ?>/res/layui/layui.js" charset="utf-8"></script>

<script>
  layui.use(['jquery', 'form', 'layedit', 'laydate', 'element','layer'], function () {
    var form = layui.form
        , layer = layui.layer
        , layedit = layui.layedit
        , laydate = layui.laydate
        , laydate = layui.laydate
        , element = layui.element
        , $ = layui.$;
    //日期
    laydate.render({
      elem: '#billingtime'
    });
    form.on('select(city)', function (data) {
      $.ajax({
        url: '/index.php/user/getarea',
        method: 'get',
        dataType: 'json',
        data: {
          city: data.value
        },
        success(res) {

          $('.area').empty();
          var str = '';
          var select_area = res.select_area;
          for (i in select_area) {
          	if (select_area[i]['name'] == '<?= $this->input->get('area')?>') {
				str += '<option selected value="' + select_area[i]['name'] + '">' + select_area[i]['name'] + '</option>'
			} else {
				str += '<option  value="' + select_area[i]['name'] + '">' + select_area[i]['name'] + '</option>'
			}

          }
          $('.area').append(str);

          $('.town').empty();
          var street_str = '';
          var select_twon = res.select_twon;
          for (j in select_twon) {
          	if (select_twon[j]['name'] == '<?= $this->input->get('town')?>') {
				street_str += '<option selected value="' + select_twon[j]['name'] + '">' + select_twon[j]['name'] + '</option>'
			} else {
				street_str += '<option  value="' + select_twon[j]['name'] + '">' + select_twon[j]['name'] + '</option>'
			}
          }
          $('.town').append(street_str);


          form.render()
        }
      })

    });
    form.on('select(area)', function (data) {
      $.ajax({
        url: '/index.php/user/getTwon',
        method: 'get',
        dataType: 'json',
        data: {
          city: data.value
        },
        success(res) {

          $('.town').empty();
          var street_str = '';
          var select_twon = res.select_twon;
          for (j in select_twon) {
            street_str += '<option  value="' + select_twon[j]['name'] + '">' + select_twon[j]['name'] + '</option>'
          }
          $('.town').append(street_str);


          form.render()
        }
      })
    })
  });
  $(".memberid").blur(function(){
	  var memeberid = $(this).val()
	  let that = $(this)
	  $.ajax({
		  url: '/index.php/api/getUserInfocheck',
		  method: 'post',
		  dataType: 'json',
		  data: {
		  	'cardid': memeberid
		  },
		  success:function (rew) {
			if (rew.data) {
				layer.msg('卡号已存在')
				that.val('')
			}
		  }
	  })
  });
</script>
<?php if (get_cookie('success')) { ?>
	<script>
      layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
        var form = layui.form
            , layer = layui.layer
            , layedit = layui.layedit
            , laydate = layui.laydate
            , element = layui.element
            , $ = layui.$; //重点处
        layer.msg('添加成功');
      });
	</script>
<?php } ?>
</body>
</html>
