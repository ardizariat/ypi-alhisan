<?php

namespace App\Repositories\Interface;

interface InventarisInterface
{
    public function inventarisAdmin();
    public function eksporDataInventaris();
    public function kategoriInventaris();
    public function detailInventarisAdmin($inventarisId);
    public function storeInventaris($request);
    public function updateInventaris($inventaris, $request);
    public function deleteInventaris($inventaris);
}
