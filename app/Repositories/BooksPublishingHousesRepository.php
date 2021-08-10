<?php
/**
 * Created by PhpStorm.
 */

namespace App\Repositories;

use App\Models\PublishingHouses as Model;

class BooksPublishingHousesRepository extends CoreRepository
{

    /**
     * @return mixed
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @return mixed
     */
    public function getAllPublishingHouses()
    {
        $fields = ['id', 'title', 'link'];
        return $this->startConditions()->get($fields)->all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getOnePublishingHousesById(int $id)
    {
        $fields = ['id', 'title', 'link'];
        return $this->startConditions()->where('id', $id)->get($fields)->first();
    }

    /**
     * @param array $publishingHousesData
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    public function createPublishingHouses(array $publishingHousesData)
    {
        $publishingHouse = $this->startConditions();
        $publishingHouse->title = $publishingHousesData['title'];
        $publishingHouse->link = $publishingHousesData['link'] ?? false;
        $publishingHouse->save();
        return $publishingHouse;
    }

    /**
     * @param string $publishingHouseTitle
     * @return mixed
     */
    public function getOnePublishingHousesByTitle(string $publishingHouseTitle)
    {
        $fields = $fields = ['id', 'title', 'link'];
        return $this->startConditions()->where('title', $publishingHouseTitle)->get($fields)->first();
    }

    /**
     * @param array $publishingHouseArr
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    public function findOrCreatePublishingHouses(array $publishingHouseArr)
    {
        $publishingHouse = $this->getOnePublishingHousesByTitle($publishingHouseArr['title']);
        if (!$publishingHouse) {
            $publishingHouse = $this->createPublishingHouses($publishingHouseArr);
        }
        return $publishingHouse;
    }

}