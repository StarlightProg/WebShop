$(document).ready(function() {
    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    $(document).on('click', '.add-to-cart', function(event) {
        event.preventDefault();
        $(this).closest('form').submit();
    });

});