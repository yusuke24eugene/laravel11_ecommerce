<x-layout :usertype="$usertype" :categories="$categories" :count="$count" :orders="$orders">
    <section style="background-color: #dcf0fa; border-radius: 10px;">
        <div class="text-center container px-4 py-5 text-center">
            <h4 class="mt-4 mb-5"><strong>All Products</strong></h4>
            <div class="row">
                @foreach ($product as $products)
                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="card">
                            <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
                                data-mdb-ripple-color="light">
                                <img src="/products/{{ $products->image }}" class="w-100" alt="" />
                                <a href="#!">
                                    <div class="mask">
                                        <div class="d-flex justify-content-start align-items-end h-100">
                                            <h5><span
                                                    class="badge bg-primary ms-2">{{ $products->category_name }}</span>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="hover-overlay">
                                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="card-body">
                                <a href="" class="text-reset">
                                    <h5 class="card-title mb-3">{{ $products->title }}</h5>
                                </a>
                                <h6 class="mb-3">${{ $products->price }}</h6>
                                <div>
                                    <a class="btn btn-danger"
                                        href="{{ url('productDetails', $products->id) }}">Details</a>
                                    @auth
                                        @if ($usertype === 'user')
                                            <a class="btn btn-primary" href="{{ url('addCart', $products->id) }}">Add to
                                                Cart</a>
                                        @endif
                                    @else
                                        <a class="btn btn-primary" href="{{ url('addCart', $products->id) }}">Add to
                                            Cart</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="div_deg">
                {{ $product->onEachSide(1)->links() }}
            </div>
        </div>
    </section>
</x-layout>
