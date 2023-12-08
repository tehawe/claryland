@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <h3>Products</h3>
                <hr />
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal" onclick="create()">
                    <i class="bi-bag-plus me-1"></i>Add Product
                </button>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="my-3 p-2 border rounded" id="data">
                    {{-- data products --}}
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL FORM --}}

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal-title"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            data();
        });

        function data() {
            $.get("{{ url('dashboard/products/data') }}", {}, function(data, status) {
                $("#data").html(data);
            });
        }

        function closeModal() {
            $('.btn-close').click();
        }

        function create() {
            $.get("{{ url('dashboard/products/create') }}", {}, function(data, status) {
                $('#modal-title').html('Add Product');
                $('#modal-body').html(data);
                $('#modal').modal('show');
            });
        }

        function store() {
            $('#form-product-create').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                $.ajax({
                    url: '/dashboard/products',
                    method: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if (response.errors) {
                            console.log(response.errors);
                        } else {
                            $('#btn-reset').click();
                            $('#modal').modal('hide');
                            data();
                        }
                    }
                });
            });
        }

        function edit(id) {
            $.get("{{ url('dashboard/products') }}/" + id + "/edit", {}, function(data, status) {
                $('#modal-title').html('Edit Product');
                $('#modal-body').html(data);
                $('#modal').modal('show');
            });
        }

        function update(id) {
            $('#form-product-edit').submit(function(e) {
                e.preventDefault();
                let form = $(this);
                $.ajax({
                    url: '/dashboard/products/' + id,
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
