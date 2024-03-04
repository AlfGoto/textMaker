document.addEventListener('DOMContentLoaded', () => {
    let sendButton = document.getElementById('Send')
    let inputFile = document.getElementById('inputFile')
    console.log('Script connected')

    sendButton.addEventListener('click', () => {

        var file_data = $(inputFile).prop('files')[0]
        var form_data = new FormData()
        form_data.append('file', file_data)

        if (inputFile.value.length == 0) { return }
        console.log('Sending...', form_data)

        $.ajax({
            method: 'POST',
            dataType: 'text',
            cache: false,
            url: 'ajaxFontMaker.php',
            data: form_data,
            processData: false,
            contentType: false
        }).done((e) => {
            console.log(JSON.parse(e))
        })
    })



    let display = document.getElementById('display')
    let inputText = document.getElementById('inputText')

    display.addEventListener('click', () => {
        if (inputText.value.length > 0) {

            $.ajax({
                method: 'POST',
                url: 'ajaxDisplayer.php',
                data: {
                    text: inputText.value.toLowerCase()
                }
            }).done((e) => {
                console.log(e)
            })
        }
    })
})