<?php
require 'autoload.php';

class PersonneController{
    protected $personne = NULL;

    public function __construct() 
    {
        $this->personne = new PersonneModel();
    }

    public function redirect($location) {
        header('Location: '.$location);
    }

    public function handleRequest()
    {
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

    public function listPerson() 
    {
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

    public function savePerson()
    {
        $img = '';
        $nom = '';
        $mail = '';
        $phone = '';

        if ( isset($_POST['save']) ) {
            $img      = isset($_FILES['photo']['name'])?   $_FILES['photo']['name'] :NULL;
            $nom    = isset($_POST['nom'])? $_POST['nom']:NULL;
            $mail    = isset($_POST['mail'])? $_POST['mail']:NULL;
            $phone    = isset($_POST['phone'])? $_POST['phone']:NULL;

            try {
                $this->personne->newPerson($img, $nom, $mail, $phone);
                $file = $_FILES['photo']['tmp_name'];
                $destination = '/assets/images';
                move_uploaded_file($file, realpath(dirname(__DIR__)).$destination.'/'.$img);
                $this->redirect('index.php');

                return;
            } catch (Exception $exception) { echo 'Error: '. $exception->getMessage(); }
        }
        include 'views/insert.php';
    }

    public function editPerson($id)
    {
        $item = $this->personne->getPersonById($id);
        $img = $item['img_url'];
        $nom = $item['nom'];
        $mail = $item['email'];
        $phone = $item['phone'];

        if ( isset($_POST['save']) ) {
            $photo      = isset($_FILES['photo']['name']) ?   $_FILES['photo']['name'] : NULL;
            $name    = isset($_POST['nom']) ? $_POST['nom'] : NULL;
            $email    = isset($_POST['mail']) ? $_POST['mail'] : NULL;
            $tel    = isset($_POST['phone']) ? $_POST['phone'] : NULL;

            try {

                $this->personne->updatePerson($id, $photo, $name, $email, $tel);
                $file = $_FILES['photo']['tmp_name'];
                $destination = '/assets/images';
                move_uploaded_file($file, realpath(dirname(__DIR__)).$destination.'/'.$photo);
                $this->redirect('index.php');

                return;
            } catch (Exception $exception) { echo 'Error: '. $exception->getMessage(); }
        }
        include 'Views/update.php';

    }

    public function deletePerson($id)
    {
        try {
            $this->personne->deletePerson($id);
        } catch (Exception $exception) {
            echo 'Error: ' . $exception->getMessage();
        }
        $this->redirect('index.php');
    }
}