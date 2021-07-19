<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SignInRequest;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SignInController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('sign_in');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Check
     * @param SignInRequest $request
     * @return RedirectResponse
     */
    public function check(SignInRequest $request)
    {
        $user = Users::where('email', $request->input('email'))->first();
        if (!$user)
        {
            return redirect()->back()->withErrors(array('email_or_password' => 'The email or password is incorrect!'));
        }
        if (!Hash::check($request->input('password'), $user->password)) {
            return redirect()->back()->withErrors(array('email_or_password' => 'The email or password is incorrect!'));
        }
        $log_user = array(
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        );

        Auth::attempt($log_user);
        return redirect()->route('chat');
    }
}
