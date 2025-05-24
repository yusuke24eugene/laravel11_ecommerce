<x-dashboard-layout :name="$user->name">
    <div class="container-fluid">

        <h1>All Products</h1>

        <form id="form" class="div_deg" action="{{ url('searchProduct') }}" method="get">
            @csrf
            <div class="div_deg">
                <input id="input" class="form-control search-input" name="search" type="search" placeholder="Search"
                    aria-label="Search" value="{{ $search }}">
                <button class="btn btn-info search-icon" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <div class="div_deg">
            @if ($count === 0)
                <h3>No results found on "{{ $search }}"</h3>
            @elseif ($count === 1)
                <h3>{{ $count }} result found on "{{ $search }}"</h3>
            @else
                <h3>{{ $count }} results found on "{{ $search }}"</h3>
            @endif
        </div>
        <div class="div_deg">
            @if ($count)
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
                            <td>{{ $products->price }}</td>
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
                                <a class="btn btn-success" href="{{ url('edit_product', $products->id) }}">Edit</a>
                            </td>
                            <td>
                                <a class="btn btn-danger" href="{{ url('delete_product', $products->id) }}"
                                    onclick="confirmation(event)">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
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
