<!DOCTYPE html>
<html class="x-admin-sm">

<?php echo $__env->make('admin.public.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <body>
        <div class="layui-fluid">
            <div class="layui-row">
                <form class="layui-form" method="post" action="<?php echo e(url('admin/role')); ?>">
                    <?php echo csrf_field(); ?>
                  <div class="layui-form-item">
                      <label for="username" class="layui-form-label">
                          <span class="x-red">*</span>角色名称
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="username" name="name" required="" lay-verify="required"
                          autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red">*</span>角色名称
                      </div>
                  </div>

                    <div class="layui-form-item">
                        <label for="username" class="layui-form-label">
                            <span class="x-red">*</span>拥有的权限
                        </label>
                        <div class="layui-input-block">
                          <?php $__currentLoopData = $pers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="checkbox" name="permission_id[]" value="<?php echo e($v->id); ?>" lay-skin="primary"  title="<?php echo e($v->title); ?>">
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>
                  <div class="layui-form-item">
                      <label for="L_repass" class="layui-form-label">
                      </label>
                      <input type="submit"  class="layui-btn" lay-filter="add" lay-submit="" value=" 增加"/>


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
                        url:'<?php echo e(url('/admin/role')); ?>',
                        type:'POST',
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
<?php /**PATH D:\blog\resources\views/admin/role/add.blade.php ENDPATH**/ ?>