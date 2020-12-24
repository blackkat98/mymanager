$('input.error-message').each(function (index, obj) {
    toastr.error(obj.value)
})

var successMessage = $('input.success-message').val()

if (typeof successMessage === 'string' && successMessage.length > 0) {
    toastr.success(successMessage)
}

var warningMessage = $('input.warning-message').val()

if (typeof warningMessage === 'string' && warningMessage.length > 0) {
    toastr.warning(warningMessage)
}

var messageMessage = $('input.message-message').val()

if (typeof messageMessage === 'string' && messageMessage.length > 0) {
    toastr.info(messageMessage)
}

