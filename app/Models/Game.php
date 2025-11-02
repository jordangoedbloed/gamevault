<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['title','description','is_active','is_featured'];

    public function genres()    { return $this->belongsToMany(Genre::class); }
    public function platforms() { return $this->belongsToMany(Platform::class); }
    public function reviews() { return $this->hasMany(Review::class); }


    // Vrije tekst zoeken in titel/omschrijving
    public function scopeSearch($q, ?string $term)
    {
        if ($term) {
            $q->where(fn($qq)=>$qq
                ->where('title','like',"%{$term}%")
                ->orWhere('description','like',"%{$term}%"));
        }
        return $q;
    }

    public function scopeGenre($q, $genreId)
    {
        if ($genreId) {
            $q->whereHas('genres', fn($qq)=>$qq->where('genres.id',$genreId));
        }
        return $q;
    }

    public function scopePlatform($q, $platformId)
    {
        if ($platformId) {
            $q->whereHas('platforms', fn($qq)=>$qq->where('platforms.id',$platformId));
        }
        return $q;
    }

    public function scopeActive($q)
    {
        return $q->where('is_active', true);
    }
}
