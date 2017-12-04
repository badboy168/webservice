<?php
namespace App\Modules\User\Http\Controllers;


use App\Modules\Model\Validator\Impl\UserVaildatorImpl;
use Illuminate\Http\Request;

/**
 * 用户接口
 * 请求方式	URI路径	            控制器方法	路由名称
    GET	    /user	            index	    user.index
    GET	    /user/create	    create	    user.create
    POST	/user	            store	    user.store
    GET	    /user/{post}	    show	    user.show
    GET	    /user/{post}/edit	edit	    user.edit
    PUT/PATCH	/user/{post}	update	    user.update
    DELETE	/user/{post}	    destroy	    user.destroy
 */
class UserController extends AbBaseController
{

    protected $userVaild;

    function __construct()
    {
//        $route = request()->route()->getAction();
//
//        list($controller, $action) = explode('@', $route['controller']);
//
//        echo $controller, $action;

         $this->userVaild = new UserVaildatorImpl();
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return ['index'];
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'title' => 'required|max:255',
//            'body' => 'required',
//        ]);
//
//        if ($validator->fails()) {
//            $errors = $validator->errors();
//
//            return $errors->all();
//        }

         UserVaildatorImpl::getInstance()->rule($request->all());

        echo UserVaildatorImpl::getInstance()->getErrorMessage();

//        $this->userVaild->make($request->all());
//        echo $request->input('username');
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
    }
}