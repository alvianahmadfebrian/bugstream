<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    protected $fillable = [
        'title',
        'priority',
        'status',
        'developer',
        'description',
        'reporter_id',
    ];

    /**
     * Get the user who reported the bug.
     */
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }
}
