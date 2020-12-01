$(document).ready(function () {

//dashboard
$('.toggle-info').click(function () {
    $(this).children('i').toggleClass(' fa-plus').parents('.card-header').next('.latest-info').slideToggle(350);
    // $(this).children('i').toggleClass(' fa-plus');
})

});