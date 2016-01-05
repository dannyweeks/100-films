$(document).foundation();

$('.film').hover(function () {
    //var bgUrl = $(this).attr('data-bg-image');
    //$('body').fadeIn().css('background-image', 'url(\'' + bgUrl + '\')');
}, function () {
    //$('body').fadeIn().css('background-image', '');
});

$(document).ready(function () {
    $('#watched-table').DataTable({
        columnDefs: [
            {type: 'anti-the', targets: 0},
            {type: 'date-uk', targets: 1}
        ]
    });
});