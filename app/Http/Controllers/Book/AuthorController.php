<?php

namespace App\Http\Controllers\Book;

use App\Models\Authors;
use App\Repositories\BooksAuthorsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthorController extends BaseController
{
    private $bookAuthorsRepository;

    public function __construct()
    {
        parent::__construct();
        $this->bookAuthorsRepository = app(BooksAuthorsRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::channel('books')->info('Something happened!');
        $authors = $this->bookAuthorsRepository->getAllAuthors();
        if (empty($authors)) {
            Log::channel('book')->info('status:404 | Api endpoint | Authors not found');
            return response()->json(['message' => 'Authors not found '], 404);
        }
        Log::channel('book')->info('status:200 | Api endpoint | All authors was found');

        return response()->json($authors, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $authors = $this->bookAuthorsRepository->getOneAuthorById($id);
        if (empty($authors)) {
            Log::channel('book')->info('status:404 | Api endpoint | Author not found');
            return response()->json(['message' => 'Author not found '], 404);
        }
        Log::channel('book')->info('status:200 | Api endpoint | Author id: '.$id.' found');
        return response()->json($authors, 200);
    }

}
