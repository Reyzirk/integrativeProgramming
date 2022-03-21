/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
var sortType = "Name";
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
        url: "AJAX/displayChildClassesList.php",
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
        url: "AJAX/displayChildClassesPagination.php",
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
        url: "AJAX/displayChildClassesPagination.php",
        type: "POST",
        data: {"id": url.searchParams.get("id"), "currentPage": pageIndex, "entry": entry.val(), "search": inputSearch.val()},
        success: function (response) {
            paginationContent.html(response);
        }
    });
}
function deleteDataRecord(value, value2) {
    Swal.fire({
        title: 'Confirmation',
        text: "Are you sure you want to delete the student from the class!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Confirm'
    }).then((result) => {
        if (result.isConfirmed) {
            loadingScreen();
            $.ajax({
                url: "AJAX/deleteChildClass.php",
                type: "POST",
                data: {"classID": value, "childID": value2},
                success: function (response) {
                    if (response === "fail") {
                        Swal.close();
                        showErrorMessage("Please Try Again!");
                    } else if (response === "success") {
                        Swal.close();
                        displayListWithoutLoading();
                        Toast.fire({
                            icon: 'success',
                            html: '<b>Successful</b><br/>Removed the student from the class.'
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
        url: "AJAX/displayChildClassesPagination.php",
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
        url: "AJAX/displayChildClassesPagination.php",
        type: "POST",
        data: {"id": url.searchParams.get("id"), "currentPage": pageIndex, "entry": entry.val()},
        success: function (response) {
            paginationContent.html(response);
        }
    });
    loadList(true);
}

function createBtn() {
    Swal.fire({
        title: 'Assign student to the class',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        inputPlaceholder: 'Enter the Child ID',
        showCancelButton: true,
        confirmButtonText: 'Assign',
        showLoaderOnConfirm: true,
        preConfirm: (inputID) => {
            $.ajax({
                url: "AJAX/assignChildClass.php",
                type: "POST",
                async:false,
                data: {"classID": url.searchParams.get("id"), "childID": inputID},
            }).done(function (response) {
                if (response === "fail") {
                    Swal.showValidationMessage(
                        `Please Try Again!`
                    )
                    return false;
                } else if (response === "success") {
                    Swal.close();
                    displayListWithoutLoading();
                    return true;
                }else{
                    Swal.showValidationMessage(response)
                    return false;
                }
                
                
            }).fail(function (jqXHR, status) {
                Swal.showValidationMessage(
                    `Failed to assign: ${error}`
                )
                return false;
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                heightAuto: false,
                titleText: 'Successful',
                icon: 'success',
                text: 'Successful assign student to the class.',
                showCloseButton: true,
                timer: 3000,
                showConfirmButton: false
            })
        }
    })
}
$(document).ready(function () {
    displayList();
});
function downloadPDF(){
    const table = this.document.getElementById("tableList");
    var opt = {
        margin: 0.2,
        filename: 'childclasses.pdf',
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
                name: "Child Classes",
                filename: "Child Classes" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
                preserveColors: true
        });
    }
}
