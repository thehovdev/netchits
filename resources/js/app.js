require('./bootstrap');

$(document).on('click', '.forgot-button', function () {
    $('.signin-container').hide();
    $('.forgotpass-container').show();
});
