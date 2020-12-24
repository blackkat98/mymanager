var listRoute = $('input#list-route').val()
var storeRoute = $('input#store-route').val()
var showRoute = $('input#show-route').val()
var updateRoute = $('input#update-route').val()
var deleteRoute = $('input#delete-route').val()
var csrfToken = $('input#csrf-token').val()

$(document).on('click', '#create-btn', function () {
    var data = new FormData($('#_create-form')[0])
    
    $.ajax({
        url: storeRoute,
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function (res) {
            if (res.status) {
                var data = res.data
                var content = data.content
                content = content.length > 15 ? content.substring(0, 16) + '...' : content
                var note = `
                    <div class="col-md-3" id="note-${data.id}">
                        <div class="card" style="${data.style}">
                            <div class="card-header">
                                <div class="card-tools float-right">
                                    <button id="edit-btn-${data.id}" class="btn btn-xs" data-toggle="modal" data-target="#edit-form">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button id="delete-btn-${data.id}" class="btn btn-xs">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                ${content}
                            </div>
                        </div>
                    </div>
                `
                $('#note-list').prepend(note)
            }
        }, error: function (e) {
            console.log(e)
        }
    })
})

$(document).on('click', 'button[id^=edit-btn-]', function () {
    var noteId = this.id.replace('edit-btn-', '')
    var url = showRoute.slice(0, -1) + noteId
    $.ajax({
        url: url,
        type: 'GET',
        success: function (res) {
            if (res.status) {
                var style = res.data.style
                style = style.replaceAll(/\s/g, '')
                style = style.split(';')
                var styles = {}

                style.forEach(function (s) {
                    if (s) {
                        var splitted = s.split(':')
                        styles[splitted[0]] = splitted[1]
                    }
                })
                
                $('#edit-form textarea[name=content]').val(res.data.content)
                $('#edit-form input[name=color]').val(styles['color'])
                $('#edit-form input[name=background-color]').val(styles['background-color'])
                $('i#sqr-color').css('color', styles['color'])
                $('i#sqr-bg-color').css('color', styles['background-color'])
            } else {

            }
        }, error: function (e) {
            console.log(e)
        }
    })
})

$(document).on('click', 'button[id^=delete-btn-]', function () {
    var noteId = this.id.replace('delete-btn-', '')
    var url = deleteRoute.slice(0, -1) + noteId
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: csrfToken
        },
        success: function (res) {
            if (res.status) {
                $('#note-' + noteId).remove()
            } else {

            }
        }, error: function (e) {
            console.log(e)
        }
    })
})
