<?php

namespace App\Models\Backend;

use App\Models\User;
use Modules\Song\Models\Song;
use App\Models\Backend\SongCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SongCategory extends Model
{
    use HasFactory;

    protected $table = 'song_categories';

    protected $fillable = [
        'name',
        'slug',
        'status',
        'description',
        'parent_id',
        'order',
        'is_featured',
        'is_special',
        'hits',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    // ... other code

    public static function boot()
    {
        parent::boot();

        // Set the created_by and updated_by attributes
        static::creating(function ($model) {
            $model->created_by = Auth::id();
            $model->updated_by = Auth::id();
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });

        static::deleting(function ($model) {
            $model->deleted_by = Auth::id();
        });
    }

    /**
     * Get the songs for the song category.
     */
    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    /**
     * Get the parent song category that owns the song category.
     */
    public function parent()
    {
        return $this->belongsTo(SongCategory::class, 'parent_id');
    }

    /**
     * Get the children song categories for the song category.
     */
    public function children()
    {
        return $this->hasMany(SongCategory::class, 'parent_id');
    }

    /**
     * Get the user that owns the song category.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user that updated the song category.
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the user that deleted the song category.
     */
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    /**
     * Get all song categories who is parent.
     */
    public static function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }
}
