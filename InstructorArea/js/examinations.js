/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
var sortType = "ExaminationID";
var sortOrder = "ASC";
var pageIndex = 1;
function sortCol(element) {
    loadingScreen();
    if (sortType === element.innerText) {
        if (sortOrder === "ASC") {
            sortOrder = "DESC";
        } else {
            sortOrder = "ASC";
        }
    } else {
        sortOrder = "ASC";
    }
    sortType = element.innerText;
    headerRow = $('#tableList') > $('thead') > $('tr');
    headerRow > $('th').each(function () {
        var icon = $(this).find('i');
        if (this.innerText === sortType) {
            icon.eq(0).removeClass("fa-sort");
            if (sortOrder === "ASC") {
                icon.eq(0).removeClass("fa-sort-down");
                icon.eq(0).addClass("fa-sort-up");
            } else {
                icon.eq(0).removeClass("fa-sort-up");
                icon.eq(0).addClass("fa-sort-down");
            }
        } else {
            icon.eq(0).removeClass("fa-sort-down");
            icon.eq(0).removeClass("fa-sort-up");
            icon.eq(0).addClass("fa-sort");
        }
    });
    loadList(true);
}
function loadList(closeBool) {
    inputSearch = $('#inputSearch');
    tableContent = $('#tableContent');
    entry = $('#displayEntries');

    $.ajax({
        url: "AJAX/displayExaminationList.php",
        type: "POST",
        data: {"search": inputSearch.val(), "sorttype": sortType, "sortorder": sortOrder, "currentPage": pageIndex, "entry": entry.val()},
        success: function (response) {
            tableContent.html(response);
            if (closeBool) {
                Swal.close();
            }
        }
    });
}
function loadingScreen() {
    Swal.fire({
        heightAuto: false,
        titleText: 'Loading',
        icon: 'info',
        showCloseButton: false,
        showConfirmButton: false
    })
}
function displayList() {
    loadingScreen();
    loadList(false);
    entry = $('#displayEntries');
    paginationContent = $('#displayPagination');
    $.ajax({
        url: "AJAX/displayExaminationPagination.php",
        type: "POST",
        data: {"currentPage": pageIndex, "entry": entry.val(),"search": inputSearch.val()},
        success: function (response) {
            Swal.close();
            paginationContent.html(response);
        }
    });
}
function displayListWithoutLoading() {
    loadList(false);
    entry = $('#displayEntries');
    paginationContent = $('#displayPagination');
    $.ajax({
        url: "AJAX/displayExaminationPagination.php",
        type: "POST",
        data: {"currentPage": pageIndex, "entry": entry.val(),"search": inputSearch.val()},
        success: function (response) {
            paginationContent.html(response);
        }
    });
}
function deleteDataRecord(value) {
    Swal.fire({
        title: 'Confirmation',
        text: "Are you sure you want to delete the examination!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.isConfirmed) {
            loadingScreen();
            $.ajax({
                url: "AJAX/deleteExamination.php",
                type: "POST",
                data: {"examinationID": value},
                success: function (response) {
                    if (response === "fail") {
                        Swal.close();
                        showErrorMessage("Please Try Again!");
                    } else if (response === "success") {
                        Swal.close();
                        displayListWithoutLoading();
                        Toast.fire({
                            icon: 'success',
                            html: '<b>Successful</b><br/>Removed the examination.'
                        })

                    } else {
                        Swal.close();
                        showErrorMessage(response);
                    }

                }
            });
        }
    });
}



function updatePageIndex(index) {
    loadingScreen();
    pageIndex = index;
    entry = $('#displayEntries');
    paginationContent = $('#displayPagination');
    $.ajax({
        url: "AJAX/displayExaminationPagination.php",
        type: "POST",
        data: {"currentPage": pageIndex, "entry": entry.val(),"search": inputSearch.val()},
        success: function (response) {
            paginationContent.html(response);
        }
    });
    loadList(true);
}
function updatePageEntry() {
    loadingScreen();
    pageIndex = 1;
    entry = $('#displayEntries');
    paginationContent = $('#displayPagination');
    $.ajax({
        url: "AJAX/displayExamminationPagination.php",
        type: "POST",
        data: {"currentPage": pageIndex, "entry": entry.val()},
        success: function (response) {
            paginationContent.html(response);
        }
    });
    loadList(true);
}
$(document).ready(function() {
   displayList(); 
});


