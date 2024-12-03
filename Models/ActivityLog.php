<?php
require_once(__DIR__ . '/../Core/Database.php');

class ActivityLog extends Database {

        // Method to add a log entry
    public function addLog($userEmail, $actionType, $recordId, $searchKeywords = null) {
        try {
            // Prepare the SQL query to insert a new log entry
            $stmt = $this->connect()->prepare("INSERT INTO activity_logs (user_email, action_type, record_id, search_keywords)
                                            VALUES (?, ?, ?, ?)");
            $stmt->execute([$userEmail, $actionType, $recordId, $searchKeywords]);

        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Get all activity logs
    public function getActivityLogs() {
        try {
            // Assuming 'action_timestamp' is the column storing the timestamp
            $stmt = $this->connect()->prepare("SELECT al.*, u.email AS user_email 
                                               FROM activity_logs al 
                                               JOIN users u ON al.user_email = u.email 
                                               ORDER BY al.action_timestamp DESC"); // Order by timestamp in descending order
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    
}
?>
