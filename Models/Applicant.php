<?php
require_once(__DIR__ . '/../Core/Database.php');
require_once(__DIR__ . '/../Models/ActivityLog.php');  // Include the ActivityLog class

class Applicant extends Database {

    // Fetch applicant by ID
    public function getApplicantById($id) {
        $stmt = $this->connect()->prepare("SELECT * FROM applicants WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fetch user email by user ID
    private function getUserEmailById($userId) {
        $stmt = $this->connect()->prepare("SELECT email FROM users WHERE id = :userId");
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user['email'] ?? null;
    }

    // Get all applicants and log the search action
    public function getAllApplicants($userId) {
        try {
            $stmt = $this->connect()->prepare("SELECT * FROM applicants");
            $stmt->execute();
            $applicants = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Get the user email
            $userEmail = $this->getUserEmailById($userId);
            
            return $applicants;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Delete an applicant and log the action
    public function deleteApplicant($id, $userId) {
        try {
            $stmt = $this->connect()->prepare("DELETE FROM applicants WHERE id = ?");
            $stmt->execute([$id]);

            // Get the user email
            $userEmail = $this->getUserEmailById($userId);

            // Log the delete action
            $activityLogObj = new ActivityLog();
            $activityLogObj->addLog($userEmail, 'DELETE', $id);  

        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function createApplicant($username, $first_name, $last_name, $birth_date, $gender, $email_address, $phone_number, $applied_position, $start_date, $address, $nationality, $userId) {
        try {
            // Prepare the SQL query for inserting the new applicant
            $stmt = $this->connect()->prepare("INSERT INTO applicants (username, first_name, last_name, birth_date, gender, email_address, phone_number, applied_position, start_date, address, nationality)
                                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
            // Execute the query
            $stmt->execute([$username, $first_name, $last_name, $birth_date, $gender, $email_address, $phone_number, $applied_position, $start_date, $address, $nationality]);
    
            // Use the unique data (username or email) to retrieve the newly inserted applicant's ID
            $stmt = $this->connect()->prepare("SELECT id FROM applicants WHERE username = ? AND email_address = ?");
            $stmt->execute([$username, $email_address]);
    
            // Fetch the inserted applicant ID
            $applicant = $stmt->fetch(PDO::FETCH_ASSOC);
            $lastInsertId = $applicant['id'];
    
            // Ensure the ID is retrieved successfully
            if (!$lastInsertId) {
                throw new Exception("Failed to retrieve the last inserted applicant ID.");
            }
    
            // Get the user email based on the userId
            $userEmail = $this->getUserEmailById($userId);
    
            // Log the action (INSERT)
            $activityLogObj = new ActivityLog();
            $activityLogObj->addLog($userEmail, 'INSERT', $lastInsertId);  // Log the inserted applicant ID
    
            return $lastInsertId;  // Optionally return the inserted ID for further use
    
        } catch (PDOException $e) {
            return "Database Error: " . $e->getMessage();
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Update an applicant and log the action
    public function updateApplicant($id, $username, $first_name, $last_name, $email_address, $phone_number, $applied_position, $start_date, $address, $nationality, $userId) {
        try {
            $stmt = $this->connect()->prepare("UPDATE applicants 
                                               SET username = ?, first_name = ?, last_name = ?, email_address = ?, phone_number = ?, applied_position = ?, start_date = ?, address = ?, nationality = ?
                                               WHERE id = ?");
            $stmt->execute([$username, $first_name, $last_name, $email_address, $phone_number, $applied_position, $start_date, $address, $nationality, $id]);

            // Get the user email
            $userEmail = $this->getUserEmailById($userId);

            // Log the update action
            $activityLogObj = new ActivityLog();
            $activityLogObj->addLog($userEmail, 'UPDATE', $id);  

        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Search applicants and log the search action
    public function searchApplicants($searchTerm, $userId) {
        try {
            $searchTerm = "%" . $searchTerm . "%";
            $stmt = $this->connect()->prepare("SELECT * FROM applicants WHERE username LIKE ? OR first_name LIKE ? OR last_name LIKE ?");
            $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Get the user email
            $userEmail = $this->getUserEmailById($userId);

            // Log the search action
            $activityLogObj = new ActivityLog();
            $activityLogObj->addLog($userEmail, 'SEARCH', null, $searchTerm);

            return $results;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>
