<?php

namespace App\Http\Controllers;

use App\Chat\Chat;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable|Application|Factory|View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable|Application|Factory|View
     */
    public function create()
    {
        return view('chat');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return bool
     */
    public function store(Request $request)
    {
        return (new Chat)->prepare($request->message, 'local');
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

}
