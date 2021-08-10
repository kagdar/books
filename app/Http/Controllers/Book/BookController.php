<?php

namespace App\Http\Controllers\Book;
use App\Http\Requests\BooksRequest;
use App\Repositories\BooksRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends BaseController
{
    private $booksRepository;

    public function __construct()
    {
        parent::__construct();
        $this->booksRepository = app(BooksRepository::class);
    }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = $this->booksRepository->getAllBooks();
        if (empty($books)) {
            Log::channel('book')->info('status:404 | Api endpoint | Books not found');
            return response()->json(['message' => 'Books not found '], 404);
        }
        Log::channel('book')->info('status:200 | Api endpoint | All Books found');
        return response()->json($books, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BooksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BooksRequest $request)
    {
        $validatedData = $request->validated();
        $book = $this->booksRepository->createNewBook($validatedData);
        if (empty($book)) {
            Log::channel('book')->info('status:500 | Api endpoint | Books not created');
            return response()->json(['message' => 'Book not created '], 500);
        }
        Log::channel('book')->info('status:200 | Api endpoint | Books was created');
        return response()->json(['message' => 'Book was created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = $this->booksRepository->getOneBookById($id);

        if (empty($book)) {
            Log::channel('book')->info('status:404 | Api endpoint | Book not found');
            return response()->json(['message' => 'Book not found '], 404);
        }
        Log::channel('book')->info('status:200 | Api endpoint | Book id:'. $id .' found');
        return response()->json($book, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BooksRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BooksRequest $request, $id)
    {
        $validatedData = $request->validated();
        $book = $this->booksRepository->updateBookById($validatedData, $id);
        if (empty($book)) {
            Log::channel('book')->info('status:500 | Api endpoint | Book not updated');
            return response()->json(['message' => 'Book not updated '], 500);
        }
        Log::channel('book')->info('status:200 | Api endpoint | Book id:'.$id.' updated');
        return response()->json(['message' => 'Book was updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $books = $this->booksRepository->deleteBookById($id);
        if (empty($books)) {
            Log::channel('book')->info('status:404 | Api endpoint | Book not found');
            return response()->json(['message' => 'Book not found '], 404);
        }
        Log::channel('book')->info('status:200 | Api endpoint | Books id:'.$id.' deleted');
        return response()->json(['message' => 'Book id '.$id.' was deleted'], 200);
    }
}
