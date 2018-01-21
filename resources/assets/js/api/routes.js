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
    addGroup : '/api/user/addGroup', //add new Group
    deleteChits : '/api/user/deleteChits', //delete Chits
    deleteChitsGroup : '/api/user/deleteChitsGroup',
    showChits : '/api/user/showChits', //show Chits
    uploadProfileImage : '/user/actions/uploadProfileImage', //upload profile image on user page
    updateProfile : '/user/actions/updateProfile', // update profile infor
    search: '/api/user/search', // search on navbar
    addFriend: '/user/actions/addFriend', //add friend
    deleteFriend: '/user/actions/deleteFriend', //add friend
    showFriends: '/user/actions/showFriends', //show friends
}
