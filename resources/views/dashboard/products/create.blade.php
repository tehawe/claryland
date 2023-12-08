<form action="/dashboard/products/" method="POST" id="form-product-create">
    @csrf
    <div class="col mb-3 form-floating">
        <select class="form-select" name="category_id" id="category_id" required>
            <option value="">--Category--</option>
            @foreach ($categories as $category)
                @if (old('category_id') == $category->id)
                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                @else
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
            @endforeach
        </select>
        <label for="category_id" class="form-label">Category</label>
        @error('category_id')
            <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Product Name" value="{{ old('name') }}" required>
        <label for="name">Product Name</label>
        @error('name')
            <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-floating mb-3">
        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" placeholder="Price" value="{{ old('price') }}" required>
        <label for="price">Price</label>
        @error('price')
            <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="my-2 d-flex justify-content-center">
        <button type="reset" class="btn btn-secondary btn-sm me-1"><i class="bi-x-square me-1"></i>Reset</button>
        <button type="submit" class="btn btn-primary btn-sm" onclick="store()"><i class="bi-check-square me-1"></i>Submit</button>
    </div>
</form>
