<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    public const PENAWARAN = 'Penawaran';
    public const DEMO = 'Demo';
    public const FOLLOW_UP = 'Follow Up';
    public const GO = 'Go';

    public function projects() {
        return $this->hasMany(Project::class);
    }
}
