<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppFooter extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $footer['1'] = [
            'Beranda' => route('beranda'),
            'Tentang Kami' => route('tentang-kami'),
            'Struktur Organisasi' => route('struktur-organisasi'),
            'Visi & Misi' => route('visi-misi'),
            'Artikel' => route('artikel'),
        ];
        $footer['2'] = [
            'Galeri' => route('galeri'),
            'Kontak' => route('kontak'),
            'Bidang Pendidikan & Dakwah' => '/',
            'Bidang Sosial' => '/',
            'Bidang Usaha & Lainnya' => '/',
        ];
        return view('layouts.application.footer', compact('footer'));
    }
}
