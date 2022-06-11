<?php

namespace App\View\Components;

use App\Repositories\Interface\ArtikelInterface;
use Illuminate\View\Component;

class BerandaArtikelTerbaru extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    protected $artikelRepository;

    public function __construct(ArtikelInterface $artikelRepository)
    {
        $this->artikelRepository = $artikelRepository;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $data = $this->artikelRepository
            ->artikel()
            ->paginate(3);
        return view('components.beranda-artikel-terbaru', compact('data'));
    }
}
