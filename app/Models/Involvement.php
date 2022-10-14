<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Involvement extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'act_code',
        'report_code',
        'date_notification',
        'date_received',
        'start_date',
        'end_date',
        'task_type',
        'work_status',
        'place_execution',
        'coordinates',
        'examined',
        'persons',
        'ammunition',
        'all_ammunition',
        'tnt',
        'detonator'
    ];
}
