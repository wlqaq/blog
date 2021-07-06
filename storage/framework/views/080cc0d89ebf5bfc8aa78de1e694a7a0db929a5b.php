<!DOCTYPE html>
<html class="x-admin-sm">

<?php echo $__env->make('admin.public.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <body>
        <div class="layui-fluid">
            <div class="layui-row">
                <form class="layui-form" method="PUT" action="<?php echo e(url('admin/role/update')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="<?php echo e($tags->id); ?>">
                  <div class="layui-form-item">
                      <label for="url" class="layui-form-label">
                          <span class="x-red">*</span>URL
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" value="<?php echo e($tags->url); ?>" id="url" name="url" required="" lay-verify="required"
                          autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>url
                      </div>
                  </div>
                   <div class="layui-form-item">
                      <label for="title" class="layui-form-label">
                          <span class="x-red">*</span>标题
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" value="<?php echo e($tags->title); ?>" id="title" name="title" required="" lay-verify="required"
                          autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>title
                      </div>
                  </div>
                  <div class="layui-form-item">
                      <label for="tip" class="layui-form-label">
                          <span class="x-red">*</span>提示
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" value="<?php echo e($tags->tip); ?>" id="tip" name="tip" required="" lay-verify="required"
                          autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>tip
                      </div>
                  </div>

                  <div class="layui-form-item">
                      <label for="L_repass" class="layui-form-label">
                      </label>
                      <input type="submit"  class="layui-btn" lay-filter="add" lay-submit="" value="修改"/>


                  </div>
              </form>
            </div>
        </div>


    </body>
    <script>
        layui.use(['form', 'layer'],function () {

        var form = layui.form;
            form.render();
            layer = layui.layer;
            //监听提交
            form.on('submit(add)',
                function(data) {
                    console.log(data);
                    //发异步，把数据提交给php
                    $.ajax({
                        url:'<?php echo e(url('/admin/tabs/update')); ?>',
                        type:'PATCH',
                        data : data.field,
                        dataType:'json',
                        success : function(data) {
                            if(data.status == 0){
                                //发异步，把数据提交给php
                                layer.alert(data.message, {icon: 6},function () {
                                    // 获得frame索引
                                    var index = parent.layer.getFrameIndex(window.name);
                                    //关闭当前frame
                                    parent.layer.close(index);
                                    //添加成功刷新页面
                                    parent.location.reload();
                                });
                            }else{
                                //发异步，把数据提交给php
                                layer.alert(data.message, {icon: 5},function () {
                                    // 获得frame索引
                                    var index = parent.layer.getFrameIndex(window.name);
                                    //关闭当前frame
                                    parent.layer.close(index);
                                    //添加失败刷新页面
                                    parent.location.reload();
                                });
                            }

                        }

                    })

                    return false;
                })
        })
    </script>

</html>
<?php /**PATH D:\blog\resources\views/admin/tabs/edit.blade.php ENDPATH**/ ?>