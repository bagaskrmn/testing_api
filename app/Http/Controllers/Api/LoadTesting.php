<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class LoadTesting extends Controller
{
    public function loadTesting(Request $request, $count)
    {
        try{
            $resultData = DB::table('linen_lists')
            ->whereNull('linen_lists.deleted_at')
            ->inRandomOrder()
            ->limit($count)
            ->leftJoin('epc_lists', 'linen_lists.epc_list_id', '=', 'epc_lists.id')
            ->leftJoin('registrations', 'linen_lists.registration_id', '=', 'registrations.id')
            ->leftJoin('linen_types', 'registrations.linen_type_id', '=', 'linen_types.id')
            ->select('epc_lists.tag_id', 'linen_types.linen_type_name')
            ->get();
        $data = ([
            'success' => true,
            'code' => 200,
            'message' => 'success get data',
            'epc_lists' => $resultData
        ]);
        Log::info('success');

        return response()->json($data);
        } catch (\Throwable $th) {
            $data = ([
            'success' => false,
            'code' => 400,
            'message' => 'error : ' . $th
        ]);
        Log::error('gagal');

        return response()->json($data);

        }
    }
}
