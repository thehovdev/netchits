Route = {
    host : '/',
    header : {
      "Accept": "application/json",
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
    },

    signIn : '/api/auth/signIn', // Api/Auth/SignInController@signIn
    signUp : '/api/auth/signUp', // Api/Auth/SignUpController@signUp
    signOut : '/api/auth/signOut', //signOut

    search: '/api/user/search', // search on navbar
    addChits : '/api/user/addChits', //add new Chits
    copyChits : '/api/user/copyChits', // copy Chits
    copyGroup : '/api/user/copyGroup', // copy Group
    addGroup : '/api/user/addGroup', //add new Group
    deleteChits : '/api/user/deleteChits', //delete Chits
    deleteGroup : '/api/user/deleteGroup',
    showChits : '/api/user/showChits', //show Chits
    uploadProfileImage : '/user/actions/uploadProfileImage', //upload profile image on user page
    updateProfile : '/user/actions/updateProfile', // update profile infor
    addFriend: '/user/actions/addFriend', //add friend
    deleteFriend: '/user/actions/deleteFriend', //add friend
    showFriends: '/user/actions/showFriends', //show friends

    sendResetCode : '/user/actions/sendResetCode', //send reset pass code
    resetPass : '/user/actions/resetPass',
}
