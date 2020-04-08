$('.btn-upload-img').click(function () {
    $('#upload-me').click();
})

$('#upload-me').change(function () {
    $('#upload-picture').click();
})

$(document).on('click', '#add-chit', function () {
    let group = $('select[name="group"]').val()
    let address = $('#chits-address-input').val()
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
	    $('#group-' + res.id + '-list').remove();
	    $('.alerts').append('<div class="alert alert-success" id="alert-' + res.id +'">' + res.message + '</div>');
	    setTimeout(function () {
		$('#alert-' + res.id).remove()
	    }, 2000)
	}) 
    }
}
