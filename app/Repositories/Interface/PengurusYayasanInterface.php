<?php

namespace App\Repositories\Interface;

interface PengurusYayasanInterface
{
    public function daftarPengurusYayasan($request = '');
    public function daftarPengurusYayasanAdmin();
    public function pengurusYayasanDetail($pengurusYayasanId);
    public function strukturOrganisasi($request = '');
    public function storePengurusYayasan($request);
    public function updatePengurusYayasan($pengurusYayasan, $request);
    public function deletePengurusYayasan($pengurusYayasan);
}
