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

<script>
    $(function() {
        $("#search-input").on("keyup", function() {
            var searchQuery = $(this).val();
            if (searchQuery.length > 2) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.search') }}",
                    data: {
                        query: searchQuery
                    },
                    dataType: 'json',
                    success: function(data) {
                        $("#box-content-search").html('');
                        $.each(data, function(index, item) {
                            var url =
                                "{{ route('admin.products.edit', 'product_slug_pls') }}";
                            var link = url.replace('product_slug_pls', item.slug);

                            $("#box-content-search").append(`
                                <li>
                                    <ul>
                                        <li class="product-item gap14 mb-10">
                                            <div class="image no-bg">
                                                <img style="display: flex; align-items: center; justify-content: center; width: 50px; height: 50px; gap: 10px; flex-shrink: 0; padding: 5px; border-radius: 10px; background: #EFF4F8;"
                                                    src="{{ asset('storage') }}/${item.image}" alt="${item.name}">
                                            </div>
                                            <div class="flex items-center justify-between gap20 flex-grow">
                                                <div class="name">
                                                    <a href="${link}" class="body-text">${item.name}</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="mb-10">
                                            <div class="divider"></div>
                                        </li>
                                    </ul>
                                </li>
                            `);
                        });
                    }
                });
            }
        });
    });
</script>
@stack('scripts')
