var listRoute = $('input#list-route').val()
var getRoute = $('input#get-route').val()
var storeRoute = $('input#store-route').val()
var showRoute = $('input#show-route').val()
var updateRoute = $('input#update-route').val()
var deleteRoute = $('input#delete-route').val()
var csrfToken = $('input#csrf-token').val()

var Calendar = FullCalendar.Calendar;
var calendarDiv = document.getElementById('calendar')
var calendar = new Calendar(calendarDiv, {
    plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
    header: {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    themeSystem: 'bootstrap',
    events: [],
    editable: true,
    eventRender: function (event) {
        var fcContent = event.el.firstChild
        fcContent.setAttribute('id', event.event.id)
    },
    eventDrop: function (event) {
        var planId = event.event.id.replace('plan-event-', '')
        var url = updateRoute.slice(0, -1) + planId
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: csrfToken,
                name: event.event.title,
                starts_at: moment(event.event.start).format('YYYY-MM-DD hh:mm:ss'),
                ends_at: moment(event.event.start).add(1, 'hours').format('YYYY-MM-DD hh:mm:ss'),
                color: event.event.backgroundColor
            }, success: function (res) {
                console.log(res.message)
                console.log(res.data)
            }, error: function (e) {
                console.log(e)
            }
        })
    }
})
calendar.render()

$.ajax({
    url: getRoute,
    type: 'GET',
    success: function (res) {
        res.forEach(function (element) {
            var event = {
                id: 'plan-event-' + element.id,
                title: element.name,
                start: new Date(element.starts_at),
                end: new Date(element.ends_at),
                backgroundColor: element.style.replace('color: ', ''),
                borderColor: element.style.replace('color: ', '')
            }
            calendar.addEvent(event)
        })
    }, error: function (e) {
        console.log(e)
    }
})

$('.fc-color-picker.plan-create-color-picker .fa-square').on('click', function() {
    var color = $(this).css('color')
    $('input[name=color]').val(color)
    $('#create-btn').css('background-color', color)
    $('#color-sample').css('color', color)
})

$('.fc-color-picker.plan-edit-color-picker .fa-square').on('click', function() {
    var color = $(this).css('color')
    $('input#plan-color').val(color)
    $('#plan-color-sample').css('color', color)
})

$(document).on('click', '#create-btn', function (event) {
    event.preventDefault()
    var data = new FormData($('#create-form')[0])
    $('input[name=name]').val('')
    $.ajax({
        url: storeRoute,
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function (res) {
            var event = {
                id: 'plan-event-' + res.data.id,
                title: res.data.name,
                start: new Date(res.data.starts_at),
                end: new Date(res.data.ends_at),
                backgroundColor: res.data.style.replace('color: ', ''),
                borderColor: res.data.style.replace('color: ', '')
            }
            calendar.addEvent(event)
        }, error: function (e) {
            console.log(e)
        }
    })
})

$(document).on('dblclick', '.fc-content', function () {
    $('button#edit-btn').trigger('click')
    var elementId = this.id
    var planId = elementId.replace('plan-event-', '')
    var url = showRoute.slice(0, -1) + planId
    $.ajax({
        url: url,
        type: 'GET',
        success: function (res) {
            $('input#plan-id').val(res.id)
            $('input#plan-name').val(res.name)
            $('input#plan-time').val(res.starts_at + ' - ' + res.ends_at)
            $('input#plan-color').val(res.style.replace('color: ', ''))
            $('#plan-color-sample').css('color', res.style.replace('color: ', ''))
        }, error: function (e) {
            console.log(e)
        }
    })
})

$(document).on('click', 'button#update-btn', function () {
    var planId = $('input#plan-id').val()
    var url = updateRoute.slice(0, -1) + planId
    var name = $('input#plan-name').val()
    var timeRange = $('input#plan-time').val()
    var range = timeRange.split(' - ')
    var startTime = range[0]
    var endTime = range[1]
    var color = $('input#plan-color').val()
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: csrfToken,
            name: name,
            starts_at: startTime,
            ends_at: endTime,
            color: color
        }, success: function (res) {
            var eventContainer = calendar.getEventById('plan-event-' + planId)
            eventContainer.remove()
            var event = {
                id: 'plan-event-' + res.data.id,
                title: res.data.name,
                start: new Date(res.data.starts_at),
                end: new Date(res.data.ends_at),
                backgroundColor: res.data.style.replace('color: ', ''),
                borderColor: res.data.style.replace('color: ', '')
            }
            calendar.addEvent(event)
        }, error: function (e) {
            console.log(e)
        }
    })
})

$(document).on('click', 'button#delete-btn', function () {
    var planId = $('input#plan-id').val()
    var url = deleteRoute.slice(0, -1) + planId
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: csrfToken
        }, success: function (res) {
            if (res.status) {
                var eventContainer = calendar.getEventById('plan-event-' + planId)
                eventContainer.remove()
            } else {
                console.log(res.message)
            }
        }, error: function (e) {
            console.log(e)
        }
    })
})
