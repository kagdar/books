<?php

namespace App\Http\Controllers\Book;

use App\Repositories\BooksPublishingHousesRepository;
use Illuminate\Support\Facades\Log;

class PublishingHouseController extends BaseController
{
    private $bookPublishingHousesRepository;

    public function __construct()
    {
        parent::__construct();
        $this->bookPublishingHousesRepository = app(BooksPublishingHousesRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishingHouses = $this->bookPublishingHousesRepository->getAllPublishingHouses();
        if (empty($publishingHouses)) {
            Log::channel('book')->info('status:404 | Api endpoint | Publishing House not found');
            return response()->json(['message' => 'Publishing House not found '], 404);
        }
        Log::channel('book')->info('status:200 | Api endpoint | All Publishing Houses was found');
        return response()->json($publishingHouses, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
//    public function show(PublishingHousesRequest $request,$publishing_house)
    public function show($id)
    {
        $publishingHouse = $this->bookPublishingHousesRepository->getOnePublishingHousesById($id);
        if (empty($publishingHouse)) {
            Log::channel('book')->info('status:404 | Api endpoint | Publishing House was found');
            return response()->json(['message' => 'Publishing House not found '], 404);
        }
        Log::channel('book')->info('status:200 | Api endpoint | Publishing House id: '.$id.' found');
        return response()->json($publishingHouse, 200);
    }
}
