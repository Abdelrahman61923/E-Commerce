<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/apexcharts/apexcharts.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
{{-- SweetAlert --}}
<script>
    $(function() {
        $('.delete').on('click', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            swal({
                title: "Are you sure do you want to delete this record?",
                text: "You cannot undo this action!",
                icon: "warning",
                buttons: ["No", "Yes"],
                dangerMode: true,
            }).then(function(willDelete) {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    });
</script>
@stack('scripts')
