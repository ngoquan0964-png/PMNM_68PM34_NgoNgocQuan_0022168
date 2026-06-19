
<?php
require_once '../app/core/Controller.php';
class sinhvien extends Controller {
    public function index($limit = 10, $offset = 0) {
        $limit = (int)$limit;
        $offset = (int)$offset;
        
        $search = $_GET['search'] ?? '';
        $malop = $_GET['malop'] ?? '';
        $sort = $_GET['sort'] ?? 'MSSV_asc'; // Sắp xếp mặc định theo MSSV tăng dần
        
        $sinhvienModel = $this->model('sinhvienModel');
        $lophocModel = $this->model('lophocModel');
        
        $result = $sinhvienModel->paging($limit, $offset, $search, $malop, $sort);
        $lophoc = $lophocModel->getAllLophoc();
        
        $sinhvien = $result['sinhvien'];
        $totalPage = $result['totalPage'];
        $totalRecord = $result['totalRecord'];
        
        $this->view('sinhvien/index', [
            'sinhvien' => $sinhvien,
            'lophoc' => $lophoc,
            'totalPage' => $totalPage,
            'totalRecord' => $totalRecord,
            'limit' => $limit,
            'offset' => $offset,
            'search' => $search,
            'malop' => $malop,
            'sort' => $sort
        ], 'Danh sách sinh viên');
    }

    public function create() {
        $lophocModel = $this->model('lophocModel');
        $lophoc = $lophocModel->getAllLophoc();
        $this->view('sinhvien/create', ['lophoc' => $lophoc], 'Thêm sinh viên mới');
    }
    public function store() {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $HoTen = $_POST['HoTen'] ?? '';
            $GioiTinh = $_POST['GioiTinh'] ?? '';
            $MSSV = $_POST['MSSV'] ?? '';
            $malop = $_POST['malop'] ?? '';

            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->create($HoTen, $GioiTinh, $MSSV, $malop);
            if ($result) {
                header('Location: /sinhvien/index');
                exit();
            } else {
                echo "<script>alert('Lỗi: Thêm sinh viên thất bại! Có thể MSSV đã tồn tại.'); window.history.back();</script>";
            }
        }
    }

    public function edit($id) {
        $sinhvienModel = $this->model('sinhvienModel');
        $sinhvien = $sinhvienModel->getSinhvienById($id);
        $lophocModel = $this->model('lophocModel');
        $lophoc = $lophocModel->getAllLophoc();
        if ($sinhvien) {
            $this->view('sinhvien/edit', ['sinhvien' => $sinhvien, 'lophoc' => $lophoc], 'Sửa sinh viên');
        } else {
            echo "Không tìm thấy sinh viên!";
        }
    }

    public function update($id) {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $HoTen = $_POST['HoTen'] ?? '';
            $GioiTinh = $_POST['GioiTinh'] ?? '';
            $MSSV = $_POST['MSSV'] ?? '';
            $malop = $_POST['malop'] ?? '';

            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->update($id, $HoTen, $GioiTinh, $MSSV, $malop);
            if ($result) {
                header('Location: /sinhvien/index');
                exit();
            } else {
                echo "<script>alert('Lỗi: Cập nhật thất bại! Có thể MSSV đã tồn tại.'); window.history.back();</script>";
            }
        }
    }

    public function delete($id) {
        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->delete($id);
        if ($result) {
            header('Location: /sinhvien/index');
            exit();
        } else {
            echo "Lỗi khi xóa sinh viên!";
        }
    }
}