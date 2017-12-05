Route = {
    host : '/',
    login : '/api/auth/login',
}

$(document).ready(function() {

    $('#signup-button').click(function() {
        Api.showSignup();
    });

    $('#signin-button').click(function() {
        Api.showSignin();
    });

    $('#signin-submit-button').click(function() {
        Api.makeSignin();
    });

    $('#signup-submit-button').click(function() {
        Api.makeSignup();
    });

});


Api = {

    showSignin : function() {
        $('.signup-container').hide();
        $('.signin-container').show();
    },

    showSignup : function() {
        $('.signin-container').hide();
        $('.signup-container').show();
    },

    makeSignin : function() {
        var userEmail = $('.signin-container #signin-email').val();
        var userPassword = $('.signin-container #signin-password').val();

        // alert(userEmail);
        // alert(userPassword);
    },

    makeSignup : function() {
        var userEmail = $('.signup-container #signup-email').val();
        var userPassword = $('.signup-container #signup-password').val();

        $.ajax({
          method: "GET",
          url: Route.login,
          data: {
            userEmail: userEmail,
            userPassword: userPassword
            }
        }).done(function(data) {
            alert(data.status);
        });

        // alert(userEmail);
        // alert(userPassword)
    }

}
