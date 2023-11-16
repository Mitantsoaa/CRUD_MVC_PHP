<?php include('header.php');
?>
<div class="row">
    <div class="col-md-6 col-offset-3">
        <form action="" method="POST" class="form">
                <div class="form-group">
                    <input type="file" class="form-control item" id="file" name="photo">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control item" id="username" placeholder="Entrez votre nom" name="nom">
                </div>
                <div class="form-group">
                    <input type="mail" class="form-control item" id="email" placeholder="Email" name="mail">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control item" id="phone-number" placeholder="Entrez votre numero de téléphone" name="phone">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary create-account" name="save" value="Enregistrer">
                </div>
        </form>
    </div>
</div>