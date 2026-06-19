<?php
    require_once '../app/core/DB.php';
    class lophocModel {
        private $conn;
        public function __construct() {
            $this->conn = ConnectDB::connect();
        }

        public function getAllLophoc() {
            $query = "SELECT * FROM lophoc ORDER BY malop ASC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function create($malop, $tenlop, $ghichu) {
            $query = "INSERT INTO lophoc (malop, tenlop, ghichu) VALUES (:malop, :tenlop, :ghichu)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':malop', $malop);
            $stmt->bindParam(':tenlop', $tenlop);
            $stmt->bindParam(':ghichu', $ghichu);
            try {
                return $stmt->execute();
            } catch (PDOException $e) {
                return false;
            }
        }

        public function paging($limit = 5, $offset = 0, $search = '') {
            $searchPattern = "%$search%";
            $query = "SELECT * FROM lophoc WHERE malop LIKE :search OR tenlop LIKE :search LIMIT :limit OFFSET :offset";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':search', $searchPattern);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Tính tổng số bản ghi có bộ lọc
            $countQuery = "SELECT COUNT(*) FROM lophoc WHERE malop LIKE :search OR tenlop LIKE :search";
            $countStmt = $this->conn->prepare($countQuery);
            $countStmt->bindParam(':search', $searchPattern);
            $countStmt->execute();
            $totalRecord = $countStmt->fetchColumn();

            $totalPage = ceil($totalRecord / $limit);
            
            return ['lophoc' => $result, 'totalPage' => (int) $totalPage];
        }

        public function getLophocById($id) {
            $query = "SELECT * FROM lophoc WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function update($id, $malop, $tenlop, $ghichu) {
            $class = $this->getLophocById($id);
            if ($class) {
                $oldMalop = $class['malop'];
                
                $this->conn->beginTransaction();
                try {
                    // Cập nhật lớp học
                    $query = "UPDATE lophoc SET malop = :malop, tenlop = :tenlop, ghichu = :ghichu WHERE id = :id";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':malop', $malop);
                    $stmt->bindParam(':tenlop', $tenlop);
                    $stmt->bindParam(':ghichu', $ghichu);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    
                    // Cập nhật mã lớp của sinh viên nếu mã lớp thay đổi
                    if ($oldMalop !== $malop) {
                        $updateQuery = "UPDATE sinhvien SET malop = :newMalop WHERE malop = :oldMalop";
                        $updateStmt = $this->conn->prepare($updateQuery);
                        $updateStmt->bindParam(':newMalop', $malop);
                        $updateStmt->bindParam(':oldMalop', $oldMalop);
                        $updateStmt->execute();
                    }
                    
                    $this->conn->commit();
                    return true;
                } catch (PDOException $e) {
                    $this->conn->rollBack();
                    return false;
                }
            }
            return false;
        }

        public function delete($id) {
            $class = $this->getLophocById($id);
            if ($class) {
                $malop = $class['malop'];
                
                $this->conn->beginTransaction();
                try {
                    // Cập nhật mã lớp của sinh viên thuộc lớp này thành NULL
                    $updateQuery = "UPDATE sinhvien SET malop = NULL WHERE malop = :malop";
                    $updateStmt = $this->conn->prepare($updateQuery);
                    $updateStmt->bindParam(':malop', $malop);
                    $updateStmt->execute();
                    
                    // Xóa lớp học
                    $query = "DELETE FROM lophoc WHERE id = :id";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();
                    
                    $this->conn->commit();
                    return true;
                } catch (PDOException $e) {
                    $this->conn->rollBack();
                    return false;
                }
            }
            return false;
        }

        public function checkMalopExists($malop, $excludeId = null) {
            if ($excludeId) {
                $query = "SELECT COUNT(*) FROM lophoc WHERE malop = :malop AND id != :excludeId";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':excludeId', $excludeId, PDO::PARAM_INT);
            } else {
                $query = "SELECT COUNT(*) FROM lophoc WHERE malop = :malop";
                $stmt = $this->conn->prepare($query);
            }
            $stmt->bindParam(':malop', $malop);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        }
    }
?>
