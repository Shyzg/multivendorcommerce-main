<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use App\Models\DeliveryAddress;
use App\Models\Country;
use App\Models\City;
use App\Models\Province;

class AddressController extends Controller
{
    public function getDeliveryAddress(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // Mencari alamat pengiriman berdasarkan id dari data request
            $deliveryAddress = DeliveryAddress::find($data['addressid']);

            // Mengembalikan data alamat dalam format json karna yang ada di dalam views front berinteraksi menggunakan AJAX
            return response()->json(['address' => $deliveryAddress]);
        }
    }


    public function saveDeliveryAddress(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'delivery_name'    => 'required|string|max:100',
                'delivery_address' => 'required|string|max:100',
                'delivery_city'    => 'required|string|max:100',
                'delivery_state'   => 'required|string|max:100',
                'delivery_country' => 'required|string|max:100',
                'delivery_mobile'  => 'required|numeric'
            ]);

            if ($validator->passes()) {
                $data = $request->all();
                // Menyiapkan data alamat yang akan disimpan
                $address = [
                    'user_id' => Auth::user()->id,
                    'name'    => $data['delivery_name'],
                    'address' => $data['delivery_address'],
                    'city'    => $data['delivery_city'],
                    'state'   => $data['delivery_state'],
                    'country' => $data['delivery_country'],
                    'mobile'  => $data['delivery_mobile']
                ];

                // Memeriksa apakah ada id pengiriman
                if (!empty($data['delivery_id'])) {
                    DeliveryAddress::where('id', $data['delivery_id'])->update($address);
                } else {
                    DeliveryAddress::create($address);
                }

                // Mengambil data alamat pengiriman terbaru
                $deliveryAddresses = DeliveryAddress::deliveryAddresses();
                $countries = Country::orderBy('name', 'asc')->get();
                $cities = City::orderBy('name', 'asc')->get();
                $provinces = Province::orderBy('name', 'asc')->get();

                // Mengembalikan tampilan alamat pengiriman dalam format json
                return response()->json([
                    'view' => (string) View::make('front.products.delivery_addresses')
                        ->with(compact('deliveryAddresses', 'countries', 'cities', 'provinces'))
                ]);
            } else {
                // Mengembalikan pesan kesalahan validasi dalam format json
                return response()->json([
                    'type'   => 'error',
                    'errors' => $validator->messages()
                ]);
            }
        }
    }

    public function removeDeliveryAddress(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            DeliveryAddress::where('id', $data['addressid'])->delete();

            // Mengambil data terbaru dari database untuk diperbarui di view
            $deliveryAddresses = DeliveryAddress::deliveryAddresses();
            $countries = Country::orderBy('name', 'asc')->get();
            $cities = City::orderBy('name', 'asc')->get();
            $provinces = Province::orderBy('name', 'asc')->get();

            return response()->json([
                // Mengonversi view menjadi string dan mengubah/memasukkan dalam bentuk json
                'view' => (string) View::make('front.products.delivery_addresses')
                    ->with(compact('deliveryAddresses', 'countries', 'cities', 'provinces'))
            ]);
        }
    }
}
