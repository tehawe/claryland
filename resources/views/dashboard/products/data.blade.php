<table class="table table-sm table-hover" id="data-table">
    <thead class="table-secondary">
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Stock</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td class="text-end">Rp {{ number_format($product->price) }}</td>
                <td class="text-end">{{ $product->category->name }}</td>
                <td class="text-end">{{ $product->stocks_sum_stock_in - $product->stocks_sum_stock_out }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <a href="/dashboard/products/{{ $product->id }}" class="btn btn-sm btn-info"><i class="bi-check-square me-1"></i>Show</a>
                        <button class="btn btn-sm btn-warning" onclick="edit({{ $product->id }})"><i class="bi-pencil-square me-1"></i>Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="remove({{ $product->id }})"><i class="bi-trash me-1"></i>Delete</button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    let table = new DataTable('#data-table');
</script>
