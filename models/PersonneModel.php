<?php
require_once 'connexion.php';

class PersonneModel {

    public function getAllPerson($order = 'nom', $paginate, $start_from)
    {
        try {
            $pdo = DataBase::connect();
            $sql = $pdo->prepare("SELECT * FROM personnel p GROUP BY p.id ORDER BY $order LIMIT $start_from, $paginate");
            $sql->execute();
            $result = $sql->fetchAll();
            DataBase::disconnect();
        } catch (PDOException  $e ){
            echo "Error: ".$e;
        }

        return $result;
    }

    public function getPersonById($id) 
    {
        try{
            $pdo = DataBase::connect();
            $sql = $pdo->prepare("SELECT * FROM personnel WHERE id = $id");
            $sql->execute();
            $result = $sql->fetch();
            DataBase::disconnect();
        }catch(PDOException  $e ){
            echo "Error: ".$e;
        }

        return ($result);
    }

     public function updatePerson( $id, $img, $nom, $mail, $phone) 
     {
         try {
             $pdo = DataBase::connect();
             $sql = $pdo->prepare(
                 "UPDATE personnel SET img_url = ?, nom = ?, email=?, phone=? WHERE id = $id");
             $sql->execute([$img, $nom, $mail, $phone]);
             $sql->execute();
             DataBase::disconnect();;
         } catch (Exception $e) {
             DataBase::disconnect();
             throw $e;
         }
    }

    public function deletePerson( $id) 
    {
         try {
             $pdo = DataBase::connect();
             $sql = $pdo->prepare("DELETE FROM personnel WHERE id = $id");
             $sql->execute();
             DataBase::disconnect();
         } catch (Exception $e) {
             DataBase::disconnect();
             throw $e;
         }
    }

    public function newPerson($img,$nom,$mail,$phone)
    {
        try {
            $pdo = DataBase::connect();
            $sql = $pdo->prepare("INSERT INTO personnel (img_url, nom, email, phone) VALUES ('".$img."','".$nom."','".$mail."','".$phone."')");
			$sql->execute();
            // var_dump('okok');die;
            DataBase::disconnect();;
            } catch (Exception $e) {
            DataBase::disconnect();
            throw $e;
        }
    }

    public function paginator ($limit)
    {
        try {
            $pdo = DataBase::connect();
            $sth = $pdo->prepare("SELECT COUNT(id) FROM personnel");
            $sth->execute();
            $result = $sth->fetchColumn();

            DataBase::disconnect();
            $total_pages = ceil($result / $limit);
            
            return $total_pages;
        } catch (PDOException  $e ){
            echo "Error: ".$e;
        }
    }

}
