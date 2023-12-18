@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex justify-content-between border-bottom pb-1 mb-1">
                <h2>Categories</h2>
                <!-- Button trigger modal -->

            </div>
            <button type="button" class="btn btn-primary btn-sm my-2" onclick="create()">
                <i class="bi-plus-square"></i>
                Add Category
            </button>
            <div id="data"></div>

        </div>
    </div>
</div>



<!-- Modal Category Create -->
<div class="modal fade" id="modal-category" tabindex="-1" aria-labelledby="categoryModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-label"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" id="modal-body"></div>

        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        data();
    });

    function data() {
        $.get("{{ url('dashboard/categories/data') }}", {}, function(categories, status) {
            $("#data").html(categories);
        });
    }

    function closeModal() {

        $('#modal-category').modal('hide');
    }

    function create() {
        $.get("{{ url('dashboard/categories/create') }}", {}, function(data, status) {
            $("#modal-label").html('Add Category');
            $("#modal-body").html(data);
            $("#modal-category").modal('show');
        });
    }

    function store() {
        $('#form-category-create').submit(function(e) {
            e.preventDefault();
            let form = $(this);
            $.ajax({
                url: '/dashboard/categories',
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    if (response.errors) {
                        console.log(response.errors);
                        $('.alert-danger').removeClass('d-none');
                        $('.alert-danger').html(response.errors);
                    } else {
                        $('.alert-success').html(response.success).delay(1500);
                        $('#btn-reset').click();
                        $('#modal-category').modal('hide');
                        data();
                    }
                }
            });
        });
    }


    function edit(id) {
        $.get("{{ url('dashboard/categories') }}/" + id + "/edit", {}, function(data, status) {
            $("#modal-label").html('Edit Category');
            $("#modal-body").html(data);
            $("#modal-category").modal('show');
        });
    }

    function update(id) {
        $('#form-category-edit').submit(function(e) {
            e.preventDefault();
            let form = $(this);
            $.ajax({
                url: '/dashboard/categories/' + id,
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    closeModal();
                    data();
                }
            });
        });
    }

    function remove(id) {
        $.get("{{ url('dashboard/categories') }}/" + id + "/remove", {}, function(data, status) {
            $("#modal-label").html('Delete Category');
            $("#modal-body").html(data);
            $("#modal-category").modal('show');
        });
    }

    function destroy(id) {
        $('#form-category-delete').submit(function(e) {
            e.preventDefault();
            let form = $(this);
            $.ajax({
                url: '/dashboard/categories/' + id,
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    closeModal();
                    data();
                }
            });
        });
    }
</script>
@endsection