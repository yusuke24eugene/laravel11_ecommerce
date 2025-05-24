<x-layout :usertype="$usertype" :categories="$categories" :count="$count" :orders="$orders">
    <section style="background-color: #dcf0fa; border-radius: 10px;">
        <div class="text-center container px-4 py-5 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-12 align-items-center justify-content-center">
                        <div class="box">
                            <h4 class="mt-4 mb-5"><strong>Product Details</strong></h4>
                            <div class="div_center">
                                <?php
                                if ($product->image) {
                                    echo '<img width="400" src="/products/' . $product->image . '" alt="">';
                                }
                                ?>
                            </div>
                            <div class="detail-box">
                                <h6>
                                    {{ $product->title }}
                                </h6>
                                <h6>
                                    <span style="color: #1E3E62;">Price :</span> ${{ $product->price }}
                                </h6>
                            </div>
                            <div class="detail-box">
                                <h6>
                                    <span style="color: #1E3E62;">Category :</span> {{ $product->category_name }}
                                </h6>
                                <h6>
                                    <span style="color: #1E3E62;">Available Quantity :</span> {{ $product->quantity }}
                                </h6>
                            </div>
                            <div class="detail-box">
                                <h6>
                                    <span style="color: #1E3E62;">Description :</span> {{ $product->description }}
                                </h6>
                            </div>
                            @auth
                                @if ($usertype === 'user')
                                    <a class="btn btn-primary" href="{{ url('addCart', $product->id) }}">Add to
                                        Cart</a>
                                @endif
                            @else
                                <a class="btn btn-primary" href="{{ url('addCart', $product->id) }}">Add to
                                    Cart</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
