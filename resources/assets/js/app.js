$(document).foundation();

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

    var films = $('.film');

    var randomFilm = $(films[Math.floor(Math.random()*films.length)]);
    var initialBg = randomFilm.attr('data-bg-image');
    $('#old-bg').css({'background-image': 'url(\'' + initialBg + '\')'});
});

$('.film').hover(function () {
    var bg = $('#bg');
    var bgUrl = $(this).attr('data-bg-image');
    bg.animate({opacity: 0}, 'slow', function () {
        $(this).css({'background-image': 'url(\'' + bgUrl + '\')'}).animate({opacity: 1});
    });
    bg.attr('data-src', bgUrl);
}, function () {
    var oldBg = $('#bg').attr('data-src');
    $('#old-bg').css({'background-image': 'url(\'' + oldBg + '\')'});
});
