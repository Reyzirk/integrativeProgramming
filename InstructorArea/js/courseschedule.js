/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
var sortType = "Course Code";
var sortOrder = "ASC";
var pageIndex = 1;
var url = new URL(window.location.href);
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
        url: "AJAX/displayCourseScheduleList.php",
        type: "POST",
        data: {"id": url.searchParams.get("id"), "search": inputSearch.val(), "sorttype": sortType, "sortorder": sortOrder, "currentPage": pageIndex, "entry": entry.val()},
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
        url: "AJAX/displayCourseSchedulePagination.php",
        type: "POST",
        data: {"id": url.searchParams.get("id"), "currentPage": pageIndex, "entry": entry.val(), "search": inputSearch.val()},
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
        url: "AJAX/displayCourseSchedulePagination.php",
        type: "POST",
        data: {"id": url.searchParams.get("id"), "currentPage": pageIndex, "entry": entry.val(), "search": inputSearch.val()},
        success: function (response) {
            paginationContent.html(response);
        }
    });
}
function deleteDataRecord(value) {
    Swal.fire({
        title: 'Confirmation',
        text: "Are you sure you want to delete the course from the class!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.isConfirmed) {
            loadingScreen();
            $.ajax({
                url: "AJAX/deleteCourseSchedule.php",
                type: "POST",
                data: {"scheduleID": value},
                success: function (response) {
                    if (response === "fail") {
                        displayListWithoutLoading();
                        showErrorMessage("Please Try Again!");
                    } else if (response === "success") {
                        Swal.close();
                        displayListWithoutLoading();
                        Toast.fire({
                            icon: 'success',
                            html: '<b>Successful</b><br/>Removed the course from the class.'
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
        url: "AJAX/displayCourseSchedulePagination.php",
        type: "POST",
        data: {"id": url.searchParams.get("id"), "currentPage": pageIndex, "entry": entry.val(), "search": inputSearch.val()},
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
        url: "AJAX/displayCourseSchedulePagination.php",
        type: "POST",
        data: {"id": url.searchParams.get("id"), "currentPage": pageIndex, "entry": entry.val()},
        success: function (response) {
            paginationContent.html(response);
        }
    });
    loadList(true);
}
$(document).ready(function () {
    displayList();
});

function downloadPDF(){
    const table = this.document.getElementById("tableList");
    var opt = {
        margin: 0.2,
        filename: 'courseschedule.pdf',
        image: { type: 'png', quality: 10 },
        html2canvas: { scale: 3 },
        jsPDF: { unit: 'in', format: 'A4', orientation: 'landscape' }
    };
    html2pdf().from(table).set(opt).save();
}
function downloadXLSX(){
    var table = $('.table2excel');
    if (table && table.length) {
        $(table).table2excel({
                exclude: ".noExl",
                name: "Course Schedule",
                filename: "Course Schedule" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: true
        });
    }
}