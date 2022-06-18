<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppNavbar extends Component
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
        $navbar = [
            'Beranda' => route('beranda'),
            'tentang kami' => [
                'Tentang Kami' => route('tentang-kami'),
                'Struktur Organisasi' => route('struktur-organisasi'),
                'Visi & Misi' => route('visi-misi'),
            ],
            'Artikel' => route('artikel'),
            'dakwah' => [
                'Kalimat Hikmah' => route('kalimat-hikmah'),
                'Poster Dakwah' => route('poster-dakwah'),
            ],
            'Galeri' => route('galeri'),
            'Kontak' => route('kontak'),
        ];
        return view('layouts.application.navbar', compact('navbar'));
    }
}
