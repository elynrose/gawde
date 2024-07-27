<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'agents';

    protected $dates = [
        'date_reviewed',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'review_results',
        'date_reviewed',
        'habit_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getDateReviewedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateReviewedAttribute($value)
    {
        $this->attributes['date_reviewed'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function habit()
    {
        return $this->belongsTo(Habit::class, 'habit_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
