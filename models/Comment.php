<?php

require_once __DIR__ . '/../core/Model.php';

/**
 * Handles database operations for comments.
 */
class Comment extends Model
{
    /**
     * Saves a new comment for a photo.
     *
     * @param int $photoId Photo ID.
     * @param int $userId Logged-in user ID.
     * @param string $commentText Comment text.
     * @return bool
     */
    public function create(
        $photoId,
        $userId,
        $commentText
    ) {
        $sql = 'INSERT INTO comments
                (photo_id, user_id, comment)
                VALUES (?, ?, ?)';

        $statement = $this->db->prepare($sql);

        return $statement->execute([
            $photoId,
            $userId,
            $commentText
        ]);
    }

    /**
     * Gets all comments for one photo with the author's name.
     *
     * @param int $photoId Photo ID.
     * @return array
     */
    public function getByPhoto($photoId)
    {
        $sql = 'SELECT c.*, u.first_name
                FROM comments c
                JOIN users u ON c.user_id = u.id
                WHERE c.photo_id = ?
                ORDER BY c.date_time DESC';

        $statement = $this->db->prepare($sql);

        $statement->execute([$photoId]);

        return $statement->fetchAll();
    }

    /**
     * Deletes a comment by its ID.
     *
     * @param int $id Comment ID.
     * @return bool
     */
    public function delete($id)
    {
        $sql = 'DELETE FROM comments WHERE id = ?';

        $statement = $this->db->prepare($sql);

        return $statement->execute([$id]);
    }

    /**
     * Gets the total number of comments.
     *
     * @return int
     */
    public function getCount()
    {
        $sql = 'SELECT COUNT(*) FROM comments';

        $statement = $this->db->prepare($sql);

        $statement->execute();

        return (int) $statement->fetchColumn();
    }
}