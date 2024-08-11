<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentModels extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $fillable =[
        'user_id', 'post_id', 'comments_content'
    ];
    /**
     * Get the commentator that owns the CommentModels
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commentator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
