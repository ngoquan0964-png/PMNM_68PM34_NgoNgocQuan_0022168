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
    .filter-container {
        margin-bottom: 25px;
        background-color: var(--bg-color);
        padding: 20px;
        border-radius: var(--radius-md);
        border: 1px solid var(--border-color);
    }
    .filter-form {
        display: grid;
        grid-template-columns: 2fr 1.5fr 1.5fr 1fr;
        gap: 15px;
        align-items: end;
    }
    .form-group-filter {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .form-group-filter label {
        font-size: 12px;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .filter-form input[type="text"], 
    .filter-form select {
        padding: 10px 14px;
        border: 1px solid var(--border-color);
        border-radius: var(--radius-sm);
        font-size: 14px;
        font-family: inherit;
        background-color: var(--card-bg);
        color: var(--text-color);
        transition: var(--transition);
        width: 100%;
    }
    .filter-form input[type="text"]:focus, 
    .filter-form select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
    }
    .filter-actions {
        display: flex;
        gap: 8px;
        width: 100%;
    }
    .filter-actions .btn {
        flex: 1;
        padding: 10px;
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
        color: white;
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
    .badge-mssv {
        background-color: var(--bg-color);
        color: var(--text-color);
        padding: 4px 8px;
        border-radius: var(--radius-sm);
        font-weight: 600;
        font-size: 13px;
        border: 1px solid var(--border-color);
    }
    .badge-class {
        background-color: rgba(79, 70, 229, 0.08);
        color: var(--primary-color);
        padding: 4px 10px;
        border-radius: var(--radius-sm);
        font-weight: 600;
        font-size: 13px;
        display: inline-block;
    }
    .badge-gender-male {
        background-color: rgba(14, 165, 233, 0.1);
        color: #0369a1;
        padding: 3px 8px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-gender-female {
        background-color: rgba(236, 72, 153, 0.1);
        color: #be185d;
        padding: 3px 8px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-gender-other {
        background-color: rgba(100, 116, 139, 0.1);
        color: #475569;
        padding: 3px 8px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
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
    
    @media (max-width: 900px) {
        .filter-form {
            grid-template-columns: 1fr 1fr;
        }
        .filter-actions {
            grid-column: span 2;
        }
    }
    @media (max-width: 600px) {
        .filter-form {
            grid-template-columns: 1fr;
        }
        .filter-actions {
            grid-column: span 1;
        }
    }
</style>

<div class="card">
    <div class="header-section">
        <h1>Danh sách sinh viên</h1>
        <a href="/sinhvien/create" class="btn btn-success">➕ Thêm sinh viên mới</a>
    </div>

    <!-- Filter Bar -->
    <div class="filter-container">
        <form action="/sinhvien/index" method="GET" class="filter-form">
            <div class="form-group-filter">
                <label for="search">Tìm kiếm</label>
                <input type="text" id="search" name="search" placeholder="Mã số sinh viên hoặc họ tên..." value="<?php echo htmlspecialchars($search ?? ''); ?>">
            </div>
            
            <div class="form-group-filter">
                <label for="malop">Lớp học</label>
                <select id="malop" name="malop">
                    <option value="">Tất cả các lớp</option>
                    <?php if (!empty($lophoc)): ?>
                        <?php foreach($lophoc as $lh): ?>
                            <option value="<?php echo htmlspecialchars($lh['malop']); ?>" <?php echo ($malop === $lh['malop']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($lh['malop'] . ' - ' . $lh['tenlop']); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            
            <div class="form-group-filter">
                <label for="sort">Sắp xếp</label>
                <select id="sort" name="sort">
                    <option value="MSSV_asc" <?php echo ($sort === 'MSSV_asc') ? 'selected' : ''; ?>>Mã sinh viên tăng dần</option>
                    <option value="MSSV_desc" <?php echo ($sort === 'MSSV_desc') ? 'selected' : ''; ?>>Mã sinh viên giảm dần</option>
                    <option value="HoTen_asc" <?php echo ($sort === 'HoTen_asc') ? 'selected' : ''; ?>>Họ tên A-Z</option>
                    <option value="HoTen_desc" <?php echo ($sort === 'HoTen_desc') ? 'selected' : ''; ?>>Họ tên Z-A</option>
                </select>
            </div>
            
            <div class="filter-actions">
                <button type="submit" class="btn btn-primary">🔍 Lọc</button>
                <a href="/sinhvien/index" class="btn btn-secondary">Đặt lại</a>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 6%;">STT</th>
                    <th style="width: 12%;">MSSV</th>
                    <th style="width: 22%;">Họ tên</th>
                    <th style="width: 12%;">Giới tính</th>
                    <th style="width: 15%;">Mã lớp</th>
                    <th style="width: 20%;">Tên lớp</th>
                    <th style="width: 13%;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($sinhvien)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 30px;">Không tìm thấy sinh viên nào.</td>
                    </tr>
                <?php else: ?>
                    <?php 
                    $stt_base = isset($offset) ? (int)$offset : 0;
                    foreach($sinhvien as $index => $sv): 
                    ?>
                        <tr>
                            <td><?php echo $stt_base + $index + 1; ?></td>
                            <td><span class="badge-mssv"><?php echo htmlspecialchars($sv['MSSV']); ?></span></td>
                            <td style="font-weight: 500; color: var(--text-color);"><?php echo htmlspecialchars($sv['HoTen']); ?></td>
                            <td>
                                <?php 
                                    if ($sv['GioiTinh'] === 'Nam') {
                                        echo '<span class="badge-gender-male">Nam</span>';
                                    } elseif ($sv['GioiTinh'] === 'Nữ') {
                                        echo '<span class="badge-gender-female">Nữ</span>';
                                    } else {
                                        echo '<span class="badge-gender-other">' . htmlspecialchars($sv['GioiTinh']) . '</span>';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                if (!empty($sv['malop'])) {
                                    echo '<span class="badge-class">' . htmlspecialchars($sv['malop']) . '</span>';
                                } else {
                                    echo '<span style="color: var(--text-muted); font-style: italic; font-size: 13px;">Chưa phân lớp</span>';
                                }
                                ?>
                            </td>
                            <td style="color: var(--text-color);">
                                <?php echo htmlspecialchars($sv['TenLop'] ?? ''); ?>
                            </td>
                            <td> 
                                <div class="action-btns">
                                    <a href="/sinhvien/edit/<?php echo $sv['id']; ?>" class="btn btn-warning">Sửa</a>
                                    <a href="/sinhvien/delete/<?php echo $sv['id']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?');">Xoá</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if ($totalPage > 1): ?>
        <div class="pagination">
            <?php
                $pageSize = $limit ?? 10;
                $currentOffset = $offset ?? 0;
                for($i = 1; $i <= $totalPage; $i++){
                    $pageOffset = ($i - 1) * $pageSize;
                    
                    // Build query params to preserve filters
                    $queryParams = [];
                    if (!empty($search)) $queryParams['search'] = $search;
                    if (!empty($malop)) $queryParams['malop'] = $malop;
                    if (!empty($sort)) $queryParams['sort'] = $sort;
                    
                    $queryString = count($queryParams) > 0 ? '?' . http_build_query($queryParams) : '';
                    $activeClass = ($pageOffset == $currentOffset) ? 'btn-active' : ''; 
                    
                    echo "<a class='btn $activeClass' href='/sinhvien/index/$pageSize/$pageOffset$queryString'>Trang $i</a>";
                }
            ?>
        </div>
    <?php endif; ?>
</div>