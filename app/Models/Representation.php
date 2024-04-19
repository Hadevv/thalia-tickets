<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Carbon\Carbon;

class Representation extends Model implements Feedable
{
    use HasFactory;

    protected $fillable = [
        'schedule',
        'location_id',
        'show_id'
    ];
    protected $table = 'representations';

    public $timestamps = false;

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function show()
    {
        return $this->belongsTo(Show::class);
    }
    public function representationReservations()
    {
        return $this->hasMany(RepresentationReservation::class);
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->show->title)
            ->summary($this->show->description)
            ->updated(Carbon::now())
            ->link(route('representation.show', $this->id))
            ->authorName("Bob Sull")
            ->authorEmail("bob@sull.com");
    }

    public static function getFeedItems()
    {
    return Representation::all();
    }
}
