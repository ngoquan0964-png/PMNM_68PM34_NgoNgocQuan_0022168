<style>
    .card {
        background-color: var(--card-bg);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        max-width: 500px;
        margin: 20px auto;
        border: 1px solid var(--border-color);
        overflow: hidden;
    }
    .card-header {
        background-color: var(--warning-color);
        color: white;
        padding: 20px 30px;
        font-size: 18px;
        font-weight: 600;
        letter-spacing: -0.5px;
    }
    .card-body {
        padding: 30px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        font-size: 14px;
        color: var(--text-color);
    }
    label .required {
        color: var(--danger-color);
        margin-left: 3px;
    }
    input[type="text"], select {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid var(--border-color);
        border-radius: var(--radius-sm);
        box-sizing: border-box;
        font-size: 14px;
        font-family: inherit;
        background-color: var(--card-bg);
        color: var(--text-color);
        transition: var(--transition);
    }
    input[type="text"]:focus, select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
    }
    .btn-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 30px;
    }
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        border: none;
        border-radius: var(--radius-sm);
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
        width: 100%;
    }
    .btn-submit {
        background-color: var(--warning-color);
        color: white;
    }
    .btn-submit:hover {
        background-color: var(--warning-hover);
        transform: translateY(-1px);
    }
    .btn-back {
        background-color: var(--bg-color);
        color: var(--text-muted);
        border: 1px solid var(--border-color);
    }
    .btn-back:hover {
        background-color: var(--border-color);
        color: var(--text-color);
    }
</style>

<div class="card">
    <div class="card-header">
        ✏️ Sửa thông tin sinh viên
    </div>
    <div class="card-body">
        <form action="/sinhvien/update/<?php echo $sinhvien['id']; ?>" method="POST">
            <div class="form-group">
                <label for="MSSV">Mã số sinh viên (MSSV) <span class="required">*</span></label>
                <input type="text" id="MSSV" name="MSSV" value="<?php echo htmlspecialchars($sinhvien['MSSV']); ?>" required autocomplete="off">
            </div>
            
            <div class="form-group">
                <label for="HoTen">Họ và tên <span class="required">*</span></label>
                <input type="text" id="HoTen" name="HoTen" value="<?php echo htmlspecialchars($sinhvien['HoTen']); ?>" required autocomplete="off">
            </div>
            
            <div class="form-group">
                <label for="GioiTinh">Giới tính <span class="required">*</span></label>
                <select id="GioiTinh" name="GioiTinh" required>
                    <option value="">Chọn giới tính</option>
                    <option value="Nam" <?php echo ($sinhvien['GioiTinh'] === 'Nam') ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?php echo ($sinhvien['GioiTinh'] === 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                    <option value="Khác" <?php echo ($sinhvien['GioiTinh'] === 'Khác') ? 'selected' : ''; ?>>Khác</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="malop">Mã lớp</label>
                <select id="malop" name="malop">
                    <option value="">-- Chưa phân lớp --</option>
                    <?php if (!empty($lophoc)): ?>
                        <?php foreach($lophoc as $lh): ?>
                            <option value="<?php echo htmlspecialchars($lh['malop']); ?>" <?php echo (isset($sinhvien['malop']) && $sinhvien['malop'] === $lh['malop']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($lh['malop'] . ' - ' . $lh['tenlop']); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-submit">💾 Lưu thay đổi</button>
                <a href="/sinhvien/index" class="btn btn-back">Quay lại danh sách</a>
            </div>
        </form>
    </div>
</div>
