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
        Ajax.sendSignin();
    });

    $('#signup-submit-button').click(function() {
        Ajax.sendSignup();

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

    makeSignin : function(data) {

        var status = data.status;
        var msg = data.msg;

        if(status == 0) {
            alert(msg);
            return false;
        }

        $('.mainPage').hide();
        $('.profilePage').show();

        $('#header-username').text(data.email);
    },

    makeSignup : function(data) {

        var status = data.status;
        var msg = data.msg;

        if(status == 0) {
            alert(msg);
            return false;
        }

        $('.mainPage').hide();
        $('.profilePage').show();

        $('#header-username').text(data.email);

    }

}
