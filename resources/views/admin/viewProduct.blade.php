<x-dashboard-layout :name="$user->name">
    <div class="container-fluid">

        <h3 class="mb-4">All Products</h3>

        <form id="form" action="{{ url('searchProduct') }}" method="get">
            @csrf
            <div class="div_deg">
                <input id="input" class="form-control search-input search-admin" name="search" type="search"
                    placeholder="Search" aria-label="Search">
                <button class="btn btn-info search-icon search-icon-admin" type="submit"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>

        <div class="container-fluid">
            <table class="table_deg">
                <tr>
                    <th>Product Title</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                @foreach ($product as $products)
                    <tr key="{{ $products->id }}">
                        <td>{{ $products->title }}</td>
                        <td>{!! Str::limit($products->description, 50) !!}</td>
                        <td>{{ $products->category_name }}</td>
                        <td>${{ $products->price }}</td>
                        <td>{{ $products->quantity }}</td>
                        <td>
                            <?php
                            if ($products->image) {
                                echo '<img width="100" src="/products/' . $products->image . '" alt="">';
                            }
                            ?>
                        </td>
                        </td>
                        <td>
                            <a class="btn btn-success" href="{{ url('editProduct', $products->id) }}">Edit</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="{{ url('deleteProduct', $products->id) }}"
                                onclick="confirmation(event)">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="div_deg">
            {{ $product->onEachSide(1)->links() }}
        </div>
    </div>
    <script src="{{ asset('preventSubmit.js') }}"></script>
    <script src="{{ asset('sweetalert.js') }}"></script>
    <script>
        function confirmation(e) {
            e.preventDefault();
            let urlToRedirect = e.currentTarget.getAttribute('href');

            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this Product!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = urlToRedirect;
                    }
                });
        }
    </script>
</x-dashboard-layout>
