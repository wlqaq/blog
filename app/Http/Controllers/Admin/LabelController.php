<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Admin\Role;
use App\Models\Admin\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPSTORM_META\type;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $admins = Admin::get();
        return view('admin.admin.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::get();
        return view('admin.admin.add',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        if(DB::table('admin')->where(['name'=>$data['name']])->first()){
            return $data=[
            'status'=>1,
            'message'=>'角色存在'
            ];
        }
        $res = DB::table('admin')->insert(['name'=>$data['name'],'password'=>$data['pass'],'email'=>$data['email']]);
        $uid = DB::table('admin')->where('name','=',$data['name'])->first()->id;
        $str = '';
        foreach ($data['rid'] as $v){
            $str .= $v.',';
        }
        $res1 = DB::table('user_role')->insert(['uid'=>$uid,'role_id'=>$str]);
        if ($res && $res1){
            $data=[
                'status'=>0,
                'message'=>'增加成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'message'=>'增加失败'
            ];
        }
        return  $data;
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
      $admin = Admin::find($id);
      $res = $admin->delete();
      return  ifsuccess($res);
    }
    public function auth($uid){
        $role =Role::get();//获去所有规则
        //根据用户id查找权限
        $user_role = DB::table('user_role')->where(['uid'=>$uid])->first();
        if ($user_role){
            //拆分规则
            $user_role  = explode(",", $user_role->role_id);
        }else{
            //默认规则
            $user_role = ['1','2'];
        }
        return view('admin.admin.auth',compact('role','user_role','uid'));
    }


    public function doauth(){
        $data = request()->all();
        $uid = request()->only('uid');
        $ur =new UserRole();
        $str = '';
        foreach ($data['rid'] as $v){
            $str .= $v.',';
        }
        $res = $ur->UpdateUserRole($str,$uid);
        return $this->ifsuccess($res);

    }
}


