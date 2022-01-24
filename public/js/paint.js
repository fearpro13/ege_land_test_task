let app = () => {
    let canvas = document.getElementById('paint_canvas')
    let xsrf = document.querySelectorAll('input[name="_token"]')[0].value

    let ctx = canvas.getContext('2d')


    let prevX = 0;
    let prevY = 0;
    let offsetX = 150;
    let offsetY = 0;
    let color = "#FFFFFF"
    let size = 15
    let backgroundColor = "#FFFFFF"
    let eraser_toggled = false

    let save_image = () => {
        let link =
            canvas.toDataURL("image/png")
            .replace("image/png", "image/octet-stream")

        let a = document.createElement('a');
        a.href = link
        a.download = "MyImage";
        document.body.appendChild(a);
        //a.click();

        let formData = new FormData()
        formData.append('canvas_image',link)
        formData.append('info',"MyImage")

        fetch('/paint/save',{
            method:"POST",
            headers:{
                "X-CSRF-Token":xsrf,
                //'Content-Type': 'multipart/form-data'
            },
            body:formData
        })

        //window.location.href = link
    }
    document.getElementById('save_image').addEventListener('mousedown',save_image)

    let add_image = document.getElementById('add_image')
    add_image.addEventListener('mousedown',(e)=>{
        let file = document.getElementById('image').files[0]

        let url = URL.createObjectURL(file)

        let img = new Image(600,600)
        img.src = url

        img.onload = () => {
            ctx.drawImage(img,0,0)
        }

    })

    document.getElementById('toggle_eraser').addEventListener('mousedown',(e)=>{
        eraser_toggled = !eraser_toggled

        document.getElementById('toggle_eraser').style.backgroundColor = eraser_toggled ? "gray" : "white"

    })

    let drawing = false;
    window.addEventListener('mousedown',(e)=>{
        prevX = e.pageX - canvas.getBoundingClientRect().left
        prevY = e.pageY - canvas.getBoundingClientRect().top
        size = document.getElementById('drawer_size').value
        color = eraser_toggled ? backgroundColor : document.getElementById('color_pick').value
        drawing = true
        window.addEventListener('mousemove', drawer)
    })
    window.addEventListener('mouseup',(e)=>{
        drawing = false
        window.removeEventListener('mousemove',drawer)
    })

    let drawer = (e) => {
        let x = e.pageX - canvas.getBoundingClientRect().left
        let y = e.pageY - canvas.getBoundingClientRect().top


        ctx.fillStyle = color
        ctx.fillRect(x,y,size,size)
        ctx.stroke()
        prevX = x
        prevY = y

    }

}

window.onload = app