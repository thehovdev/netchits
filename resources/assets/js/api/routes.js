Route = {
    header : { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    host : '/',
    signIn : '/api/auth/signIn', // Api/Auth/SignInController@signIn
    signUp : '/api/auth/signUp', // Api/Auth/SignUpController@signUp
}
