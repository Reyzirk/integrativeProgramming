/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 */

var textvalidate = false;


//Validate Announcement Input
function validateA() {

    descF = $("#descFeedBack");
    var cat = validateCat();
    var title = validateTitle();

    if (textvalidate === false) {
        descF.html("<b>Description</b> cannot be empty");
        $("#desc").addClass("is-invalid");
        $("#desc").focus();
        return false;
    } else if (cat && title) {
        
        Swal.fire({
            title: 'Confirmation',
            text: "Confirm to create a new annoucement?",
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
    title = $("#title");
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




