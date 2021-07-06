<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TabsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tabs =  DB::table('tags')->paginate(10);
		 return view('admin.tabs.index',compact('tabs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.tabs.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //创建标签
       $data = $request->all();
       $res = DB::table('tags')->insert(['url'=>$data['url'],'title'=>$data['title'],'tip'=>$data['tip']]);
       return $this->ifsuccess($res);
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
        //编辑
        $tags = DB::table('tags')->where(['id'=>$id])->first();

        return view('admin.tabs.edit',compact('tags'));
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
        //更新
        $data = $request->all();
        $res = DB::table('tags')->where('id',$data['id'])->update([
            'title'=>$data['title'],
            'url'=>$data['url'],
            'tip'=>$data['tip']
            ]);
        return $this->ifsuccessMessage($res,'修改成功','修改失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除标签
        $res = DB::table('tags')->where(['id'=>$id])->delete();
        return ifsuccessMessage($res,'删除成功','删除失败');
    }
}
