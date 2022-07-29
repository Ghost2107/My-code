<?php
 require_once "Connect.php";
 require_once "template.php";

 



 ?>




<div id="page-wrapper" style="min-height: 292px;">

       <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 align = "center" class=" bg-success titre-contact"> MODIFIER UNE CARTE SIM  </h3>

            <div class="panel panel-primary">
                <form class="form-horizontal" data-toggle="validator"  role="form"  method="post" >
                    <p></p>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-5">
                                <!--<form class="form-horizontal" role="form">-->

                                <div class="form-group">
                                    <label  class=" col-sm-6 control-label">OPERATEUR:</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="operateur" id="operateur" value="<?php echo $_GET['operateur']  ?>"
                                               required>
                                    </div>
                                   
                                </div>

                                
                            
                                
                            </div><!--  col-xs-5-->

                            <div class="col-xs-5">

                                
                                    
                                <div class="form-group">
                                    <label  class=" col-sm-4 control-label">NUMERO:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="numero_sim" id="numero_sim" value="<?php echo $_GET['numero_sim']  ?>" required>
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
                            
                        </div> <!--col-xs-2 -->
                        </div> <!--col-xs-12 -->
            
                    </div> <!--row -->

                </form> <!--  /form>-->



            </div>

        </div>
 


<?php


if (isset($_POST['submit'])) {

    
    $id= $_GET['id_carte_sim'];
    $martelephone= $_POST['operateur'];
    $mattelephone= $_POST['numero_sim'];


    $sql1 = null;
    if (isset($_POST['operateur']) && isset($_POST['numero_sim']) ) {
        $sql1 = "UPDATE carte_sim set operateur='".$martelephone."', numero_sim='".$mattelephone."' where (id_carte_sim ='".$id."') ";
        // utilise exec() car aucun résultat n'est renvoyé
        $db->exec($sql1);
        //creation de l'enregistrement
        echo " modifiés avec success <br>";
    } else {
        echo " modification refusé   <br>";
        
    }
}
