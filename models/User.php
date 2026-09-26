<?php

require_once __DIR__ . '/../core/Model.php';
/**
 * User model for database operations.
 */
class User extends Model{
      /**
     * Creates a new user.
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $email
    * @param string $password
     * * @param string|null $location
    * @param string|null $description
    * @param string|null $occupation
     * @return bool
     */
public  function create(  $firstName,$lastName,$email,$password,$location = null, $description = null,$occupation = null){
$sql= "INSERT INTO users (first_name,last_name ,email ,password	,location ,description ,occupation ) VALUES(?,?,?,?,?, ?,?)";
$statement = $this->db->prepare($sql);
$statement->execute([ $firstName,$lastName,$email,$password,$location, $description ,$occupation ]);
return true;
}
/**
 * Finds a user by email.
 *
 * @param string $email
 * @return array|false
 */
public function findByEmail($email){
$sql= "SELECT * FROM users WHERE (email=?)";
$statement = $this->db->prepare($sql);
$statement->execute([$email]);
return $statement->fetch();
}

/**
 * Finds a user by id.
 *
 * @param int $id
 * @return array|false
 */
public function findById($id){
$sql= "SELECT * FROM users WHERE (id=?)";
$statement = $this->db->prepare($sql);
$statement->execute([$id]);
return $statement->fetch();
}

/**
 * Gets the number of registered users.
 *
 * @return int
 */
public function getCount()
{
    $sql = "SELECT COUNT(*) FROM users";

    $statement = $this->db->prepare($sql);
    $statement->execute();

    return (int) $statement->fetchColumn();
}

/**
 * Gets all users.
 *
 * @return array
 */
public function getAll()
{
    $sql = "SELECT id, first_name, last_name FROM users";

    $statement = $this->db->prepare($sql);
    $statement->execute();

    return $statement->fetchAll();
}
}
	