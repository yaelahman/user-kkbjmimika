<?php

namespace App\Http\Controllers;

use App\RegistrasiUser;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Log;

class UserController extends Controller
{

    public function sendMessage($phone, $message)
    {
        $wa = Http::withHeaders([
            'API-Key' => env('API_KEY_SENDTALK'),
        ])->post('https://sendtalk-api.taptalk.io/api/v1/message/send_whatsapp', [
            'phone' => $phone,
            'messageType' => 'text',
            'body' => $message
        ]);
    }
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
            $reg->asal = $request->asal;
            $reg->alamat = $request->alamat;
            $reg->verifikasi_kode = Str::random(7);
            $reg->is_active = 1;

            $file = $request->file('foto');

            $nama_file = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'foto';
            $file->move($tujuan_upload, $nama_file);
            $reg->foto = $nama_file;

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
            $reg->asal = $request->asal;
            $reg->alamat = $request->alamat;
            if ($request->hasFile('foto')) {

                File::delete('foto/' . $reg->foto);
                $file = $request->file('foto');

                $nama_file = time() . "_" . $file->getClientOriginalName();
                $tujuan_upload = 'foto';
                $file->move($tujuan_upload, $nama_file);
                $reg->foto = $nama_file;
            }

            $reg->save();

            DB::commit();

            $request->session()->flash('alert', 'success');
            return redirect(route('admin.user.index'))->with('message', "User Berhasil Diubah !");
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
            $kode = "AKJ" . rand(0, 999999);
            $reg->no_user = $kode;
            // return ([
            //     'no' => $reg->no_user,
            //     'mss' => "Hai " . $reg->nama . ", Selamat akun anda telah teraktivasi. No User anda adalah : " . $kode
            // ]);
            $reg->is_active = 2;
            $reg->save();

            $this->sendMessage($reg->no_hp, "Hai " . $reg->nama . ", Selamat akun anda telah teraktivasi. No User anda adalah : " . $kode);

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
            File::delete('foto/' . $reg->foto);
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
