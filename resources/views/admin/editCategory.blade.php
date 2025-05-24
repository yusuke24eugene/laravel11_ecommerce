<x-dashboard-layout :name="$user->name">
    <div class="container-fluid">
        <h1>Update Category</h1>
        <div class="div_deg">
            <form id="form" action="/updateCategory/{{ $data->id }}" method="POST">
                @csrf
                @method('PUT')
                <input id="input" type="text" name="category" value="{{ $data->category_name }}"
                    style="height: 35px;">
                <input class="btn btn-primary" type="submit" value="Update Category">
            </form>
        </div>
    </div>
    <script src="{{ asset('preventSubmit.js') }}"></script>
</x-dashboard-layout>
