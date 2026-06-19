<?php
    require_once '../app/core/DB.php';
    class sinhvienModel {
        private $conn;
        public function __construct() {
            $this -> conn = ConnectDB::Connect();
        }

        public function getAllSinhvien() {
            $query = "SELECT * FROM sinhvien";
            $stmt = $this -> conn -> prepare($query);
            $stmt -> execute();
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }
        public function create($HoTen, $GioiTinh, $MSSV, $malop) {
            $query = "INSERT INTO sinhvien (HoTen, GioiTinh, MSSV, malop) VALUES (:HoTen, :GioiTinh, :MSSV, :malop)";
            $stmt = $this -> conn -> prepare($query);
            $stmt -> bindParam(':HoTen', $HoTen);
            $stmt -> bindParam(':GioiTinh', $GioiTinh);
            $stmt -> bindParam(':MSSV', $MSSV);
            $stmt -> bindParam(':malop', $malop);
            try {
                return $stmt -> execute();
            } catch (PDOException $e) {
                return false;
            }
        }
        public function paging($limit = 10, $offset = 0, $search = '', $malop = '', $sort = '') {
            $conditions = [];
            $params = [];
            
            if (!empty($search)) {
                $conditions[] = "(sinhvien.MSSV LIKE :search OR sinhvien.HoTen LIKE :search)";
                $params[':search'] = "%$search%";
            }
            
            if (!empty($malop)) {
                $conditions[] = "sinhvien.malop = :malop";
                $params[':malop'] = $malop;
            }
            
            $whereClause = "";
            if (count($conditions) > 0) {
                $whereClause = "WHERE " . implode(" AND ", $conditions);
            }
            
            // Xử lý sắp xếp
            $orderBy = "sinhvien.id DESC"; // Sắp xếp mặc định
            if ($sort === 'MSSV_asc') {
                $orderBy = "sinhvien.MSSV ASC";
            } elseif ($sort === 'MSSV_desc') {
                $orderBy = "sinhvien.MSSV DESC";
            } elseif ($sort === 'HoTen_asc') {
                $orderBy = "sinhvien.HoTen ASC";
            } elseif ($sort === 'HoTen_desc') {
                $orderBy = "sinhvien.HoTen DESC";
            }
            
            // Câu lệnh truy vấn chính
            $query = "SELECT sinhvien.*, lophoc.tenlop AS TenLop 
                      FROM sinhvien 
                      LEFT JOIN lophoc ON sinhvien.malop = lophoc.malop 
                      $whereClause 
                      ORDER BY $orderBy 
                      LIMIT :limit OFFSET :offset";
                      
            $stmt = $this->conn->prepare($query);
            
            // Bind các tham số điều kiện
            if (!empty($search)) {
                $stmt->bindParam(':search', $params[':search']);
            }
            if (!empty($malop)) {
                $stmt->bindParam(':malop', $params[':malop']);
            }
            
            // Bind limit và offset
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Đếm tổng số bản ghi khớp bộ lọc
            $countQuery = "SELECT COUNT(*) FROM sinhvien $whereClause";
            $countStmt = $this->conn->prepare($countQuery);
            if (!empty($search)) {
                $countStmt->bindParam(':search', $params[':search']);
            }
            if (!empty($malop)) {
                $countStmt->bindParam(':malop', $params[':malop']);
            }
            $countStmt->execute();
            $totalRecord = (int)$countStmt->fetchColumn();
            
            $totalPage = ceil($totalRecord / $limit);
            
            return [
                'sinhvien' => $result, 
                'totalPage' => (int)$totalPage,
                'totalRecord' => $totalRecord
            ];
        }

        public function getSinhvienById($id) {
            $query = "SELECT * FROM sinhvien WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function update($id, $HoTen, $GioiTinh, $MSSV, $malop) {
            $query = "UPDATE sinhvien SET HoTen = :HoTen, GioiTinh = :GioiTinh, MSSV = :MSSV, malop = :malop WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':HoTen', $HoTen);
            $stmt->bindParam(':GioiTinh', $GioiTinh);
            $stmt->bindParam(':MSSV', $MSSV);
            $stmt->bindParam(':malop', $malop);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            try {
                return $stmt->execute();
            } catch (PDOException $e) {
                return false;
            }
        }

        public function delete($id) {
            $query = "DELETE FROM sinhvien WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        }
    }
    
?>