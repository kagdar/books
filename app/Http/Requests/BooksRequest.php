<?php

namespace App\Http\Requests;

use App\Models\Books;
use App\Repositories\BooksRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BooksRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
        $rules = [
            'author_id' => 'required|integer|exists:authors,id',
            'title' => [
                'required',
                'string',
                'min:1',
                'max:255',
                function ($attribute, $value, $fail) {
                    $bookRepository = new BooksRepository();
                    $result = $bookRepository->getBookByTitleAndAuthorId($value, $this->get('author_id'));
                    if ($result) {
                        $fail('This author has already written such a book ');
                    }
                },
            ],
            'publishing_house_id' => 'required|integer|exists:publishing_houses,id',
            'isbn' => 'required|string|min:1|max:255',
            'page_count' => 'required|integer',
        ];

        switch ($this->getMethod()) {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                    'author_id' => 'sometimes|integer|exists:authors,id',
                    'title' => [
                        'sometimes',
                        'string',
                        'min:1',
                        'max:255'
                    ],
                    'publishing_house_id' => 'sometimes|integer|exists:publishing_houses,id',
                    'isbn' => 'sometimes|string|min:1|max:255',
                    'page_count' => 'sometimes|integer',
                ];
            case 'PATCH':
                return [
                    'title' => ['sometimes', 'string', 'min:1', 'max:255'],
                    'publishing_house_id' => 'sometimes|integer|exists:publishing_houses,id',
                    'author_id' => 'sometimes|integer|exists:authors,id',
                    'isbn' => 'sometimes|string|min:1|max:255',
                    'page_count' => 'sometimes|integer',
                ];
        }
    }
}
