<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->
<!-- Author: Choo Meng -->

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>404 Error Page</title>
        <style>
            button{
                display:inline-block;
                font-weight:400;
                text-align:center;
                white-space:nowrap;
                vertical-align:middle;
                user-select:none;
                border: 1px solid transparent;
                padding: .375rem .75rem;
                font-size: 1rem;
                line-height:1.5;
                border-radius:.25rem;
                transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                color: #fff;
                background-color: #007bff;
                cursor: pointer;
            }
        </style>
    </head>
    <body style="background-color: #f8f5f0;">
        <div style="max-width: 500px;margin:auto;position:fixed;top:47%;left:50%;margin-top:-50px;margin-left:-150px">
            <div style="float:right">
                 <h1 style="margin-bottom: 0px;padding-left:20px;"> 404 ERROR</h1>
                 <h3 style="margin-top: 0px;padding-left:20px;"> Page not found.</h3>
            </div>
            <img src="../images/404-error.png" alt="" width="100" height="100" />
            <br>
            <br>
            <center><button onclick="location.href='index.php'">Home Page</button></center>
        </div>
        
    </body>
</html>
