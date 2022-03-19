/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
var invalidDescription = true;
var maxFileSize = 0;
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
function validateMaterialName(input){
    input = $(input);
    errorMsg = input.next();
    if (input.val().length===0){
        errorMsg.html("<b>Material Name</b> cannot empty.");
        input.addClass("is-invalid");
        input.removeClass("is-valid");
        return false;
    }else if (input.val().length > 300){
        errorMsg.html("<b>Material Name</b> cannot more than 300 characters.");
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
        invalidDescription = true;
        return false;
    }else{
        errorMsg.html("");
        invalidDescription = false;
        return true;
    }
}
function validateFile(element){
    input = $(element);
    errorMsg = input.next();
    fileNameInput = input.next().next();
    hiddenInput = input.next().next().next();
    if (hiddenInput.val().length!=0){
        if (input.val().length===0){
            fileNameInput.html("File Name: "+hiddenInput.val());
            return true;
        }else if(!checkValidFileType(input.val())){
            input.val("");
            fileNameInput.html("File Name: "+hiddenInput.val());
            errorMsg.html("File type of <b>Material File</b> not supported.");
            input.addClass("is-invalid");
            input.removeClass("is-valid");
            return false;
        }else{
            fileSize = element.files[0].size;
            if(fileSize>maxFileSize){
                input.val("");
                fileNameInput.html("File Name: "+hiddenInput.val());
                errorMsg.html("<b>Material File</b> cannot more than "+convertByteToMB(maxFileSize)+".");
                input.addClass("is-invalid");
                input.removeClass("is-valid");
                return false;
            }
            else{
                errorMsg.html("");
                fileNameInput.html("File Name: "+input.val());
                input.addClass("is-valid");
                input.removeClass("is-invalid");
                return true;
            }
        }
    }else{
        if (input.val().length===0){
            errorMsg.html("<b>Material File</b> cannot empty.");
            input.addClass("is-invalid");
            input.removeClass("is-valid");
            return false;
        }else if(!checkValidFileType(input.val())){
            input.val("");
            errorMsg.html("File type of <b>Material File</b> not supported.");
            input.addClass("is-invalid");
            input.removeClass("is-valid");
            return false;
        }else{
            fileSize = element.files[0].size;
            if(fileSize>maxFileSize){
                input.val("");
                errorMsg.html("<b>Material File</b> cannot more than "+convertByteToMB(maxFileSize)+".");
                input.addClass("is-invalid");
                input.removeClass("is-valid");
                return false;
            }
            else{
                errorMsg.html("");
                input.addClass("is-valid");
                input.removeClass("is-invalid");
                return true;
            }
        }
    }
    
}
function convertByteToMB(size){
    if (size >= 1048576){
        return size/1048576.0+" MB";
    }else if (size>=1024){
        return size/1024.0+" KB";
    }else{
        return size+" bytes";
    }
}
function checkValidFileType(value){
    return !(value.includes(".php")||value.includes(".java")||
            value.includes(".jsp")||value.includes(".html")||value.includes(".xhtml")||
            value.includes(".js")||value.includes(".css")||value.includes(".aspx")||
            value.includes(".cs")||value.includes(".py")||value.includes("htaccess")||value.includes(".sql")
            ||value.includes(".db"))
}
function submitForm(){
    form = $("#form");
    Swal.fire({
        title: 'Confirmation',
        text: "Are you sure you want to edit an existing course!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm'
      }).then((result) => {
        if (result.isConfirmed) {
            var validated1 = validateCourseCode();
            var validated2 = validateCourseName();
            var validated3 = invalidDescription;
            if(invalidDescription){
                errorMsg = $("#feedbackText");
                errorMsg.html("<b>Course Description</b> cannot empty.");
            }
            var valid = true;
            var validFile = true;
            $(".material").each(function(i, obj) {
                if (!validateMaterialName(obj.getElementsByClassName("materialName")[0])){
                    if (valid){
                        valid = false;
                    }
                }
            });
            $(".material").each(function(i, obj) {
                if (!validateFile(obj.getElementsByClassName("materialFile")[0])){
                    if (validFile){
                        validFile = false;
                    }
                }
            });
            if (validated1&&validated2&&!validated3&&valid&&validFile){
                form.submit();
            }
        }
      })
}
var rowCount = 0;
function addNewRow(){
    if (rowCount===10){
        showErrorMessage("Only allowed to upload 10 course materials.");
        return;
    }
    $.ajax({
        url: "Template/newCourseMaterialRow.php",
        type: "POST",
        success: function (response) {
            $('#courseMaterials > tbody tr:last').before(response);
            rowCount++;
        }
    });
}
function removeRow(element){
    element.parentElement.parentElement.remove();
}

