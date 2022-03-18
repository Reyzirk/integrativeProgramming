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
function validateInstructor(){
    input = $("#instructor");
    errorMsg = input.next();
    if (input.val().length===0){
        errorMsg.html("<b>Examiner</b> cannot empty.");
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
function validateExamStartTime(){
    input = $("#examStartTime");
    errorMsg = input.next();
    if (input.val().length===0){
        errorMsg.html("<b>Exam Start Time</b> cannot empty.");
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
function validateExamDuration(){
    input = $("#examDuration");
    errorMsg = input.next();
    if (input.val().length===0){
        errorMsg.html("<b>Exam Duration</b> cannot empty.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (isNaN(input.val())){
        errorMsg.html("<b>Exam Duration</b> not decimal.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (input.val()<1||input.val()>60000){
        errorMsg.html("<b>Exam Duration</b> must between 1 to 60000.");
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
function submitForm(){
    form = $("#form");
    Swal.fire({
        title: 'Confirmation',
        text: "Are you sure you want to create a new examination!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm'
      }).then((result) => {
        if (result.isConfirmed) {
            var validated1 = validateCourseCode();
            var validated2 = validateInstructor();
            var validated3 = validateExamDuration();
            var validated4 = validateExamStartTime();
            if (validated1&&validated2&&validated3&&validated4){
                form.submit();
            }
        }
      })
}

