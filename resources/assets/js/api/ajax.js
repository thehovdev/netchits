Ajax = {

    sendSignup : function(request) {
        $.ajax({
          method: "GET",
          url: Route.signUp,
          data: {
            userEmail: request.userEmail,
            userPassword: request.userPassword
            }
        }).done(function(data) {
            alert(data.status);
            alert(data.msg);
        });
    },


    sendSignin : function(request) {
        // alert('send');
        alert(request.userEmail);
        alert(request.userPassword);



        $.ajax({
          method: "GET",
          url: Route.signIn,
          data: {
            userEmail: request.userEmail,
            userPassword: request.userPassword
            }
        }).done(function(data) {
            alert(data.status);
            alert(data.msg);
        });
    },
}
