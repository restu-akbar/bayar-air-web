<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PencatatanStoreRequest extends FormRequest
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
    public function rules()
    {
        return [
            'customer_id'    => 'required|string|exists:customers,id',
            'meter'          => 'required|integer|min:1',
            'evidence'       => 'required|file|mimes:jpg,jpeg,png|max:5024',
            'total_amount'   => 'required|integer|min:0',
            'fine'           => 'nullable|integer|min:0',
            'duty_stamp'     => 'nullable|integer|min:0',
            'retribution_fee' => 'nullable|integer|min:0',
        ];
    }

    public function attributes()
    {
        return [
            'customer_id'     => 'pelanggan',
            'meter'           => 'angka meteran',
            'evidence'        => 'bukti meteran',
            'total_amount'    => 'total harga',
            'fine'            => 'denda',
            'duty_stamp'      => 'bea materai',
            'retribution_fee' => 'retribusi',
        ];
    }
}
