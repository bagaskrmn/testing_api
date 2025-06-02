<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CekDbController extends Controller
{
    public function cekDb()
    {
        // $nomkot = DB::table('orders')
        // ->select('nomkot')
        // ->orderBy('nomkot', 'desc')
        // ->get();
        // return $nomkot;
        $newOrderId = DB::table('orders')
            ->selectRaw("
        CASE
            WHEN MAX(nomkot) IS NULL THEN CONCAT(DATE_FORMAT(NOW(), '%y%m'), '00001')
            ELSE LPAD(MAX(nomkot) + 1, 9, '0')
        END as new_nomkot
    ")
            ->whereRaw("LEFT(nomkot, 4) = DATE_FORMAT(NOW(), '%y%m')")
            ->value('new_nomkot');

        return $newOrderId;
    }

    public function setNewNomkot()
    {
        $newOrderId = DB::table('orders')
            ->selectRaw("
        CASE
            WHEN MAX(nomkot) IS NULL THEN CONCAT(DATE_FORMAT(NOW(), '%y%m'), '00001')
            ELSE LPAD(MAX(nomkot) + 1, 9, '0')
        END as new_nomkot
    ")
            ->whereRaw("LEFT(nomkot, 4) = DATE_FORMAT(NOW(), '%y%m')")
            ->value('new_nomkot');

        $orderParams = [
            'nomkot' => $newOrderId,
            'created_at' => now()->format('Y:m:d H:i:s'),
        ];

        DB::table('orders')->insert($orderParams);

        $dataResponse = [
            'status' => 'ok',
            'data' => $orderParams
        ];
        return response()->json($dataResponse);
    }
}
