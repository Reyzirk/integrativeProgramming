/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */


function showErrorMessage(message) {
    Swal.fire({
        heightAuto: false,
        titleText: 'Error',
        icon: 'error',
        timer: 1500,
        text: message,
    })
}
const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 3000,
    width: 350,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer),
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
function toggle(element){
    if (element.parentNode.classList.contains("toggled")){
        element.parentNode.classList.remove("toggled");
    }else{
        element.parentNode.classList.add("toggled");
    }
}
function toggle2(element){
    if (element.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("ul")[0].classList.contains("toggled")){
        element.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("ul")[0].classList.remove("toggled");
    }else{
        element.parentNode.parentNode.parentNode.parentNode.getElementsByTagName("ul")[0].classList.add("toggled");
    }
}

function dropdown(element){
    if (element.classList.contains("show")){
        element.classList.remove("show");
        element.getElementsByTagName("div")[0].classList.remove("show");
    }else{
        element.classList.add("show");
        element.getElementsByTagName("div")[0].classList.add("show");
    }
}