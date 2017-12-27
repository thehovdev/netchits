Route = {
    host : '/',
    header : {
      "Accept": "application/json",
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
    },

    signIn : '/api/auth/signIn', // Api/Auth/SignInController@signIn
    signUp : '/api/auth/signUp', // Api/Auth/SignUpController@signUp
    signOut : '/api/auth/signOut', //signOut

    addChits : '/api/user/addChits', //add new Chits
    deleteChits : '/api/user/deleteChits', //delete Chits
    showChits : '/api/user/showChits', //show Chits

}
