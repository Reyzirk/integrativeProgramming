/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Oon Kheng Huang
 */

var descValue;
var descStore = true;

//Validate Announcement Input
function validateA(){
    title = $("#title");
    descF = $("#descFeedback"); 
    cat = $("#cat");
    if(title.val().length===0){
        title.next().html("<b>Title</b> cannot be empty");
        title.addClass("is-invalid");
        title.removeClass("is-valid");
        return false;
    }else if(title.val().length > 50){
        title.next().html("<b>Title</b> cannot contain more than 50 characters");
        title.addClass("is-invalid");
        title.removeClass("is-valid");
        return false;
    }else if(descValue.length === 0){
        descF.html("<b>Description</b> cannot be empty");
        descStore = false;
        return false;
    }else if(descValue.length > 5000){
        descF.html("<b>Description</b> cannot contain more than 5000 characters");
        descStore = false;
        return false;
    }else if(cat.val() == 0){
        desc.next().html("<b>Category</b> is not selected");
        desc.addClass("is-invalid");
        desc.removeClass("is-valid");
        return false;
    }else if(descStore == true){
        error.html("");
        input.addClass("is-valid");
        input.removeClass("is-invalid");
        return false;
    }
}

function getDesc(desc){
    descF = $("#descFeedback");
    if(desc.length === 0){
        descF.html("<b>Description</b> cannot be empty");
        descStore = false;
        return false;
    }else if(desc.length > 5000){
        descF.html("<b>Description</b> cannot contain more than 5000 characters");
        descStore = false;
        return false;
    }
}


