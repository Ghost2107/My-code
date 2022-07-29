<?php
require_once "template.php";

require_once "Connect.php";






$sql1 = "SELECT * FROM carte_sim";

$stmt1 = $db->query($sql1);


?>




<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 align="center" class=" bg-success titre-contact"> MODIFIER UN RECHARGE </h3>

            <div class="panel panel-primary">
                <form class="form-horizontal" data-toggle="validator" role="form" method="post">
                    <p></p>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-5">
                                <!--<form class="form-horizontal" role="form">-->

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">CARTE SIM:</label>
                                    <div class="col-sm-6">
                                        <select name="id_carte_sim" class="form-control" value="<?php echo $_GET['id_carte_sim']  ?>" required>

                                            /* affiche les id des cartes sim avec les numero corespondant *\

                                            <?php while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) : ?>

                                                <option value="<?php echo $row['id_carte_sim']; ?>"><?php echo $row['numero_sim']; ?></option>





                                            <?php endwhile; ?>

                                        </select>

                                    </div>
                                </div>


                            </div><!--  col-xs-5-->

                            <div class="col-xs-5">



                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">MONTANT :</label>
                                    <div class="col-sm-8">

                                        <input type="text" class="form-control" name="montant" id="montant" value="<?php echo $_GET['montant']  ?>" required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">DATE:</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" name="created_at" id="created_at" value="<?php echo $_GET['created_at']  ?>" required>

                                    </div>
                                </div>


                            </div><!--  /col-xs-5>-->
                            <div class="col-xs-2">
                                <p>
                                    <button type="submit" class="btn btn-primary" name="enregistrer">Valider </button>
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




        <?php
        $sql = null;
        if (isset($_POST['enregistrer'])) {

            $id = $_GET['id_recharge'];
            $credit = $_POST['rcredit'];
            $data = $_POST['rdata'];
            $sms = $_POST['rsms'];
            $minute = $_POST['rminute'];
            $dates = $_POST['dates'];



            if (
                isset($_POST['rcredit']) && isset($_POST['rdata']) && isset($_POST['rsms'])
                && isset($_POST['rminute']) &&  isset($_POST['date_dexpi'])
            ) {
                $sql = " UPDATE Recharge set rcredit='" . $credit . "',rdata='" . $data . "',rsms='" . $sms . "',rminute='" . $minute . "' ,dates='" . $dates . "' where  (id_recharge ='" . $id . "') ";

                // utilise exec() car aucun résultat n'est renvoyé
                $db->exec($sql);
                //creation de l'enregistrement
                echo " Modifier avec succes ";
            } else {
                echo " refusé ";
            }
        }
