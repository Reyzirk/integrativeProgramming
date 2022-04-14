/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
//Author: Poh Choo Meng

function validateHolidayName(){
    input = $("#holidayName");
    errorMsg = input.next();
    if (input.val().length===0){
        errorMsg.html("<b>Holiday Name</b> cannot empty.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (input.val().length > 300){
        errorMsg.html("<b>Holiday Name</b> cannot more than 300 characters.");
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
        errorMsg.html("<b>Start Date</b> cannot empty.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (!isValidDate(input.val())){
        errorMsg.html("<b>Start Date</b> invalid date.");
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
        errorMsg.html("<b>End Date</b> cannot empty.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (!isValidDate(input.val())){
        errorMsg.html("<b>End Date</b> invalid date.");
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
function isValidDate(date){
    if (!/^(20\d\d)[-](0[1-9]|1[0-2])[-](0[1-9]|[12][0-9]|3[01])$/.test(date)){
        return false;
    }else{
        var splitDate = date.split("-");
        var year = parseInt(splitDate[0]);
        var month = parseInt(splitDate[1]);
        var day = parseInt(splitDate[2]);
        if (year<=2000||year>3000||month<=0||month>12){
            return false;
        }else{
            if (year%4===0){
                if (month===2&&day>29){
                    return false;
                }
            }
            var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];
            return day > 0 && day <= monthLength[month - 1];
        }
    }
}
function submitForm(){
    form = $("#form");
    Swal.fire({
        title: 'Confirmation',
        text: "Are you sure you want to edit an existing holiday details!",
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

