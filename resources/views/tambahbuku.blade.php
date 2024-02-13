<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Add Book</title>
</head>

<body>

    <h1>Add Book</h1>

    <form id="addBookForm">
        <label for="judul">Judul:</label>
        <input type="text" id="judul" name="judul" required>

        <label for="penulis">Penulis:</label>
        <input type="text" id="penulis" name="penulis" required>

        <label for="penerbit">Penerbit:</label>
        <input type="text" id="penerbit" name="penerbit" required>

        <label for="deskripsi">Deskripsi:</label>
        <textarea id="deskripsi" name="deskripsi" required></textarea>

        <label for="tahun_terbit">Tahun Terbit:</label>
        <input type="text" id="tahun_terbit" name="tahun_terbit" required>

        <label for="cover_buku">Cover Buku (File):</label>
        <input type="file" id="cover_buku" name="cover_buku" accept="image/*">

        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required>

        <button type="button" id="tambahBukuBtn">Tambah Buku</button>
    </form>

    <script>
        $(document).ready(function() {
            $("#tambahBukuBtn").click(function() {
                const formData = {
                    judul: $("#judul").val(),
                    penulis: $("#penulis").val(),
                    penerbit: $("#penerbit").val(),
                    deskripsi: $("#deskripsi").val(),
                    tahun_terbit: $("#tahun_terbit").val(),
                    stock: $("#stock").val(),
                    // Menggunakan FormData untuk meng-handle file
                    cover_buku: $("#cover_buku")[0].files[0],
                };

                // Menggunakan FormData untuk meng-handle file
                const form = new FormData();
                form.append('judul', formData.judul);
                form.append('penulis', formData.penulis);
                form.append('penerbit', formData.penerbit);
                form.append('deskripsi', formData.deskripsi);
                form.append('tahun_terbit', formData.tahun_terbit);
                form.append('stock', formData.stock);
                form.append('cover_buku', formData.cover_buku);

                $.ajax({
                    url: 'http://127.0.0.1:8000/api/tambahBuku',
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    data: form,
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(error) {
                        console.error('Error:', error);

                        if (error.responseJSON && error.responseJSON.errors) {
                            console.error('Validation Errors:', error.responseJSON.errors);
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>
