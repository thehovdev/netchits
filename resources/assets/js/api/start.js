$(document).ready(function() {

    $('#signup-button').click(function() {
        Api.signup();
    });

    $('#signin-button').click(function() {
        Api.signin();
    });
});


Api = {

    signin : function() {
        $('.login-container').hide();
        $('.register-container').show();
    },

    signup : function() {
        $('.register-container').hide();
        $('.login-container').show();
     }

}
