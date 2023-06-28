<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayOffRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch ($this->route()->getActionMethod()) {
            case 'store':
                return [
                    'debtId' => 'required|int',
                    'paidAt' => 'required|date_format:Y-m-d H:i:s',
                    'paidAmount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
                    'paidBy' => 'required|string',
                ];
        }
    }
}