<?php

namespace App\Models;

use App\Models\User;
use App\Models\CommentModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostModels extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $fillable =[
        'title', 'news_content', 'author'
    ];
    /**
     * Get the writer that owns the PostModels
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function writer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    /**
     * Get all of the comments for the PostModels
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(CommentModels::class, 'post_id', 'id');
    }
}
