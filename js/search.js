$(function() {
    $('#searchhh').on('keyup', function() {
        var pattern = $(this).val();
        $('.searchable-container .itemss').hide();
        $('.searchable-container .itemss').filter(function() {
            return $(this).text().match(new RegExp(pattern, 'i'));
        }).show();
    });
});