<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Claim;

class answer extends Model
{
    use HasFactory;

       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id',
        'type',
        'field',
        'choice',
        'email',
        'phone_number',
        'text',
        'boolean'
    ];

    public function claim()
    {
        return $this->belongsTo(Claim::class, "event_id");
    }
}
