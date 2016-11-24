/**
 * Created by cesar on 23/11/16.
 */

function block_screen() {
    $('<div id="screenBlock"></div>').appendTo('body');
    $('#screenBlock').css( { opacity: 0, background: '#f6f6f6', width: $(document).width(), height: $(document).height() } );
    $('#screenBlock').addClass('blockDiv');
    $('<h1>Carregando...</h1>').appendTo('screenBlock');
    $('#screenBlock').animate({opacity: 1}, 200);
}

function unblock_screen() {
    $('#screenBlock').animate({opacity: 0}, 200, function() {
        $('#screenBlock').remove();
    });
}