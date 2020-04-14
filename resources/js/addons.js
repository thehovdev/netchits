$('.btn-upload-img').click(function () {
    $('#upload-me').click();
})

$('#upload-me').change(function () {
    $('#upload-picture').click();
})

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
		    $('#main').append('<div class="row row-group" id="group-' + res.groupId + '"><div class="panel panel-default panel-group"><div class="panel-body">Default<i class="fa fa-window-close fa-delete-group chits-group-delete-button" id="' + res.groupId + '" aria-hidden="true"></i></div></div></div><div class="row row-chits-list" id="group-' + res.groupId + '-list"></div>');
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
	    $('#chit-' + res.id).remove();
	    $('.alerts').append('<div class="alert alert-success" id="alert-' + res.id +'">' + res.message + '</div>');
	    setTimeout(function () {
		$('#alert-' + res.id).remove()
	    }, 2000)
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
	    $('.alerts').append('<div class="alert alert-success" id="alert-' + res.id +'">' + res.message + '</div>');
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
    }
}
