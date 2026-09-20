<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    protected $fillable = [
        'title',
        'project',
        'priority',
        'status',
        'developer',
        'description',
        'reporter_id',
        'attachment',
        'attachment_name',
        'attachment_size',
    ];

    /**
     * Get the user who reported the bug.
     */
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }
}
