<x-layout :usertype="$usertype" :categories="$categories" :count="$count" :orders="$orders">
    <div class="div_deg">
        <table style="margin: auto;">
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Delivery Status</th>
            </tr>
            @foreach ($data as $data)
                <tr key="{{ $data->id }}">
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
                            <span style="color: green;">{{ $data->status }}</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</x-layout>
