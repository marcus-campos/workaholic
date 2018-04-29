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

        if (isset($routePath[0]) && isset($routePath[1])) {

            if (
                $routePath[0] == 'user' &&
                $routePath[1] == 'job' &&
                !isset($routePath[2])
            ) {
                $authorize = true;
            }

            if (
                $routePath[0] == 'user' &&
                $routePath[1] == 'job' &&
                isset($routePath[2])
            ) {
                $job = Job::find($routePath[2]);

                if($job->user_id == auth()->id()) {
                    $authorize = true;
                }
            }
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
            'job_category_id' => 'required|job_categories,id',
            'remote' => 'required|integer',
            'city_id' => 'required|cities,id',
            'description' => 'required|string|min:10|max:20000'
        ];
    }
}
