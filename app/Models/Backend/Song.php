<?php

namespace App\Models\Backend;

use App\Models\User;
use App\Models\Backend\Artist;
use App\Models\Backend\SongCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Frontend\SongCheckout;
class Song extends Model
{
    use HasFactory;

    protected $table = 'songs';

    protected $fillable = [
        'title',
        'slug',
        'lyrics',
        'short_description',
        'status',
        'song_category_id',
        'song_artist_id',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'meta_og_image',
        'meta_og_url',
        'hits',
        'created_by',
        'updated_by',
        'deleted_by',
        'moderated_by',
        'moderated_at',
    ];

    // ... other code

    public static function boot()
    {
        parent::boot();

        // Set the created_by and updated_by attributes
        static::creating(function ($model) {
            $model->created_by = auth()->id();
            $model->updated_by = auth()->id();
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->id();
        });

        static::deleting(function ($model) {
            $model->deleted_by = auth()->id();
        });
    }

    public function category()
    {
        return $this->belongsTo(SongCategory::class, 'song_category_id');
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'song_artist_id');
    }

    public function getLyricsAttribute($value)
    {
        if (auth()->check()) {
            $checkout = SongCheckout::where('song_id', $this->id)->where('user_id', auth()->id())->first();
            if ($checkout) {
                return $value;
            } else {
                return $this->short_description;
            }
        } else {
            return $this->short_description;
        }
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeUnpublished($query)
    {
        return $query->where('status', 'unpublished');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('lyrics', 'like', '%' . $search . '%')
            ->orWhere('short_description', 'like', '%' . $search . '%');
    }

    public function getCheckoutButtonHtml()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $isPurchased = $user->songCheckouts()->where('song_id', $this->id)->exists();
    
            if ($isPurchased) {
                return ''; // Empty string to hide the button for purchased songs
            }
    
            return sprintf('<p class="text-muted">এই গানটি কিনতে আপনার ১টি কানেকশন খরচ হবে।</p><a href="#" class="btn btn--primary tp-btn btn--lg btn--round mb-15 btn-checkout" data-song_id="%s" data-user_id="%s" data-connects="%s">
                    <span class="mr-10"><i class="fal fa-shopping-cart"></i></span> সম্পূর্ণ লিরিক্স ক্রয় করুন
                </a>',
                $this->id,
                $user->id,
                $user->connects
            );
        } else {
            return sprintf(
                '<p class="text-muted">এই গানটি কিনতে আপনার ১টি কানেকশন খরচ হবে।</p><a href="%s" class="btn btn--primary tp-btn btn--lg btn--round mb-15">
                    <span class="mr-10"><i class="fal fa-shopping-cart"></i></span> সম্পূর্ণ লিরিক্স ক্রয় করুন
                </a>',
                route('login')
            );
        }
    }    
}
