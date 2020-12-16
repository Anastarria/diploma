<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;


/**
 * Class User
 * @package App\Models
 * @property int $id
 * @property string $added_by
 * @property string $text
 * @property string $book_id

 *

 * @property User $user
 */
class Comment extends Model
{
    use HasFactory, Notifiable;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): HasOne
    {
        return $this->hasOne(Book::class, 'id', 'book_id');
    }


}
