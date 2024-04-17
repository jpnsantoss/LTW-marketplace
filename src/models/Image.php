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
}
