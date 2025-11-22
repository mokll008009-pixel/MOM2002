<?php
// รับค่าจาก query string
$title = isset($_GET['title']) ? htmlspecialchars($_GET['title']) : 'ไม่ทราบชื่อหนัง';
$file = isset($_GET['file']) ? htmlspecialchars($_GET['file']) : '';
$image = isset($_GET['image']) ? htmlspecialchars($_GET['image']) : 'movie_poster.jpg';
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <style>
        body {
            background: #111;
            color: #fff;
            font-family: 'Prompt', sans-serif;
        }
        .navbar {
            background: #222;
            padding: 16px 0;
            box-shadow: 0 2px 8px #0004;
        }
        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo {
            font-size: 2em;
            font-weight: bold;
            color: #b3e635;
            letter-spacing: 2px;
        }
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 24px;
        }
        .nav-link {
            color: #fff;
            text-decoration: none;
            font-size: 1.1em;
            padding: 8px 18px;
            border-radius: 8px;
            transition: background 0.2s;
        }
        .nav-link:hover {
            background: #2563eb;
            color: #fff;
        }
        .nav-dropdown {
            position: relative;
        }
        .nav-dropdown-btn {
            background: #4a5c1a;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 18px;
            font-size: 1.1em;
            cursor: pointer;
        }
        .dropdown-menu {
            display: none;
            position: absolute;
            top: 110%;
            left: 0;
            background: #222;
            border-radius: 8px;
            box-shadow: 0 2px 8px #0006;
            min-width: 160px;
            z-index: 10;
            flex-direction: column;
        }
        .dropdown-btn {
            background: none;
            color: #fff;
            border: none;
            padding: 12px 18px;
            text-align: left;
            width: 100%;
            cursor: pointer;
            font-size: 1em;
            border-bottom: 1px solid #333;
        }
        .dropdown-btn:last-child {
            border-bottom: none;
        }
        .dropdown-btn:hover {
            background: #2563eb;
            color: #fff;
        }
        .nav-dropdown:hover .dropdown-menu {
            display: flex;
        }
        .movie-player-container {
            max-width: 90vw;
            margin: 30px auto;
            background: #181818;
            border-radius: 12px;
            box-shadow: 0 0 10px #000a;
            position: relative;
            padding-bottom: 60px;
        }
        .movie-poster {
            width: 180px;
            border-radius: 8px;
            box-shadow: 0 2px 8px #0006;
            position: absolute;
            top: 30px;
            left: 30px;
        }
        .movie-info {
            position: absolute;
            top: 30px;
            left: 230px;
            color: #fff;
        }
        .video-wrapper {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 400px;
            background: #000;
            border: 2px solid #0099ff;
            border-radius: 10px;
            margin: 0 30px;
        }
        .season-select {
            position: absolute;
            right: 30px;
            bottom: 20px;
        }
        .season-btn {
            background: #4a5c1a;
            color: #fff;
            border: none;
            border-radius: 24px;
            padding: 16px 32px;
            font-size: 1.2em;
            cursor: pointer;
            box-shadow: 0 2px 8px #0006;
        }
        .season-btn:hover {
            background: #6a8c2a;
        }
    </style>
</head>
<body>
    <!-- Navigation Header -->
    <header class="navbar">
        <div class="navbar-container">
            <div class="logo">MOM2002</div>
            <nav class="nav-menu">
                <a href="index.php" class="nav-link">หน้าแรก</a>
                <a href="ซับไทย.php" class="nav-link">ซับไทย</a>
                <div class="nav-dropdown">
                <a href="ไทย.php" class="nav-link">พากย์ไทย</a>

                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- แบนเนอร์โฆษณา -->
    <div style="display: flex; gap: 16px; justify-content: center; margin: 30px 0;">
        <div style="background: #181818; border-radius: 12px; overflow: hidden; box-shadow: 0 0 10px #000a;">
            <img src="https://cdn.jsdelivr.net/gh/nicasio2255/adimg@main/ads-730x400.jpg" alt="ads1" style="width: 500px; height: 200px; display: block;">
        </div>
        <div style="background: #181818; border-radius: 12px; overflojpgw: hidden; box-shadow: 0 0 10px #000a;">
            <img src="https://cdn.jsdelivr.net/gh/nicasio2255/adimg@main/ads-730x400." alt="ads2" style="width: 500px; height: 200px; display: block;">
        </div>
    </div>

    <div style="display: flex; gap: 16px; justify-content: center; margin: 30px 0;">
        <div style="background: #181818; border-radius: 12px; overflow: hidden; box-shadow: 0 0 10px #000a;">
            <img src="https://cdn.jsdelivr.net/gh/nicasio2255/adimg@main/ads-730x400.jpg" alt="ads1" style="width: 500px; height: 100px; display: block;">
        </div>
        <div style="background: #181818; border-radius: 12px; overflow: hidden; box-shadow: 0 0 10px #000a;">
            <img src="https://cdn.jsdelivr.net/gh/nicasio2255/adimg@main/ads-730x400.jpg" alt="ads2" style="width: 500px; height: 100px; display: block;">
        </div>
    </div>

    <!-- วิดีโอเล่นหนัง -->
    <div class="video-wrapper">
       <?php if ($file): ?>
           <video id="movie-player" width="100%" height="100%" controls poster="<?php echo $image; ?>">
               <source src="<?php echo $file; ?>" type="video/mp4">
               <p></p>
           </video>
       <?php else: ?>
           <div style="color:#ccc;text-align:center;width:100%;"></div>
       <?php endif; ?>
    </div>
    <!-- ปุ่มเลือกตอน -->
    <div id="episode-buttons" style="margin: 30px 30px 0 30px;"></div>
    <script>
    // แสดงปุ่มตอนและเล่นคลิป/ลิ้งก์จาก localStorage (episodesList)
    (function() {
        const urlParams = new URLSearchParams(window.location.search);
        const currentTitle = urlParams.get('title');
        let episodes = 1;
        let episodeLinks = {};
        try {
            const animeData = JSON.parse(localStorage.getItem('animeData') || '[]');
            const found = animeData.find(a => a.title && a.title.trim() === currentTitle?.trim());
            if (found) {
                if (found.episode && !isNaN(Number(found.episode))) {
                    episodes = Number(found.episode);
                }
                if (found.episodesList) {
                    episodeLinks = found.episodesList;
                }
            }
        } catch(e) {}
        if (episodes === 1 && window.__phpEpisodes && !isNaN(Number(window.__phpEpisodes))) {
            episodes = Number(window.__phpEpisodes);
        }
        const container = document.getElementById('episode-buttons');
        let html = '<div style="display: flex; flex-wrap: wrap; gap: 16px;">';
        for (let i = 1; i <= episodes; i++) {
            let link = episodeLinks[i] || '';
            html += `<button class="episode-btn" data-ep="${i}" data-link="${link}" style="background:#2563eb;color:#fff;padding:18px 32px;border-radius:10px;border:none;font-size:1.1em;flex:0 0 180px;box-shadow:0 2px 8px #0006;cursor:pointer;position:relative;">ตอนที่ ${i}<div style=\"font-size:0.8em;color:#b3e635;\">${link ? '' : ''}</div></button>`;
        }
        html += '</div>';
        container.innerHTML = html;
        container.querySelectorAll('.episode-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var ep = this.getAttribute('data-ep');
                var link = this.getAttribute('data-link');
                var player = document.getElementById('movie-player');
                var videoWrapper = document.querySelector('.video-wrapper');
                if (!player && videoWrapper) {
                    // ถ้ายังไม่มี player ให้สร้างใหม่
                    player = document.createElement('video');
                    player.id = 'movie-player';
                    player.setAttribute('width', '100%');
                    player.setAttribute('height', '400');
                    player.setAttribute('controls', 'controls');
                    player.setAttribute('autoplay', 'autoplay');
                    player.style.maxWidth = '100%';
                    player.style.maxHeight = '400px';
                    player.style.background = '#000';
                    videoWrapper.innerHTML = '';
                    videoWrapper.appendChild(player);
                }
                if (player) {
                    while (player.firstChild) player.removeChild(player.firstChild);
                    if (link) {
                        // ถ้าเป็นลิ้ง YouTube
                        if (link.includes('youtube.com') || link.includes('youtu.be')) {
                            // ลบ video เดิม
                            if (player) player.remove();
                            var iframe = document.createElement('iframe');
                            iframe.width = '100%';
                            iframe.height = '100%';
                            iframe.style.maxWidth = '100%';
                            iframe.style.maxHeight = '100%';
                            iframe.src = link.replace('watch?v=', 'embed/');
                            iframe.frameBorder = '0';
                            iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
                            iframe.allowFullscreen = true;
                            videoWrapper.innerHTML = '';
                            videoWrapper.appendChild(iframe);
                        } else if (link.endsWith('.mp4') || link.endsWith('.webm') || link.endsWith('.ogg')) {
                            // วิดีโอไฟล์ mp4, webm, ogg
                            while (player.firstChild) player.removeChild(player.firstChild);
                            var type = link.endsWith('.mp4') ? 'video/mp4' : (link.endsWith('.webm') ? 'video/webm' : 'video/ogg');
                            var newSource = document.createElement('source');
                            newSource.setAttribute('src', link);
                            newSource.setAttribute('type', type);
                            player.appendChild(newSource);
                            player.load();
                            setTimeout(function(){ player.play(); }, 200);
                            player.onerror = function() {
                                videoWrapper.innerHTML = `<div style='color:#dc2626;text-align:center;padding:2em;'>ไม่สามารถเล่นวิดีโอนี้ได้ <br><a href='${link}' target='_blank' style='color:#3b82f6;text-decoration:underline;'>เปิดดูในแท็บใหม่</a></div>`;
                            };
                        } else if (link.endsWith('.m3u8')) {
                            // HLS stream
                            while (player.firstChild) player.removeChild(player.firstChild);
                            if (window.Hls && window.Hls.isSupported() && player) {
                                var hls = new window.Hls();
                                hls.loadSource(link);
                                hls.attachMedia(player);
                                hls.on(window.Hls.Events.MANIFEST_PARSED,function() {
                                    player.play();
                                });
                            } else if (player.canPlayType('application/vnd.apple.mpegurl')) {
                                player.src = link;
                                player.addEventListener('loadedmetadata',function() {
                                    player.play();
                                });
                            } else {
                                videoWrapper.innerHTML = `<div style='color:#dc2626;text-align:center;padding:2em;'>ไม่สามารถเล่น HLS ได้ <br><a href='${link}' target='_blank' style='color:#3b82f6;text-decoration:underline;'>เปิดดูในแท็บใหม่</a></div>`;
                            }
                        } else if (link.endsWith('.m3u8')) {
                            // HLS stream
                            while (player.firstChild) player.removeChild(player.firstChild);
                            if (Hls.isSupported()) {
                                var hls = new Hls();
                                hls.loadSource(link);
                                hls.attachMedia(player);
                                hls.on(Hls.Events.MANIFEST_PARSED,function() {
                                    player.play();
                                });
                            } else if (player.canPlayType('application/vnd.apple.mpegurl')) {
                                player.src = link;
                                player.addEventListener('loadedmetadata',function() {
                                    player.play();
                                });
                            } else {
                                videoWrapper.innerHTML = `<div style='color:#dc2626;text-align:center;padding:2em;'>ไม่สามารถเล่น HLS ได้ <br><a href='${link}' target='_blank' style='color:#3b82f6;text-decoration:underline;'>เปิดดูในแท็บใหม่</a></div>`;
                            }
                        } else if (link.startsWith('http')) {
                            // ถ้าไม่ใช่ mp4/webm/ogg/m3u8 ให้เปิดลิ้งในแท็บใหม่
                            window.open(link, '_blank');
                        } else {
                            alert('ไม่พบคลิปหรือไฟล์วิดีโอสำหรับตอนนี้');
                        }
                    } else {
                        alert('ไม่พบคลิปหรือไฟล์วิดีโอสำหรับตอนนี้');
                    }
                }
            });
        });
    })();
    </script>
    <!-- ปุ่มเลือกซีซั่น -->
    <div class="season-select">
        <button class="season-btn">ซีซั่น 1 ▼</button>
    </div>
</body>
</html>
