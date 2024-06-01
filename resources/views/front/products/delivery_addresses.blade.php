<h4 class="section-h4 deliveryText">Add New Delivery Address</h4>
<div class="u-s-m-b-24">
    <input type="checkbox" class="check-box" id="ship-to-different-address" data-toggle="collapse" data-target="#showdifferent">
    @if (count($deliveryAddresses) > 0)
    <label class="label-text newAddress" for="ship-to-different-address">Ship to a different address?</label>
    @else
    <label class="label-text newAddress" for="ship-to-different-address">Check to add Delivery Address</label>
    @endif
</div>
<div class="collapse" id="showdifferent">
    <form id="addressAddEditForm" action="javascript:;" method="post">
        @csrf
        <input type="hidden" name="delivery_id">
        <div class="group-inline u-s-m-b-13">
            <div class="group-1 u-s-p-r-16">
                <label for="delivery_name">Name
                    <span class="astk">*</span>
                </label>
                <input class="text-field" type="text" id="delivery_name" name="delivery_name">
                <p id="delivery-delivery_name"></p>
            </div>
            <div class="group-2">
                <label for="delivery_address">Address
                    <span class="astk">*</span>
                </label>
                <input class="text-field" type="text" id="delivery_address" name="delivery_address">
                <p id="delivery-delivery_address"></p>
            </div>
        </div>
        <div class="group-inline u-s-m-b-13">
            <div class="group-1 u-s-p-r-16">
                <label for="delivery_city">City
                    <span class="astk">*</span>
                </label>
                <div class="select-box-wrapper">
                    <select class="select-box" id="delivery_city" name="delivery_city">
                        <option value="">Select City</option>
                        @foreach ($cities as $city)
                        <option value="{{ $city['name'] }}" @if ($city['name']==\Illuminate\Support\Facades\Auth::user()->city) selected @endif>{{ $city['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="group-2">
                <label for="delivery_state">State
                    <span class="astk">*</span>
                </label>
                <div class="select-box-wrapper">
                    <select class="select-box" id="delivery_state" name="delivery_state">
                        <option value="">Select Province</option>
                        @foreach ($provinces as $province) {{-- $countries was passed from UserController to view using compact() method --}}
                        <option value="{{ $province['name'] }}" @if ($province['name']==\Illuminate\Support\Facades\Auth::user()->state) selected @endif>{{ $province['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="u-s-m-b-13">
            <label for="select-country-extra">Country
                <span class="astk">*</span>
            </label>
            <div class="select-box-wrapper">
                <select class="select-box" id="delivery_country" name="delivery_country">
                    <option value="">Select Country</option>
                    @foreach ($countries as $country) {{-- $countries was passed from UserController to view using compact() method --}}
                    <option value="{{ $country['country_name'] }}" @if ($country['country_name']==\Illuminate\Support\Facades\Auth::user()->country) selected @endif>{{ $country['country_name'] }}</option>
                    @endforeach
                </select>
                <p id="delivery-delivery_country"></p>
            </div>
        </div>
        <div class="u-s-m-b-13">
            <label for="delivery_mobile">Mobile
                <span class="astk">*</span>
            </label>
            <input class="text-field" type="text" id="delivery_mobile" name="delivery_mobile">
            <p id="delivery-delivery_mobile"></p>
        </div>
        <div class="u-s-m-b-13">
            <button style="width: 100%" type="submit" class="button button-outline-secondary">Save</button>
        </div>
    </form>
</div>
<div>
    <label for="order-notes">Order Notes</label>
    <textarea class="text-area" id="order-notes" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
</div>