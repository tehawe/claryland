<form id="form-settlement-edit">
    @method('patch')
    @csrf

    <div class="d-flex justify-content-end">
        <button type="reset" class="btn btn-secondary btn-sm btn-reset me-1" data-bs-dismiss="modal">Reset</button>
        <button type="submit" class="btn btn-primary btn-sm btn-submit">Create</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('.form-settlement-edit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: `{{ route('settlement.update', compact('code')) }}`,
                method: 'PATCH',
                data: $(this).serialize();
                success: function(response) {
                    console.log(response);
                }
            });
        });
    });
</script>
