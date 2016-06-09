<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller {

    /**
     * Controller to save a new user.
     *
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request) {
        $this->validate($request, [
            'f_name' => 'required|string',
            'l_name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = new User();
        if($request->input('u_id') != '') {
            $user->u_id = $request->input('u_id');
            //$user->remember_token = $request->input('remember_token');
        } else {
            $user->u_id = Uuid::uuid();
            //$user->remember_token = str_random(10);
        }
        $user->f_name = $request->input('f_name');
        $user->l_name = $request->input('l_name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        return response()->success($user->save());
    }

    /**
     * Controller to get a single user.
     *
     * @param $u_id
     * @return mixed
     */
    public function getSingle($u_id) {
        $user = User::find($u_id);

        return response()->success(compact('user'));
    }

    /**
     * Controller to get all users.
     *
     * @return mixed
     */
    public function getList() {
        $users = User::all();

        return response()->success(compact('users'));
    }

    /**
     * Controller to get projects matching a criteria.
     *
     * @return mixed
     */
    /*public function getList() {
        users = Project::all();

        return response()->success(compact('users'));
    }*/

    /**
     * Controller to edit a user.
     *
     * @param $u_id
     * @return mixed
     */
    public function update(Request $request, $u_id) {
        $this->validate($request, [
            'f_name' => 'required|string',
            'l_name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        $user = User::find($u_id);
        $user->f_name = $request->input('f_name');
        $user->l_name = $request->input('l_name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        return response()->success($user->save());
    }

    /**
     * Controller to delete a user.
     *
     * @param $u_id
     * @return mixed
     */
    public function delete($u_id) {
        $user = User::find($u_id);

        return response()->success($user->delete());
    }

}
