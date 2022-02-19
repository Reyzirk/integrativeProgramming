/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
function validateCourseCode(){
    input = $("#courseCode");
    errorMsg = input.next();
    if (input.val().length===0){
        errorMsg.html("<b>Course Code</b> cannot empty.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (input.val().length > 10){
        errorMsg.html("<b>Course Code</b> cannot more than 10 characters.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else{
        errorMsg.html("");
        input.addClass("is-valid");
        input.removeClass("is-invalid");
        return true;
    }
}
function validateCourseName(){
    input = $("#courseName");
    errorMsg = input.next();
    if (input.val().length===0){
        errorMsg.html("<b>Course Name</b> cannot empty.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (input.val().length > 300){
        errorMsg.html("<b>Course Name</b> cannot more than 300 characters.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else{
        errorMsg.html("");
        input.addClass("is-valid");
        input.removeClass("is-invalid");
        return true;
    }
}
function validateCourseDescription(data){
    errorMsg = $("#feedbackText");
    if (data.length===0){
        errorMsg.html("<b>Course Description</b> cannot empty.");
        return false;
    }else{
        errorMsg.html("");
        return true;
    }
}

function submitForm(){
    form = $("#form");
    Swal.fire({
        title: 'Confirmation',
        text: "Are you sure you want to create a new holiday!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm'
      }).then((result) => {
        if (result.isConfirmed) {
            var validated1 = validateHolidayName();
            var validated2 = validateDateStart();
            var validated3 = validateDateEnd();
            if (validated1&&validated2&&validated3){
                form.submit();
            }
        }
      })
}
function addNewRow(){
    $('#courseMaterials > tbody tr:last').before('');
}

