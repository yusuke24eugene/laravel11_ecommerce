<x-dashboard-layout :name="$user->name">
    <div class="container-fluid">
        <h3 class="mb-4">Add Product</h3>
        <form action="{{ url('uploadProduct') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="title" class="form-control" name="title" required />
                <label class="form-label" for="title">Product title</label>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <textarea class="form-control" id="description" rows="4" name="description" required></textarea>
                <label class="form-label" for="description">Description</label>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="price" class="form-control" name="price" required />
                <label class="form-label" for="price">Price</label>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <input type="number" id="quantity" class="form-control" name="quantity" required />
                <label class="form-label" for="quantity">Quantity</label>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <select class="form-select" aria-label="Default select example" id="category" name="category">
                    <option value="" selected>Select product category</option>
                    @foreach ($category as $category)
                        <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
                <label for="category">Product Category</label>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <input class="form-control" type="file" id="imageFile" name="image">
                <label for="imageFile" class="form-label">Product image</label>
            </div>

            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Add Product</button>
        </form>
    </div>
</x-dashboard-layout>
