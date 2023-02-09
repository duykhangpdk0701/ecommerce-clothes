<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ViewActivity extends Model
{
    use HasFactory;

    protected $table = 'views';

    protected $fillable = [
        'viewable_type',
        'viewable_id',
        'user_id',
        'user_email',
        'user_activity',
        'tracking',
        'ip',
        'forward_ip',
        'user_agent'
    ];

    public function viewable(): MorphTo
    {
        return $this->morphTo();
    }
}
