<?php

namespace App\Models;

use App\Models\User;
use App\Models\Favorie;
use App\Models\Category;
use App\Models\Commentaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    protected $fillable = ['name',
        'description',
        'prix', 
        'category_id', 
        'user_id',
        'defaultImage',
        'carouselImage'];

    use HasFactory;

    protected $cast = [
        'carouselImage' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function commentaire(): HasMany
    {
        return $this->hasMany(Commentaire::class);
    }

    public function favorie(): HasMany
    {
        return $this->hasMany(Favorie::class);
    }

}
