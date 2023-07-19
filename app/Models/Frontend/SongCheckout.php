<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Backend\Song;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class SongCheckout extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'song_checkouts';

    public $fillable = [
        'invoice_no',
        'song_id',
        'user_id',
        'connects',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        // create a event to happen on creating
        static::creating(function ($table) {
            $table->created_by = Auth::id();
        });

        // create a event to happen on updating
        static::updating(function ($table) {
            $table->updated_by = Auth::id();
        });

        // create a event to happen on deleting
        static::deleting(function ($table) {
            $table->deleted_by = Auth::id();
            $table->save();
        });
    }

    public function song()
    {
        return $this->belongsTo(Song::class, 'song_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
