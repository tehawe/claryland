<form action="/dashboard/categories/{{ $category->id }}" method="post" id="form-category-edit">
    @method('patch')
    @csrf
    <div class="form-floating mb-3">
        <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" placeholder="Category Name" value="{{ $category->name }}" required>
        <label for="name">Category Name</label>
        @error('name')
            <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-floating mb-3">
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Descriptions" rows="3">{{ $category->description }}</textarea>
        <label for="description">Descriptions</label>
        @error('description')
            <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
        @enderror
    </div>
    <div class="my-2 d-flex justify-content-center">
        <button type="button" id="btn-cancel" class="btn btn-secondary btn-sm me-1" onclick="closeModal()"><i class="bi-x-square me-1"></i>Cancel</button>
        <button type="submit" id="btn-submit" class="btn btn-primary btn-sm" onclick="update({{ $category->id }})"><i class="bi-check-square me-1"></i>Update</button>
    </div>
</form>
