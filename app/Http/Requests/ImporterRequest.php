<?php

namespace App\Http\Requests;

use App\Models\Books;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use App\Repositories\BooksRepository;

class ImporterRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function boot()
    {
        Validator::excludeUnvalidatedArrayKeys();
    }

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            '*.author' => 'required|string|min:1|max:255',
            '*.title' => 'required|string|min:1|max:255',
            '*.publishing_house_title' => 'required|string|min:1|max:255',
            '*.publishing_house_link' => 'url|min:1|max:255',
            '*.isbn' => 'required|alpha_dash|min:1|max:60',
            '*.page_count' => 'required|integer',
        ];
    }
}
