<?php
require_once __DIR__ . '/../system/Database.php';

class IyzicoPayment {
    protected $db;

    public function __construct() {
        $this->db = new \System\Database();
    }

    public function processPayment($orderData) {
        // Simulate payment processing with Iyzico
        // In real implementation, integrate Iyzico API here

        // For demo, assume payment is always successful
        return [
            'status' => 'success',
            'transaction_id' => uniqid('iyzico_'),
            'message' => 'Ödeme başarılı.'
        ];
    }
}
?>
