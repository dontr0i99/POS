<?php

namespace App\Http\Controllers;
use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    // public function index() {
    //     // $data = [
    //     //     'kategori_kode' => 'SNK',
    //     //     'kategori_nama' => 'Snack/Makanan Ringan',
    //     //     'created_at' => now()
    //     // ];
    //     // DB::table('m_kategori')->insert($data);
    //     // return 'Insert data baru berhasil';

    //     // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'Camilan']);
    //     // return 'Update data berhasil. jumlah data yang diupdate: '. $row . ' baris';

    //     // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
    //     // return 'Delete data berhasil. Jumlah data yang dihapus: '. $row .' baris';

    //     $data = DB::table('m_kategori')->get();
    //     return view('kategori.kategori', ['data' => $data]);
    // }
    // public function index(KategoriDataTable $dataTable)
    // {
    //     return $dataTable->render('kategori.index');
    // }
    // public function create(){
    //     return view('kategori.create');
    // }
    // public function store(Request $request){
    //     $validated = $request->validate([
    //         'kodeKategori' => 'bail|required',
    //         'namaKategori' => 'bail|required',

    //     ]);
    //     if ($validated) {
    //         KategoriModel::create([
    //             'kategori_kode' =>$request->kodeKategori,
    //             'kategori_nama' =>$request->namaKategori,
    //         ]);
    //     }
        
    //     return redirect('/kategori');
    // }
    // public function edit($id)
    // {
    //     $user = KategoriModel::find($id);
    //     return view('kategori/edit', ['data' => $user]);
    // }
    // public function edit_save($id, Request $request)
    // {
    //     $kategori = KategoriModel::find($id);

    //     $kategori->kategori_kode = $request->kodeKategori;
    //     $kategori->kategori_nama = $request->namaKategori;

    //     $kategori->save();

    //     return redirect('/kategori');
    // }
    // public function hapus($id)
    // {
    //     $kategori = KategoriModel::find($id);
    //     $kategori->delete();

    //     return redirect('/kategori');
    // }

    public function index(){
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori'],
        ];
        $page = (object) [
            'title' => 'Daftar Kategori yang terdaftar dalam sistem',
        ];

        $activeMenu = 'kategori';

        $kategori = KategoriModel::all();

        return view('kategori.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'kategori' => $kategori]);
    }

    public function list(Request $request){
        $kategoris = KategoriModel::select('kategori_id', 'kategori_kode','kategori_nama');

        if ($request->kategori_id){
            $kategoris->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($kategoris)
        ->addIndexColumn()
        ->addColumn('aksi', function ($kategori) {
            $btn = '<a href="'.url('/kategori/' . $kategori->kategori_id).'" class="btn btn-info btn-sm">Detail</a>';
            $btn .= '<a href="'.url('/kategori/' . $kategori->kategori_id.'/edit').'" class="btn btn-warning btn-sm">Edit</a>';
            $btn .= '<form class="d-inline-block" method="POST" action="'. url('/kategori/'. $kategori->kategori_id) .'">'. csrf_field() . method_field('DELETE') .'<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
    }

    public function create(){
        $breadcrumb = (object)[
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];
        $page = (object)[
            'title' => 'Tambah Kategori Baru'
        ];

        $kategori = KategoriModel::all(); //ambil data untuk ditampilkan di form
        $activeMenu = 'kategori';
        return view('kategori.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' =>$activeMenu]);
    }

    public function store(Request $request): RedirectResponse{
        $validated = $request->validate([
            'kategori_kode' => 'bail|required|string|unique:m_kategoris,kategori_kode',
            'kategori_nama' => 'required|string|max:100',
        ]);
        KategoriModel::create([
            'kategori_kode' =>$request->kategori_kode,
            'kategori_nama' =>$request->kategori_nama,
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil disimpan');
    }

    public function show(string $id){
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Kategori',
            'list' => ['Home', 'Kategori', 'Detail']
        ];
        $page = (object)[
            'title' => 'Detail Kategori'
        ];

        $activeMenu ='kategori';

        return view('kategori.show', ['kategori' =>$kategori,'breadcrumb' => $breadcrumb, 'page' =>$page, 'activeMenu' => $activeMenu]);
    }

    public function edit($id){
        $kategori = KategoriModel::find($id);
        // $kategori = LevelModel::all();

        $breadcrumb = (object)[
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];
        $page = (object)[
            'title' => 'Edit Kategori'
        ];

        $activeMenu = 'kategori';

        return view('kategori.edit', ['breadcrumb' => $breadcrumb, 'page' =>$page, 'activeMenu' => $activeMenu, 'kategori' => $kategori]);
    }

    public function update(Request $request, string $id){
        $request->validate([
            'kategori_kode' => 'bail|required|string|unique:m_kategoris,kategori_kode,'.$id.',kategori_id',
            'kategori_nama' => 'required|string|max:100',
        ]);

        KategoriModel::find($id)->update([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil diubah');
    }

    public function destroy(string $id){
        $check = KategoriModel::find($id);
        if(!$check) {
            return redirect('/kategori')->with('error', 'Data kategori tidak ditemukan');
        }

        try{
            KategoriModel::destroy($id);

            return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus');
        }catch (\illuminate\Database\QueryException $e){
            return redirect('/kategori')->with('error', 'Data kategori gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
