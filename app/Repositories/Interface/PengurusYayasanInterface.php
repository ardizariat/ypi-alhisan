<?php

namespace App\Repositories\Interface;

interface PengurusYayasanInterface
{
    public function daftarPengurusYayasan($request = '');
    public function daftarPengurusYayasanAdmin();
    public function strukturOrganisasi($request = '');
}
