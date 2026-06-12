
<?php
require_once '../app/core/Controller.php';
class sinhvien extends Controller {
    public function index($limit = 5, $offset = 0, $search = '') {
        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel -> paging($limit, $offset, $search);
        $sinhvien = $result['sinhvien'];
        $totalPage = $result['totalPage'];
        //trả về view 
        //require_once '../app/views/sinhvien/index.php';
        $this -> view('sinhvien/index', ['sinhvien' => $sinhvien, 'totalPage' => $totalPage], 'Danh sách sinh viên');
    }

    public function create() {
        //trả về view 
        require_once '../app/views/sinhvien/create.php';
    }
    public function store() {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $HoTen = $_POST['HoTen'] ?? '';
            $GioiTinh = $_POST['GioiTinh'] ?? '';
            $MSSV = $_POST['MSSV'] ?? '';

            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->create($HoTen, $GioiTinh, $MSSV);
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
        if ($sinhvien) {
            $this->view('sinhvien/edit', ['sinhvien' => $sinhvien], 'Sửa sinh viên');
        } else {
            echo "Không tìm thấy sinh viên!";
        }
    }

    public function update($id) {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $HoTen = $_POST['HoTen'] ?? '';
            $GioiTinh = $_POST['GioiTinh'] ?? '';
            $MSSV = $_POST['MSSV'] ?? '';

            $sinhvienModel = $this->model('sinhvienModel');
            $result = $sinhvienModel->update($id, $HoTen, $GioiTinh, $MSSV);
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