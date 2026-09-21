<?php
/**
 * Handles All database operations for comments.
 */
require_once __DIR__ . '/../core/Model.php';


class Comment extends Model{
  	 /**
     * Create a new comment.
     * 
     * @param int    $photo_id Photo ID
     * @param int    $user_id  User ID
     * @param string $comment  Comment text
     * @return bool
     */

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
 /**
     * Delete a comment by ID.
     * 
     * @param int $id
     * @return bool
     */
public function delete($id){
    $sql= "DELETE FROM comments WHERE (id=?)";
$statement = $this->db->prepare($sql);
return $statement->execute([$id]);
 
}
}
