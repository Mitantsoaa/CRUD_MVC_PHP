<?php include('header.php');
?>
<div class="row">
    <div class="col-md-6 col-offset-3">
        <form action="" method="POST" class="form" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="file" class="form-control item" id="photo" name="photo" value="<?php echo $img?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control item" id="username" placeholder="Entrez votre nom" name="nom"  value="<?php echo $nom?>">
                </div>
                <div class="form-group">
                    <input type="mail" class="form-control item" id="email" placeholder="Email" name="mail"  value="<?php echo $mail?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control item" id="phone-number" placeholder="Entrez votre numero de téléphone" name="phone"  value="<?php echo $phone?>">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-block create-account" value="Enregistrer" name="save">
                </div>
        </form>
    </div>
</div>