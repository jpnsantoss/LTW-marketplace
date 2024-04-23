<?php

namespace Models;

use \Models\Database;

class ImageModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function createImage($image, $item_id)
    {
        $this->db->query("INSERT INTO images (`url`, `item_id`) VALUES (:url, :item_id)");
        $this->db->bind(':url', $image);
        $this->db->bind(':item_id', $item_id);
        if ($this->db->execute()) {
            return true;
        }
        return false;
    }

    public function findImages($id)
    {
        $this->db->query("SELECT * FROM images WHERE item_id = :id");
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }

    public function deleteImage($id)
    {
        $this->db->query("SELECT * FROM images WHERE id = :id");
        $this->db->bind(':id', $id);
        $image = $this->db->single();

        if ($image) {
            $image = get_object_vars($image);
            unlink(URLROOT . '/images/uploads' . $image['url']);
            $this->db->query('DELETE FROM images WHERE id = :id');
            $this->db->bind(':id', $image['id']);
            if ($this->db->execute()) return true;
            return false;
        }
    }
}
