<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scheduler extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'schedulers';

    protected $dates = [
        'today',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'habit_id',
        'today',
        'user_id',
        'reminded',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function habit()
    {
        return $this->belongsTo(Habit::class, 'habit_id');
    }

    public function getTodayAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTodayAttribute($value)
    {
        $this->attributes['today'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
