<?php
/**
 * Created by PhpStorm.
 */

namespace App\Repositories;

use App\Models\Authors as Model;

class BooksAuthorsRepository extends CoreRepository
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
    public function getAllAuthors()
    {
        $fields = ['id', 'full_name'];
        return $this->startConditions()->get($fields)->all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getOneAuthorById(int $id)
    {
        $fields = $fields = ['id', 'full_name'];
        return $this->startConditions()->where('id', $id)->get($fields)->first();
    }

    /**
     * @param string $authorFullname
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    public function createAuthor(string $authorFullname)
    {
        $author = $this->startConditions();
        $author->full_name = $authorFullname;
        $author->save();
        return $author;
    }

    /**
     * @param string $authorFullname
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    public function findOrCreateAuthorByFullname(string $authorFullname){
        $author = $this->getOneAuthorByFullname($authorFullname);
        if(!$author){
            $author = $this->createAuthor($authorFullname);
        }
        return $author;
    }

    /**
     * @param string $authorFullname
     * @return mixed
     */
    public function getOneAuthorByFullname(string $authorFullname)
    {
        $fields = $fields = ['id', 'full_name'];
        return $this->startConditions()->where('full_name', $authorFullname)->get($fields)->first();
    }
}