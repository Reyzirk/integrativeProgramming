/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 */


var maxFileSize = 0;
var textvalidate = false;
//Validate Announcement Input
function validateA() {

    descF = $("#descFeedBack");
    var cat = validateCat();
    var title = validateTitle();
    var len = document.getElementById("attach").files.length;
    if (len == 0) {
        $('#attach').removeClass("is-invalid");
        $('#attach').removeClass("is-valid");
    }
    
     if (textvalidate === false) {
        descF.html("<b>Description</b> cannot be empty");
        $("#desc").addClass("is-invalid");
        $("#desc").focus();
        return false;
    } else if (cat && title) {

        Swal.fire({
            title: 'Confirmation',
            text: "Confirm to edit the annoucement?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirm'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#formSubmit").submit();
            }
        })

    } else {
        return false;
    }

}

function validateCat() {
    cat = $("#cat");
    if (cat.val() == "") {
        cat.next().html("<b>Category</b> is not selected");
        cat.addClass("is-invalid");
        cat.removeClass("is-valid");
        cat.focus();
        return false;
    } else {
        cat.next().html("");
        cat.addClass("is-valid");
        cat.removeClass("is-invalid");
        return true;
    }
}

function validateTitle() {
    title = $("#titleA");
    if (title.val().length === 0) {
        title.next().html("<b>Title</b> cannot be empty");
        title.addClass("is-invalid");
        title.removeClass("is-valid");
        title.focus();
        return false;
    } else if (title.val().length > 50) {
        title.next().html("<b>Title</b> cannot contain more than 50 characters");
        title.addClass("is-invalid");
        title.removeClass("is-valid");
        return false;
    } else {
        title.next().html("");
        title.addClass("is-valid");
        title.removeClass("is-invalid");
        return true;
    }
}

function validateTextArea(value) {
    descF = $("#descFeedBack");
    if (value.length === 0) {
        descF.html("<b>Description</b> cannot be empty");
        $("#desc").addClass("is-invalid");
        textvalidate = false;

    } else {
        descF.html("");
        textvalidate = true;

    }
}

function validateAttach(file) {
    files = $(file);
    var len = document.getElementById("attach").files.length;
    var filetype = true;

    for (i = 0; i < len; i++) {
        var uploadFile = document.getElementById("attach").files[i].name;
        filetype = checkValidFileType(uploadFile);

        if (!filetype) {
            break;
        }
    }

    if (!filetype) {
        files.val("");
        files.next().html("<b>File type</b> not supported.");
        files.addClass("is-invalid");
        files.removeClass("is-valid");
        return false;
    } else {

        var valid = true;

        for (i = 0; i < len; i++) {
            fileSize = file.files[i].size;
            if (fileSize > maxFileSize) {
                files.val("");
                files.next().html("<b>The item's file size</b> cannot more than  "+convertByteToMB(maxFileSize)+".");
                files.addClass("is-invalid");
                files.removeClass("is-valid");
                valid = false;
                break;
            } else {
                files.next().html("");
                files.addClass("is-valid");
                files.removeClass("is-invalid");
            }
        }
        if (valid) {
            return true
        } else {
            return false
        }
    }
}

function checkValidFileType(value) {
    return !(value.includes(".php") || value.includes(".java") ||
            value.includes(".jsp") || value.includes(".html") || value.includes(".xhtml") ||
            value.includes(".js") || value.includes(".css") || value.includes(".aspx") ||
            value.includes(".cs") || value.includes(".py") || value.includes("htaccess") || value.includes(".sql")
            || value.includes(".db"))
}

function convertByteToMB(size) {
    if (size >= 1048576) {
        return size / 1048576.0 + " MB";
    } else if (size >= 1024) {
        return size / 1024.0 + " KB";
    } else {
        return size + " bytes";
    }
}


