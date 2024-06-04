<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Carbon\Carbon;
use App\Events\RepresentationCreated;
use App\Traits\HasAvailableSeats;

class Representation extends Model implements Feedable
{
    use HasFactory, HasAvailableSeats;

    // Dispatch l'event RepresentationCreated lors de la création d'une représentation
    protected $dispatchesEvents = [
        'created' => RepresentationCreated::class,
    ];

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

    public function seats()
    {
        return $this->belongsToMany(Seat::class, 'representation_seat')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function reservations()
    {
        return $this->hasManyThrough(Reservation::class, RepresentationSeat::class, 'representation_id', 'id', 'id', 'representation_seat_id');
    }

    // ------------------------------------------------------------------

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

    public function hasAttended(): bool
    {
        // vérifie s'il existe une réservation pour cette représentation associée à l'utilisateur
        return $this->representationReservations()
            ->whereHas('reservation', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->exists();
    }

    public function isPaymentConfirmed(): bool
    {
        // vérifie si toutes les réservations associées à cette représentation ont un statut confirmé
        return $this->representationReservations()->whereHas('reservation', function ($query) {
            $query->where('status', 'confirmed');
        })->exists();
    }

    public function scopeFuture($query)
    {
        return $query->where('schedule', '>', Carbon::now());
    }
}
