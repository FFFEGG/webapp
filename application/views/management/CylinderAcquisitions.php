<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>钢瓶收购</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/res/layui/css/layui.css" media="all">
    <script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/res/js/jquery-2.2.4.min.js"></script>
    <script src="<?php echo base_url(); ?>/res/js/win10.child.js"></script>

</head>

<body>

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>会员<?= $this->input->get('memberid') ?> - <?php echo $this->input->get('name'); ?>钢瓶收购</legend>
    </fieldset>
    <div class="oapd">


        <?php echo form_open('', 'class="layui-form" id="gpsgform"'); ?>
        <input type="hidden" name="userid" value="<?= $this->input->get('userid') ?>">
        <input type="hidden" name="memberid" value="<?= $this->input->get('memberid') ?>">
        <input type="hidden" name="name" value="<?= $this->input->get('name') ?>">

        <div class="layui-form-item">
            <label class="layui-form-label">包装物类型</label>
            <div class="layui-input-block">
                <select name="packingtype" lay-filter="aihao" lay-verify="required">
                    <option value=""></option>
                    <?php foreach ($_SESSION['initData']->Packingtype->info as $v) { ?>
                        <option value="<?= $v->name ?>"><?= $v->name ?></option>
                    <?php } ?>

                </select>
            </div>
        </div>





        <div class="layui-form-item">
            <label class="layui-form-label">生产日期
            </label>
            <div class="layui-input-block">
                <select name="" id="">
                    <option value="2010">2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                </select>
            </div>
        </div>



        <div class="layui-form-item">
            <label class="layui-form-label">检测日期
            </label>
            <div class="layui-input-block">
                <select name="" id="">
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="无">无</option>
                </select>
            </div>
        </div>

        


        <div class="layui-form-item">
            <label class="layui-form-label">是否报废
            </label>
            <div class="layui-input-block">
                <select name="" id="">
                    <option value="否">否</option>
                    <option value="是">是</option>
                </select>
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">收购价格
            </label>
            <div class="layui-input-block">
                <input type="text" name="price" lay-verify="required" autocomplete="off" placeholder="收购价格" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">经手人</label>
            <div class="layui-input-block">
                <select name="brokerage" lay-filter="aihao" lay-verify="required">
                    <option value=""></option>
                    <?php foreach ($_SESSION['AreaDeliverymanList'] as $v) { ?>
                        <option value="<?= $v->name ?>"><?= $v->name ?></option>
                    <?php } ?>

                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">备注
            </label>
            <div class="layui-input-block">
                <input type="text" name="remarks" autocomplete="off" placeholder="备注(可选)" class="layui-input">
            </div>
        </div>


        <div class="layui-form-item">
            <div class="layui-input-block">

                <button type="submit" class="layui-btn" lay-submit="" lay-filter="gpsg">确认办理</button>
            </div>
        </div>
        </form>

    </div>

</body>

<script src="<?php echo base_url(); ?>/res/layui/layui.js" charset="utf-8"></script>
<script>
    layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function() {
        var form = layui.form,
            layer = layui.layer,
            layedit = layui.layedit,
            laydate = layui.laydate,
            element = layui.element,
            $ = layui.$; //重点处
        //监听提交
        form.on('submit(gpsg)', function(data) {
            if (!data.field.packingtype) {
                layer.msg('请选择包装物类型');
                return false;
            }
            if (!data.field.price) {
                layer.msg('请填写收购价格');
                return false;
            }
            layer.open({
                type: 1,
                title: false //不显示标题栏
                    ,
                closeBtn: false,
                area: '400px;',
                shade: 0.8,
                id: 'LAY_layuipro' //设定一个id，防止重复弹出
                    ,
                btn: ['确认', '取消'],
                btnAlign: 'c',
                moveType: 1 //拖拽模式，0或者1
                    ,
                content: '<div  style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">' +
                    '<h3>信息确认</h3>' +
                    '<p>包装物类型:' + data.field.packingtype + '</p>' +
                    '<p>收购价格:' + data.field.price + '</p>' +
                    '<p>备注:' + data.field.remarks + '</p></div>',
                yes: function() {
                    $('#gpsgform').submit();
                },
                btn2: function() {
                    layer.closeAll();
                }

            });

            return false;
        });
        form.on('radio(goods)', function(data) {
            var arr = data.value.split("|");
            $('.price_dyw').attr('value', arr[1]);
        });

    });
</script>
<?php if (get_cookie('Cylindercquisition')) { ?>
    <script>
        layui.use(['jquery', 'form', 'layedit', 'laydate', 'element'], function() {
            var form = layui.form,
                layer = layui.layer,
                layedit = layui.layedit,
                laydate = layui.laydate,
                element = layui.element,
                $ = layui.$; //重点处
            layer.msg('办理成功！')
            return false
            layer.open({
                type: 1,
                title: false //不显示标题栏
                    ,
                closeBtn: false,
                area: '300px;',
                shade: 0.8,
                id: 'LAY_layuipro_2' //设定一个id，防止重复弹出
                    ,
                btn: ['打印票据', '关闭窗口'],
                btnAlign: 'c',
                moveType: 1 //拖拽模式，0或者1
                    ,
                content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">办理成功</div>',
                yes: function() {
                    Win10_child.openUrl('/index.php/<?php echo $url; ?>', '抵押物库存信息')
                },
                btn2: function() {
                    layer.closeAll();
                }
            });

        });
    </script>
<?php } ?>



<?php if (get_cookie('printinfo')) { ?>
    <script src="<?php echo base_url(); ?>res/js/axios.js" charset="utf-8"></script>
    <script>
        const data = <?= get_cookie('printinfo') ?>;

        if (data.type == '收购钢瓶单') {

            var jsonp = {
                title: "南宁三燃公司收购钢瓶单",
                time: data.topinfo,
                memberid: "来源  " + data.memberid,
                name: data.department + "办理",
                Memo1: '',
                Memo2: '',
                Memo3: '钢瓶: ' + data.goods,
                Memo4: '收购价格: ' + data.pay_cash + "元",
                Memo5: '营业员: ' + data.operator,
                Memo6: '配送员签字：',
                Memo7: '用户签字：',
            }
            var data_infop = {
                PrintData: jsonp,
                Print: true
            }
            axios.get('http://127.0.0.1:8000/api/print/order/9/?data=' + JSON.stringify(data_infop)).then(rew => {
                console.log(rew)
            })
        }
    </script>
<?php } ?>

</html>
