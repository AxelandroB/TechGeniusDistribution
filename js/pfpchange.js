
const file = document.getElementById('file');
const img = document.getElementById('photo');

file.addEventListener('change', e => {
    if (e.target.files[0]) {
        
        const reader = new FileReader();
        reader.onload = function (e) {
            img.src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[0])
    } else {
        if(x == 0){
            img.src = "images/pfp.jpg";
        }   
    }
})
