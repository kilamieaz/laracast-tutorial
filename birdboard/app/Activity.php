<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];

    // to database confert this array to string
    protected $casts = [
        'changes' => 'array'
    ];

    public function subject()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function username()
    {
        if ($this->user->is(auth()->user())) {
            return 'You';
        }
        return $this->user->name;
    }
}
