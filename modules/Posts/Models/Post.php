<?php
namespace Modules\Posts\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];

    public function author()
    {
        return $this->belongsTo(\Modules\Auth\Models\User::class, 'user_id');
    }
}
