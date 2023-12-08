<form action="/dashboard/products/{{ $product->id }}/stocks" id="form-stock-create" method="POST">
    @csrf
    @if ($stock === 'in')
        <div class="form-floating mb-2">
            <input type="number" class="form-control" placeholder="Stock In" name="stock_in" id="stock_in" value="{{ old('stock_in') }}" min="0" required />
            <label for="stock_in">Stock In</label>
        </div>
    @else
        <div class="form-floating mb-2">
            <input type="number" class="form-control" placeholder="Stock Out" name="stock_out" id="stock_out" value="{{ old('stock_out') }}" min="0" required />
            <label for="stock_in">Stock Out</label>
        </div>
    @endif

    <div class="form-floating">
        <textarea class="form-control" placeholder="Leave descriptions here" name="description" id="description" style="height: 150px;">{{ old('description') }}</textarea>
        <label for="description">Description</label>
    </div>

    <div class="my-2 d-flex justify-content-end">
        <button type="reset" id="btn-reset" class="btn btn-secondary btn-sm me-1"><i class="bi-x-square me-1"></i>Reset</button>
        <button type="submit" id="btn-submit" class="btn btn-primary btn-sm"><i class="bi-check-square me-1"></i>Submit</button>
    </div>
</form>
