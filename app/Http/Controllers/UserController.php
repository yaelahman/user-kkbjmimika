<?php

namespace App\Http\Controllers;

use App\RegistrasiUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $user = RegistrasiUser::orderBy('id', 'desc')->get();

        $data = [
            'user' => $user
        ];

        return view('admin.user.index', $data);
    }

    public function create()
    {

        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        // dd($request->foto);
        $validator = Validator::make($request->all(), [
            'no_hp' => 'unique:registrasi_user,no_hp',
            // 'foto'  => 'mimes:jpeg,png'
        ], [
            'required' => ':Attribute tidak boleh kosong !',
            'unique' => ':Attribute telah digunakan !',
            'mimes'    => ':Attribute harus berupa gambar !'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();
            $reg = new RegistrasiUser();
            $reg->nama = $request->nama;
            $reg->no_user = '';
            $reg->no_hp = $request->no_hp;
            $reg->jenis_pekerjaan = $request->jenis_pekerjaan;
            $reg->alamat = $request->alamat;
            $reg->foto = $request->foto;
            $reg->verifikasi_kode = Str::random(7);
            $reg->is_active = 1;
            $reg->save();

            DB::commit();

            $request->session()->flash('alert', 'success');
            return redirect(route('admin.user.index'))->with('message', "Registrasi Berhasil Dilakukan, Silahkan Aktivasi Akun !");
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function edit($id)
    {
        $user = RegistrasiUser::find($id);

        $data = [
            'user' => $user
        ];

        return view('admin.user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // dd($request->foto);
        $validator = Validator::make($request->all(), [
            'no_hp' => 'unique:registrasi_user,no_hp,' . $id,
            // 'foto'  => 'mimes:jpeg,png'
        ], [
            'required' => ':Attribute tidak boleh kosong !',
            'unique' => ':Attribute telah digunakan !',
            'mimes'    => ':Attribute harus berupa gambar !'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();
            $reg = RegistrasiUser::find($id);
            $reg->nama = $request->nama;
            $reg->no_hp = $request->no_hp;
            $reg->jenis_pekerjaan = $request->jenis_pekerjaan;
            $reg->alamat = $request->alamat;
            $reg->foto = $request->foto;
            $reg->save();

            DB::commit();

            $request->session()->flash('alert', 'success');
            return redirect(route('admin.user.index'))->with('message', "Registrasi Berhasil Dilakukan, Silahkan Aktivasi Akun !");
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function aktivasiUser(Request $request)
    {

        try {
            DB::beginTransaction();
            $reg = RegistrasiUser::find($request->id_registrasi_user);
            if ($reg == null) {
                $request->session()->flash('alert', 'danger');
                return redirect(route('admin.user.index'))->with('message', "Akun Tidak Ditemukan !");
            }

            $reg->no_user = "AKJ" . rand(0, 999999);
            $reg->is_active = 2;
            $reg->save();

            DB::commit();

            $request->session()->flash('alert', 'success');
            return redirect(route('admin.user.index'))->with('message', "Aktivasi Berhasil Dilakukan !");
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteUser(Request $request)
    {

        try {
            DB::beginTransaction();
            $reg = RegistrasiUser::find($request->id_registrasi_user);
            if ($reg == null) {
                $request->session()->flash('alert', 'danger');
                return redirect(route('admin.user.index'))->with('message', "Akun Tidak Ditemukan !");
            }
            $reg->delete();

            DB::commit();

            $request->session()->flash('alert', 'success');
            return redirect(route('admin.user.index'))->with('message', "User Berhasil Dihapus !");
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
