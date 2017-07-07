<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
        <title>WeUI</title>
        <link rel="stylesheet" href="/Public/weui.min.css"/>
     

<script type="text/javascript" src="../../Public/weui.min.js"></script>
<script type="text/javascript" src="../../Public/jquery-1.8.3.min.js"></script>
    

<script type="text/javascript">
    weui.alert('alert');
</script>
    </head>

    <body>

    <div class="weui-mask">11111111111asdasd11</div>
    <div class="weui-dialog">
        <div class="weui-dialog__hd"><strong class="weui-dialog__title">弹窗标题</strong></div>
        <div class="weui-dialog__bd">弹窗内容，告知当前页面信息等</div>
        <div class="weui-dialog__ft">
            <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary">确定</a>
        </div>
    </div>

<div class="weui-cells">
     <div class="weui-cell">
        <div class="weui-cell_hd">列的header</div>
         <div class="weui-cell_bd">列的内容</div>
         <div class="weui-cell_ft">列的右侧（默认有一个箭头）</div>
     </div>
     <div class="weui-cell">
        <div class="weui-cell_hd">列的header2</div>
         <div class="weui-cell_bd">列的内容2</div>
         <div class="weui-cell_ft">列的右侧（默认有一个箭头）2</div>
     </div>
 </div>

 <a href="javascript:;" class="weui-btn weui-btn_default">按钮</a>
 <div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__hd" style="position: relative;margin-right: 10px;">
                    <img src="images/pic_160.png" style="width: 50px;display: block"/>
                    <span class="weui-badge" style="position: absolute;top: -.4em;right: -.4em;">8</span>
                </div>
                <div class="weui-cell__bd">
                    <p>联系人名称</p>
                    <p style="font-size: 13px;color: #888888;">摘要信息</p>
                </div>
            </div>
            <div class="weui-cell weui-cell_access">
                <div class="weui-cell__bd">
                    <span style="vertical-align: middle">单行列表</span>
                    <span class="weui-badge" style="margin-left: 5px;">8</span>
                </div>
                <div class="weui-cell__ft"></div>
            </div>
            <div class="weui-cell weui-cell_access">
                <div class="weui-cell__bd">
                    <span style="vertical-align: middle">单行列表</span>
                    <span class="weui-badge" style="margin-left: 5px;">8</span>
                </div>
                <div class="weui-cell__ft">详细信息</div>
            </div>
            <div class="weui-cell weui-cell_access">
                <div class="weui-cell__bd">
                    <span style="vertical-align: middle">单行列表</span>
                    <span class="weui-badge" style="margin-left: 5px;">New</span>
                </div>
                <div class="weui-cell__ft"></div>
            </div>
        </div>
<div class="weui-cells__title">单选列表项</div>
<div class="weui-cells weui-cells_radio">
    <label class="weui-cell weui-check__label" for="x11">
        <div class="weui-cell__bd">
            <p>cell standard</p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" class="weui-check" name="radio1" id="x11">
            <span class="weui-icon-checked"></span>
        </div>
    </label>
    <label class="weui-cell weui-check__label" for="x12">

        <div class="weui-cell__bd">
            <p>cell standard</p>
        </div>
        <div class="weui-cell__ft">
            <input type="radio" name="radio1" class="weui-check" id="x12" checked="checked">
            <span class="weui-icon-checked"></span>
        </div>
    </label>
    <a href="javascript:void(0);" class="weui-cell weui-cell_link">
        <div class="weui-cell__bd">添加更多</div>
    </a>
</div>
<div class="weui-cells__title">复选列表项</div>
<div class="weui-cells weui-cells_checkbox">
    <label class="weui-cell weui-check__label" for="s11">
        <div class="weui-cell__hd">
            <input type="checkbox" class="weui-check" name="checkbox1" id="s11" checked="checked">
            <i class="weui-icon-checked"></i>
        </div>
        <div class="weui-cell__bd">
            <p>standard is dealt for u.</p>
        </div>
    </label>
    <label class="weui-cell weui-check__label" for="s12">
        <div class="weui-cell__hd">
            <input type="checkbox" name="checkbox1" class="weui-check" id="s12">
            <i class="weui-icon-checked"></i>
        </div>
        <div class="weui-cell__bd">
            <p>standard is dealicient for u.</p>
        </div>
    </label>
    <a href="javascript:void(0);" class="weui-cell weui-cell_link">
        <div class="weui-cell__bd">添加更多</div>
    </a>
</div>

<div class="weui-cells__title">表单</div>
<div class="weui-cells weui-cells_form">
    <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">qq</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入qq号"/>
        </div>
    </div>
    <div class="weui-cell weui-cell_vcode">
        <div class="weui-cell__hd">
            <label class="weui-label">手机号</label>
        </div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="tel" placeholder="请输入手机号">
        </div>
        <div class="weui-cell__ft">
            <a href="javascript:;" class="weui-vcode-btn">获取验证码</a>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label for="" class="weui-label">日期</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="date" value=""/>
        </div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__hd"><label for="" class="weui-label">时间</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="datetime-local" value="" placeholder=""/>
        </div>
    </div>
    <div class="weui-cell weui-cell_vcode">
        <div class="weui-cell__hd"><label class="weui-label">验证码</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="number" placeholder="请输入验证码"/>
        </div>
        <div class="weui-cell__ft">
            <img class="weui-vcode-img" src="./images/vcode.jpg" />
        </div>
    </div>
</div>
<div class="weui-cells__tips">底部说明文字底部说明文字</div>

<div class="weui-cells__title">表单报错</div>
<div class="weui-cells weui-cells_form">
    <div class="weui-cell weui-cell_warn">
        <div class="weui-cell__hd"><label for="" class="weui-label">卡号</label></div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="number" pattern="[0-9]*" value="weui input error" placeholder="请输入卡号"/>
        </div>
        <div class="weui-cell__ft">
            <i class="weui-icon-warn"></i>
        </div>
    </div>
</div>


<div class="weui-cells__title">开关</div>
<div class="weui-cells weui-cells_form">
    <div class="weui-cell weui-cell_switch">
        <div class="weui-cell__bd">标题文字</div>
        <div class="weui-cell__ft">
            <input class="weui-switch" type="checkbox"/>
        </div>
    </div>
</div>

<div class="weui-cells__title">文本框</div>
<div class="weui-cells">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <input class="weui-input" type="text" placeholder="请输入文本"/>
        </div>
    </div>
</div>

<div class="weui-cells__title">文本域</div>
<div class="weui-cells weui-cells_form">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <textarea class="weui-textarea" placeholder="请输入文本" rows="3"></textarea>
            <div class="weui-textarea-counter"><span>0</span>/200</div>
        </div>
    </div>
</div>

<div class="weui-cells__title">选择</div>
<div class="weui-cells">

    <div class="weui-cell weui-cell_select weui-cell_select-before">
        <div class="weui-cell__hd">
            <select class="weui-select" name="select2">
                <option value="1">+86</option>
                <option value="2">+80</option>
                <option value="3">+84</option>
                <option value="4">+87</option>
            </select>
        </div>
        <div class="weui-cell__bd">
            <input class="weui-input" type="number" pattern="[0-9]*" placeholder="请输入号码"/>
        </div>
    </div>
</div>
<div class="weui-cells__title">选择</div>
<div class="weui-cells">
    <div class="weui-cell weui-cell_select">
        <div class="weui-cell__bd">
            <select class="weui-select" name="select1">
                <option selected="" value="1">微信号</option>
                <option value="2">QQ号</option>
                <option value="3">Email</option>
            </select>
        </div>
    </div>
    <div class="weui-cell weui-cell_select weui-cell_select-after">
        <div class="weui-cell__hd">
            <label for="" class="weui-label">国家/地区</label>
        </div>
        <div class="weui-cell__bd">
            <select class="weui-select" name="select2">
                <option value="1">中国</option>
                <option value="2">美国</option>
                <option value="3">英国</option>
            </select>
        </div>
    </div>
</div>

<label for="weuiAgree" class="weui-agree">
    <input id="weuiAgree" type="checkbox" class="weui-agree__checkbox">
    <span class="weui-agree__text">
        阅读并同意<a href="javascript:void(0);">《相关条款》</a>
    </span>
</label>

<div class="weui-btn-area">
    <a class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips">确定</a>
</div>

    </body>
    <script type="text/javascript">
    weui.alert('alert');
</script>
</html>