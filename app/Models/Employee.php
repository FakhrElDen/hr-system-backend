<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Employee extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'position',
        'salary',
        'hired_at',
        'status',
        'department_id'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function getHiredAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
