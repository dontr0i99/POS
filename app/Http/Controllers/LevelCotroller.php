<?php

namespace App\Http\Controllers;
use App\Models\LevelModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LevelCotroller extends Controller
{
    // public function index(){
    //     // DB::insert('insert into m_level(level_kode, level_nama, created_at) values(?,?,?)', ['CUS', 'Pelanggan', now()]);
    //     // return 'Insert Data baru berhasil';

    //     // $row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer', 'CUS']);
    //     // return 'Update data berhasil. Jumlah data yang diupdate: '. $row .' baris';

    //     // $row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
    //     // return 'Delete data berhasil. Jumlah data yang dihapus: '. $row.' baris';

    //     $data = DB::select('select * from m_level');
    //     return view('level.level', ['data'=>$data]);
    // }
    // public function create(){
    //     return view('level/create');
    // }

    public function index(){
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level'],
        ];
        $page = (object) [
            'title' => 'Daftar Level yang terdaftar dalam sistem',
        ];

        $activeMenu = 'level';

        $level = LevelModel::all();

        return view('level.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'level' => $level]);
    }

    public function list(Request $request){
        $levels = LevelModel::select('level_id', 'level_kode','level_nama');

        if ($request->level_id){
            $levels->where('level_id', $request->level_id);
        }

        return DataTables::of($levels)
        ->addIndexColumn()
        ->addColumn('aksi', function ($level) {
            $btn = '<a href="'.url('/level/' . $level->level_id).'" class="btn btn-info btn-sm">Detail</a>';
            $btn .= '<a href="'.url('/level/' . $level->level_id.'/edit').'" class="btn btn-warning btn-sm">Edit</a>';
            $btn .= '<form class="d-inline-block" method="POST" action="'. url('/level/'. $level->level_id) .'">'. csrf_field() . method_field('DELETE') .'<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function create(){
        $breadcrumb = (object)[
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];
        $page = (object)[
            'title' => 'Tambah Level Baru'
        ];

        $level = LevelModel::all(); //ambil data untuk ditampilkan di form
        $activeMenu = 'level';
        return view('level.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' =>$activeMenu]);
    }

    public function store(Request $request): RedirectResponse{
        $validated = $request->validate([
            'level_kode' => 'bail|required|string|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:100',
        ]);
        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Data level berhasil disimpan');
    }

    public function show(string $id){
        $level = LevelModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Level',
            'list' => ['Home', 'Level', 'Detail']
        ];
        $page = (object)[
            'title' => 'Detail Level'
        ];

        $activeMenu ='level';

        return view('level.show', ['level' =>$level,'breadcrumb' => $breadcrumb, 'page' =>$page, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id){
        $level = LevelModel::find($id);
        // $level = LevelModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', 'Edit']
        ];
        $page = (object)[
            'title' => 'Edit Level'
        ];

        $activeMenu = 'level';

        return view('level.edit', ['breadcrumb' => $breadcrumb, 'page' =>$page, 'activeMenu' => $activeMenu, 'level' => $level]);
    }

    public function update(Request $request, string $id){
        $request->validate([
            'level_kode' => 'bail|required|string|unique:m_level,level_kode,'.$id.',level_id',
            'level_nama' => 'required|string|max:100',
        ]);

        LevelModel::find($id)->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama,
        ]);

        return redirect('/level')->with('success', 'Data level berhasil diubah');
    }

    public function destroy(string $id){
        $check = LevelModel::find($id);
        if(!$check) {
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }

        try{
            LevelModel::destroy($id);

            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        }catch (\illuminate\Database\QueryException $e){
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
