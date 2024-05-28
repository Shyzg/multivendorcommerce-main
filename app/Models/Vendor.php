<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    // Relasi antara table 'vendors' dengan 'vendors_business_details'
    public function vendorbusinessdetails()
    {
        // Foreign key untuk 'vendor_id'
        return $this->belongsTo('App\Models\VendorsBusinessDetail', 'id', 'vendor_id');
    }

    public static function getVendorShop($vendorid)
    {
        // Digunakan untuk menampilkan dalam fungsi vendorListing() di Front/ProductsController.php
        $getVendorShop = \App\Models\VendorsBusinessDetail::select('shop_name')->where('vendor_id', $vendorid)->first()->toArray();

        return $getVendorShop['shop_name'];
    }
}
