<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>简单实用响应式个人博客HTML5网站模板</title>
<meta name="keywords" content="简单实用,响应式,个人博客,HTML5网站模板" />
<meta name="description" content="简单实用响应式个人博客HTML5网站模板下载。本套个人博客模板设计简洁大气，自适应手机移动端，简单易用。下载文件包含首页、多个列表页、导航页、关于我、往期文章等8张html网页模板，详见在线演示。使用最新HTML5+CSS3技术，采用响应式布局设计，自适应手机移动端，用户体验友好的一套个人博客网站模板。" />
<meta name="author" content="php中文网(www.php.cn)" />
<meta name="copyright" content="php中文网(www.php.cn)" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="<?php echo e(asset('/home/css/')); ?>/base.css" rel="stylesheet">
<link href="<?php echo e(asset('/home/css/')); ?>/m.css" rel="stylesheet">
<script src="<?php echo e(asset('/home/js/')); ?>/jquery-1.8.3.min.js" ></script>
<script src="<?php echo e(asset('/home/js/')); ?>/comm.js"></script>
<!--[if lt IE 9]>
<script src="<?php echo e(asset('/index/js/')); ?>/modernizr.js"></script>
<![endif]-->
</head>
<body>
<!--top begin-->
<header id="header">
  <div class="navbox">
    <h2 id="mnavh"><span class="navicon"></span></h2>
    <div class="logo"><a href="index.html"><?php echo e($blogall->name); ?>个人博客</a></div>
    <nav>
      <ul id="starlist">
        <li><a href="/">首页</a></li>
        <li><a href="list.html">个人博客日记</a></li>
        <li class="menu"><a href="list2.html">博客网站制作</a>
          <ul class="sub">
            <li><a href="#">推荐工具</a></li>
            <li><a href="#">JS经典实例</a></li>
            <li><a href="#">网站建设</a></li>
            <li><a href="#">CSS3|Html5</a></li>
            <li><a href="#">心得笔记</a></li>
          </ul>
          <span></span></li>
        <li><a href="/home/mycenter">个人中心</a></li>
        <li><a href="/message">留言板</a></li>
        <li><a href="about.html">关于我</a></li>
      </ul>
    </nav>

    <div class="searchico"></div>
    <div class="loginico"></div>
  </div>
</header>

<div class="searchbox">
  <div class="search">
    <form action="/e/search/index.php" method="post" name="searchform" id="searchform">
      <input name="keyboard" id="keyboard" class="input_text" value="请输入关键字词" style="color: rgb(153, 153, 153);" onFocus="if(value=='请输入关键字词'){this.style.color='#000';value=''}" onBlur="if(value==''){this.style.color='#999';value='请输入关键字词'}" type="text">
      <input name="show" value="title" type="hidden">
      <input name="tempid" value="1" type="hidden">
      <input name="tbname" value="news" type="hidden">
      <input name="Submit" class="input_submit" value="搜索" type="submit">
    </form>
  </div>
  <div class="searchclose"></div>

</div>
<div class="loginbox">
  <div class="login">
    <h3 style="text-align: center;">登录</h3>
    <form action="/login" method="post" name="loginform" id="loginform">

      <input name="email"  class="logininput" placeholder="请输入邮箱" style="color: rgb(153, 153, 153);" type="text">
       <input name="passwd"  placeholder="请输入密码" class="logininput" style="color: rgb(153, 153, 153);" type="text">
      <button type="button" id='login' value="登录" >登录</button>
      <button  type="button" id='login' value="注册">注册</button>

    </form>
    <div id="error" style="color: #F1B0B7;"></div>
  </div>

  <div class="loginclose"></div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        

    $('#login').on('click',function(){

             var passwd = $("input[name='passwd']").val();
             var email =  $("input[name='email']").val();
             pdata = {
                 "_token":"<?php echo e(csrf_token()); ?>",
                 "passwd":passwd,
                 "email":email,
                 }
             $.ajax({
                 type:"POST",
                 url:'/login', //你的请求程序页面随便啦
                 data:pdata,//请求需要发送的处理数据
                 success:function(data){
                    if(data.status == 0){
                        alert(data.message);
                        $(".loginbox").removeClass("open");
                    }else{
                        alert(data.message);
                    }
                 },
                 error:function(data) {
                     if(data.status === 422){
                           var errors = $.parseJSON(data.responseText);    //转json格式，或直接使用 data.responseJSON
                                $.each(errors, function (key, value) {
                                $('#error').addClass("alert alert-danger");
                                if ($.isPlainObject(value)) {
                                    $.each(value, function (key, value) {
                                        $('#error').show().html(value + "<br/>");}
                                    );
                                } else {
                                    $('#error').show().html(value + "<br/>"); //this is my div with messages
                                }
                            });

                     }
                 }
              })


    })

   })

</script>
<?php /**PATH D:\blog\resources\views/home/public/header.blade.php ENDPATH**/ ?>