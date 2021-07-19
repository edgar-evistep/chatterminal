<?php

namespace App\Http\Controllers;

use App\Chat\Chat;
use App\Slack\SlackCurl;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;


class SlackBotController extends Controller
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
        return view('create');
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
     * @param Request $request
     * @return Application|Response|ResponseFactory|bool
     */
    public function email(Request $request)
    {
        $user_info = $this->userinfo($request->user_id);
        $user_info = gettype($user_info) == 'string' ? json_decode($user_info) : $user_info;
//        $user_email = gettype($user_info) == 'object' && isset($user_info->user->profile->email) ? $user_info->user->profile->email : null;
//        $user_name = gettype($user_info) == 'object' && isset($user_info->user->name) ? $user_info->user->name : null;
        $user = gettype($user_info) == 'object' && isset($user_info->user) ? $user_info->user : null;
        if (is_null($user->profile->email)) return response('Try again later.', 200);
        Session::put('SLACK_USER', $user);
        $result = (new Chat)->prepare(substr($request->command, 1) . ' ' . $request->text, 'slack');
        return response($result, 200);
    }

    /**
     * @param $user_id
     * @param int $pretty
     * @return bool|string
     */
    public function userinfo($user_id, $pretty = 1)
    {
        if($user_id)
        {
            $headers = array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . env('SLACK_BOT_USER_OAUTH_TOKEN')
            );
            $method = 'GET';
            return SlackCurl::call('https://slack.com/api/users.info?user=' . $user_id . '&pretty=' . $pretty, $headers, $method);
        }
        return false;
    }
}

