<x-layout :usertype="$usertype" :categories="$categories" :count="$count" :orders="$orders">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 mb-2">
                @if ($count > 0)
                    <h4>Cart</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>Product title</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <?php
                        $value = 0;
                        ?>
                        @foreach ($cart as $cart)
                            <tr>
                                <td>{{ $cart->product->title }}</td>
                                <td>${{ $cart->product->price }}</td>
                                <td>
                                    <?php
                                    if ($cart->product->image) {
                                        echo '<img width="100" src="/products/' . $cart->product->image . '" alt="">';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="{{ url('deleteCart', $cart->id) }}">Remove</a>
                                </td>
                            </tr>
                            <?php
                            $value = $value + $cart->product->price;
                            ?>
                        @endforeach
                    </table>
                @else
                    <h4>"No products added on cart"</h4>
                @endif
            </div>
            <div class="col-12 col-lg-6">
                <form action="{{ url('confirmOrder') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label>Receiver Name</label>
                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="form-group mb-3">
                        <label>Receiver Address</label>
                        <textarea class="form-control" name="address"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label>Receiver Phone</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <div class="input-group mb-3">
                        <input type="submit" class="btn btn-primary form-control" value="Cash on Delivery">
                    </div>
                    <div class="input-group mb-3">
                        <a href="" class="btn btn-success form-control">Pay using Card</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>/
