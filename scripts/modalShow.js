$(document).ready(function() {
    console.log('JS Entered');
    $('.cat-row').click(function() {
        var catId = $(this).data('id');

        $.ajax({
            url: '?act=show',
            type: 'GET',
            data: { id: catId },
            success: function(data) {
                $('#catModalBody').html(data);
                $('#catModal').modal('show');
            },
            error: function() {
                alert('Ошибка при получении данных.');
            }
        });
    });
});
