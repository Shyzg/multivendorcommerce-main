<h4 class="section-h4 deliveryText">Tambahkan Alamat Pengiriman</h4>
<div class="u-s-m-b-24">
    <input type="checkbox" class="check-box" id="ship-to-different-address" data-toggle="collapse" data-target="#showdifferent">
    @if (count($deliveryAddresses) > 0)
    <label class="label-text newAddress" for="ship-to-different-address">Kirim Ke Alamat Yang Berbeda?</label>
    @else
    <label class="label-text newAddress" for="ship-to-different-address">Tambahkan Alamat</label>
    @endif
</div>
<div class="collapse" id="showdifferent">
    <form id="addressAddEditForm" action="javascript:;" method="post">
        @csrf
        <input type="hidden" name="delivery_id">
        <div class="group-inline u-s-m-b-13">
            <div class="group-1 u-s-p-r-16">
                <label for="delivery_name">Nama
                    <span class="astk">*</span>
                </label>
                <input class="text-field" type="text" id="delivery_name" name="delivery_name">
                <p id="delivery-delivery_name"></p>
            </div>
            <div class="group-2">
                <label for="delivery_address">Alamat
                    <span class="astk">*</span>
                </label>
                <input class="text-field" type="text" id="delivery_address" name="delivery_address">
                <p id="delivery-delivery_address"></p>
            </div>
        </div>
        <div class="group-inline u-s-m-b-13">
            <div class="group-1 u-s-p-r-16">
                <label for="delivery_city">Kota
                    <span class="astk">*</span>
                </label>
                <div class="select-box-wrapper">
                    <select class="select-box" id="delivery_city" name="delivery_city">
                        <option value="">Pilih Kota</option>
                        @foreach ($cities as $city)
                        <option value="{{ $city['name'] }}" @if ($city['name']==\Illuminate\Support\Facades\Auth::user()->city) selected @endif>{{ $city['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="group-2">
                <label for="delivery_state">Provinsi
                    <span class="astk">*</span>
                </label>
                <div class="select-box-wrapper">
                    <select class="select-box" id="delivery_state" name="delivery_state">
                        <option value="">Pilih Provinsi</option>
                        @foreach ($provinces as $province)
                        <option value="{{ $province['name'] }}" @if ($province['name']==\Illuminate\Support\Facades\Auth::user()->state) selected @endif>{{ $province['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="u-s-m-b-13">
            <label for="select-country-extra">Negara
                <span class="astk">*</span>
            </label>
            <div class="select-box-wrapper">
                <select class="select-box" id="delivery_country" name="delivery_country">
                    <option value="">Pilih Negara</option>
                    @foreach ($countries as $country)
                    <option value="{{ $country['name'] }}" @if ($country['name']==\Illuminate\Support\Facades\Auth::user()->country) selected @endif>{{ $country['name'] }}</option>
                    @endforeach
                </select>
                <p id="delivery-delivery_country"></p>
            </div>
        </div>
        <div class="u-s-m-b-13">
            <label for="delivery_mobile">Nomor Handphone
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