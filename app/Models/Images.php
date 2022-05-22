<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exhibitions;
class Images extends Model
{
    use HasFactory;
    protected $fillable=[
        'image',
        'exhibitions_id',
    ];

    public function exhibitions(){
        return $this->belongsTo(Exhibitions::class);
    }
}
