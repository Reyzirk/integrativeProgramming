/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

//Author: Poh Choo Meng
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
var id;
function navigateToChildClass(){
    Swal.fire({
        title: 'Navigate to the child class list',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        inputPlaceholder: 'Enter the Class ID',
        showCancelButton: true,
        confirmButtonText: 'Navigate',
        showLoaderOnConfirm: true,
        preConfirm: (inputID) => {
            $.ajax({
                url: "AJAX/navigateChildClass.php",
                type: "POST",
                async:false,
                data: {"classID": inputID },
            }).done(function (response) {
                if (response === "fail") {
                    Swal.showValidationMessage(
                        `Please Try Again!`
                    )
                    return false;
                } else if (response === "success") {
                    Swal.close();
                    id = inputID;
                    return true;
                }else{
                    Swal.showValidationMessage(response);
                    return false;
                }
                
                
            }).fail(function (jqXHR, status) {
                Swal.showValidationMessage(
                    `Failed to assign: ${error}`
                )
                return false;
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            location.href='childclasses.php?id='+id;
        }
    })
}
function navigateToExamResult(){
    Swal.fire({
        title: 'Navigate to the exam result list',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        inputPlaceholder: 'Enter the Examination ID',
        showCancelButton: true,
        confirmButtonText: 'Navigate',
        showLoaderOnConfirm: true,
        preConfirm: (inputID) => {
            $.ajax({
                url: "AJAX/navigateExamResult.php",
                type: "POST",
                async:false,
                data: {"examID": inputID },
            }).done(function (response) {
                if (response === "fail") {
                    Swal.showValidationMessage(
                        `Please Try Again!`
                    )
                    return false;
                } else if (response === "success") {
                    Swal.close();
                    id = inputID;
                    return true;
                }else{
                    Swal.showValidationMessage(response);
                    return false;
                }
                
                
            }).fail(function (jqXHR, status) {
                Swal.showValidationMessage(
                    `Failed to assign: ${error}`
                )
                return false;
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            location.href='examresults.php?id='+id;
        }
    })
}
function navigateToHomework(){
    Swal.fire({
        title: 'Navigate to the homework list',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        inputPlaceholder: 'Enter the Class ID',
        showCancelButton: true,
        confirmButtonText: 'Navigate',
        showLoaderOnConfirm: true,
        preConfirm: (inputID) => {
            $.ajax({
                url: "AJAX/navigateHomework.php",
                type: "POST",
                async:false,
                data: {"classID": inputID },
            }).done(function (response) {
                if (response === "fail") {
                    Swal.showValidationMessage(
                        `Please Try Again!`
                    )
                    return false;
                } else if (response === "success") {
                    Swal.close();
                    id = inputID;
                    return true;
                }else{
                    Swal.showValidationMessage(response);
                    return false;
                }
                
                
            }).fail(function (jqXHR, status) {
                Swal.showValidationMessage(
                    `Failed to assign: ${error}`
                )
                return false;
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            location.href='homeworks.php?id='+id;
        }
    })
}
function navigateToCourseSchedule(){
    Swal.fire({
        title: 'Navigate to the schedule list',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        inputPlaceholder: 'Enter the Class ID',
        showCancelButton: true,
        confirmButtonText: 'Navigate',
        showLoaderOnConfirm: true,
        preConfirm: (inputID) => {
            $.ajax({
                url: "AJAX/navigateCourseSchedule.php",
                type: "POST",
                async:false,
                data: {"classID": inputID },
            }).done(function (response) {
                if (response === "fail") {
                    Swal.showValidationMessage(
                        `Please Try Again!`
                    )
                    return false;
                } else if (response === "success") {
                    Swal.close();
                    id = inputID;
                    return true;
                }else{
                    Swal.showValidationMessage(response);
                    return false;
                }
                
                
            }).fail(function (jqXHR, status) {
                Swal.showValidationMessage(
                    `Failed to assign: ${error}`
                )
                return false;
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            location.href='courseschedule.php?id='+id;
        }
    })
}
function initScrollToTop(){
    var topButton = document.getElementById("scrollToTop");
    if (topButton != null) {
        window.onscroll = function () { detectScroll() };
        function detectScroll() {
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                topButton.style.display = "block";
            } else {
                topButton.style.display = "none";
            }
        }

    }

}
//Scroll to the top button
function scrollFunction() {
    window.location.href = "#top"
}