<?php
require_once __DIR__ . '/../core/Model.php';

/**
 * Handles database operations for photo tags.
 */
class Tag extends Model
{
    /**
     * Adds a user tag to a photo.
     *
     * @param int $photoId
     * @param int $userId
     * @return bool
     */
    public function create($photoId, $userId)
    {
        $sql = "INSERT INTO tags (photo_id, user_id) VALUES (?, ?)";

        $statement = $this->db->prepare($sql);

        return $statement->execute([$photoId, $userId]);
    }

    /**
     * Gets tagged users for a photo.
     *
     * @param int $photoId
     * @return array
     */
    public function getByPhoto($photoId)
    {
        $sql = "SELECT t.user_id, u.first_name, u.last_name
                FROM tags t
                JOIN users u ON t.user_id = u.id
                WHERE t.photo_id = ?";

        $statement = $this->db->prepare($sql);
        $statement->execute([$photoId]);

        return $statement->fetchAll();
    }

    /**
     * Removes all tags from a photo.
     *
     * @param int $photoId
     * @return bool
     */
    public function deleteByPhoto($photoId)
    {
        $sql = "DELETE FROM tags WHERE photo_id = ?";

        $statement = $this->db->prepare($sql);

        return $statement->execute([$photoId]);
    }
}