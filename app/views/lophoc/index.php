<style>
    .card {
        background-color: var(--card-bg);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        padding: 30px;
        border: 1px solid var(--border-color);
        margin-top: 10px;
    }
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    h1 {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-color);
        letter-spacing: -0.5px;
    }
    .search-container {
        margin-bottom: 25px;
        background-color: var(--bg-color);
        padding: 20px;
        border-radius: var(--radius-md);
        border: 1px solid var(--border-color);
    }
    .search-form {
        display: flex;
        gap: 12px;
        align-items: center;
    }
    .search-form input[type="text"] {
        flex: 1;
        padding: 10px 16px;
        border: 1px solid var(--border-color);
        border-radius: var(--radius-sm);
        font-size: 14px;
        font-family: inherit;
        background-color: var(--card-bg);
        transition: var(--transition);
    }
    .search-form input[type="text"]:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
    }
    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
    }
    th, td {
        padding: 14px 20px;
        text-align: left;
        font-size: 14px;
        border-bottom: 1px solid var(--border-color);
    }
    th {
        background-color: var(--bg-color);
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.5px;
    }
    tr {
        transition: var(--transition);
    }
    tr:hover {
        background-color: rgba(241, 245, 249, 0.5);
    }
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 9px 18px;
        text-decoration: none;
        color: white;
        border-radius: var(--radius-sm);
        transition: var(--transition);
        border: none;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        gap: 6px;
    }
    .btn-primary {
        background-color: var(--primary-color);
    }
    .btn-primary:hover {
        background-color: var(--primary-hover);
        transform: translateY(-1px);
    }
    .btn-secondary {
        background-color: var(--secondary-color);
    }
    .btn-secondary:hover {
        background-color: var(--secondary-hover);
        transform: translateY(-1px);
    }
    .btn-success {
        background-color: var(--success-color);
    }
    .btn-success:hover {
        background-color: var(--success-hover);
        transform: translateY(-1px);
    }
    .btn-warning {
        background-color: var(--warning-color);
        color: white;
    }
    .btn-warning:hover {
        background-color: var(--warning-hover);
        transform: translateY(-1px);
    }
    .btn-danger {
        background-color: var(--danger-color);
    }
    .btn-danger:hover {
        background-color: var(--danger-hover);
        transform: translateY(-1px);
    }
    .badge-class {
        background-color: rgba(79, 70, 229, 0.1);
        color: var(--primary-color);
        padding: 4px 10px;
        border-radius: var(--radius-sm);
        font-weight: 600;
        font-size: 13px;
        display: inline-block;
    }
    .action-btns {
        display: flex;
        gap: 8px;
    }
    .action-btns .btn {
        padding: 6px 12px;
        font-size: 13px;
    }
    .pagination {
        display: flex;
        gap: 6px;
        margin-top: 25px;
    }
    .pagination a.btn {
        background-color: var(--card-bg);
        color: var(--text-color);
        border: 1px solid var(--border-color);
    }
    .pagination a.btn:hover {
        background-color: var(--bg-color);
        border-color: var(--primary-color);
        color: var(--primary-color);
    }
    .pagination .btn-active {
        background-color: var(--primary-color) !important;
        color: white !important;
        border-color: var(--primary-color) !important;
        cursor: default;
    }
    
    /* Alert styles */
    .alert {
        padding: 16px 20px;
        border-radius: var(--radius-md);
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
        font-weight: 500;
        box-shadow: var(--shadow-sm);
        animation: fadeIn 0.3s ease-out;
    }
    .alert-success {
        background-color: rgba(5, 150, 105, 0.1);
        color: var(--success-hover);
        border: 1px solid rgba(5, 150, 105, 0.2);
    }
    .alert .close-btn {
        cursor: pointer;
        font-weight: bold;
        font-size: 18px;
        line-height: 1;
        opacity: 0.7;
        transition: var(--transition);
    }
    .alert .close-btn:hover {
        opacity: 1;
    }
</style>

<!-- Flash Alert Message -->
<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['msg']) || isset($_GET['msg'])): 
    $msg = $_SESSION['msg'] ?? $_GET['msg'] ?? '';
    unset($_SESSION['msg']); // Clear session flash message
    if ($msg === 'created'): ?>
        <div class="alert alert-success">
            <span>✨ Thêm lớp học mới thành công!</span>
            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
    <?php elseif ($msg === 'updated'): ?>
        <div class="alert alert-success">
            <span>💾 Cập nhật thông tin lớp học thành công!</span>
            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
    <?php elseif ($msg === 'deleted'): ?>
        <div class="alert alert-success">
            <span>🗑️ Đã xóa lớp học thành công!</span>
            <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
    <?php endif; ?>
<?php endif; ?>

<div class="card">
    <div class="header-section">
        <h1>Danh sách lớp học</h1>
        <a href="/lophoc/create" class="btn btn-success">➕ Thêm lớp học mới</a>
    </div>

    <div class="search-container">
        <form action="/lophoc/index" method="GET" class="search-form">
            <input type="text" name="search" placeholder="Tìm kiếm theo mã lớp hoặc tên lớp..." value="<?php echo htmlspecialchars($search ?? ''); ?>">
            <button type="submit" class="btn btn-primary">🔍 Tìm kiếm</button>
            <a href="/lophoc/index" class="btn btn-secondary">Đặt lại</a>
        </form>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 8%;">STT</th>
                    <th style="width: 20%;">Mã lớp</th>
                    <th style="width: 35%;">Tên lớp</th>
                    <th style="width: 22%;">Ghi chú</th>
                    <th style="width: 15%;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($lophoc)): ?>
                    <tr>
                        <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 30px;">Không tìm thấy lớp học nào.</td>
                    </tr>
                <?php else: ?>
                    <?php 
                    $stt_base = isset($offset) ? (int)$offset : 0;
                    foreach($lophoc as $index => $lh): 
                    ?>
                        <tr>
                            <td><?php echo $stt_base + $index + 1; ?></td>
                            <td><span class="badge-class"><?php echo htmlspecialchars($lh['malop']); ?></span></td>
                            <td style="font-weight: 500; color: var(--text-color);"><?php echo htmlspecialchars($lh['tenlop']); ?></td>
                            <td style="color: var(--text-muted);"><?php echo htmlspecialchars($lh['ghichu'] ?? ''); ?></td>
                            <td> 
                                <div class="action-btns">
                                    <a href="/lophoc/edit/<?php echo $lh['id']; ?>" class="btn btn-warning">Sửa</a>
                                    <a href="/lophoc/delete/<?php echo $lh['id']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa lớp học này? Điều này sẽ cập nhật lớp học của các sinh viên thuộc lớp thành chưa phân lớp.');">Xoá</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($totalPage > 1): ?>
        <div class="pagination">
            <?php
                $pageSize = $limit ?? 5;
                $currentOffset = $offset ?? 0;
                for($i = 1; $i <= $totalPage; $i++){
                    $pageOffset = ($i - 1) * $pageSize;
                    $searchParam = !empty($search) ? "?search=" . urlencode($search) : "";
                    $activeClass = ($pageOffset == $currentOffset) ? 'btn-active' : ''; 
                    echo "<a class='btn $activeClass' href='/lophoc/index/$pageSize/$pageOffset$searchParam'>Trang $i</a>";
                }
            ?>
        </div>
    <?php endif; ?>
</div>
