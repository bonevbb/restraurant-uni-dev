<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        return view('admin.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login')->with('success', 'You are now logged out.');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
        ]);

        if (!Auth::guard('admin')->attempt(['name' => $request['name'], 'password' => $request['password']])) {
            return redirect()->back()->with('fail', 'Could not log in!');
        }

        return redirect()->route('dashboard');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDashboard()
    {
//        if(!Auth::check()){
//            return redirect()->back();
//        }
        $dashboardData = [];
        $dashboardData['users_num'] = count(User::all());

        return view('admin.dashboard', ['users_num' => $dashboardData['users_num']]);
    }
}
