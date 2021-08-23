@include('home.public.header')
<style>
    .banbox{
        height: 800px;
    }
    form > div{
        box-sizing: border-box;

        width: 300px;
    }
   form  input {
       padding: 3px;
       margin-top: 10px;
       width: 300px;
       height: 30px;
   }
   form > div > div{
       padding: 3px;
       margin-top: 10px;
       width: 300px;
       height: 40px;
   }
    form button {
       margin-top: 15px;
       width: 300px;
       height: 30px;
   }
    form >div> a{
        margin-top: 10px;
        color: red;
        font-size: 12px;
        float: right;
    }
    form . img {
       margin-top: 10px;
       width: 300px;
       height: 30px;
   }
</style>
<article>
<div class="lbox">
<div class="banbox">
    <h2>用户中心</h2>

     <form action="">
         <div>
         <input type="text" id="email" placeholder="请输入邮箱" value="" name="email"><br>

         <input type="text" id="code" placeholder="请输入验证码" name="code"> <br>
         <div> <img src="{{captcha_src()}}"  style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()"></div>
         <button type="button" onclick="getcode()">点此获取邮箱验证码<span id="time"></span></button><br>
         <input type="text" placeholder="请输入用户名" name="user"><br>
         <input type="password" placeholder="请输入密码"><br>
         <input type="password" placeholder="请确认密码">
         <button type="button" onclick="">提交</button>
         </div>
     </form>
</div>
</div>
<div class="rbox">


</div>
<script>

    var $t = 60;
    function getcode(){

        var email = $("#email").val();
        console.log(email)
        var pattern = /^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;
        if(!pattern.test(email)){
            return alert('请输入正确的邮箱地址！');
        }

        var st = setInterval(() =>{
        //console.log($t)
        $("#time").text($t);
        if($t<=0){
            $t = 60
            clearInterval(st);
            $("#time").text();
        }
        $t--;
        },1000);

          var code =  $("#code").val();
        var data = {
             "_token":"{{csrf_token()}}",
             "email":email,
             "captcha":code,
        }
        $.ajax({
            type:'POST',
            url:'/home/code',
            data:data,
            sussess:function(){
                alert(1);
            },
        })

    }
    $(document).ready(function(){

    })
</script>
</article>
@include('home.public.footer')
