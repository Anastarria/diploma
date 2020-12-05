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
 * @property string $book_id
 * @property string $user_id
 *

 * @property User $user
 */


class Bookmark extends Model
{
    use HasFactory, Notifiable;

    public function book(): HasOne
    {
        return $this->hasOne(Book::class, 'id', 'book_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
