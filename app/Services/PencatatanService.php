<?php

namespace App\Services;

use App\Models\MeterRecord;

class PencatatanService
{
    public function update(string $id, array $data): bool
    {
        $record = MeterRecord::find($id);
        if (!$record) {
            return false;
        }
        $record->fill($data);

        if ($record->isDirty()) {
            return $record->save();
        }

        return true;
    }
}
