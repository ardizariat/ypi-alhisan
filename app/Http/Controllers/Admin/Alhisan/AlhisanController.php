<?php

namespace App\Http\Controllers\Admin\Alhisan;

use App\Http\Controllers\Controller;
use App\Models\Alhisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlhisanController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Alhisan';
        $data['data'] = alhisan();
        return view('admin.alhisan.index', compact('data'));
    }

    public function edit(Alhisan $alhisan)
    {
        $data['title'] = 'Ubah Data Alhisan';
        $data['data'] = $alhisan;
        return view('admin.alhisan.edit', compact('data'));
    }

    public function update(Alhisan $alhisan, Request $request)
    {
        $alhisan->nama = $request->nama;
        $alhisan->no_telpon = $request->no_telpon;
        $alhisan->no_hp = $request->no_hp;
        $alhisan->email = $request->email;
        $alhisan->alamat = $request->alamat;
        $alhisan->visi = $request->visi;
        $alhisan->misi = $request->misi;
        $alhisan->tujuan = $request->tujuan;
        $alhisan->sejarah = $request->sejarah;
        if ($request->hasFile('logo')) {
            $logoOld = $alhisan->logo;
            if ($logoOld)
                Storage::delete('alhisan/' . $logoOld);
            $filename = uploadFile($request->file('logo'), 'alhisan/');
            $alhisan->logo = $filename;
        }
        $alhisan->update();
        return response()->json([
            'message' => 'Data berhasil diubah',
            'url' => route('admin.alhisan.index')
        ], 200);
    }
}
