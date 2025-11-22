<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่ม/อัพเดทหนัง - ไทยอนิเมะ</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .admin-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .admin-header {
            background-color: #a3e635;
            color: #000;
            padding: 2rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            text-align: center;
        }

        .admin-header h1 {
            margin: 0;
            font-size: 2rem;
        }

        .admin-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .btn-admin {
            background-color: #a3e635;
            color: #000;
            border: none;
            padding: 1rem 2rem;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
            transition: opacity 0.3s, transform 0.1s;
        }

        .btn-admin:hover {
            opacity: 0.8;
        }

        .btn-admin:active {
            transform: scale(0.98);
        }

        .btn-admin.active {
            background-color: #4ade80;
        }

        .admin-section {
            background-color: #222;
            padding: 2rem;
            border-radius: 8px;
            display: none;
        }

        .admin-section.active {
            display: block;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #a3e635;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #444;
            border-radius: 6px;
            background-color: #333;
            color: #fff;
            font-family: inherit;
            font-size: 1rem;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #a3e635;
            box-shadow: 0 0 10px rgba(163, 230, 53, 0.3);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .btn-submit {
            background-color: #a3e635;
            color: #000;
            border: none;
            padding: 1rem 2rem;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
            width: 100%;
            transition: opacity 0.3s;
        }

        .btn-submit:hover {
            opacity: 0.8;
        }

        .anime-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 2rem;
        }

        .anime-item {
            background-color: #333;
            border-radius: 8px;
            overflow: hidden;
            padding: 1rem;
            text-align: center;
        }

        .anime-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 1rem;
        }

        .anime-item h3 {
            margin: 0 0 0.5rem 0;
            color: #a3e635;
            font-size: 1rem;
        }

        .anime-item p {
            color: #ccc;
            font-size: 0.9rem;
            margin: 0.5rem 0;
        }

        .anime-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .btn-small {
            flex: 1;
            padding: 0.6rem 0.8rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: bold;
            transition: opacity 0.2s;
        }

        .btn-edit {
            background-color: #4ade80;
            color: #000;
        }

        .btn-delete {
            background-color: #dc2626;
            color: #fff;
        }

        .btn-small:hover {
            opacity: 0.8;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            animation: fadeIn 0.3s;
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .modal-content {
            background-color: #222;
            padding: 2rem;
            border-radius: 8px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.9);
            animation: slideIn 0.3s;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .modal-header h2 {
            margin: 0;
            color: #a3e635;
        }

        .btn-close {
            background: none;
            border: none;
            color: #a3e635;
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.2s;
        }

        .btn-close:hover {
            color: #4ade80;
        }

        .upload-area {
            border: 2px dashed #a3e635;
            border-radius: 6px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 1rem;
        }

        .upload-area:hover {
            background-color: rgba(163, 230, 53, 0.1);
        }

        .upload-area.dragging {
            background-color: rgba(163, 230, 53, 0.2);
            border-color: #4ade80;
        }

        .upload-area img {
            max-width: 200px;
            max-height: 200px;
            margin-top: 1rem;
            border-radius: 6px;
        }

        #imagePreview {
            display: none;
        }

        .form-row-modal {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .modal-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .btn-ok {
            flex: 1;
            background-color: #a3e635;
            color: #000;
        }

        .btn-cancel {
            flex: 1;
            background-color: #dc2626;
            color: #fff;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 2rem;
            padding: 0.8rem 1.5rem;
            background-color: #444;
            color: #a3e635;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s;
        }

        .back-link:hover {
            background-color: #555;
        }

        .success-message {
            background-color: #4ade80;
            color: #000;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            display: none;
        }

        .success-message.show {
            display: block;
        }
    </style>
</head>
<body>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>037-Anime - ดูอนิเมะออนไลน์</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Navigation Header -->
    <header class="navbar">
        <div class="navbar-container">
            <div class="logo">MOM2002</div>
            <nav class="nav-menu">
                <a href="./index.php" class="nav-link">หน้าแรก</a>
                <a href="ซับไทย.php" class="nav-link">ซับไทย</a>
                <a href="#" class="nav-link">
                <a href="ไทย.php" class="nav-link">พากย์ไทย</a>
    </header>

    <!-- Admin Container -->
    <div class="admin-container">
        <a href="index.php" class="back-link">← กลับไปหน้าแรก</a>

        <div class="admin-header">
            <h1>จัดการหนัง</h1>
        </div>

        <div class="success-message" id="successMessage">
            ✓ บันทึกข้อมูลสำเร็จแล้ว
        </div>

        <div class="admin-buttons">
            <button class="btn-admin active" data-section="add">+ เพิ่มหนัง</button>
            <button class="btn-admin" data-section="list">📋 ดูรายการ</button>
            <button class="btn-admin" data-section="update">✏️ อัพเดท</button>
        </div>

        <!-- Add Anime Section -->
        <div class="admin-section active" id="add">
            <h2>เพิ่มหนังใหม่</h2>
            <form id="addAnimeForm">
                <div class="form-group">
                    <label>ชื่อเรื่อง</label>
                    <input type="text" name="title" required placeholder="เช่น One Piece">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Episode</label>
                        <input type="number" name="episode" required placeholder="240">
                    </div>
                    <div class="form-group">
                        <label>ประเภท</label>
                        <select name="type" required>
                            <option value="">เลือกประเภท</option>
                            <option value="ซับไทย">ซับไทย</option>
                            <option value="พากย์ไทย">พากย์ไทย</option>
                            <option value="ซับ+พากย์">ซับ+พากย์</option>
                            
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>คำบรรยาย</label>
                    <textarea name="description" placeholder="รายละเอียดเรื่อง..."></textarea>
                </div>

                <div class="form-group">
                    <label>สถานะ</label>
                    <select name="status" required>
                        <option value="">เลือกสถานะ</option>
                        <option value="ไม่มีข้อมูลทั้งหมด">ไม่มีข้อมูลทั้งหมด</option>
                        <option value="อัปเดตอย่างต่อเนื่อง">อัปเดตอย่างต่อเนื่อง</option>
                        <option value="จบแล้ว">จบแล้ว</option>
                    </select>
                </div>

                <button type="button" class="btn-submit" onclick="openImageModal()">📸 เพิ่มรูปภาพ</button>
                <button type="submit" class="btn-submit" style="margin-top: 1rem;">✓ บันทึก</button>
            </form>

            <hr style="margin:2rem 0;">
            <h2>เพิ่ม/อัปเดตตอนในหนัง</h2>
            <form id="addEpisodeForm">
                <div class="form-group">
                    <label>เลือกหนัง</label>
                    <select name="animeTitle" id="animeTitleSelect" required>
                        <option value="">-- เลือกหนัง --</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>ตอนที่ (เลขตอน)</label>
                    <input type="number" name="episodeNumber" min="1" required placeholder="เช่น 1">
                </div>
                <div class="form-group">
                    <label>ชื่อไฟล์/ลิงก์วิดีโอ</label>
                    <input type="text" name="videoFile" required placeholder="movie_ep1.mp4 หรือ URL">
                </div>
                <div class="form-group">
                    <label>อัปโหลดคลิปจากเครื่อง</label>
                    <input type="file" name="videoFileUpload" accept="video/*" id="videoFileUploadInput" style="display:none;">
                    <button type="button" class="btn-submit" style="background:#4ade80;color:#222;margin-top:8px;" onclick="document.getElementById('videoFileUploadInput').click()">📤 เลือกไฟล์คลิปจากเครื่อง</button>
                    <span id="videoFileUploadName" style="display:block;margin-top:8px;color:#a3e635;"></span>
                </div>
                <button type="submit" class="btn-submit">เพิ่ม/อัปเดตตอนนี้</button>
            </form>
            <button type="button" class="btn-submit" style="margin-top:1rem;background:#2563eb;color:#fff;" onclick="searchAnime()">🔍 ค้นหาชื่อหนัง</button>
        </div>

        <!-- List Anime Section -->
        <div class="admin-section" id="list">
            <h2>รายการหนัง</h2>
            <div class="anime-list" id="animeList">
                <div style="text-align: center; color: #999; grid-column: 1/-1;">
                    ยังไม่มีข้อมูล (กรุณาเพิ่มหนังก่อน)
                </div>
            </div>
        </div>

        <!-- Update Section -->
        <div class="admin-section" id="update">
            <h2>อัพเดทหนัง</h2>
            <div class="form-group">
                <label>เลือกหนังที่ต้องการอัพเดท</label>
                <select id="updateSelect" onchange="loadUpdateForm()">
                    <option value="">-- เลือกหนัง --</option>
                </select>
            </div>
            <form id="updateAnimeForm" style="display: none;">
                <div class="form-group">
                    <label>ชื่อเรื่อง</label>
                    <input type="text" name="title" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Episode</label>
                        <input type="number" name="episode" required>
                    </div>
                    <div class="form-group">
                        <label>ประเภท</label>
                        <select name="type" required>
                            <option value="ซับไทย">ซับไทย</option>
                            <option value="พากย์ไทย">พากย์ไทย</option>
                            <option value="ซับ+พากย์">ซับ+พากย์</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>คำบรรยาย</label>
                    <textarea name="description"></textarea>
                </div>

                <div class="form-group">
                    <label>สถานะ</label>
                    <select name="status" required>
                        <option value="ไม่มีข้อมูลทั้งหมด">ไม่มีข้อมูลทั้งหมด</option>
                        <option value="อัปเดตอย่างต่อเนื่อง">อัปเดตอย่างต่อเนื่อง</option>
                        <option value="จบแล้ว">จบแล้ว</option>
                    </select>
                </div>

                <button type="submit" class="btn-submit">✓ บันทึกการเปลี่ยนแปลง</button>
            </form>
        </div>

        <!-- Add Video Section -->
        <div class="admin-section" id="addVideo">
            <h2>เพิ่มคลิปใหม่</h2>
            <form id="addVideoForm">
                <div class="form-group">
                    <label>ชื่อคลิป</label>
                    <input type="text" name="videoTitle" required placeholder="ชื่อคลิป">
                </div>
                <div class="form-group">
                    <label>เลือกหนัง</label>
                    <select name="videoAnime" id="videoAnimeSelect" required>
                        <option value="">-- เลือกหนัง --</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>เลือกตอน</label>
                    <input type="number" name="videoEpisode" min="1" required placeholder="ตอนที่">
                </div>
                <div class="form-group">
                    <label>อัพโหลดคลิปจากเครื่อง</label>
                    <input type="file" name="videoFile" accept="video/*" id="videoFileInput" style="display:none;">
                    <button type="button" class="btn-submit" style="background:#4ade80;color:#222;margin-top:8px;" onclick="document.getElementById('videoFileInput').click()">📤 เลือกไฟล์คลิปจากเครื่อง</button>
                    <span id="videoFileName" style="display:block;margin-top:8px;color:#a3e635;"></span>
                </div>
                <div class="form-group">
                    <label>เพิ่มคลิปจากลิงก์</label>
                    <input type="url" name="videoUrl" placeholder="https://example.com/video.mp4">
                </div>
                <button type="submit" class="btn-submit">✓ บันทึกคลิป</button>
                <button type="button" class="btn-submit" id="playVideoBtn" style="background:#2563eb;color:#fff;margin-top:1rem;">▶️ เล่นคลิป/ลิงก์ตอนนี้</button>
            </form>
        </div>
    </div>

    <!-- Image Upload Modal -->
    <div class="modal" id="imageModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>อัพโหลดรูปภาพ</h2>
                <button class="btn-close" onclick="closeImageModal()">✕</button>
            </div>

            <div class="upload-area" id="uploadArea" onclick="document.getElementById('imageInput').click()">
                <p>📷 คลิกเพื่ออัพโหลดรูปหรือลากรูปมาวางที่นี่</p>
                <img id="imagePreview" />
            </div>

            <input type="file" id="imageInput" accept="image/*" style="display: none;">

            <div class="form-row-modal" style="margin-bottom: 1rem;">
                <div class="form-group">
                    <label>ความกว้าง (px)</label>
                    <input type="number" id="imageWidth" value="200">
                </div>
                <div class="form-group">
                    <label>ความสูง (px)</label>
                    <input type="number" id="imageHeight" value="300">
                </div>
            </div>

            <div class="modal-buttons">
                <button class="btn-small btn-ok" onclick="confirmImage()">✓ ตกลง</button>
                <button class="btn-small btn-cancel" onclick="closeImageModal()">✕ ยกเลิก</button>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2025 037-Anime. All Rights Reserved.</p>
    </footer>

    <script>
// --- ระบบล็อกอิน 2 ชั้นก่อนเข้า KOK.php ---
(function() {
    // ทุกครั้งที่เข้า ต้องใส่รหัสใหม่ (ไม่ใช้ sessionStorage)
    function askPassword() {
        const pass1 = prompt('กรุณาใส่รหัสผ่านเพื่อเข้าใช้งาน (admin):');
        if (pass1 !== 'asd00asdXX') {
            alert('รหัสผ่านไม่ถูกต้อง');
            window.location.href = 'index.php';
            return;
        }
        // ผ่านแล้วให้ใช้งานได้
    }
    askPassword();
})();

                                        // แสดงชื่อไฟล์ที่เลือกในฟอร์มเพิ่ม/อัปเดตตอน
                                        document.getElementById('videoFileUploadInput')?.addEventListener('change', function() {
                                            const fileNameSpan = document.getElementById('videoFileUploadName');
                                            if (this.files && this.files[0]) {
                                                fileNameSpan.textContent = 'ไฟล์ที่เลือก: ' + this.files[0].name;
                                                // ใส่ชื่อไฟล์ลงในช่อง text ด้วย
                                                document.querySelector('input[name="videoFile"]').value = this.files[0].name;
                                            } else {
                                                fileNameSpan.textContent = '';
                                            }
                                        });
                                // ฟีเจอร์เล่นวิดีโอ/ลิงก์ของตอนที่เลือกทันที
                                document.getElementById('playVideoBtn')?.addEventListener('click', function() {
                                    const animeTitle = document.getElementById('videoAnimeSelect')?.value;
                                    const episode = document.querySelector('input[name="videoEpisode"]')?.value;
                                    if (!animeTitle || !episode) {
                                        alert('กรุณาเลือกหนังและตอน');
                                        return;
                                    }
                                    // ค้นหาข้อมูลคลิป/ลิงก์จาก localStorage
                                    const videoList = JSON.parse(localStorage.getItem('videoData')) || [];
                                    const found = videoList.find(v => v.title === animeTitle && String(v.episode) === String(episode));
                                    let videoUrl = found?.url || found?.file || '';
                                    let videoHtml = '';
                                    if (videoUrl) {
                                        // ถ้าเป็นไฟล์วิดีโอโดยตรง
                                        if (videoUrl.match(/\.(mp4|webm|ogg|m3u8)(\?|$)/i)) {
                                            videoHtml = `<video src='${videoUrl}' controls autoplay style='width:100%;max-width:600px;'></video>`;
                                        }
                                        // YouTube
                                        else if (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
                                            let ytId = '';
                                            if (videoUrl.includes('youtu.be/')) {
                                                ytId = videoUrl.split('youtu.be/')[1].split(/[?&]/)[0];
                                            } else {
                                                const match = videoUrl.match(/[?&]v=([^&]+)/);
                                                ytId = match ? match[1] : '';
                                            }
                                            if (ytId) {
                                                videoHtml = `<iframe width="100%" height="400" src="https://www.youtube.com/embed/${ytId}" frameborder="0" allowfullscreen></iframe>`;
                                            } else {
                                                videoHtml = `<iframe src="${videoUrl}" width="100%" height="400" allowfullscreen></iframe>`;
                                            }
                                        }
                                        // Google Drive
                                        else if (videoUrl.includes('drive.google.com')) {
                                            let fileId = '';
                                            const match = videoUrl.match(/\/d\/([a-zA-Z0-9_-]+)/);
                                            if (match) fileId = match[1];
                                            if (fileId) {
                                                videoHtml = `<iframe src="https://drive.google.com/file/d/${fileId}/preview" width="100%" height="400" allow="autoplay"></iframe>`;
                                            } else {
                                                videoHtml = `<iframe src="${videoUrl}" width="100%" height="400" allowfullscreen></iframe>`;
                                            }
                                        }
                                        // ทุกลิงก์อื่นๆ เปิดใน iframe (เช่น .html, .php, .asp, player ของเว็บอื่น)
                                        else {
                                            videoHtml = `<iframe src="${videoUrl}" width="100%" height="400" allowfullscreen></iframe>`;
                                        }
                                    } else {
                                        videoHtml = '<div style="color:#dc2626;font-weight:bold;">ไม่พบคลิปหรือไฟล์วิดีโอสำหรับตอนนี้</div>';
                                    }
                                    // สร้าง modal แสดงวิดีโอ (ไม่ redirect)
                                    let modal = document.createElement('div');
                                    modal.style.position = 'fixed';
                                    modal.style.top = '0';
                                    modal.style.left = '0';
                                    modal.style.width = '100vw';
                                    modal.style.height = '100vh';
                                    modal.style.background = 'rgba(0,0,0,0.7)';
                                    modal.style.zIndex = '9999';
                                    modal.style.display = 'flex';
                                    modal.style.alignItems = 'center';
                                    modal.style.justifyContent = 'center';
                                    let box = document.createElement('div');
                                    box.style.background = '#222';
                                    box.style.padding = '2rem';
                                    box.style.borderRadius = '12px';
                                    box.style.minWidth = '300px';
                                    box.innerHTML = `<h3 style='color:#a3e635;margin-bottom:1rem;'>เล่นคลิป/ลิงก์ของ ${animeTitle} ตอนที่ ${episode}</h3>` + videoHtml;
                                    let closeBtn = document.createElement('button');
                                    closeBtn.textContent = 'ปิด';
                                    closeBtn.style.marginTop = '1rem';
                                    closeBtn.style.width = '100%';
                                    closeBtn.style.padding = '1rem';
                                    closeBtn.style.background = '#dc2626';
                                    closeBtn.style.color = '#fff';
                                    closeBtn.style.fontWeight = 'bold';
                                    closeBtn.style.border = 'none';
                                    closeBtn.style.borderRadius = '8px';
                                    closeBtn.style.cursor = 'pointer';
                                    closeBtn.onclick = function() { modal.remove(); };
                                    box.appendChild(closeBtn);
                                    modal.appendChild(box);
                                    document.body.appendChild(modal);
                                });
                        // แสดงชื่อไฟล์ที่เลือก
                        document.getElementById('videoFileInput')?.addEventListener('change', function() {
                            const fileNameSpan = document.getElementById('videoFileName');
                            if (this.files && this.files[0]) {
                                fileNameSpan.textContent = 'ไฟล์ที่เลือก: ' + this.files[0].name;
                            } else {
                                fileNameSpan.textContent = '';
                            }
                        });
                // โหลดรายชื่อหนังลงใน select ของฟอร์มเพิ่มคลิป
                function populateVideoAnimeSelect() {
                    const animeData = JSON.parse(localStorage.getItem('animeData') || '[]');
                    const select = document.getElementById('videoAnimeSelect');
                    if (!select) return;
                    select.innerHTML = '<option value="">-- เลือกหนัง --</option>';
                    animeData.forEach(anime => {
                        select.innerHTML += `<option value="${anime.title}">${anime.title}</option>`;
                    });
                }
                populateVideoAnimeSelect();
        // โหลดรายชื่อหนังลงใน select
        function populateAnimeSelect() {
            const animeData = JSON.parse(localStorage.getItem('animeData') || '[]');
            const select = document.getElementById('animeTitleSelect');
            if (!select) return;
            select.innerHTML = '<option value="">-- เลือกหนัง --</option>';
            animeData.forEach(anime => {
                select.innerHTML += `<option value="${anime.title}">${anime.title}</option>`;
            });
        }
        populateAnimeSelect();

        // จัดการเพิ่ม/อัปเดตตอน
        document.getElementById('addEpisodeForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const animeTitle = this.animeTitle.value;
            const episodeNumber = Number(this.episodeNumber.value);
            const videoFile = this.videoFile.value;
            if (!animeTitle || !episodeNumber || !videoFile) return;
            let animeData = JSON.parse(localStorage.getItem('animeData') || '[]');
            const anime = animeData.find(a => a.title === animeTitle);
            if (anime) {
                if (!anime.episodesList) anime.episodesList = {};
                anime.episodesList[episodeNumber] = videoFile;
                // อัปเดตจำนวนตอนถ้ามากกว่าเดิม
                if (!anime.episode || Number(anime.episode) < episodeNumber) {
                    anime.episode = episodeNumber;
                }
                localStorage.setItem('animeData', JSON.stringify(animeData));
                alert('เพิ่ม/อัปเดตตอนสำเร็จ!');
            }
            this.reset();
        });

        // ปุ่มค้นหาชื่อหนัง
        function searchAnime() {
            const animeData = JSON.parse(localStorage.getItem('animeData') || '[]');
            const keyword = prompt('กรุณากรอกชื่อหนังที่ต้องการค้นหา:');
            if (!keyword) return;
            const filtered = animeData.filter(a => a.title.toLowerCase().includes(keyword.toLowerCase()));
            if (filtered.length === 0) {
                alert('ไม่พบหนังที่ค้นหา');
                return;
            }
            // สร้าง modal แสดงรายการหนังที่ค้นหา
            let modal = document.createElement('div');
            modal.style.position = 'fixed';
            modal.style.top = '0';
            modal.style.left = '0';
            modal.style.width = '100vw';
            modal.style.height = '100vh';
            modal.style.background = 'rgba(0,0,0,0.7)';
            modal.style.zIndex = '9999';
            modal.style.display = 'flex';
            modal.style.alignItems = 'center';
            modal.style.justifyContent = 'center';
            let box = document.createElement('div');
            box.style.background = '#222';
            box.style.padding = '2rem';
            box.style.borderRadius = '12px';
            box.style.minWidth = '300px';
            box.innerHTML = `<h3 style='color:#a3e635;margin-bottom:1rem;'>เลือกชื่อหนังที่ต้องการ</h3>`;
            filtered.forEach(a => {
                let btn = document.createElement('button');
                btn.textContent = a.title;
                btn.style.display = 'block';
                btn.style.width = '100%';
                btn.style.margin = '0.5rem 0';
                btn.style.padding = '1rem';
                btn.style.background = '#a3e635';
                btn.style.color = '#222';
                btn.style.fontWeight = 'bold';
                btn.style.border = 'none';
                btn.style.borderRadius = '8px';
                btn.style.cursor = 'pointer';
                btn.onclick = function() {
                    // แสดงชื่อหนังที่เลือกใน element ที่ต้องการ เช่น animeTitleSelect
                    let select = document.getElementById('animeTitleSelect');
                    if (select) select.value = a.title;
                    modal.remove();
                };
                box.appendChild(btn);
            });
            let closeBtn = document.createElement('button');
            closeBtn.textContent = 'ปิด';
            closeBtn.style.marginTop = '1rem';
            closeBtn.style.width = '100%';
            closeBtn.style.padding = '1rem';
            closeBtn.style.background = '#dc2626';
            closeBtn.style.color = '#fff';
            closeBtn.style.fontWeight = 'bold';
            closeBtn.style.border = 'none';
            closeBtn.style.borderRadius = '8px';
            closeBtn.style.cursor = 'pointer';
            closeBtn.onclick = function() { modal.remove(); };
            box.appendChild(closeBtn);
            modal.appendChild(box);
            document.body.appendChild(modal);
        }
        // Tab Switching
        document.querySelectorAll('.btn-admin').forEach(btn => {
            btn.addEventListener('click', function() {
                const section = this.dataset.section;
                
                // Remove active from all buttons and sections
                document.querySelectorAll('.btn-admin').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.admin-section').forEach(s => s.classList.remove('active'));
                
                // Add active to clicked button and corresponding section
                this.classList.add('active');
                document.getElementById(section).classList.add('active');
                
                // Load data when switching to list or update
                if (section === 'list') {
                    loadAnimeList();
                } else if (section === 'update') {
                    loadUpdateList();
                }
            });
        });

        // Local Storage Management
        function getAnimeData() {
            const data = localStorage.getItem('animeData');
            return data ? JSON.parse(data) : [];
        }

        function saveAnimeData(data) {
            localStorage.setItem('animeData', JSON.stringify(data));
        }

        // Add Anime Form
        document.getElementById('addAnimeForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const anime = {
                id: Date.now(),
                title: formData.get('title'),
                episode: formData.get('episode'),
                type: formData.get('type') || 'ไม่มีหมวดหมู่',
                description: formData.get('description'),
                status: formData.get('status'),
                image: currentImage || 'https://via.placeholder.com/200x300?text=No+Image'
            };

            const animeList = getAnimeData();
            animeList.unshift(anime); // เพิ่มรายการใหม่ไว้ที่ตำแหน่งแรก
            saveAnimeData(animeList);

            showSuccessMessage();
            this.reset();
            currentImage = null;
            document.getElementById('imagePreview').style.display = 'none';
        });

        // Load Anime List
        function loadAnimeList() {
            const animeList = getAnimeData();
            const listContainer = document.getElementById('animeList');
            console.log('animeList:', animeList);

            if (animeList.length === 0) {
                listContainer.innerHTML = '<div style="text-align: center; color: #999; grid-column: 1/-1;">ยังไม่มีข้อมูล</div>';
                return;
            }

            listContainer.innerHTML = animeList.map(anime => `
                <div class="anime-item">
                    <img src="${anime.image}" alt="${anime.title}">
                    <h3>${anime.title}</h3>
                    <p style="margin: 4px 0 8px 0; font-size: 1rem; color: #4ade80; font-weight: bold;">${anime.type && anime.type !== '' ? anime.type : 'ไม่มีหมวดหมู่'}</p>
                    <p>Episode ${anime.episode}</p>
                    <p style="font-size: 0.8rem; color: #999;">${anime.status}</p>
                    <div class="anime-actions">
                        <button class="btn-small btn-edit" onclick="editAnime(${anime.id})">แก้ไข</button>
                        <button class="btn-small btn-delete" onclick="deleteAnime(${anime.id})">ลบ</button>
                    </div>
                </div>
            `).join('');
        }

        // Load Update List
        function loadUpdateList() {
            const animeList = getAnimeData();
            const select = document.getElementById('updateSelect');
            
            select.innerHTML = '<option value="">-- เลือกหนัง --</option>';
            select.innerHTML += animeList.map(anime => 
                `<option value="${anime.id}">${anime.title}</option>`
            ).join('');
        }

        // Load Update Form
        function loadUpdateForm() {
            const id = document.getElementById('updateSelect').value;
            if (!id) {
                document.getElementById('updateAnimeForm').style.display = 'none';
                return;
            }

            const animeList = getAnimeData();
            const anime = animeList.find(a => a.id == id);

            if (anime) {
                document.querySelector('#updateAnimeForm input[name="title"]').value = anime.title;
                document.querySelector('#updateAnimeForm input[name="episode"]').value = anime.episode;
                document.querySelector('#updateAnimeForm select[name="type"]').value = anime.type;
                document.querySelector('#updateAnimeForm textarea[name="description"]').value = anime.description;
                document.querySelector('#updateAnimeForm select[name="status"]').value = anime.status;
                document.getElementById('updateAnimeForm').style.display = 'block';
            }
        }

        // Update Anime
        document.getElementById('updateAnimeForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const id = document.getElementById('updateSelect').value;
            const animeList = getAnimeData();
            const anime = animeList.find(a => a.id == id);

            if (anime) {
                anime.title = this.querySelector('input[name="title"]').value;
                anime.episode = this.querySelector('input[name="episode"]').value;
                anime.type = this.querySelector('select[name="type"]').value;
                anime.description = this.querySelector('textarea[name="description"]').value;
                anime.status = this.querySelector('select[name="status"]').value;

                saveAnimeData(animeList);
                showSuccessMessage();
            }
        });

        // Delete Anime
        function deleteAnime(id) {
            if (confirm('ต้องการลบหนังนี้ใช่หรือไม่?')) {
                const animeList = getAnimeData();
                const filtered = animeList.filter(a => a.id !== id);
                saveAnimeData(filtered);
                loadAnimeList();
                showSuccessMessage('ลบข้อมูลสำเร็จ');
            }
        }

        // Edit Anime
        function editAnime(id) {
            document.querySelector('button[data-section="update"]').click();
            document.getElementById('updateSelect').value = id;
            loadUpdateForm();
        }

        // Image Modal
        let currentImage = null;

        function openImageModal() {
            document.getElementById('imageModal').classList.add('active');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.remove('active');
        }

        const uploadArea = document.getElementById('uploadArea');
        const imageInput = document.getElementById('imageInput');

        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragging');
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragging');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragging');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                imageInput.files = files;
                previewImage();
            }
        });

        imageInput.addEventListener('change', previewImage);

        function previewImage() {
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    currentImage = e.target.result;
                    document.getElementById('imagePreview').src = currentImage;
                    document.getElementById('imagePreview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        function confirmImage() {
            if (currentImage) {
                closeImageModal();
            } else {
                alert('กรุณาเลือกรูปภาพ');
            }
        }

        // Success Message
        function showSuccessMessage(msg = 'บันทึกข้อมูลสำเร็จแล้ว') {
            const messageEl = document.getElementById('successMessage');
            messageEl.textContent = '✓ ' + msg;
            messageEl.classList.add('show');
            setTimeout(() => {
                messageEl.classList.remove('show');
            }, 3000);
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(e) {
            const modal = document.getElementById('imageModal');
            if (e.target === modal) {
                closeImageModal();
            }
        });

        // Add Video Form Submission
        document.getElementById('addVideoForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const videoData = {
                id: Date.now(),
                title: formData.get('videoTitle'),
                file: formData.get('videoFile') ? formData.get('videoFile').name : null,
                url: formData.get('videoUrl')
            };

            const videoList = JSON.parse(localStorage.getItem('videoData')) || [];
            videoList.push(videoData);
            localStorage.setItem('videoData', JSON.stringify(videoList));

            alert('เพิ่มคลิปสำเร็จ!');
            this.reset();
        });
    </script>
</body>
</html>
