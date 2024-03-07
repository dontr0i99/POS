<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserModel;
use Database\Seeders\UserSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

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
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345'),
        //     'level_id' => 2
        // ];
        // UserModel::create($data);// tambahkan data ke tabel m_user

        // $data = [
        //     'nama' => 'Pelanggan Pertama'
        // ];
        // UserModel::where('username', 'customer_1')->update($data);// tambahkan data ke tabel m_user

        // coba akses UserModel
        // $user = UserModel::all(); // ambil semua data dari tabel m_user
        // $user=UserModel::find(1);
        // $user = UserModel::where('level_id',1)->first();
        // $user = UserModel::firstWhere('level_id',1);

        // $user = UserModel::findOr(1, ['username', 'nama'], function () {
        //     abort(404);
        // });

        // $user = UserModel::findOr(20, ['username', 'nama'], function () {
        //     abort(404); 
        // });

        // find user data or throwing 404 not found error
        // $user = UserModel::findOrFail(1);
        $user = UserModel::where('username', 'manager9')->firstOrFail();
        return view('user.user', ['data' => $user]);
    }
}
