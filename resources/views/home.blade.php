<h1>Book Search</h1>

<label for="searchInput">Search:</label>
<input type="text" id="searchInput">
<button onclick="searchBooks()">Search</button>

<div id="searchResults"></div>

<h1>DAFTAR BUKU</h1>

<div id="daftarBuku"></div>

<script>
    // BUKU TAMPIL
    function getDaftarBuku() {
        fetch('http://127.0.0.1:8000/api/dataBuku')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Memanggil fungsi untuk menampilkan daftar buku
                    displayDaftarBuku(data.data);
                } else {
                    console.error(data.msg);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Fungsi untuk menampilkan daftar buku di halaman HTML
    function displayDaftarBuku(daftarBuku) {
        const daftarBukuElement = document.getElementById('daftarBuku');

        daftarBukuElement.innerHTML = '<ul>';

        // Iterasi melalui setiap buku dan menampilkan judulnya dengan menambahkan event listener
        daftarBuku.forEach(buku => {
            const judulBuku = `<li class="judul-buku" data-id="${buku.id}">${buku.judul}</li>`;
            daftarBukuElement.innerHTML += judulBuku;
        }); 

        daftarBukuElement.innerHTML += '</ul>';

        // Menambahkan event listener untuk setiap elemen dengan class "judul-buku"
        const judulBukuElements = document.querySelectorAll('.judul-buku');
        judulBukuElements.forEach(element => {
            element.addEventListener('click', () => {
                // Memanggil fungsi untuk menanggapi klik pada judul buku
                handleJudulBukuClick(element.dataset.id);
            });
        });
    }

    // Fungsi untuk menanggapi klik pada judul buku
    function handleJudulBukuClick(id) {
        // Mengarahkan pengguna ke endpoint Laravel untuk mendapatkan detail buku
        fetch(`http://127.0.0.1:8000/api/detailBuku/${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Jika sukses, arahkan pengguna ke halaman detail buku
                    window.location.href = `detail-buku?id=${id}`;
                } else {
                    console.error(data.msg);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // SEARCH
    document.addEventListener('DOMContentLoaded', getDaftarBuku);

    function searchBooks() {
        const query = document.getElementById('searchInput').value;

        fetch(`http://localhost:8000/api/searchBuku?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                displayResults(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function displayResults(data) {
        const resultsDiv = document.getElementById('searchResults');
        resultsDiv.innerHTML = '';

        const searchBuku = data.searchBuku;

        if (searchBuku.length === 0) {
            resultsDiv.innerHTML = 'No results found.';
        } else {
            searchBuku.forEach(buku => {
                const bookDiv = document.createElement('div');
                bookDiv.innerHTML = `
                <h3>${buku.judul}</h3>
                <p>Penulis: ${buku.penulis}</p>
                <p>Penerbit: ${buku.penerbit}</p>
                <p>Deskripsi: ${buku.deskripsi}</p>
                <p>Tahun Terbit: ${buku.tahun_terbit}</p>
                <hr>
            `;
                resultsDiv.appendChild(bookDiv);
            });

        }
    }
</script>
