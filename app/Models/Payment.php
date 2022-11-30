<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'image', 'description'
    ];
    function image($real_size = false)
    {
        $thumbnail = $real_size ? '' : 'small_';

        if ($this->image && file_exists(public_path('images/payment/' . $thumbnail . $this->image)))
            return asset('images/payment/' . $thumbnail  . $this->image);
        else
            return asset('images/no_image.png');
    }

    function delete_image()
    {
        if ($this->image && file_exists(public_path('images/payment/' . $this->image)))
            unlink(public_path('images/payment/' . $this->image));
        if ($this->image && file_exists(public_path('images/payment/small_' . $this->image)))
            unlink(public_path('images/payment/small_' . $this->image));
    }

    protected $guarded = ['id'];

    public function invoices() {
        return $this->belongsTo(Invoice::class);
    }
}

