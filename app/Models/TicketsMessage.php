<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketsMessage extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'tickets_message';
}
