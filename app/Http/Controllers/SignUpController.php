<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\SignUpRequest;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
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
        return view('sign_up');
    }

    /**
     * Store a newly created resource in storage.
     * @param SignUpRequest $request
     * @return RedirectResponse
     */
    public function store(SignUpRequest $request)
    {
        $user = Users::where('email', $request->email)->first();
        if ($user)
            return redirect()->back()->withErrors(array('email' => 'Try another email!'));

        Users::create($this->formatInputs($request->all()));
        $log_user = array(
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        );

        Auth::attempt($log_user);
        return redirect()->route('chat');
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
     * @param $inputs
     * @return array
     */
    private function formatInputs($inputs)
    {
        $users = array();
        $users['username'] = (isset($inputs['username']) && !empty($inputs['username'])) ? $inputs['username'] : '';
        $users['email'] = $inputs['email'];
        $users['password'] = Hash::make($inputs['password']);
        return $users;
    }
}
