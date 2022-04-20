<?php include 'Function/ini_load.php';session_status() === PHP_SESSION_NONE?session_start():"";
//Author: Poh Choo Meng
?>
<?php
    if (empty($_SESSION["exceptionerror"])){
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: index.php');
    }
?>
<html>
    <head>
        <?php include 'Components/headmeta.php' ?>
    </head>
    <body>
        <div id="wrapper">
            <div id="content-wrapper">
                <div id="content">
                    <br/>
                    <br/>
                    <?php
                        if ($generalSection["maintenance"]){
                            $ex = $_SESSION["exceptionerror"];
                            
                    ?>
                    
                    <div class="container-fluid">
                        <br />
                        <div class="alert alert-dismissible alert-danger" style="padding:20px 10px;margin:-22px 0px 0px 0px">
                            <h4 class="alert-danger" style="text-align: center;">Server Error</h4>
                            <hr/>
                            <div id="accordion" >
                                <div class="card">
                                    <!-- Error Message -->
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                              Error Message
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <?php echo $ex->getMessage(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <!-- Stack Trace Message -->
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Stack Trace
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            <?php echo preg_replace("/\n/", '<br>', $ex->getTraceAsString()); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <center>
                                <button type="button" class="btn btn-info" id="Button3" runat="server" onclick="location.href='index.php'">Home Page</button>
                            </center>
                        </div>
                    </div>
                       <?php }else{ ?>
                        <h5 style="color:red;">
                            <center>Unable to process the operation!<br />Please contact the website administrator staff.<br />
                                <br/>
                                <img src="https://cdn-icons-png.flaticon.com/512/675/675564.png" width="256" height="256"/><br/><br/>
                                <button type="button" class="btn btn-info" id="Button2" runat="server" onclick="location.href='index.php'">Home Page</button>
                            </center>

                        </h5>
                       <?php } ?>
                </div>
                <?php include "Components/footer.php";unset($_SESSION["exceptionerror"]); ?>
            </div>
        </div>
    </body>
</html>
