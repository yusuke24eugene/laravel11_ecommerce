<x-dashboard-layout :name="$user->name">
    <div class="container-fluid">
        <h3 class="mb-4">Edit Product</h3>
        <form action="/updateProduct/{{ $product->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="title" class="form-control" name="title" value="{{ $product->title }}"
                    required />
                <label class="form-label" for="title">Product title</label>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <textarea class="form-control" id="description" rows="4" name="description" required>{{ $product->description }}</textarea>
                <label class="form-label" for="description">Description</label>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="price" class="form-control" name="price" value="{{ $product->price }}"
                    required />
                <label class="form-label" for="price">Price</label>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <input type="number" id="quantity" class="form-control" name="quantity"
                    value="{{ $product->quantity }}" required />
                <label class="form-label" for="quantity">Quantity</label>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <select class="form-select" aria-label="Default select example" id="category" name="category">
                    <option value="" selected>Select product category</option>
                    @foreach ($category as $category)
                        <option value="{{ $category->category_name }}" <?php
                        if ($category->category_name === $product->category_name) {
                            echo ' selected';
                        }
                        ?>>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
                <label for="category">Product Category</label>
            </div>

            <div class="form-outline mb-4">
                <label>Current Image</label>
                <?php
                if ($product->image !== null) {
                    echo '<img width="200" src="/products/' . $product->image . '" alt="">';
                }
                ?>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <input class="form-control" type="file" id="imageFile" name="image">
                <label for="imageFile" class="form-label">Product image</label>
            </div>

            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Update Product</button>
        </form>
    </div>
</x-dashboard-layout>
