$('._colorpicker').colorpicker()

$(document).on('colorpickerChange', '._colorpicker', function (event) {
    var square = $(this).find('.fa-square')
    square.css('color', event.color.toString())
})
