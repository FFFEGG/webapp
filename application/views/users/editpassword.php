<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>修改密码</title>
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

</style>
<body>
<div class="oapd">
		<?php echo form_open('', 'class="layui-form layui-form-pane"'); ?>

		<div class="layui-form-item">
			<label class="layui-form-label">原密码</label>
			<div class="layui-input-block">
				<input type="password" name="oldpassword" value="" lay-verify="required" autocomplete="off"
					   placeholder="原密码" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">新密码</label>
			<div class="layui-input-block">
				<input type="password" name="newpassword" value="" lay-verify="required"
					   autocomplete="off" placeholder="新密码" class="layui-input">
			</div>
		</div>


		<div class="layui-form-item">
			<button class="layui-btn" lay-submit="" lay-filter="demo2">确认修改</button>
		</div>
	</form>
</div>
<script src="<?php echo base_url(); ?>/res/layui/layui.js" charset="utf-8"></script>

<script>
    layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
        var form = layui.form
            , layer = layui.layer
            , layedit = layui.layedit
            , laydate = layui.laydate
            , element = layui.element
            , $ = layui.$;

			form.on('select(city)', function(data){
				$.ajax({
					url: '/index.php/user/getarea',
					method: 'get',
                    dataType: 'json',
					data: {
					    city: data.value
					},
					success(res) {

						$('.area').empty()
						var str = 	'';
                        var select_area = res.select_area
					    for (i in select_area) {
					        str += '<option  value="'+select_area[i]['name']+'">'+select_area[i]['name']+'</option>'
						}
                        $('.area').append(str)

                        $('.town').empty()
                        var street_str = 	'';
                        var select_twon = res.select_twon
                        for (j in select_twon) {
                            street_str += '<option  value="'+select_twon[j]['name']+'">'+select_twon[j]['name']+'</option>'
                        }
                        $('.town').append(street_str)


						form.render()
					}
				})

			});
			form.on('select(area)', function(data){
                $.ajax({
                    url: '/index.php/user/getTwon',
                    method: 'get',
                    dataType: 'json',
                    data: {
                        city: data.value
                    },
                    success(res) {

                        $('.town').empty()
                        var street_str = 	'';
                        var select_twon = res.select_twon
                        for (j in select_twon) {
                            street_str += '<option  value="'+select_twon[j]['name']+'">'+select_twon[j]['name']+'</option>'
                        }
                        $('.town').append(street_str)


                        form.render()
                    }
                })
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
            layer.msg('修改成功');
        });
	</script>
<?php } ?>
<?php if (get_cookie('error')) { ?>
	<script>
        layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function () {
            var form = layui.form
                , layer = layui.layer
                , layedit = layui.layedit
                , laydate = layui.laydate
                , element = layui.element
                , $ = layui.$; //重点处
            layer.msg('修改失败');
        });
	</script>
<?php } ?>
</body>
</html>
