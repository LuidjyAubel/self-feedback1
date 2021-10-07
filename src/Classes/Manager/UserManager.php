<?php
namespace App\Classes\Manager;

use PDO;
use App\Classes\Entity\User;

class UserManager
{
    private $_db;

    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }

    public function setDb($db): UserManager
    {
        $this->_db = $db;
        return $this;
    }

    public function addUser($email, $password)
    {
        // Netoyge des donnés envoyées
        // $email = strip_tags($_POST['email']);
        // $password = strip_tags($_POST['password']);

        $stmt = $this->_db->prepare("INSERT INTO users (email, `password`) VALUE (?, ?);");
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $password);

        // Appel de la procédure stockée
        $stmt->execute();
    }

    public function delete(User $user) //:bool

    {
        // TODO
    }

    public function update(User $user) //:bool

    {
        // TODO
    }

    public function connectUser($email, $password)
    {
        session_start();
        $_SESSION["connecter"] = FALSE;
        $request = $this->_db->query('SELECT id, email, `password` FROM users');
    }

    public function getList(): array
    {
        $userList = array();

        $request = $this->_db->query('SELECT id, email FROM users;');
        while ($ligne = $request->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($ligne);
            $userList[] = $user;
        }
        return $userList;
    }
}
 
 
?>