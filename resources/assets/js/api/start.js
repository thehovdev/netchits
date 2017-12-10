$(document).ready(function() {

//--------------------Auth Header Buttons--------------------------//
    $('#signup-button').click(function() {
        Api.showSignup();
    });

    $('#signin-button').click(function() {
        Api.showSignin();
    });
//--------------------Auth Header Buttons--------------------------//


//--------------------Auth Form Buttons----------------------------//
    $('#signin-submit-button').click(function() {
        Api.makeSignin();
    });

    $('#signup-submit-button').click(function() {
        Api.makeSignup();
    });
//-------------------Auth Form Buttons----------------------------//

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


        request = [];
        request['userEmail'] = $('.signin-container #signin-email').val();
        request['userPassword'] = $('.signin-container #signin-password').val();


        alert(request['userEmail']);
        alert(request['userPassword']);


        Ajax.sendSignin(request);


    },

    makeSignup : function() {
        request = [];
        request['userEmail'] = $('.signup-container #signup-email').val();
        request['userPassword'] = $('.signup-container #signup-password').val();

        Ajax.sendSignup(request);
    }

}
