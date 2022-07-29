<?php
require_once "Connect.php";
require_once "template.php";





?>




<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 align="center" class=" bg-success titre-contact"> MODIFIER UN SERVICE </h3>

            <div class="panel panel-primary">
                <form class="form-horizontal" data-toggle="validator" role="form" method="post">
                    <p></p>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-5">
                                <!--<form class="form-horizontal" role="form">-->





                            </div><!--  col-xs-5-->

                            <div class="col-xs-5">



                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">NOM SERVICE:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="nom_services" id="nom_services" value="<?php echo $_GET['nom_services']  ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-8">



                                    </div>
                                </div>



                            </div><!--  /col-xs-5>-->
                            <div class="col-xs-2">
                                <p>
                                    <button type="submit" class="btn btn-primary" name="submit">Valider </button>
                                </p>

                            </div>
                            <!--col-xs-2 -->
                        </div>
                        <!--col-xs-12 -->

                    </div>
                    <!--row -->

                </form> <!--  /form>-->



            </div>

        </div>
    </div>



    <?php


    if (isset($_POST['submit'])) {


        $id = $_GET['id_services'];
        $services = $_POST['nom_services'];



        // $sql1 = null;
        if (isset($_POST['nom_services'])) {

            $sql1 = "UPDATE Services SET nom_services='$services' WHERE (id_services ='" . $id . "')";
            // utilise exec() car aucun résultat n'est renvoyé
            // $stmt = $db->prepare($sql1);
            // $stmt->execute();
            $db->exec($sql1);
            //creation de l'enregistrement
            echo "<div class='alert alert-success'>";
            echo " <h4>Modifié avec success</h4> <br>";
            echo " </div>";
        } else {
            echo "<div class='alert alert-danger'>";
            echo " mMdification refusé   <br>";
            echo " </div>";
        }
    }
