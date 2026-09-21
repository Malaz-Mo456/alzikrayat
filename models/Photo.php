<?php

require_once __DIR__ . '/../core/Model.php';

/**
 * Photo model for database operations.
 */
class Photo extends Model{
      /**
     * Adds a new photo record to the database.
     *
     * @param int $user_id
     * @param string $file_name
     * @param string $title
     * @param string|null $description
     * @return bool
     */
public  function create( $user_id,$file_name ,$title ,$description =null){
$sql = "INSERT INTO photos (user_id, file_name, title, description) VALUES (?, ?, ?, ?)"; 
$statement = $this->db->prepare($sql);
$statement->execute([ $user_id,$file_name ,$title ,$description ]);
return true;

}
  /**
     * Gets all photos from the database.
     *
     * @return array
     */
  public function getAll() {
        $sql = "SELECT p.*, u.first_name 
                FROM photos p 
                JOIN users u ON p.user_id = u.id 
                ORDER BY p.date_time DESC";
        $statement = $this->db->query($sql);
        return $statement->fetchAll();
    }
/**
     * Finds one photo by its ID.
     *
     * @param int $id
     * @return array|false
     */
public function findById($id){
  $sql = "SELECT p.*, u.first_name 
                FROM photos p 
                JOIN users u ON p.user_id = u.id 
                WHERE p.id = ?";
$statement = $this->db->prepare($sql);
$statement->execute([$id]);
return $statement->fetch();
}
   /**
     * Gets all photos uploaded by a specific user.
     *
     * @param int $userId
     * @return array
     */

public  function getByUser($userId){
    $sql= "SELECT * FROM photos WHERE user_id=? ORDER BY date_time DESC";
$statement = $this->db->prepare($sql);
$statement->execute([$userId]);
return $statement->fetchAll();
}
  /**
     * Deletes a photo record from the database.
     *
     * @param int $id
     * @return bool
     */
public function delete($id){
$sql= "DELETE FROM photos WHERE (id=?)";
$statement = $this->db->prepare($sql);
return $statement->execute([$id]);
 

}
}