<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artist extends Model
{
    use HasFactory;

    protected $table = 'artists';

    protected $fillable = [
        'name',
        'slug',
        'image',
        'bio',
        'website',
        'status',
        'is_featured',
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
    }

    // relationship with user
    public function user_created()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // relationship with user
    public function user_updated()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
