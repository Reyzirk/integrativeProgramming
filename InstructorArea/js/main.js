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