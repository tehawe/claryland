<form action="/dashboard/categories/{{ $category->id }}" method="post" id="form-category-delete">
    @method('delete')
    @csrf
    <h6>Are you sure want to delete data {{ $category->name }} from category ?</h6>
    <input type="hidden" name="category_id" value="{{ $category->id }}" />
    <div class="my-2 d-flex justify-content-center">
        <button type="button" id="btn-cancel" class="btn btn-secondary btn-sm me-1" onclick="closeModal()"><i class="bi-x-square me-1"></i>Cancel</button>
        <button type="submit" id="btn-submit" class="btn btn-danger btn-sm" onclick="destroy({{ $category->id }})"><i class="bi-check-square me-1"></i>Delete</button>
    </div>
</form>
