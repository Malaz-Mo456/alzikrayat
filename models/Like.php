<?php
// like model - toggle photo likes
require_once __DIR__ . '/../core/Model.php';

class Like extends Model {
    
    // toggle like (add if not exists, remove if exists)
    public function toggle($userId, $photoId) {
        $sql = "SELECT 1 FROM likes WHERE user_id = ? AND photo_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId, $photoId]);
        
        if ($stmt->fetch()) {
            // already liked → unlike
            $sql = "DELETE FROM likes WHERE user_id = ? AND photo_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$userId, $photoId]);
            return 'unliked';
        } else {
            // not liked → like
            $sql = "INSERT INTO likes (user_id, photo_id) VALUES (?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$userId, $photoId]);
            return 'liked';
        }
    }
    
    // count likes for a photo
    public function countByPhoto($photoId) {
        $sql = "SELECT COUNT(*) FROM likes WHERE photo_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$photoId]);
        return (int) $stmt->fetchColumn();
    }
    
    // check if user already liked
    public function isLikedBy($userId, $photoId) {
        if (!$userId) return false;
        
        $sql = "SELECT 1 FROM likes WHERE user_id = ? AND photo_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId, $photoId]);
        return (bool) $stmt->fetch();
    }
}