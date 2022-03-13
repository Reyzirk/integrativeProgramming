/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

function validateGrade(){
    input = $("#grade");
    errorMsg = input.next();
    if (input.val().length===0){
        errorMsg.html("<b>Grade</b> cannot empty.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (input.val().length > 3){
        errorMsg.html("<b>Holiday Name</b> cannot more than 3 characters.");
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
function validateMinMark(){
    input = $("#minMark");
    input2 = $("#maxMark");
    errorMsg = input.next();
    if (input.val().length===0){
        errorMsg.html("<b>Min Mark</b> cannot empty.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (isNaN(input.val())){
        errorMsg.html("<b>Min Mark</b> not decimal.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (input.val()<0||input.val()>100){
        errorMsg.html("<b>Min Mark</b> must between 0 to 100.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (parseFloat(input.val())>parseFloat(input2.val())){
        errorMsg.html("<b>Min Mark</b> cannot more than max mark.");
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
function validateMaxMark(){
    input = $("#maxMark");
    input2 = $("#minMark");
    errorMsg = input.next();
    if (input.val().length===0){
        errorMsg.html("<b>Max Mark</b> cannot empty.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (isNaN(input.val())){
        errorMsg.html("<b>Max Mark</b> not decimal.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (input.val()<0||input.val()>100){
        errorMsg.html("<b>Max Mark</b> must between 0 to 100.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (parseFloat(input.val())<parseFloat(input2.val())){
        errorMsg.html("<b>Max Mark</b> cannot less than min mark.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else{
        input2.attr("max",input.val());
        errorMsg.html("");
        input.addClass("is-valid");
        input.removeClass("is-invalid");
        validateMinMark();
        
        return true;
    }
       
}
function submitForm(){
    form = $("#form");
    Swal.fire({
        title: 'Confirmation',
        text: "Are you sure you want to edit an existing grade!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm'
      }).then((result) => {
        if (result.isConfirmed) {
            var validated1 = validateGrade();
            var validated2 = validateMinMark();
            var validated3 = validateMaxMark();
            if (validated1&&validated2&&validated3){
                form.submit();
            }
        }
      })
}

