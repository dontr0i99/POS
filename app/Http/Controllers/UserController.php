<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserModel;
use Database\Seeders\UserSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

use function PHPUnit\Framework\returnSelf;

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
        // $user = UserModel::where('username', 'manager9')->firstOrFail();
        // $user = UserModel::where('level_id', 2)->count();
        
        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager',
        //         'nama' => 'Manager',
        //     ],
        // );

        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager33',
        //         'nama' => 'Manager Tiga Tiga',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );
        // return view('user.user', ['data' => $user]);

        // $user = UserModel::create(
        //     [
        //         'username' => 'manager55',
        //         'nama' => 'Manager55',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );

        // $user->username = 'manager65';

        // $user->isDirty();//true
        // $user->isDirty('username');//true
        // $user->isDirty('name');//false
        // $user->isDirty(['nama', 'username']);//true

        // $user->isClean();//false
        // $user->isClean('username');//false
        // $user->isClean('nama');//false
        // $user->isClean(['nama', 'username']);//false

        // $user->save();

        // $user->isDirty();//false
        // $user->isClean();//true
        // dd($user->isDirty());

        // $user = UserModel::create(
        //     [
        //         'username' => 'manager11',
        //         'nama' => 'Manager11',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );

        // $user->username = 'manager12';

        // $user->save();

        // $user->wasChanged();//true
        // $user->wasChanged('username');//true
        // $user->wasChanged(['username', 'level_id']);//true
        // $user->wasChanged('nama');//fal
        // dd($user->wasChanged(['nama', 'username']));//true

        // $user = UserModel::all();
        // return view('user.user', ['data' => $user]);

        $user = UserModel::with('level')->get();
        return view('user.user', ['data' => $user]);
    }   

    public function tambah() {
        return view('user.user_tambah');
    }

    public function tambah_simpan(Request $request) {
        UserModel::create([
            'username' => $request->username,
            'nama'=> $request->nama,
            'password'=>Hash::make('$request->password'),
            'level_id'=> $request->level_id
        ]);

        return redirect('/user');
    }

    public function ubah($id){
        $user = UserModel::find($id);
        return view('user.user_ubah', ['data' => $user]);
    }

    public function ubah_simpan($id, Request $request) {
        $user = UserModel::find($id);

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make($request->password);
        $user->level_id = $request->level_id;

        $user->save();

        return redirect('/user');
    }

    public function hapus($id) {
        $user = UserModel::find($id);
        $user->delete();

        return redirect('/user');
    }

    
}
