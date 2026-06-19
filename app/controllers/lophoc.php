<?php
require_once '../app/core/Controller.php';

class lophoc extends Controller {
    
    public function index($limit = 5, $offset = 0) {
        $search = $_GET['search'] ?? '';
        
        $lophocModel = $this->model('lophocModel');
        $result = $lophocModel->paging((int)$limit, (int)$offset, $search);
        
        $lophoc = $result['lophoc'];
        $totalPage = $result['totalPage'];
        
        $this->view('lophoc/index', [
            'lophoc' => $lophoc,
            'totalPage' => $totalPage,
            'limit' => $limit,
            'offset' => $offset,
            'search' => $search
        ], 'Danh sách lớp học');
    }

    public function create() {
        $this->view('lophoc/create', [], 'Thêm lớp học mới');
    }

    public function store() {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $malop = trim($_POST['malop'] ?? '');
            $tenlop = trim($_POST['tenlop'] ?? '');
            $ghichu = trim($_POST['ghichu'] ?? '');

            if (empty($malop) || empty($tenlop)) {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin bắt buộc!'); window.history.back();</script>";
                return;
            }

            $lophocModel = $this->model('lophocModel');
            
            // Check if class code exists
            if ($lophocModel->checkMalopExists($malop)) {
                echo "<script>alert('Lỗi: Mã lớp học đã tồn tại!'); window.history.back();</script>";
                return;
            }

            $result = $lophocModel->create($malop, $tenlop, $ghichu);
            if ($result) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['msg'] = 'created';
                header('Location: /lophoc/index');
                exit();
            } else {
                echo "<script>alert('Lỗi: Thêm lớp học thất bại!'); window.history.back();</script>";
            }
        }
    }

    public function edit($id) {
        $lophocModel = $this->model('lophocModel');
        $class = $lophocModel->getLophocById($id);
        if ($class) {
            $this->view('lophoc/edit', ['class' => $class], 'Sửa thông tin lớp học');
        } else {
            echo "Không tìm thấy lớp học!";
        }
    }

    public function update($id) {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $malop = trim($_POST['malop'] ?? '');
            $tenlop = trim($_POST['tenlop'] ?? '');
            $ghichu = trim($_POST['ghichu'] ?? '');

            if (empty($malop) || empty($tenlop)) {
                echo "<script>alert('Vui lòng điền đầy đủ thông tin bắt buộc!'); window.history.back();</script>";
                return;
            }

            $lophocModel = $this->model('lophocModel');
            
            // Check if class code exists (excluding current id)
            if ($lophocModel->checkMalopExists($malop, $id)) {
                echo "<script>alert('Lỗi: Mã lớp học đã tồn tại ở lớp khác!'); window.history.back();</script>";
                return;
            }

            $result = $lophocModel->update($id, $malop, $tenlop, $ghichu);
            if ($result) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['msg'] = 'updated';
                header('Location: /lophoc/index');
                exit();
            } else {
                echo "<script>alert('Lỗi: Cập nhật lớp học thất bại!'); window.history.back();</script>";
            }
        }
    }

    public function delete($id) {
        $lophocModel = $this->model('lophocModel');
        
        // Optionally, check if any student belongs to this class before deleting
        // If they do, they will have their malop set to NULL due to our design, which is safe.
        
        $result = $lophocModel->delete($id);
        if ($result) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['msg'] = 'deleted';
            header('Location: /lophoc/index');
            exit();
        } else {
            echo "Lỗi khi xóa lớp học!";
        }
    }
}
?>
