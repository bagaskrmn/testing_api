<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LoadTesting extends Controller
{
    public function loadTesting($count)
    {
        $resultData = DB::table('epc_lists')
            ->inRandomOrder()
            ->limit($count)
            ->select('tag_id')
            ->get();

        $data = ([
            'success' => true,
            'code' => 200,
            'message' => 'success get data',
            'epc_lists' => $resultData
        ]);

        return response()->json($data);
    }
}
