<?php

namespace App\Http\Requests;

use App\Models\Job;
use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $routePath = explode('/', $this->decodedPath());
        $authorize = false;

        switch ($this->method()) {
            case 'POST':
                $authorize = true;
                break;
            case 'PUT':
                $job = Job::find($routePath[2]);

                if ($job->user_id == auth()->id()) {
                    $authorize = true;
                }
                break;
        }

        return $authorize;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:2|max:120',
            'job_category_id' => 'required|exists:job_categories,id',
            'remote' => 'required|integer',
            'user_address_id' => 'exists:user_addresses,id',
            'description' => 'required|string|min:10|max:20000'
        ];
    }
}
