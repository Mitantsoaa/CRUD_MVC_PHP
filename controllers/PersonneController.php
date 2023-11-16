<?php
require_once 'models/connexion.php';
require_once 'models/PersonneModel.php';

class PersonneController{
    protected $personne = NULL;

    public function __construct() {
        $this->personne = new PersonneModel();
    }

    public function redirect($location) {
        header('Location: '.$location);
    }

    public function handleRequest() {
        $op = isset($_GET['op']) ? $_GET['op'] : NULL;
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        try {
            if ( !$op || $op == 'list' ) {
                $this->listPerson();
            } elseif ( $op == 'new') {
                $this->savePerson();
            } elseif ( $op == 'edit'&& $id != NULL) {
                $this->editPerson($id);
            }elseif ( $op == 'delete' && $id != NULL) {
                $this->deletePerson($id);
            }else {
                $this->showError("Page not found", "Page for operation ".$op." was not found!");
            }
        } catch ( Exception $e ) {

            $this->showError("Erreur", $e->getMessage());
        }
    }

    public function listPerson() {
        $paginate = 5;
        $orderby = isset($_GET['orderby']) ? $_GET['orderby'] : "nom ";
        if (isset($_GET["page"])) {
            $page  = $_GET["page"];
        }
        else{
            $page=1;
        };
        $start_from = ($page-1) * $paginate;
        $personnes = $this->personne->getAllPerson($orderby, $paginate, $start_from);
        $total = $this->personne->paginator($paginate);
        include "views/list.php";
    }

    public function savePerson(){
        $img = '';
        $nom = '';
        $mail = '';
        $phone = '';
        
        if ( isset($_POST['save']) ) {
            $img      = isset($_FILES['photo'])?   $_FILES['photo']['name'] :NULL;
            $nom    = isset($_POST['nom'])? $_POST['nom']:NULL;
            $mail    = isset($_POST['mail'])? $_POST['mail']:NULL;
            $phone    = isset($_POST['phone'])? $_POST['phone']:NULL;
            
            try {
                
                $this->personne->newPerson($img, $nom, $mail, $phone);
                $this->redirect('index.php');
                return;
            } catch (Exception $exception) { echo 'Error: '. $exception->getMessage(); }
        }
        include 'views/insert.php';
    }
}