<div class="border mt-1 mb-3 p-2 rounded">
    <table class="table table-sm table-hover" id="data-table">
        <thead class="table-secondary">
            <tr>
                <th>Category Name</th>
                <th>Product Count</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="data">
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td align="right">{{ $category->products_count }}</td>
                <td align="right">
                    <div class="btn-group" role="group">
                        <a href="/dashboard/categories/{{ $category->id }}" class="btn btn-sm btn-info"><i class="bi-check-square me-1"></i>Show</a>
                        <button class="btn btn-sm btn-warning" onclick="edit({{ $category->id }})"><i class="bi-pencil-square me-1"></i>Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="remove({{ $category->id }})"><i class="bi-trash me-1"></i>Delete</button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        let table = new DataTable('#data-table');
    });
</script>