<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/user/index', [
            'title' => 'Pengguna',
            'active' => 'user',
            'page' => 'Pengguna',
            'users' => User::all(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/user/create', [
            'title' => 'Tambah Pengguna',
            'active' => 'user',
            'page' => 'Tambah Pengguna',
            'user' => new User,
            'button_name' => 'Simpan',

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $dtUser = $request->only(['username', 'name']);
        $dtUser['password'] = bcrypt($request->password);

        User::create($dtUser);
        return redirect('user')->with('success', 'Berhasil menambahkan data pengguna');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin/user/edit', [
            'title' => 'Edit Pengguna',
            'active' => 'user',
            'page' => 'Edit Pengguna',
            'user' => $user,
            'button_name' => 'Ubah',

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, User $user)
    {
        $dtUser = $request->only('name');
        $dtUser['password'] = bcrypt($request->password);

        $user->update($dtUser);
        return redirect('user')->with('success', 'Berhasil mengubah data pengguna');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('user')->with('success', 'Berhasil menghapus data pengguna');
    }
}
