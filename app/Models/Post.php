<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Casts\Attribute;
use Cviebrock\EloquentSluggable\Sluggable;

use Carbon\Carbon;

class Post extends Model
{
    use HasFactory, SoftDeletes, Sluggable;
    protected $fillable = ['title', 'content', 'author', 'image_url', 'original_image_name'];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function createdAt(): Attribute
    {
        return new Attribute(
            get: fn($value) => Carbon::parse($value)->format('d-m-Y H:i A')
        );
    }

    public function imageUrl(): Attribute
    {
        return new Attribute(
            get: fn($value) => $value ? asset('storage/' . $value) : null
        );
    }
}
