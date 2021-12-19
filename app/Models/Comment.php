<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property mixed|string text
 * @property Carbon|mixed created_at
 * @property Carbon|mixed updated_at
 * @property mixed user_id
 * @property mixed article_id
 * @property mixed parent_id
 * @property int|mixed is_active
 */
class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
