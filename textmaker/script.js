document.addEventListener('DOMContentLoaded', () => {
    $.ajax({
        method: 'POST',
        url: 'ajaxFontMaker.php',
        data: {
            font: window.location.href.split('?f=')[window.location.href.split('?f=').length-1] + '.png'
        }
    })


    let inputText = document.getElementById('inputText')
    let inputGap = document.getElementById('inputGap')
    let inputSpace = document.getElementById('inputSpace')

    inputText.addEventListener('change', sendToDisplay)
    inputGap.addEventListener('change', sendToDisplay)
    inputSpace.addEventListener('change', sendToDisplay)


    function sendToDisplay() {
        if (inputText.value.length == 0) { return }
        if (inputGap.value == 0) { var gap = -1 } else { var gap = inputGap.value }

        $.ajax({
            method: 'POST',
            url: 'ajaxDisplayer.php',
            data: {
                text: inputText.value.toLowerCase(),
                gap: gap,
                space: inputSpace.value
            }
        }).done((e) => {
            if (JSON.parse(e) == 'font not defined') { console.log('Font not defined'); return }
            let imgContainer = document.getElementById('result')
            imgContainer.classList.add('img')
            imgContainer.innerHTML = ''
            let img = document.createElement('img')
            img.classList.add('anim')
            imgContainer.appendChild(img)
            img.src = 'data:image/jpeg;base64,' + JSON.parse(e)
            let a = document.createElement("a")
            a.href = "data:image/png;base64," + JSON.parse(e)
            a.download = inputText.value + ".png";
            img.addEventListener('click', () => {
                a.click();
            })
        })
    }


    inputText.value = 'Exemple'
    sendToDisplay()
    setTimeout(()=>{
        inputText.value = ''
    }, 100)
})