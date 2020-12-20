var listRoute = $('input#list-route').val()
var updateRoute = $('input#update-route').val()
var deleteRoute = $('input#delete-route').val()
var restoreRoute = $('input#restore-route').val()
var csrfToken = $('input#csrf-token').val()

$(document).on('click', 'button[id^=inactive-btn-]', function () {
    var userId = this.id.replace('inactive-btn-', '')
    var url = deleteRoute.slice(0, -1) + userId
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: csrfToken
        },
        success: function (res) {
            if (res.status) {
                $('button#inactive-btn-' + userId).replaceWith(`
                    <button id="active-btn-${userId}" class="btn btn-sm btn-success"><i class="fa fa-play"></i></button>
                `)
                $('td#status-tag-' + userId).html(`<span class="badge bg-danger">Inactive</span>`)
            } else {

            }
        }, error: function (e) {
            console.log(e)
        }
    })
})

$(document).on('click', 'button[id^=active-btn-]', function () {
    var userId = this.id.replace('active-btn-', '')
    var url = restoreRoute.slice(0, -1) + userId
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: csrfToken
        },
        success: function (res) {
            if (res.status) {
                $('button#active-btn-' + userId).replaceWith(`
                    <button id="inactive-btn-${userId}" class="btn btn-sm btn-danger"><i class="fa fa-pause"></i></button>
                `)
                $('td#status-tag-' + userId).html(`<span class="badge bg-success">Active</span>`)
            } else {

            }
        }, error: function (e) {
            console.log(e)
        }
    })
})
