<script src="{{ asset('/backend/js/jquery-3.3.1.slim.min.js') }}"></script>
<script src="{{ asset('/backend/js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('/backend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/backend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/share.js') }}"></script>
<script src="{{ asset('frontend/js/main_menu.js') }}"></script>
<script src="{{ asset('frontend/js/text_ticker.js') }}"></script>

<!-- summernote css/js -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $(".show-search-modal-input").click(function() {
            $('#searchCard').empty();
            $('#searchModal').on('shown.bs.modal', function() {
                $('#docDepSearch').focus();
            })
            $('#searchModal').modal('show');
            // $("#docDepSearch").focus();
        });

        $('#docDepSearch').keyup(function() {
            var searchInput = $(this).val();
            if (searchInput.length > 2) {
                $.ajax({
                    url: '{{ url('ajax-department-doctor') }}/' + searchInput,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#searchCard').empty();
                        $('#searchCard').append(data);
                        console.log(data)
                    }
                });
            }
        });
        $(document).on('click', '.btn-close', function() {
            $('#docDepSearch').val('');
        })

    })
</script>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=241110544128";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
