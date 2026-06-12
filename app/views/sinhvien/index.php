<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Sinh Viên</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #e0e0e0;
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 4px;
            transition: background 0.3s;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        .btn:hover { background-color: #0056b3; }
        .btn-success { background-color: #28a745; margin-bottom: 15px; }
        .btn-success:hover { background-color: #218838; }
        .btn-warning { background-color: #ffc107; color: #212529; }
        .btn-warning:hover { background-color: #e0a800; }
        .btn-danger { background-color: #dc3545; }
        .btn-danger:hover { background-color: #c82333; }
        .action-btns {
            display: flex;
            gap: 8px;
        }
        .pagination {
            display: flex;
            gap: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Danh sách sinh viên</h1>
        
        <a href="/sinhvien/create" class="btn btn-success">+ Thêm sinh viên mới</a>

        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>MSSV</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($sinhvien as $index => $sv): ?>
                    <tr>
                        <td><?php echo $index +1; ?></td>
                        <td><?php echo htmlspecialchars($sv['MSSV']); ?></td>
                        <td><?php echo htmlspecialchars($sv['HoTen']); ?></td>
                        <td><?php echo htmlspecialchars($sv['GioiTinh']); ?></td>
                        <td> 
                            <div class="action-btns">
                                <a href="/sinhvien/edit/<?php echo $sv['id']; ?>" class="btn btn-warning">Sửa</a>
                                <a href="/sinhvien/delete/<?php echo $sv['id']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?');">Xoá</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="pagination">
            <?php
                $pageSize = 5;
                for($i =1; $i <= $totalPage; $i++){
                    $offset = ($i - 1) * $pageSize;
                    echo "<a class='btn' href='/sinhvien/index/$pageSize/$offset'>Trang $i</a>";
                }
            ?>
        </div>
    </div>
</body>
</html>