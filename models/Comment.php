<?php

require_once __DIR__ . '/../core/Model.php';

/**
 * Handles database operations for comments.
 */
class Comment extends Model{
  	

    public  function create($photo_id,$user_id,$comment){
$sql = "INSERT INTO comments (photo_id,user_id,comment) VALUES (?, ?, ?)"; 
$statement = $this->db->prepare($sql);
$statement->execute([$photo_id,$user_id,$comment]);
return true;

}

  /**
     * Gets all comments for specific photo with author name.
     *
     * @param int $photo_id
     * @return array
     */

public  function getByPhoto($photo_id){
   $sql = "SELECT c.*, u.first_name 
                FROM comments c 
                JOIN users u ON c.user_id = u.id 
                WHERE c.photo_id = ? 
                ORDER BY c.date_time DESC";
$statement = $this->db->prepare($sql);
$statement->execute([$photo_id]);
return $statement->fetchAll();
}
public function delete($id){
    $sql= "DELETE FROM comments WHERE (id=?)";
$statement = $this->db->prepare($sql);
return $statement->execute([$id]);
 
}
}
