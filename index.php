<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentasi 17 Agustus 2025 - RSUD TANJUNG PURA</title>
    <link rel="stylesheet" href="styles.css">
    <style>
    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100vw;
        height: 100vh;
        overflow: auto;
        background: rgba(214,19,19,0.97);
        animation: fadeIn 0.3s;
        backdrop-filter: blur(2px);
    }
    @keyframes fadeIn {
        from { opacity: 0;}
        to { opacity: 1;}
    }
    .modal-header {
        position: absolute;
        top: 34px;
        right: 44px;
        display: flex;
        gap: 14px;
        z-index: 10001;
    }
    .modal-btn {
        color: #fff;
        background: #d61313;
        border: none;
        font-size: 1.4rem;
        font-weight: bold;
        cursor: pointer;
        border-radius: 50%;
        width: 44px; height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s, transform 0.2s;
        text-decoration: none;
        outline: none;
        box-shadow: 0 4px 24px rgba(0,0,0,0.15);
    }
    .modal-btn.download,
    .modal-btn.info {
        background: #fff;
        color: #d61313;
        border: 2px solid #d61313;
        font-size: 1.2rem;
    }
    .modal-btn:hover {
        background: #fff;
        color: #d61313;
        border: 2px solid #fff;
        transform: scale(1.12);
    }
    .modal-content {
        margin: auto;
        display: block;
        max-width: 80vw;
        max-height: 70vh;
        border-radius: 18px;
        box-shadow: 0 8px 32px #0008;
        border: 6px solid #fff;
        background: #fff;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        animation: popupScale 0.25s;
    }
    @keyframes popupScale {
        from { transform: scale(0.92);}
        to { transform: scale(1);}
    }
    #infoModal .modal-header {
        top: 20px;
        right: 20px;
        gap: 0;
    }
    #infoModal {
        background: rgba(214, 19, 19, 0.98);
    }
    #infoModal-box {
        background: transparent;
        max-width:400px;
        margin:80px auto;
        padding:2rem;
        border-radius:15px;
        text-align:center;
        font-family: 'Segoe UI', Arial, sans-serif;
        color: #fff;
        animation: fadeIn 0.3s;
        border: 2px solid #fff;
        box-shadow: 0 6px 24px #000a;
    }
    #infoModal-box h2 {
        color: #fff;
        margin-bottom: 1rem;
        letter-spacing: 1px;
    }
    #infoContent p {
        color: #fff;
        font-weight: 500;
        margin: 0.7em 0;
        font-size: 1.07em;
    }
    /* Logo: hilangkan background putih */
    .header-logo img {
        border-radius: 10px;
        box-shadow: 0 2px 10px #d6131322;
        width: 80px;
        height: 80px;
        object-fit: contain;
        margin-bottom: 10px;
        border: 2px solid #d61313;
        background: transparent !important;
    }
    /* Pagination styles */
    .pagination {
        margin: 2rem auto 1.5rem auto;
        text-align: center;
    }
    .pagination .page {
        display: inline-block;
        padding: 8px 18px;
        margin: 0 3px;
        background: #fff;
        color: #d61313;
        font-weight: bold;
        font-size: 1.05rem;
        border-radius: 7px;
        border: 2px solid #d61313;
        text-decoration: none;
        transition: background .2s, color .2s;
    }
    .pagination .page:hover {
        background: #d61313;
        color: #fff;
    }
    .pagination .current {
        background: #d61313;
        color: #fff;
        border: 2px solid #d61313;
        font-weight: bolder;
    }
    </style>
</head>
<body>
    <header>
        <div class="header-logo">
            <img src="images/logo/logo1.png" alt="Logo RSUD Tanjung Pura" />
        </div>
        <h1>Dokumentasi 17 Agustus 2025</h1>
        <p>Galeri Foto Kegiatan HUT RI ke-80<br><span class="subtitle">RSUD TANJUNG PURA</span></p>
    </header>
    <main>
        <section class="gallery">
            <?php
            // Pagination logic
            $dir = "images/";
            $photos_per_page = 24;
            $found = false;

            // Ambil halaman dari parameter GET, default ke 1
            $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

            $files = [];
            if (is_dir($dir)) {
                foreach (scandir($dir) as $file) {
                    if (
                        is_file($dir . $file) &&
                        preg_match('/\.(jpg|jpeg|png)$/i', $file)
                    ) {
                        $files[] = $file;
                    }
                }
                $total_photos = count($files);
                $total_pages = ceil($total_photos / $photos_per_page);

                if ($total_photos > 0) {
                    $start = ($page - 1) * $photos_per_page;
                    $photos = array_slice($files, $start, $photos_per_page);

                    foreach ($photos as $file) {
                        echo '<div class="photo">';
                        echo '<img src="'.$dir.$file.'" alt="Foto 17 Agustus" class="popup-img" style="cursor:pointer;" data-src="'.$dir.$file.'" data-name="'.htmlspecialchars($file).'">';
                        echo '</div>';
                    }

                    // Navigasi halaman
                    if ($total_pages > 1) {
                        echo '<div class="pagination">';
                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($i == $page) {
                                echo '<span class="page current">'.$i.'</span>';
                            } else {
                                echo '<a class="page" href="?page='.$i.'">'.$i.'</a>';
                            }
                        }
                        echo '</div>';
                    }
                } else {
                    echo "<p>Tidak ada file .jpg, .jpeg, atau .png ditemukan di folder images/.</p>";
                }
            } else {
                echo "<p>Folder images/ tidak ditemukan. Silakan buat folder images/ dan upload foto di sana.</p>";
            }
            ?>
        </section>
        <!-- Modal Popup -->
        <div id="imgModal" class="modal">
            <div class="modal-header">
                <button class="modal-btn" id="closeModal" title="Tutup">&times;</button>
                <a href="#" id="modalDownload" class="modal-btn download" title="Unduh" download>
                    &#128190;
                </a>
                <button class="modal-btn info" id="modalInfo" title="Info">&#9432;</button>
            </div>
            <img class="modal-content" id="modalImage">
        </div>
        <!-- Info Modal -->
        <div id="infoModal" class="modal">
          <div class="modal-header">
            <button class="modal-btn" id="closeInfoModal" title="Tutup Info">&times;</button>
          </div>
          <div id="infoModal-box">
            <h2>Info Foto</h2>
            <div id="infoContent"></div>
          </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 Dokumentasi 17 Agustus &mdash; RSUD TANJUNG PURA</p>
    </footer>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = document.getElementById("imgModal");
        var modalImg = document.getElementById("modalImage");
        var closeBtn = document.getElementById("closeModal");
        var images = document.querySelectorAll('.popup-img');
        var downloadBtn = document.getElementById("modalDownload");
        var infoBtn = document.getElementById("modalInfo");
        var infoModal = document.getElementById("infoModal");
        var closeInfoBtn = document.getElementById("closeInfoModal");
        var infoContent = document.getElementById("infoContent");
        var currentFileName = "";

        images.forEach(function(img) {
            img.addEventListener('click', function() {
                var imgSrc = img.getAttribute('data-src');
                currentFileName = img.getAttribute('data-name');
                modal.style.display = "block";
                modalImg.src = imgSrc;
                downloadBtn.href = imgSrc;
                var filename = imgSrc.split('/').pop();
                downloadBtn.setAttribute('download', filename);
            });
        });

        closeBtn.onclick = function() {
            modal.style.display = "none";
            modalImg.src = "";
            downloadBtn.href = "#";
        };

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
                modalImg.src = "";
                downloadBtn.href = "#";
            }
            if (event.target == infoModal) {
                infoModal.style.display = "none";
            }
        };

        infoBtn.onclick = function() {
            infoModal.style.display = "block";
            var infoHtml = "<p><strong>Nama File:</strong> " + currentFileName + "</p>";
            infoHtml += "<p><strong>Ukuran:</strong> ";
            fetch(modalImg.src)
            .then(response => {
                if (!response.ok) throw new Error("Network response was not ok");
                return response.blob();
            })
            .then(blob => {
                var sizeKb = (blob.size/1024).toFixed(2);
                infoHtml += sizeKb + " KB</p>";
                infoContent.innerHTML = infoHtml;
            })
            .catch(() => {
                infoHtml += "Tidak diketahui</p>";
                infoContent.innerHTML = infoHtml;
            });
        };

        closeInfoBtn.onclick = function() {
            infoModal.style.display = "none";
        };
    });
    </script>
</body>
</html>