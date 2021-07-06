
@include('home.public.header')

<script src="https://cdn.jsdelivr.net/npm/wangeditor@latest/dist/wangEditor.min.js"></script>
<style>
    .btn{
        float: right;
        background-color: #E2E3E5;
        border: 2px;
        width:100%;
        padding: 2px;
        border-radius: 10px;
        position: relative;
        top: -61px;

    }

    .w-e-toolbar .w-e-menu {
        z-index: 0 !important;
      }
      .w-e-text-container {
        z-index: 0 !important;
      }
      .msg-lst{
          display: -webkit-flex;
          display: flex;
         -webkit-flex-direction: row;
          flex-direction: row;
          margin: 3px;
          max-height: 700px;
          margin-top:20px ;
          width: 100%;
          box-sizing: border-box;

      }
      /*头像*/
      .cav{
          text-align: center;
          position: relative;
          overflow: hidden;
          float: left;
          font-size: 38px;
           line-height: 60px;
          height: 60px;
          width: 60px;
          min-width: 60px;
          border-radius: 30px;
          background-color: rgba(111,111,111,0.2);
      }

       .email{

           border-bottom: #E4E3E3 double 1px;
           margin-left: 10px;
           height: 20px;
           color: #222;
           width: 85%;
           font-weight: bold;
       }
       .contentbox{
           width: 100%;
           float: left;

       }
       .content{
           overflow: hidden;
           margin-left: 10px;
            width: 85%;
       }
       .hasmany{
           width: 160px;
           height: 60px;
           animation: tip 3s;
           -webkit-animation: tip 3s;
           display: none;
           margin:200px auto;
       }
       @keyframes  tip{
           from{display: block;}
           to{display: none;}
       }
       @-webkit-keyframes tip{
           from{display: block;}
           to{display: none;}
       }
       .addmessage{
           width: 100%;
           margin: 0 auto;
       }
</style>
<script src="{{asset('/home/js/vue.min.js')}}"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/axios/0.21.1/axios.min.js"></script>
<article>

  <div class="whitebg" style="background-color:#fff;">
   <div class="hasmany" v-show="hasmany">没有更多</div>
  <div id="app">
      <form style="margin: 20px 0px;border: 2px solid #FFFF00;" style="position: absolute;" action="" >
           <div id="div1" >

           </div>
          <textarea hidden="hidden" name="mssage" id="text1"  cols="30" rows="10">
              @{{msg}}
          </textarea>
          <input style="height: 60px;" type="button" value="留言" class="btn" @click.stop="submit()">
      </form>
      <div >
          <div >
            <ul>
                <li class="msg-lst"  v-for="item in message">
                    <div class="cav">
                        <div v-if="item.homeuser.thumb"><img style="width: 100%;height: 100%;" :src="item.homeuser.thumb" alt="" /></div>
                        <span v-if="!item.homeuser.thumb">@{{item.name | substr}}</span>

                    </div><!--头像-->
                    <div class="contentbox">
                        <div class="email">@{{item.name}}</div><!--邮箱-->
                        <div class="content" v-html="item.content"></div><!--内容-->
                    </div>
                </li>
            </ul>
          </div>
          <hr>
          <div class="addmessage">

                <button class="addmessagebtn" type="button" @click="addmessage()">更多</button>
          </div>


      </div>

  </div>
</div>
<script>
      var vm =new Vue({
          el:"#app",
          data:{
             msg:"",
             message:[
               //  content:'niee',
                // uid:1,
                // name:'niee'
             ],
             num:3,
             hasmany:false,
             islogin:'{{session()->get('homeuser')}}'
          },
          mounted() {
              this.initeditor();
              this.getmeseage()
          },
          methods:{
              initeditor(){
                  var width = window.innerWidth;
                  width = width>1000?160:200
                  const E = window.wangEditor
                  const editor = new E('#div1')
                  const $text1 = $('#text1')
                  var _this = this;
                  editor.config.onchange = function (html) {
                      // 第二步，监控变化，同步更新到 textarea
                      _this.msg = html
                  }

                  editor.config.uploadImgParams = {
                      '_token': '{{csrf_token()}}',
                  }

                  editor.config.uploadImgHeaders = {
                      'X-CSRF-TOKEN': '{{csrf_token()}}',

                  }
                  editor.config.menus = [

                            'bold',  // 粗体
                            'fontSize',  // 字号
                            'fontName',  // 字体
                            'italic',  // 斜体
                            'underline',  // 下划线
                            'strikeThrough',  // 删除线
                            'foreColor',  // 文字颜色
                            'backColor',  // 背景颜色
                            'link',  // 插入链接
                            'list',  // 列表
                            'justify',  // 对齐方式
                            'quote',  // 引用
                            'emoticon',  // 表情

                            'table',  // 表格
                            // 'video',  // 插入视频
                             'code',  // 插入代码
                            // 'undo',  // 撤销
                            // 'redo'  // 重复

                          ]
                  editor.config.height = width
                  editor.create()


                  // 第一步，初始化 textarea 的值
                  $text1.val(editor.txt.html())
              },
              submit() {
                  axios.get('/getsession').then(res=>{
                     this.islogin = res.data
                  })

                  if(this.islogin == ""){
                      $(".loginico").click()
                      return false;
                  }
                   var _this = this;


                   axios.post('/message',{
                       msg:_this.msg,
                       _token:'{{csrf_token()}}',
                       email:'{{session()->get('homeuser')}}'
                   }).then(function(response){
                        if(response.data.status == 0){
                          alert(response.data.message)
                        }

                   },function(){

                   })

              },
              getmeseage(){
                  axios.get("/api/getmessage/"+this.num).then(res => {
                      this.message = res.data
                  })
              },
              addmessage(){
                  this.num += 6
                  axios.get("/api/getmessage/"+this.num).then(res => {

                       if(res.data.length == 0){
                          this.hasmany = true
                       }
                       this.message = this.message.concat(res.data)
                       console.log(this.message)
                  })
              }

          },
          filters:{
              substr:function(e){
                  return e.slice(0,1);
              }
          }
      })
  </script>

  <script type="text/javascript">



  </script>

  </div>

</article>


@include('home.public.footer')
