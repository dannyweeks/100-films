$(document).foundation();

$('.film').hover(function () {
    var bgUrl = $(this).attr('data-bg-image');
    $('#bg').animate({opacity: 0}, 'slow', function () {
        $(this).css({'background-image': 'url(\'' + bgUrl + '\')'}).animate({opacity: 1});
    });
}, function () {
    //$('#bg').animate({opacity: 0}, 'fast', function () {
    //    $(this).css({'background-image': 'url(\'\')'}).animate({opacity: 1});
    //});
});



$(document).ready(function () {
    $('#watched-table').DataTable({
        "iDisplayLength": 100,
        "bPaginate": false,
        "order": [[1, "desc"]],
        columnDefs: [
            {type: 'anti-the', targets: 0},
            {type: 'date-uk', targets: 1}
        ]
    });
});
