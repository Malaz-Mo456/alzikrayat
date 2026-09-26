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
/**
 * Creates a new photo.
 *
 * @param int $user_id
 * @param string $file_name
 * @param string $title
 * @param string|null $description
 * @return int
 */
public function create($user_id, $file_name, $title, $description = null)
{
    $sql = "INSERT INTO photos (user_id, file_name, title, description)
            VALUES (?, ?, ?, ?)";

    $statement = $this->db->prepare($sql);
    $statement->execute([
        $user_id,
        $file_name,
        $title,
        $description
    ]);

    return (int) $this->db->lastInsertId();
}
  /**
     * Gets all photos from the database.
     *
     * @return array
     */
  public function getAll() {
        $sql = "SELECT p.*, u.first_name ,u.last_name
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
  $sql = "SELECT p.*, u.first_name ,u.last_name
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
/**
 * Gets the number of photos.
 *
 * @return int
 */
public function getCount()
{
    $sql = "SELECT COUNT(*) FROM photos";

    $statement = $this->db->prepare($sql);
    $statement->execute();

    return (int) $statement->fetchColumn();
}
/**
 * Gets the latest photos with the uploader name.
 *
 * @param int $limit Number of photos to return.
 * @return array
 */
public function getRecent($limit = 6)
{
    $sql = "SELECT 
                p.*,
                u.first_name,
                u.last_name
            FROM photos p
            JOIN users u ON p.user_id = u.id
            ORDER BY p.date_time DESC
            LIMIT ?";

    $statement = $this->db->prepare($sql);
    $statement->bindValue(1, (int) $limit, PDO::PARAM_INT);
    $statement->execute();

    return $statement->fetchAll();
}
}