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
                <a href="ไทย.php" class="nav-link">พากย์ไทย</a>
                <div class="nav-dropdown">
                    <button class="nav-dropdown-btn">ติดต่อ ▼</button>
                    <div class="dropdown-menu">
                        <button class="dropdown-btn">1. ติดต่อ</button>
                        <button class="dropdown-btn">2. รายงาน</button>
                        <button class="dropdown-btn">3. เพิ่มหนัง</button>
                    </div>
                </div>
            </nav>
            <div class="nav-right">
                <button class="btn-search">🔍</button>
                <div id="search-box" style="display:none;position:absolute;top:60px;right:40px;z-index:1000;">
                    <input type="text" id="search-input" placeholder="ค้นหาชื่อหนัง..." style="padding:8px 16px;border-radius:8px;border:1px solid #ccc;width:220px;">
                    <button id="search-go" style="padding:8px 16px;border-radius:8px;background:#2563eb;color:#fff;border:none;">ค้นหา</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>อุดนิเมะออนไลน์ฟรี | 037-Anime เว็บอุดารุ์ดนนพากย์ไทย ซับไทย อับเด็ดไหม่ทุกวัน!</h1>
            <p>ยินดี้ต้อบรับ 037-Anime แหล่งรวมอนิเมะดุดนภาพ ทั้งแบบ ซับไทย และ พากย์ไทย อับเด็ดออนไลน์วิทีสุด! สูตร ไม่ต้องสมัครสมาชิก ไม่มโยชนารถกา รองรับทั้งมือถืออและคอมพิวเตอร์ พร้อมระบบค้นหาง่าย แฟกผมวดหมู่เตะเน ไม่่จะเป็นแบงอตู้ แฟนตาดี โรแมนติก หรืออุดดอมเด้ — ทีมีครบทุกแนว!</p>
            <p class="highlight-title">สนทศับอนิเมะออนไลม์ เซิ่น</p>
            <div class="anime-list-mini">
                <a href="#" class="anime-link">One Piece</a>
                <a href="#" class="anime-link">Demon Slayer</a>
                <a href="#" class="anime-link">Jujutsu Kaisen</a>
            </div>
            <p class="disclaimer">แตะดึกดำแนนับบ HD คุณดีไม่มีสะดุด! คลิกเลี่ยวจาน อุดนิเมะศุนค ๑ ทุกคอน ที่ 037-Anime.com เว็บอุดารุ์ดนนอับดับหนังย่องคนกอนเมะไทย</p>
        </div>
    </section>

    <!-- Button Section -->
    <section class="button-section">
        <button class="btn-category">อุดนิเมะออนไลน์</button>
    </section>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Anime Grid -->
        <section class="anime-grid">
            <!-- JS จะเติม card หนังที่เพิ่มจาก KOK.php ที่นี่ -->
        </section>

        <!-- Sidebar Categories -->
        <aside class="sidebar">
            <div class="category-group">
                <h3 class="category-title"></h3>ยอดหนังทั้งหมด
                <div class="category-item">ยอดรายการหนัง<span class="count" id="anime-total-count"></span></div>
            <div class="stats">
                <div class="stat-item">👁️ Views</div>
                <div class="stat-count">6 753 312</div>
            </div>
        </aside>
    </div>

    <footer class="footer">
        <!-- รายการคลิปที่อัปโหลด -->
        <section class="uploaded-clips" style="margin:2rem 0;">
            <h2>รายการคลิปที่อัปโหลด</h2>
            <?php
            $clipDir = 'uploads/';
            if (is_dir($clipDir)) {
                $clips = array_diff(scandir($clipDir), array('.', '..'));
                if (count($clips) > 0) {
                    echo '<ul style="list-style: none; padding: 0;">';
                    foreach ($clips as $clip) {
                        $clipUrl = $clipDir . $clip;
                        echo '<li style="margin-bottom: 1rem;">';
                        echo '<video src="' . $clipUrl . '" controls width="320" style="max-width:100%;"></video><br>';
                        echo '<span>' . htmlspecialchars($clip) . '</span>';
                        echo '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p>ยังไม่มีคลิปที่อัปโหลด</p>';
                }
            } else {
                echo '<p>ยังไม่มีคลิปที่อัปโหลด</p>';
            }
            ?>
        </section>
        <p>&copy; 2025 037-Anime. All Rights Reserved.</p>
    </footer>

    <script>
 // --- แสดงหนังที่เพิ่มจาก KOK.php ---
                function renderAnimeFromLocalStorage() {
                    const animeList = JSON.parse(localStorage.getItem('animeData') || '[]');
                    const grid = document.querySelector('.anime-grid');
                    if (!grid) return;
                    // กรองเฉพาะประเภทซับไทย
                    const subThaiList = animeList.filter(anime => anime.type === 'พากย์ไทย');
                    if (!subThaiList.length) {
                        grid.innerHTML = '<div style="text-align:center;color:#999;grid-column:1/-1;">ยังไม่มีข้อมูลหนังซับไทย</div>';
                        return;
                    }
                    grid.innerHTML = subThaiList.map(anime => `
                        <div class="anime-card" onclick="window.location.href='หนัง.php?title=${encodeURIComponent(anime.title)}'">
                            <div class="anime-image-wrapper">
                                <img src="${anime.image}" alt="${anime.title}">
                                <span class="episode-badge">EP ${anime.episode}</span>
                            </div>
                            <div class="anime-info">
                                <div class="anime-status">
                                    <span class="status-tag">${anime.status}</span>
                                </div>
                                <h3 class="anime-title">${anime.title}</h3>
                                <div class="anime-buttons">
                                    <button class="btn-episode">EP ${anime.episode}</button>
                                    <button class="btn-watch">ดู</button>
                                </div>
                            </div>
                        </div>
                    `).join('');
                }
                // เรียกใช้งานเมื่อโหลดหน้า
                renderAnimeFromLocalStorage();
        // Dropdown toggle functionality
        document.querySelectorAll('.nav-dropdown-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const dropdown = this.closest('.nav-dropdown');
                const menu = dropdown.querySelector('.dropdown-menu');
                
                // ปิดเมนูอื่นๆ
                document.querySelectorAll('.dropdown-menu').forEach(m => {
                    if (m !== menu) m.classList.remove('active');
                });
                
                // สลับเมนูปัจจุบัน
                menu.classList.toggle('active');
            });
        });

        // ปิดเมนูเมื่อคลิกนอกเมนู
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.nav-dropdown')) {
                document.querySelectorAll('.dropdown-menu').forEach(m => {
                    m.classList.remove('active');
                });
            }
        });

        // ปิดเมนูเมื่อคลิกปุ่มในเมนู
        document.querySelectorAll('.dropdown-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const text = this.textContent.trim();
                
                if (text.includes('เพิ่มหนัง')) {
                    window.location.href = 'KOK.php';
                } else if (text.includes('ติดต่อ')) {
                    console.log('ติดต่อ');
                    // เพิ่มการทำงานที่นี่
                } else if (text.includes('รายงาน')) {
                    console.log('รายงาน');
                    // เพิ่มการทำงานที่นี่
                }
            });
        });

        // แสดง/ซ่อนช่องค้นหา
document.querySelector('.btn-search').addEventListener('click', function() {
    const box = document.getElementById('search-box');
    box.style.display = box.style.display === 'none' ? 'block' : 'none';
    document.getElementById('search-input').focus();
});

// ค้นหาชื่อหนัง
document.getElementById('search-go').addEventListener('click', function() {
    const keyword = document.getElementById('search-input').value.trim().toLowerCase();
    const animeList = JSON.parse(localStorage.getItem('animeData') || '[]');
    const grid = document.querySelector('.anime-grid');
    if (!grid) return;
    if (!keyword) {
        renderAnimeFromLocalStorage(); // แสดงทั้งหมดถ้าไม่กรอก
        return;
    }
    const filtered = animeList.filter(anime => anime.title && anime.title.toLowerCase().includes(keyword));
    if (!filtered.length) {
        grid.innerHTML = `<div style="text-align:center;color:#999;grid-column:1/-1;">ไม่พบหนังที่ค้นหา</div>`;
        return;
    }
    grid.innerHTML = filtered.map(anime => `
        <div class="anime-card" onclick="window.location.href='หนัง.php?title=${encodeURIComponent(anime.title)}'">
            <div class="anime-image-wrapper">
                <img src="${anime.image}" alt="${anime.title}">
                <span class="episode-badge">EP ${anime.episode}</span>
            </div>
            <div class="anime-info">
                <div class="anime-status">
                    <span class="status-tag">${anime.status}</span>
                </div>
                <h3 class="anime-title">${anime.title}</h3>
                <div class="anime-buttons">
                    <button class="btn-episode">EP ${anime.episode}</button>
                    <button class="btn-watch">ดู</button>
                </div>
            </div>
        </div>
    `).join('');
});

// กด Enter เพื่อค้นหา
document.getElementById('search-input').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        document.getElementById('search-go').click();
    }
});

// --- อัปเดตจำนวนหนังแต่ละหมวดหมู่ ---
function updateCategoryCounts() {
    const animeList = JSON.parse(localStorage.getItem('animeData') || '[]');
    document.querySelectorAll('.category-item').forEach(item => {
        const category = item.childNodes[0].nodeValue.trim();
        const countSpan = item.querySelector('.count');
        if (countSpan) {
            const count = animeList.filter(anime => anime.category && anime.category.trim() === category).length;
            countSpan.textContent = `(${count})`;
        }
    });
}
updateCategoryCounts();

// --- ยอดเข้าชมเว็บ ---
function updateViews() {
    const viewsKey = 'siteViews';
    let views = parseInt(localStorage.getItem(viewsKey) || '6005030', 10);
    views++;
    localStorage.setItem(viewsKey, views);
    const statCount = document.querySelector('.stat-count');
    if (statCount) statCount.textContent = views.toLocaleString();
}
updateViews();

// แสดงยอดหนังทั้งหมดที่เพิ่มจาก KOK.php
function updateAnimeTotalCount() {
    const animeList = JSON.parse(localStorage.getItem('animeData') || '[]');
    document.getElementById('anime-total-count').textContent = `(${animeList.length})`;
}
updateAnimeTotalCount();
    </script>
</body>
</html>
