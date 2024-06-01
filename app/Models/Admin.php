<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $guard = 'admin';

    public function vendorPersonal()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function vendorBusiness()
    {
        return $this->belongsTo(VendorsBusinessDetail::class, 'vendor_id');
    }
}
