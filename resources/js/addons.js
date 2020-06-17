$(document).on('click', '#add-chit', function () {
    let group = $('select[name="group"]').val()
    let address = $('#chits-address-input').val()

    $('#process-chits').attr('style', false)
    Api.addChit(address, group)
})

$(document).on('click', '.chits-delete-button', function () {
    let id = $(this).attr('id');
    Api.deleteChit(id);
})

$(document).on('click', '#add-group', function () {
    let name = $('#group-name').val()
    Api.addGroup(name)
})

$(document).on('click', '.chits-group-delete-button', function () {
    let id = $(this).attr('id');
    Api.deleteGroup(id);
})


$(document).on('click', '#chits-search-button', function () {
    let query = $('#chits-address-input').val();

    let results = [];
    Youtube.search(query).then(function (res) {
	results = res.items;

	if (!$('#yt-results').length) {
	    $('.chits-address-column').after('<div class="jumbotron col-sm-12" id="yt-results"></div>');
	}

	$('#yt-results').append('<div class="row row" id="inner-yt-results"></div>');
	
	for (var i = 0; i < results.length; ++i) {
	    $('#inner-yt-results').empty();
	    let thumbnail = '<img id="thumb" src="'+results[i].snippet.thumbnails.medium.url + '" alt="' + results[i].snippet.title + '" class="search-item-img">';
	    $('#inner-yt-results').append('<div class="search-item col-sm-3" id="' + results[i].id.videoId + '">' +
					  '<div class="search-item-img">' +
					  thumbnail +
					  '</div>' +
					  '<div class="search-item-title">' +
					  results[i].snippet.title +
					  '</div>' +
					  '<div class="search-item-actions">' +
					  '<button class="btn btn-default btn-loveit" id="' + results[i].id.videoId +'">' +
					  '<i class="fa fa-plus-square fa-love"></i>Add' +
					  '</button>' +
					  '</div>' +
					  '</div>' +
					  '</div>');
	}
    });


})

$(document).on('click', '.btn-loveit', function () {
    $('#process-chits').attr('style', false);
    let videoId = $(this).attr('id');
    let group = $('select[name="group"]').val()

    address = 'https://youtube.com/watch?v=' + videoId;

    Api.addChit(address, group);
})

$(document).on('click', '.follow', function () {
    let id = $(this).attr('id');
    Api.follow(id);
})

$(document).on('click', '.unfollow', function () {
    let id = $(this).attr('id');
    Api.unFollow(id);
})

$(document).on('click', '.search', function () {
    let word = $('.friend-search').val();
    Api.search(word);
})

Api = {
    headers : {
      "Accept": "application/json",
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
    },
    addChit(address, groupId) {
	$.ajax({
	    url: '/chits',
	    type: 'POST',
	    headers: Api.headers,
	    data: { address, groupId }
	}).done(function (res) {
	    if (res.status == 1) {
		if (!$('#group-' + res.groupId).length) {
		    $('#main').append('<div class="row row-group" id="group-' + res.groupId + '"><div class="card panel-default panel-group"><div class="card-body text-center">Default<i class="fa fa-window-close fa-delete-group chits-group-delete-button" id="' + res.groupId + '" aria-hidden="true"></i></div></div></div><div class="row row-chits-list col-md-12 offset-sm-1 col-sm-12" id="group-' + res.groupId + '-list"></div>');
			$('select[name="group"]').empty()
			$('select[name="group"]').append('<option value="' + res.groupId + '">Default</option>')
		}
		$('#group-' + res.groupId + '-list').prepend(res.html);
		
	    } else {
		$('.alerts').append('<div class="alert alert-danger" id="alert-' + res.id +'">' + res.message + '</div>');
		setTimeout(function () {
		    $('#alert-' + res.id).remove()
		}, 2000)
	    }

	    $('#process-chits').css('display', 'none');
	    
	})
    },

    deleteChit(id) {
	$.ajax({
	    url: '/chits/' + id,
	    type: 'DELETE',
	    headers: Api.headers,
	    data: { chit: id }
	}).done(function (res) {
	    if (res.status == 1) {
		$('#chit-' + res.id).remove();
		$('.alerts').append('<div class="alert alert-success col-md-12 offset-sm-1 col-sm-12" id="alert-' + res.id +'">' + res.message + '</div>');
		setTimeout(function () {
		    $('#alert-' + res.id).remove() 
		}, 2000)
	    }
	})
    },

    addGroup(name) {
	$.ajax({
	    url: '/groups',
	    type: 'POST',
	    headers: Api.headers,
	    data: { name }
	}).done(function (res) {
	    $('.alerts').after(res.html);
	    $('.alerts').append('<div class="alert alert-success col-md-12 offset-sm-1 col-sm-12" id="alert-' + res.id +'">' + res.message + '</div>');
	    $('select[name="group"]').append('<option value="' + res.group.id + '">' + res.group.name + '</option>')
	    setTimeout(function () {
		$('#alert-' + res.id).remove()
	    }, 2000)
	})
    },

    deleteGroup(id) {
	$.ajax({
	    url: '/groups/' + id,
	    type: 'DELETE',
	    headers: Api.headers
	}).done(function (res) {
	    $('#group-' + res.id).remove();
	    $('#select-' + res.id).remove();
	    if (!$('select[name="group"]').children().length) {
		$('select[name="group"]').append('<option value="0">Default</option>');
	    }
	    $('#group-' + res.id + '-list').remove();
	    $('.alerts').append('<div class="alert alert-success" id="alert-' + res.id +'">' + res.message + '</div>');
	    setTimeout(function () {
		$('#alert-' + res.id).remove()
	    }, 2000)
	}) 
    },

    follow(id) {
	$.ajax({
	    url: '/follow',
	    type: 'POST',
	    headers: Api.headers,
	    data: { id }
	}).done(function (res) {
	    $('.follow').before('<button class="btn btn-primary unfollow" id="' + res.id + '">Following</div>');
	    $('.follow').remove();
	})
    },

    unFollow(id) {
	$.ajax({
	    url: '/unfollow',
	    type: 'POST',
	    headers: Api.headers,
	    data: { id }
	}).done(function (res) {
	    $('.unfollow').before('<button class="btn btn-secondary follow" id="' + res.id + '">Follow</button>');
	    $('.unfollow').remove();
	})
    },

    search(word) {
	$.ajax({
	    url: '/search',
	    type: 'GET',
	    headers: Api.headers,
	    data: { word }
	}).done(function (res) {
	    $('.results').remove();
	    if (!$('.results .container').length) {
		$('#process-chits').after('<div class="col-sm-10 offset-sm-2 results"><div class="container" id="search-results"></div></div>');
	    }
	    
	    if (res.results.length) {
		for (var item in res.results) {
		    console.log(res.results[item]);
		    $('#search-results').prepend('<a class="results-item" href="/user/' + res.results[item].id + '" target="_blank"><img class="image img-circle" width="50" height="50" src="/images/' + res.results[item].profile_picture + '" title="' + res.results[item].hashtag + '"></a>');
		}
	    } else {
		$('.results .container').append('<i class="text-center">No results</i>');
	    }
	})
    }
}
