<form action="/dashboard/products/{{ $product->id }}/stocks/{{ $data->id }}" method="post" id="form-stock-delete">
    @method('delete')
    @csrf
    <h6>Are you sure want to delete {{ $stock == 'in' ? $data->stock_in : $data->stock_out }} data stock {{ $stock }} ?</h6>
    <div class="my-2 d-flex justify-content-center">
        <button type="button" id="btn-cancel" class="btn btn-secondary btn-sm me-1" onclick="closeModal()"><i class="bi-x-square me-1"></i>Cancel</button>
        <button type="submit" id="btn-submit" class="btn btn-danger btn-sm" onclick="destroy({{ $data->id }})"><i class="bi-check-square me-1"></i>Delete</button>
    </div>
</form>