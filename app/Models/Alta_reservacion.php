<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alta_reservacion extends Model
{
    use HasFactory;

    protected $table = 'alta_reservacion';

    protected $primaryKey = 'idalta_reservacion';

    public $timestamps = false;
}
