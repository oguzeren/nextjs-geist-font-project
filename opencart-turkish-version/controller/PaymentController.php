<?php
require_once __DIR__ . '/../system/Database.php';
require_once __DIR__ . '/../payment/IyzicoPayment.php';
require_once __DIR__ . '/../payment/PayTRPayment.php';

class PaymentController {
    protected $db;
    protected $iyzico;
    protected $paytr;

    public function __construct() {
        $this->db = new \System\Database();
        $this->iyzico = new IyzicoPayment();
        $this->paytr = new PayTRPayment();
    }

    public function checkout() {
        // For demo, simulate order data
        $orderData = [
            'user_id' => 1,
            'total' => 100.00,
            'payment_method' => $_POST['payment_method'] ?? 'iyzico'
        ];

        if ($orderData['payment_method'] === 'iyzico') {
            $result = $this->iyzico->processPayment($orderData);
        } elseif ($orderData['payment_method'] === 'paytr') {
            $result = $this->paytr->processPayment($orderData);
        } else {
            echo "Geçersiz ödeme yöntemi.";
            return;
        }

        if ($result['status'] === 'success') {
            echo "Ödeme başarılı! İşlem ID: " . $result['transaction_id'];
            // Save payment info to database (simplified)
            $payment_method = $this->db->escape($orderData['payment_method']);
            $transaction_id = $this->db->escape($result['transaction_id']);
            $amount = $orderData['total'];
            $status = 'completed';

            $sql = "INSERT INTO payments (order_id, payment_method, transaction_id, amount, status) VALUES (1, '$payment_method', '$transaction_id', $amount, '$status')";
            $this->db->query($sql);
        } else {
            echo "Ödeme başarısız: " . $result['message'];
        }
    }
}
?>
