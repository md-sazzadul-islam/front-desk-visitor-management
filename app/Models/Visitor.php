<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $table = 'visitor';
    protected $fillable = [
        'visitor_mobile',
        'date',
        'vname',
        'company',
        'address',
        'department',
        'employee',
        'employee_email',
        'purpose',
        'nid',
        'card_no',
        'in_time',
        'out_time',
        'comments',
        'visitor_image',
        'entrydate',
        'is_exit',
        'exit_time',
        'cer_id'
    ];
}
