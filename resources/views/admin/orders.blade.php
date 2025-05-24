<x-dashboard-layout :name="$user->name">
    <div class="container-fluid">
        <h3 class="mb-4">Orders</h3>
        <div class="div_deg">
            <table class="table_deg">
                <tr>
                    <th>Customer Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Product Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Change Status</th>
                </tr>
                @foreach ($data as $data)
                    <tr key="{{ $data->id }}">
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->rec_address }}</td>
                        <td>{{ $data->phone }}</td>
                        <td>{{ $data->product->title }}</td>
                        <td>${{ $data->product->price }}</td>
                        <td>
                            <?php
                            if ($data->product->image) {
                                echo '<img width="100" src="/products/' . $data->product->image . '" alt="">';
                            }
                            ?>
                        </td>
                        <td>
                            @if ($data->status === 'In Progress')
                                <span style="color: red;">{{ $data->status }}</span>
                            @elseif ($data->status === 'On the Way')
                                <span style="color: skyblue;">{{ $data->status }}</span>
                            @elseif ($data->status === 'Delivered')
                                <span style="color: yellow;">{{ $data->status }}</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary mb-2" href="{{ url('onTheWay', $data->id) }}">On
                                the
                                Way</a>
                            <a class="btn btn-success" href="{{ url('delivered', $data->id) }}">Delivered</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</x-dashboard-layout>
