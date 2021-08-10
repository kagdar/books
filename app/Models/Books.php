<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $fillable = ['title', 'publishing_house_id', 'author_id', 'isbn', 'page_count'];
    protected $hidden = ["created_at", "updated_at"];
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publishingHouses()
    {
        return $this->belongsTo(PublishingHouses::class, 'publishing_house_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(Authors::class, 'author_id');
    }
}
