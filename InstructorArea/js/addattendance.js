/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @Author: Ng Kar Kai
 */

function searchBarConversion(){
    var criteria = document.getElementById("criteriaDropdown");
    var value = criteria.value;
    var input = document.getElementById("searchInfo");
    
    if (value ==="date"){
        input.type = 'date';
    }
    else if (value === "name") {
        input.type = 'text';
    }
    
}


