<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;


/**
 * Class User
 * @package App\Models
 * @property int $id
 * @property string $added_by
 * @property string $title
 * @property string $author
 * @property string $description
 * @property string $genre
 * @property string $cover
 * @property string $path_to_book
 *

 * @property User $user
 */
class Book extends Model
{
    use HasFactory, Notifiable;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
