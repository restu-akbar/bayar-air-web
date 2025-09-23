<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PencatatanUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'meter'          => 'nullable|integer|min:1',
            'evidence'       => 'nullable|file|mimes:jpg,jpeg,png|max:3072',
            'total_amount'   => 'nullable|integer|min:0',
            'fine'           => 'nullable|integer|min:0',
            'duty_stamp'     => 'nullable|integer|min:0',
            'retribution_fee' => 'nullable|integer|min:0',
            'status' => 'sometimes|string|in:belum_bayar,sudah_bayar',
        ];
    }

    public function attributes()
    {
        return [
            'meter'           => 'angka meteran',
            'evidence'        => 'bukti meteran',
            'total_amount'    => 'total harga',
            'fine'            => 'denda',
            'duty_stamp'      => 'bea materai',
            'retribution_fee' => 'retribusi',
            'status' => 'status pembayaran',
        ];
    }
}
