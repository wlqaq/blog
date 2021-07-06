<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use App\Models\Admin\Role_Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use parallel\Events\Input;
use Psy\Util\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = DB::table('role')->get();
        return view('admin.role.index',compact('role'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pers = Permission::get();
        return view('admin.role.add',compact('pers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        //查看角色是否存在
        if(DB::table('role')->where('name','=',$data['name'])->first()){
            return $data=[
                'status'=>1,
                'message'=>'角色已存在'
            ];
        }
        $data['permission'] = implode(",",$data['permission_id']);
        //提交事务
        DB::transaction(function () use ($data) {
            DB::table('role')->insert(['name'=>$data['name'],'status'=>1]);
            $role = DB::table('role')->where(['name'=>$data['name']])->first();
            DB::table('role_permission')->insert(['permission'=> $data['permission'],'role_id'=>$role->id]);
        });
        $data=[
            'status'=>0,
            'message'=>'增加成功'
        ];
       return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
      $res = DB::transaction(function  () use ($id){
          DB::table('Role')->where(['id'=>$id])->delete();//删除角色
          DB::table('role_permission')->where(['role_id'=>$id])->delete();//删除权限
      });
      return $this->ifsuccessMessage( $res ,"删除成功","删除失败");
    }
    public function doauth(){
        $data = request()->all();
        //dd($data);
        $str = '';
        foreach ($data['permissions_id'] as $v){
            $str .= $v.',';
        }
        $rperm = new Role_Permission();
        $rolepermission=$rperm->getRolePermissionById($data['role_id']);

        if ($rolepermission){
            $res = DB::table('role_permission')->where(['role_id'=>$data['role_id']])->update(['permission'=>$str]);
        }else{
            $res = DB::table('role_permission')->insert(['permission'=>$str,'role_id'=>$data['role_id']]);
        }
        return $this->ifsuccess($res);



    }
    /**
     *
     */
    public function auth($role_id){
      $permission = Permission::get();
      return view('admin.role.auth',compact('role_id','permission'));
    }
}
