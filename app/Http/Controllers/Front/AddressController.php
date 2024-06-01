<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DeliveryAddress;
use App\Models\Country;
use App\Models\City;
use App\Models\Province;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class AddressController extends Controller
{
    public function getDeliveryAddress(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $deliveryAddress = DeliveryAddress::where('id', $data['addressid'])->first();

            return response()->json([
                'address' => $deliveryAddress
            ]);
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
                $address = array();
                $address['user_id'] = Auth::user()->id;
                $address['name']    = $data['delivery_name'];
                $address['address'] = $data['delivery_address'];
                $address['city']    = $data['delivery_city'];
                $address['state']   = $data['delivery_state'];
                $address['country'] = $data['delivery_country'];
                $address['mobile']  = $data['delivery_mobile'];

                if (!empty($data['delivery_id'])) {
                    DeliveryAddress::where('id', $data['delivery_id'])->update($address);
                } else {
                    DeliveryAddress::create($address);
                }

                $deliveryAddresses = DeliveryAddress::deliveryAddresses();
                $countries = Country::get()->toArray();
                $cities =  City::get()->toArray();
                $provinces = Province::get()->toArray();

                return response()->json([
                    'view' => (string) View::make('front.products.delivery_addresses')->with(compact('deliveryAddresses', 'countries', 'cities', 'provinces'))
                ]);
            } else {
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

            $deliveryAddresses = DeliveryAddress::deliveryAddresses();
            $countries = Country::get();
            $cities =  City::get();
            $provinces = Province::get();

            return response()->json([
                'view' => (string) View::make('front.products.delivery_addresses')->with(compact('deliveryAddresses', 'countries', 'cities', 'provinces'))
            ]);
        }
    }
}
