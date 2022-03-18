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
function validateTimeStart(){
    input = $("#timeStart");
    errorMsg = input.next();
    if (input.val().length===0){
        errorMsg.html("<b>Time Start</b> cannot empty.");
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
function validateDuration(){
    input = $("#duration");
    errorMsg = input.next();
    if (input.val().length===0){
        errorMsg.html("<b>Duration</b> cannot empty.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (isNaN(input.val())){
        errorMsg.html("<b>Duration</b> not decimal.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (input.val()<1||input.val()>6000){
        errorMsg.html("<b>Duration</b> must between 1 to 6000.");
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
function validateDayOfWeek(){
    input = $("#dayOfWeek");
    errorMsg = input.next();
    if (input.val().length===0){
        errorMsg.html("<b>Day of Week</b> cannot empty.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (!(input.val() === "Monday"||input.val() === "Tuesday"||input.val() === "Wednesday"||input.val() === "Thursday"||input.val() === "Friday"||input.val() === "Saturday"||input.val() === "Sunday")){
        errorMsg.html("<b>Day of Week</b> not valid option.");
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
function validateClassType(){
    input = $("#classType");
    errorMsg = input.next();
    if (input.val().length===0){
        errorMsg.html("<b>Class Type</b> cannot empty.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (!(input.val() === "Lecture"||input.val() === "Tutorial"||input.val() === "Practical"||input.val() === "Blended")){
        errorMsg.html("<b>Class Type</b> not valid option.");
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
        text: "Are you sure you want to create a new schedule!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm'
      }).then((result) => {
        if (result.isConfirmed) {
            var validated1 = validateCourseCode();
            var validated2 = validateInstructor();
            var validated3 = validateDuration();
            var validated4 = validateTimeStart();
            var validated5 = validateDayOfWeek();
            var validated6 = validateClassType();
            if (validated1&&validated2&&validated3&&validated4&&validated5&&validated6){
                form.submit();
            }
        }
      })
}

