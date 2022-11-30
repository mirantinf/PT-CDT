<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = ['id'];

    public function project() {
        return $this->belongsTo(Project::class);
    }
    public function payments()
    {
        return $this->hasOne(Payment::class);
    }
}
