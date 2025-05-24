<x-dashboard-layout :name="$user->name">
    <div class="container-fluid">
        <h3 class="mb-4">Category</h3>
        <div class="div_deg mb-4">
            <form id="form" action="{{ url('addCategory') }}" method="POST">
                @csrf
                <div>
                    <input id="input" type="text" name="category" style="height: 30px;">
                    <input class="btn btn-primary" type="submit" value="Add Category">
                </div>
            </form>
        </div>
        <div>
            <table class="table_deg">
                <tr>
                    <th>Category Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                @foreach ($data as $data)
                    <tr key="{{ $data->id }}">
                        <td>{{ $data->category_name }}</td>
                        <td>
                            <a class="btn btn-success" href="{{ url('editCategory', $data->id) }}">Edit</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="{{ url('deleteCategory', $data->id) }}"
                                onclick="confirmation(event)">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </table>
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
                    text: "Once deleted, you will not be able to recover this Category!",
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
