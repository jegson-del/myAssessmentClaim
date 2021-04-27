<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Answer;
use App\Models\User;

class Claim extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id',
        'event_type',
        'user_id',
        'form_response'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function answer()
    {
        return $this->hasMany(Answer::class, 'event_id', 'event_id');
    }

}
