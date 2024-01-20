<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>
    <style>
        /* Add your custom styles here */
        .reviews-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .review {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <button onclick="addToBookmark()">Bookmark</button>
    <button onclick="unbookmark()">unBookmark</button>

    <h1>Total Rating for Book</h1>

    <div id="totalRating">
        <!-- Total rating akan ditampilkan di sini -->
    </div>

    <div id="book-details">
        <!-- Informasi buku akan ditampilkan di sini -->
    </div>

    <form id="borrow-form">
        <label for="tglPeminjaman">Tanggal Peminjaman:</label>
        <input type="date" id="tglPeminjaman" required>

        <label for="tglPengembalian">Tanggal Pengembalian:</label>
        <input type="date" id="tglPengembalian" required>

        <button type="button" onclick="borrowBook()" id="userId">Pinjam Buku</button>
    </form>

    <h2>Add Review</h2>

    <form id="reviewForm">
        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating" min="1" max="5" required>

        <label for="ulasan">Review:</label>
        <textarea id="ulasan" name="ulasan" rows="4"></textarea>

        <button type="button" onclick="submitReview()">Submit Review</button>
    </form>

    <h2>Ulasan Buku</h2>
    <div id="ulasan-container"></div>


    <script>
        function addToBookmark() {
            const userToken = localStorage.getItem('user_token');
            const userId = getUserIdFromToken(userToken);

            const urlParams = new URLSearchParams(window.location.search);
            const idBuku = urlParams.get('id');

            fetch('http://127.0.0.1:8000/api/bookmark/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${userToken}`, // Ganti dengan token otentikasi Anda
                    },
                    body: JSON.stringify({
                        id_buku: idBuku,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(`Buku berhasil dihapus dari bookmark: ${data.message}`);
                    } else {
                        alert(`${data.message}`);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus buku dari bookmark');
                });
        }

        function unbookmark() {
            const userToken = localStorage.getItem('user_token');
            const userId = getUserIdFromToken(userToken);

            const urlParams = new URLSearchParams(window.location.search);
            const idBuku = urlParams.get('id');

            fetch('http://127.0.0.1:8000/api/unbookmark', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${userToken}`,
                    },
                    body: JSON.stringify({
                        id_buku: idBuku,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(`Buku berhasil dihapus dari bookmark: ${data.message}`);
                    } else {
                        alert(`${data.message}`);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus buku dari bookmark');
                });
        }

        function getTotalRating() {
            const urlParams = new URLSearchParams(window.location.search);
            const idBuku = urlParams.get('id');

            fetch(`http://127.0.0.1:8000/api/total-rating/${idBuku}`)
                .then(response => response.json())
                .then(data => {
                    const totalRatingElement = document.getElementById('totalRating');

                    if (data.success) {
                        totalRatingElement.innerHTML = `
                    <p>Total Rating: ${data.total_rating}</p>
                `;
                    } else {
                        totalRatingElement.innerHTML = `
                    <p>${data.message}</p>
                `;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    const totalRatingElement = document.getElementById('totalRating');
                    totalRatingElement.innerHTML = `
                <p>An error occurred while fetching data.</p>
            `;
                });
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Mendapatkan ID buku dari parameter URL
            const urlParams = new URLSearchParams(window.location.search);
            const idBuku = urlParams.get('id');

            // Fungsi untuk mengambil detail buku berdasarkan ID dari API
            function getDetailBuku(id) {
                fetch(`http://127.0.0.1:8000/api/detailBuku/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        if (data.success) {
                            // Panggil fungsi untuk mengambil dan menampilkan detail kategori
                            getDetailKategori(data.data.id_kategori);

                            getTotalRating();

                            // Memanggil fungsi untuk menampilkan detail buku
                            displayDetailBuku(data.data);
                        } else {
                            console.error(data.msg);
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }

            function displayDetailBuku(detailBuku) {
                const detailBukuElement = document.getElementById('book-details');

                const detailHTML = `
            <img src="${detailBuku.cover_buku}" alt="${detailBuku.judul}" style="width: 300px; height: 400px;">
            <h2>${detailBuku.judul}</h2>
            <p><strong>Stock:</strong> ${detailBuku.stock}</p>
            <p><strong>Penulis:</strong> ${detailBuku.penulis}</p>  
            <p><strong>Penerbit:</strong> ${detailBuku.penerbit}</p>
            <p><strong>Tahun Terbit:</strong> ${detailBuku.tahun_terbit}</p>
            <p><strong>Deskripsi:</strong> ${detailBuku.deskripsi}</p>
            <div id="kategori"></div>
        `;

                detailBukuElement.innerHTML = detailHTML;
            }

            // Jika ID buku ditemukan, Anda dapat menggunakannya
            if (idBuku) {
                // Panggil fungsi untuk mengambil dan menampilkan detail buku berdasarkan ID
                getDetailBuku(idBuku);
            } else {
                console.error('ID buku tidak ditemukan.');
            }
        });

        // Fungsi untuk mengambil detail kategori berdasarkan ID dari API
        function getDetailKategori(id_kategori) {
            fetch(`http://127.0.0.1:8000/api/dataKategori/${id_kategori}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        // Memanggil fungsi untuk menampilkan detail kategori
                        displayKategori(data.data.name);
                    } else {
                        console.error(data.msg);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function displayKategori(namaKategori) {
            const kategoriElement = document.getElementById('kategori');
            kategoriElement.innerHTML = `<p><strong>Kategori:</strong> ${namaKategori}</p>`;
        }




        function getUserIdFromToken(token) {
            // Split token menjadi bagian-bagian yang terpisah
            const tokenParts = token.split('.');

            // Decode bagian payload (berisi informasi pengguna)
            const payload = JSON.parse(atob(tokenParts[1]));

            // Ambil ID pengguna dari payload
            const userId = payload.sub;

            return userId;
        }

        function borrowBook() {
            // Mengambil token otorisasi dari localStorage
            const userToken = localStorage.getItem('user_token');


            // Periksa apakah token sudah tersedia
            if (!userToken) {
                console.error('Error: Token otorisasi tidak tersedia di localStorage. Silakan periksa penyimpanan.');
                return;
            }

            // Mendapatkan ID buku dari parameter URL
            const urlParams = new URLSearchParams(window.location.search);
            const idBuku = urlParams.get('id');

            // Mendapatkan data tanggal peminjaman dan pengembalian dari form
            const tglPeminjaman = document.getElementById('tglPeminjaman').value;
            const tglPengembalian = document.getElementById('tglPengembalian').value;

            // Default status peminjaman
            const statusPeminjaman = 'tertunda';
            const userId = getUserIdFromToken(userToken);

            // Membuat objek data peminjaman
            const dataPeminjaman = {
                id_users: userId,
                id_buku: idBuku,
                tgl_peminjaman: tglPeminjaman,
                tgl_pengembalian: tglPengembalian,
                status_peminjaman: statusPeminjaman
            };

            // Kirim permintaan API untuk menyimpan data peminjaman
            fetch('http://127.0.0.1:8000/api/peminjaman', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${userToken}`
                    },
                    body: JSON.stringify(dataPeminjaman),
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.success) {
                        // Peminjaman buku berhasil, Anda dapat menanggapi di sini
                        console.log('Peminjaman berhasil:', data.msg);
                    } else {
                        // Peminjaman buku gagal, Anda dapat menanggapi di sini
                        console.error('Peminjaman gagal:', data.msg);
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        async function submitReview() {

            const userToken = localStorage.getItem('user_token');
            const userId = getUserIdFromToken(userToken);

            console.log('user_token:', userToken);

            const urlParams = new URLSearchParams(window.location.search);
            const idBuku = urlParams.get('id');

            const rating = document.getElementById('rating').value;
            const ulasan = document.getElementById('ulasan').value;

            const dataUlasan = {
                id_users: userId,
                id_buku: idBuku,
                rating: rating,
                ulasan: ulasan,
            };

            try {
                const response = await fetch('http://127.0.0.1:8000/api/reviews', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${userToken}`
                    },
                    body: JSON.stringify(dataUlasan),
                });


                if (response.ok) {
                    const data = await response.json();
                    alert(data.msg);
                    // Lakukan tindakan lain setelah berhasil mengirim ulasan
                    resetForm();
                } else {
                    const data = await response.json();
                    console.error('Failed to submit review:', data.error);
                    alert('Failed to submit review. Please try again.');
                }
            } catch (error) {
                console.error('Error submitting review:', error);
                alert('Error submitting review. Please try again.');
            }
        }

        function resetForm() {
            document.getElementById('rating').value = '';
            document.getElementById('ulasan').value = '';
        }

        async function fetchAndDisplayUlasans() {
            try {
                const response = await fetch('http://127.0.0.1:8000/api/getReviews');
                const data = await response.json();

                const ulasansContainer = document.getElementById('ulasan-container');

                // Clear previous ulasans
                ulasansContainer.innerHTML = '';

                // Display new ulasans
                if (data.success) {
                    data.ulasans.forEach(ulasan => {
                        const ulasanElement = document.createElement('div');
                        ulasanElement.classList.add('ulasan');
                        ulasanElement.innerHTML = `
                            <h3>Rating: ${ulasan.rating}</h3>
                            <p>User: ${ulasan.user.name}</p>
                            <p>Review: ${ulasan.ulasan || 'No review available'}</p>
                            <hr>
                        `;
                        ulasansContainer.appendChild(ulasanElement);
                    });
                } else {
                    console.error('Error fetching ulasans:', data.message);
                }
            } catch (error) {
                console.error('Error fetching ulasans:', error);
            }
        }

        // Call the function to fetch and display ulasans on page load
        fetchAndDisplayUlasans();
    </script>


</body>

</html>
