<?php
/**
 * Created by PhpStorm.
 */

namespace App\Repositories;

use App\Models\Books as Model;
use phpDocumentor\Reflection\Types\Integer;

class BooksRepository extends CoreRepository
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
    public function getAllBooks()
    {
        $result = $this->startConditions()->get()->all();
        $books = false;

        if (!empty($result)) {
            foreach ($result as $item) {
                $books[] = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'publishing_house' => $item->publishingHouses->title ?? false,
                    'author' => $item->author->full_name ?? false,
                    'isbn' => $item->isbn,
                    'page_count' => $item->page_count,
                ];
            }
        }
        return $books;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getOneBookById(int $id)
    {
        $result = $this->startConditions()->where('id', $id)->get()->first();
        $book = false;

        if (!empty($result)) {
            $book = [
                'id' => $result->id,
                'title' => $result->title,
                'publishing_house' => $result->publishingHouses->title ?? false,
                'author' => $result->author->full_name ?? false,
                'isbn' => $result->isbn,
                'page_count' => $result->page_count,
            ];
        }
        return $book;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteBookById(int $id)
    {
        return $this->startConditions()->destroy($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function createNewBook(array $data)
    {
        $book = $this->startConditions();
        $book->title = $data['title'];
        $book->publishing_house_id = $data['publishing_house_id'];
        $book->author_id = $data['author_id'];
        $book->isbn = $data['isbn'];
        $book->page_count = $data['page_count'];
        return $book->save();
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function updateBookById(array $data, int $id)
    {
        $book = $this->startConditions()->where('id', $id)->get()->first();
        if (empty($book)) {
            return false;
        }
        $book->title = $data['title'] ?? $book->title;
        $book->publishing_house_id = $data['publishing_house_id'] ?? $book->publishing_house_id;
        $book->author_id = $data['author_id'] ?? $book->author_id;
        $book->isbn = $data['isbn'] ?? $book->isbn;
        $book->page_count = $data['page_count'] ?? $book->page_count;
        return $book->save();
    }

    /**
     * @param string $title
     * @param int $authorId
     * @return mixed
     */
    public function getBookByTitleAndAuthorId(string $title, int $authorId)
    {
        return $this->startConditions()->where('title', $title)->where('author_id', $authorId)->get()->first();
    }
}