<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PencatatanStoreRequest;
use App\Models\MeterRecord;

class PencatatanController extends Controller
{

    public function store(PencatatanStoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth()->id();
        if ($request->hasFile('evidence')) {
            $path = $request->file('evidence')->store('evidence', 'public');
            $data['evidence'] = $path;
        }
        $pencatatan = MeterRecord::create($data);

        if ($pencatatan) {
            return successResponse("Data berhasil disimpan!", $pencatatan, 201);
        }

        return errorResponse("Terjadi kesalahan saat menyimpan data");
    }
}
