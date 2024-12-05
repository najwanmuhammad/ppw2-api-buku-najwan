<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <!-- Header -->
        <h1 class="text-center text-primary mb-4">Daftar Buku</h1>

        <!-- Table -->
        <div class="overflow-hidden shadow-sm rounded-3 bg-white p-4">
            <table class="table table-striped table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Harga</th>
                        <th>Tahun Terbit</th>
                    </tr>
                </thead>
                <tbody id="bookTableBody">
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
            <div class="text-end mt-3">
                <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('{{ url('/api/books') }}')
                .then(response => response.json())
                .then(responseData => {
                    if (responseData.success && responseData.data) {
                        const bookTableBody = document.getElementById('bookTableBody');
                        responseData.data.data.forEach((book, index) => {
                            const row = document.createElement('tr');
                            row.className = 'hover-table';
                            row.innerHTML = `
                                <td class="text-center">${index + 1}</td>
                                <td>${book.judul}</td>
                                <td>${book.penulis}</td>
                                <td>Rp. ${book.harga.toLocaleString('id-ID', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                                <td>${new Date(book.tahun_terbit).toLocaleDateString('id-ID')}</td>
                            `;
                            bookTableBody.appendChild(row);
                        });
                    } else {
                        console.error('Failed to fetch books:', responseData.message);
                    }
                })
                .catch(error => console.error('Error fetching books:', error));
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
