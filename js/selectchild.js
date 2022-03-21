/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

function validateChild(){
    input = $("#child");
    errorMsg = input.next();
    if (input.val().length===0){
        errorMsg.html("<b>Child</b> cannot empty.");
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
        text: "Are you sure you want to select this child!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm'
      }).then((result) => {
        if (result.isConfirmed) {
            var validated1 = validateChild();
            if (validated1){
                form.submit();
            }
        }
      })
}


