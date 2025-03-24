<?php
require_once "Database/Database.php";

class CardModel {
    private $db;

    public function __construct() {
        $this->db = new Database("localhost", "cafe_shop_db", "root", "");
    }
    
    public function getProductById($productId) {
        try {
            $query = "SELECT product_ID, name, price, image, description FROM products WHERE product_ID = :product_ID";
            $stmt = $this->db->query($query, ['product_ID' => $productId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching product by ID: " . $e->getMessage());
            return false;
        }
    }

    // Get or create a sale_id for the current session
    public function getOrCreateSale() {
        try {
            // Check if a sale_id exists in the session
            if (isset($_SESSION['current_sale_id'])) {
                $saleId = $_SESSION['current_sale_id'];
                // Verify the sale_id exists in the database
                $query = "SELECT sale_id FROM sales WHERE sale_id = :sale_id";
                $stmt = $this->db->query($query, ['sale_id' => $saleId]);
                if ($stmt->fetch(PDO::FETCH_ASSOC)) {
                    return $saleId;
                }
            }

            // If no sale_id exists, create a new sale
            $query = "INSERT INTO sales (sale_date, total_price) VALUES (NOW(), 0.00)";
            $this->db->query($query);
            
            // Retrieve the last inserted sale_id
            $query = "SELECT LAST_INSERT_ID() as sale_id";
            $stmt = $this->db->query($query);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $saleId = $result['sale_id'] ?? null;

            if (!$saleId) {
                throw new Exception("Failed to retrieve the last inserted sale_id");
            }

            // Store the sale_id in the session
            $_SESSION['current_sale_id'] = $saleId;
            return $saleId;
        } catch (Exception $e) {
            error_log("Error getting or creating sale: " . $e->getMessage());
            throw $e;
        }
    }

    // Check if a sale item already exists for a given sale_id and product_id
    public function checkSaleItemExists($saleId, $productId) {
        try {
            $query = "SELECT * FROM sale_items WHERE sale_id = :sale_id AND product_id = :product_id";
            $params = [
                'sale_id' => $saleId,
                'product_id' => $productId
            ];
            $stmt = $this->db->query($query, $params);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error checking sale item: " . $e->getMessage());
            throw $e;
        }
    }

    // Update the quantity of an existing sale item
    public function updateSaleItem($saleId, $productId, $quantity) {
        try {
            $query = "UPDATE sale_items SET quantity = :quantity WHERE sale_id = :sale_id AND product_id = :product_id";
            $params = [
                'quantity' => $quantity,
                'sale_id' => $saleId,
                'product_id' => $productId
            ];
            $this->db->query($query, $params);
            return true;
        } catch (Exception $e) {
            error_log("Error updating sale item: " . $e->getMessage());
            throw $e;
        }
    }

    // Insert a new sale item into the sale_items table
    public function addSaleItem($saleId, $productId, $quantity) {
        try {
            $query = "INSERT INTO sale_items (sale_id, product_id, quantity) VALUES (:sale_id, :product_id, :quantity)";
            $params = [
                'sale_id' => $saleId,
                'product_id' => $productId,
                'quantity' => $quantity
            ];
            $this->db->query($query, $params);
            return true;
        } catch (Exception $e) {
            error_log("Error adding sale item: " . $e->getMessage());
            throw $e;
        }
    }

    // Update the total price in the sales table
    public function updateSaleTotalPrice($saleId, $totalPrice) {
        try {
            $query = "UPDATE sales SET total_price = :total_price WHERE sale_id = :sale_id";
            $params = [
                'total_price' => $totalPrice,
                'sale_id' => $saleId
            ];
            $this->db->query($query, $params);
            return true;
        } catch (Exception $e) {
            error_log("Error updating sale total price: " . $e->getMessage());
            throw $e;
        }
    }

    // Get all sale items for a given sale_id to calculate the total price
    public function getSaleItems($saleId) {
        try {
            $query = "SELECT si.*, p.price FROM sale_items si JOIN products p ON si.product_id = p.product_ID WHERE si.sale_id = :sale_id";
            $stmt = $this->db->query($query, ['sale_id' => $saleId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching sale items: " . $e->getMessage());
            throw $e;
        }
    }
}
?>