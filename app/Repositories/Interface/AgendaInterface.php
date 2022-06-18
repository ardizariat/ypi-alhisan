<?php

namespace App\Repositories\Interface;

interface AgendaInterface
{
    public function agendaAdmin();
    public function storeAgenda($request);
    public function updateAgenda($agenda, $request);
    public function deleteAgenda($agenda);
}
