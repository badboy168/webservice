<?php
namespace App\Modules\User\Http\Controllers;


use App\Exceptions\ApiExecption;
use App\Exceptions\DBNotColumnException;
use App\Models\Dao\Impl\UsersDaoImpl;
use App\Models\Service\Impl\UserServiceImpl;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


/**
 * 用户接口
 * 请求方式    URI路径                控制器方法    路由名称
 * GET        /user                index        user.index
 * GET        /user/create        create        user.create
 * POST         /user               store        user.store
 * GET        /user/{post}        show        user.show
 * GET        /user/{post}/edit    edit        user.edit
 * PUT/PATCH    /user/{post}    update        user.update
 * DELETE    /user/{post}        destroy        user.destroy
 */
class UserController extends AbBaseController
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        $arr = [
//            ["id"=>1, "member"=>"1000000"],
//            ["id"=>2, "member"=>"1000004"],
//            ["id"=>3, "member"=>"10000045"]
//        ];
//        $user = new UsersDaoImpl();

        $list = DB::table('users')->select(["member", "network_status", 'app_version', 'phone_version'])->get();

        return $list;
        //return [];
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws ApiExecption
     */
    public function store(Request $request)
    {

        try {
            $userService = new UserServiceImpl();
            $menber = $userService->save($request->all());
            return $this->jsonApiSuccess($menber);
        } catch (\Exception $e) {
            return $this->jsonApiError($e);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}