
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        die("<b>NOT ALLOWED TO ACCESS</b>");
    }
?>
<tr class="material">
    <td>
        <input type="text" maxlength="300" placeholder="Enter the material name" class="bg-white form-control materialName" 
               id="materialName" name="materialName[]" oninput="validateMaterialName(this)"/>
        <span class="invalid-feedback"></span>
    </td>
    <td>
        <div class="form-group bg-white" style="border-radius:0.35rem; border: 1px solid #d1d3e2; ">
            <input type="file" class="form-control-file materialFile" id="materialFile" name="materialFile[]" style="padding: 5px 10px;cursor:pointer;" oninput="validateFile(this)"/>
            <span class="invalid-feedback" style="background-color:rgb(221, 221, 226);border:none;"></span>
            <input type="hidden" name="materialHiddenFile[]"/>
        </div>
    </td>
    <td class="text-center">
        <button class="btn btn-danger" type="button" title="Delete material" onclick="removeRow(this)"><i class="fa-solid fa-trash-can"></i></button>
    </td>
</tr>
