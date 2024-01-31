<table class="table table-sm" id="data-table">
    <thead>
        <tr>
            <th>Stock In</th>
            <th>Stock Out</th>
            <th>Description</th>
            <th>Date Created</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($stocks as $stock)
            <tr>
                <td>{{ $stock->stock_in }}</td>
                <td>{{ $stock->stock_out }}</td>
                <td>{{ $stock->description }}</td>
                <td>{{ date_format($stock->created_at, 'd-M-Y') }}</td>
                <td align="right">
                    <div class="btn-group" role="group">
                        <button class="btn btn-sm btn-warning" id="btn-edit" data-id="{{ $stock->id }}" onclick="edit({{ $stock->id }},{{ $stock->product->id }})"><i class="bi-pencil-square me-1"></i>Edit</button>
                        <button class="btn btn-sm btn-danger" id="btn-delete" data-id="{{ $stock->id }}" onclick="remove({{ $stock->id }}, {{ $stock->product->id }})"><i class="bi-trash me-1"></i>Delete</button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready(function() {
        let table = new DataTable('#data-table');
    });
</script>
