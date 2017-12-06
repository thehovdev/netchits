Ajax = {
    sendSignup : function(request) {
        $.ajax({
          method: "GET",
          url: Route.login,
          data: {
            userEmail: request.userEmail,
            userPassword: request.userPassword
            }
        }).done(function(data) {
            alert(data.status);
        });
    },
}
