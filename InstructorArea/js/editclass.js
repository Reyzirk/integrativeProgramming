/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

function validateYear(){
    input = $("#year");
    errorMsg = input.next();
    if (input.val().length===0){
        errorMsg.html("<b>Year</b> cannot empty.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (isNaN(input.val())){
        errorMsg.html("<b>Year</b> not number.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (input.val()<2000||input.val()>9999){
        errorMsg.html("<b>Year</b> must between 2000 to 9999.");
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
function validateSemester(){
    input = $("#semester");
    errorMsg = input.next();
    if (input.val().length===0){
        errorMsg.html("<b>Semester</b> cannot empty.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (isNaN(input.val())){
        errorMsg.html("<b>Semester</b> not number.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (input.val()<0||input.val()>100){
        errorMsg.html("<b>Semester</b> must between 0 to 100.");
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
        errorMsg.html("<b>Form Teacher</b> cannot empty.");
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
function validateDateStart(){
    input = $("#dateStart");
    input2 = $("#dateEnd");
    errorMsg = input.next();
    if (input.val().length===0){
        errorMsg.html("<b>Class Start</b> cannot empty.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (!isValidDate(input.val())){
        errorMsg.html("<b>Class Start</b> invalid date.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else{
        input2.attr("min",input.val());
        errorMsg.html("");
        input.addClass("is-valid");
        input.removeClass("is-invalid");
        return true;
    }
}
function validateDateEnd(){
    input = $("#dateEnd");
    input2 = $("#dateStart");
    errorMsg = input.next();
    if (input.val().length===0){
        errorMsg.html("<b>Class End</b> cannot empty.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (!isValidDate(input.val())){
        errorMsg.html("<b>Class End</b> invalid date.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else{
        input2.attr("max",input.val());
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
        text: "Are you sure you want to edit an existing class!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm'
      }).then((result) => {
        if (result.isConfirmed) {
            var validated1 = validateYear();
            var validated2 = validateSemester();
            var validated3 = validateInstructor();
            var validated4 = validateDateStart();
            var validated5 = validateDateEnd();
            if (validated1&&validated2&&validated3&&validated4&&validated5){
                form.submit();
            }
        }
      })
}