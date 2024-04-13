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
}
