/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @Author: Ng Kar Kai
 */

function searchBarConversion() {
    var criteria = document.getElementById("criteriaDropdown");
    var value = criteria.value;
    var input = document.getElementById("searchInfo");

    if (value === "date") {
        input.type = 'date';
    } else if (value === "name") {
        input.type = 'text';
    }

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

function deleteAttendanceRecord(attendanceID) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result)=>{
        if (result.isConfirmed){
            loadingScreen();
            $.ajax({
                url:"AJAX/deleteAttendanceLog.php",
                type:"POST",
                data:{"attendanceID":attendanceID},
                success: function(response){
                    if (response === "success"){
                        Swal.close();
                        Toast.fire({
                            icon: 'success',
                            html: '<b>Successful</b><br/>Removed the attendance record.'
                        })
                         window.setTimeout(function(){location.reload()},3000);
                    }
                    else{
                        Swal.close();
                        showErrorMessage(response);
                    }
                }
            })
        }
    })
}

function refreshPage(){
    window.location.reload();
}

function downloadPDF(){
    const table = this.document.getElementById("attendanceTable");
    var opt = {
        margin: 0.2,
        filename: 'attendanceLog.pdf',
        image: { type: 'png', quality: 10 },
        html2canvas: { scale: 3 },
        jsPDF: { unit: 'in', format: 'A4', orientation: 'landscape' }
    };
    html2pdf().from(table).set(opt).save();
}

