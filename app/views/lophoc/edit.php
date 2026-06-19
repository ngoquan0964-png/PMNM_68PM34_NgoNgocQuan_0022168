<style>
    .card {
        background-color: var(--card-bg);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        max-width: 600px;
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
    input[type="text"], textarea {
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
    input[type="text"]:focus, textarea:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
    }
    textarea {
        resize: vertical;
        min-height: 100px;
    }
    .btn-group {
        display: flex;
        gap: 12px;
        margin-top: 30px;
    }
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        border: none;
        border-radius: var(--radius-sm);
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        text-decoration: none;
    }
    .btn-warning {
        background-color: var(--warning-color);
        color: white;
    }
    .btn-warning:hover {
        background-color: var(--warning-hover);
        transform: translateY(-1px);
    }
    .btn-light {
        background-color: var(--bg-color);
        color: var(--text-muted);
        border: 1px solid var(--border-color);
    }
    .btn-light:hover {
        background-color: var(--border-color);
        color: var(--text-color);
    }
</style>

<div class="card">
    <div class="card-header">
        ✏️ Sửa thông tin lớp học
    </div>
    <div class="card-body">
        <form action="/lophoc/update/<?php echo $class['id']; ?>" method="POST">
            <div class="form-group">
                <label for="malop">Mã lớp <span class="required">*</span></label>
                <input type="text" id="malop" name="malop" value="<?php echo htmlspecialchars($class['malop']); ?>" required autocomplete="off">
            </div>
            
            <div class="form-group">
                <label for="tenlop">Tên lớp <span class="required">*</span></label>
                <input type="text" id="tenlop" name="tenlop" value="<?php echo htmlspecialchars($class['tenlop']); ?>" required autocomplete="off">
            </div>
            
            <div class="form-group">
                <label for="ghichu">Ghi chú</label>
                <textarea id="ghichu" name="ghichu"><?php echo htmlspecialchars($class['ghichu'] ?? ''); ?></textarea>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-warning">💾 Lưu thay đổi</button>
                <a href="/lophoc/index" class="btn btn-light">Hủy</a>
            </div>
        </form>
    </div>
</div>
