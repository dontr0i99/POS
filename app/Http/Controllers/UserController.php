<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function user($id, $name) {
    //     return view('user.user')
    //     ->with('id',$id)
    //     ->with('name', $name);
    // }

    public function index() {
        // tambah data user dengan Eloquent Model
        // $data = [
        //     'username' => 'customer_1',
        //     'nama' => 'Pelanggan',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 4
        // ];
        // UserModel::insert($data);// tambahkan data ke tabel m_user

        $data = [
            'nama' => 'Pelanggan Pertama'
        ];
        UserModel::where('username', 'customer_1')->update($data);// tambahkan data ke tabel m_user

        // coba akses UserModel
        $user = UserModel::all(); // ambil semua data dari tabel m_user
        return view('user.user', ['data' => $user]);
    }
}
