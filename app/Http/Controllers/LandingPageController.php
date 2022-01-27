<?php

namespace App\Http\Controllers;

use App\RegistrasiUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LandingPageController extends Controller
{

    public function index()
    {
        return view('welcome');
    }

    public function registrasiUser(Request $request)
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
            $reg->verifikasi_kode = Str::random(7);
            $reg->is_active = 0;

            $file = $request->file('foto');

            $nama_file = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'foto';
            $file->move($tujuan_upload, $nama_file);
            $reg->foto = $nama_file;

            $reg->save();

            DB::commit();

            $request->session()->flash('alert', 'success');
            return redirect(route('landing'))->with('message', "Registrasi Berhasil Dilakukan, Silahkan Aktivasi Akun ! Kode Aktivasi Anda => " . $reg->verifikasi_kode);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function aktivasiUser(Request $request)
    {

        try {
            DB::beginTransaction();
            $reg = RegistrasiUser::where('verifikasi_kode', $request->verifikasi_kode)->first();
            if ($reg == null) {
                $request->session()->flash('alert', 'danger');
                return redirect(route('landing'))->with('message', "Akun Tidak Ditemukan !");
            } else if ($reg->is_active == 1) {
                $request->session()->flash('alert', 'danger');
                return redirect(route('landing'))->with('message', "Sudah Melakukan Permintaan Aktivasi !");
            }


            $reg->is_active = 1;
            $reg->save();

            DB::commit();

            $request->session()->flash('alert', 'success');
            return redirect(route('landing'))->with('message', "Aktivasi Berhasil Dilakukan, Harap Tunggu Untuk Penyetujuan, Cek Secara Berkala !");
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function cariUser(Request $request)
    {

        try {
            $user = RegistrasiUser::where('no_user', $request->no_user)->where('is_active', 2)->first();
            if ($user == null) {
                return response()->json([
                    'message' => 'Data Tidak Ditemukan !',
                    'status'  => 404,
                ]);
            }
            $data = [
                'user' => $user,
                'status' => 200
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
