<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Images;
class Exhibitions extends Model
{
    use HasFactory;
    protected $fillable=[
        'link',
        'activationLink',
        'enTitle',
        'arTitle'
    ];

    public function images(){
        return $this->hasMany(Images::class);
    }
}
