<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImporterRequest;
use App\Providers\AuthServiceProvider;
use App\Repositories\BooksAuthorsRepository;
use App\Repositories\BooksPublishingHousesRepository;
use App\Repositories\BooksRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ImporterController extends BaseController
{
    private $booksRepository;

    public function __construct()
    {
        parent::__construct();
        $this->bookAuthorsRepository = app(BooksAuthorsRepository::class);
        $this->booksRepository = app(BooksRepository::class);
        $this->bookPublishingHousesRepository = app(BooksPublishingHousesRepository::class);

    }

    /**
     * @param ImporterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function importJson(ImporterRequest $request)
    {
        $validatedData = $request->validated();

        foreach ($validatedData as $validatedDatum) {
            $author = $this->bookAuthorsRepository->findOrCreateAuthorByFullname($validatedDatum["author"]);
            $publishingHouseArr = [
                'title' => $validatedDatum["publishing_house_title"],
                'link' => $validatedDatum["publishing_house_link"] ?? ""
            ];
            $publishingHouse = $this->bookPublishingHousesRepository->findOrCreatePublishingHouses($publishingHouseArr);
            $book = [
                'title' => $validatedDatum['title'],
                'publishing_house_id' => $publishingHouse->id,
                'author_id' => $author->id,
                'isbn' => $validatedDatum['isbn'],
                'page_count' => $validatedDatum['page_count'],
            ];
            //check if book isset
            if (!$this->booksRepository->getBookByTitleAndAuthorId($book['title'],
                $book['author_id'])) {
                //save new book
                $this->booksRepository->createNewBook($book);
            } else {
                //add book if it isset in db
                $error[] = $book['title'];
            }
        }
        if (!empty($error)) {
            Log::channel('book')->info('status:200 | Api endpoint | Not all books was imported successfully, it exists in the database!');
            return response()->json([
                'message' => 'Not all books was imported successfully, it exists in the database! This books not imported: ' . implode(',',
                        $error)
            ], 200);
        }
        Log::channel('book')->info('status:200 | Api endpoint | All book was imported successfully');
        return response()->json(['message' => 'All book was imported successfully'], 200);
    }
}
