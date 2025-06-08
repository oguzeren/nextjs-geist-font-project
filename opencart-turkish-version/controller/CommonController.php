<?php
require_once __DIR__ . '/../system/Database.php';

class CommonController {
    protected $db;

    public function __construct() {
        $this->db = new \System\Database();
    }

    public function home() {
        echo "<h1>Hoşgeldiniz - Türkçe OpenCart</h1>";
        echo "<p>Bu, Türkçe versiyon OpenCart ana sayfasıdır.</p>";
    }
}
?>
