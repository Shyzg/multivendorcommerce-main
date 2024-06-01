<div class="row product-container grid-style">
    @foreach ($vendorProducts as $product)
        <div class="product-item col-lg-4 col-md-6 col-sm-6">
            <div class="item">
                <div class="image-container">
                    <a class="item-img-wrapper-link" href="{{ url('product/' . $product['id']) }}">
                        @php
                            $product_image_path = 'front/images/product_images/small/' . $product['product_image'];
                        @endphp
                        @if (!empty($product['product_image']) && file_exists($product_image_path))
                            {{-- if the product image exists in BOTH database table AND filesystem (on server) --}}
                            <img class="img-fluid" src="{{ asset($product_image_path) }}" alt="Product">
                        @else
                            {{-- show the dummy image --}}
                            <img class="img-fluid" src="{{ asset('front/images/product_images/small/no-image.png') }}"
                                alt="Product">
                        @endif
                    </a>
                </div>
                <div class="item-content">
                    <div class="what-product-is">
                        <h6 class="item-title">
                            <a href="single-product.html">{{ $product['product_name'] }}</a>
                        </h6>
                        <div class="item-description">
                            <p>{{ $product['description'] }}</p>
                        </div>
                    </div>
                    @php
                        $getDiscountPrice = \App\Models\Product::getDiscountPrice($product['id']);
                    @endphp
                    @if ($getDiscountPrice > 0)
                        <div class="price-template">
                            <div class="item-new-price">
                                IDR {{ $getDiscountPrice }}
                            </div>
                            <div class="item-old-price">
                                IDR {{ $product['product_price'] }}
                            </div>
                        </div>
                    @else
                        <div class="price-template">
                            <div class="item-new-price">
                                IDR{{ $product['product_price'] }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
