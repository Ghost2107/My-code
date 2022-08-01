<?php
require_once "template.php";

require_once "Connect.php";
?>



<div id="page-wrapper" style="min-height: 292px;">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 align="center" class=" bg-success titre-contact"> AJOUTER UN EMPLOYE </h3>

            <div class="panel panel-primary">
                <form class="form-horizontal" data-toggle="validator" role="form" method="post">
                    <p></p>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-5">
                                <!--<form class="form-horizontal" role="form">-->



                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">NOM :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="nom_employe" id="nom_employe" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">PRENOM :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="prenom_employe" id="prenom_employe" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">MATRICULE :</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="matricule_employe" id="matricule_employe" required>
                                    </div>
                                </div>


                            </div><!--  col-xs-5-->


                            <div class="col-xs-5">




                                <div class="form-group">
                                    <label class=" col-sm-4 control-label">POSTE :</label>
                                    <div class="col-sm-8">

                                        <input type="text" class="form-control" name="poste" id="poste" pattern="[A-Za-z]+">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--col-xs-12 -->

                    </div>
                    <!--row -->

                </form> <!--  /form>-->



            </div>

        </div>
    </div>