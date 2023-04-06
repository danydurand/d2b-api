<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ConditionPaymentUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $method = $this->method();
        $id     = Route::current()->parameter('condition_payment')->id;

        if ($method == 'PUT') {
            return [
                'description'  => ['required', 'string', 'max:100', Rule::unique('condition_payments')->ignore($id)],
                'branch_id'    => ['required', 'integer', 'exists:branches,id'],
                'credit_days'  => ['required', 'integer'],
                'field1'       => ['nullable', 'string', 'max:60'],
                'field2'       => ['nullable', 'string', 'max:60'],
                'field3'       => ['nullable', 'string', 'max:60'],
                'field4'       => ['nullable', 'string', 'max:60'],
                'must_be_sync' => ['required'],
                'sync_at'      => ['nullable'],
                'created_by'   => ['nullable'],
                'updated_by'   => ['required', 'integer', 'exists:users,id'],
            ];
        } else {
            return [
                'description'  => ['sometimes', 'required', 'string', 'max:100', Rule::unique('condition_payments')->ignore($id)],
                'branch_id'    => ['sometimes', 'required', 'integer', 'exists:branches,id'],
                'credit_days'  => ['sometimes', 'required', 'integer'],
                'field1'       => ['nullable', 'string', 'max:60'],
                'field2'       => ['nullable', 'string', 'max:60'],
                'field3'       => ['nullable', 'string', 'max:60'],
                'field4'       => ['nullable', 'string', 'max:60'],
                'must_be_sync' => ['required'],
                'sync_at'      => ['nullable'],
                'created_by'   => ['nullable'],
                'updated_by'   => ['required', 'integer', 'exists:users,id'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if (strlen($this->description)) {
            $this->merge([ 'description' => Str::upper($this->description), ]);
        }
        if (strlen($this->branchId)) {
            $this->merge([ 'branch_id' => $this->branchId, ]);
        }
        if (strlen($this->creditDays)) {
            $this->merge([ 'credit_days' => $this->creditDays, ]);
        }
        if (strlen($this->mustBeSync)) {
            $this->merge([ 'must_be_sync' => $this->mustBeSync, ]);
        }
        if ($this->syncAt) {
            $this->merge([ 'sync_at' => $this->syncAt, ]);
        }
        if ($this->updatedBy) {
            $this->merge([ 'updated_by' => $this->updatedBy, ]);
        }
    }

}
