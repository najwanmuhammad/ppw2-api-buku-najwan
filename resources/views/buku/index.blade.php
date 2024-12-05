<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <form action="{{ route('buku.search') }}" method="GET" style="margin-top: 20px; margin-left: 20px;">
        @csrf
    <input type="text" name="kata" class="form-control" placeholder="Cari..."
    style="width: 30%; margin-bottom: 10px; border: 2px solid #007bff; box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);">
    <table class="table mt-3">
        @if (Session::has('successadd'))
            <div class="alert alert-success" id="success-alert" style="background-color: rgb(57, 182, 57); color: white;">{{ Session::get('successadd') }}</div>
        @endif
        @if (Session::has('successedit'))
            <div class="alert alert-success" id="success-alert" style="background-color: rgb(45, 101, 255); color: white;">{{ Session::get('successedit') }}</div>
        @endif
        @if (Session::has('successdel'))
            <div class="alert alert-success" id="success-alert" style="background-color: rgb(255, 98, 98); color: white;">{{ Session::get('successdel') }}</div>
        @endif
        <script>
            setTimeout(function() {
                document.getElementById('success-alert').style.display = 'none';
            }, 3000);
        </script>
        </form>
        <thead class="table-light">

            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tahun Terbit</th>
                <th  class="text-center">Edit</th>
                <th  class="text-center">Hapus</th>
            </tr>
        </thead>
        <tbody>

            @foreach($data_buku as $index => $Buku)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$Buku->judul}}</td>
                <td>{{$Buku->penulis}}</td>
                <td>Rp. {{number_format($Buku->harga,2,',','.')}}</td>
                <td>{{ \Carbon\Carbon::parse($Buku->tahun_terbit)->format('d/m/Y') }}</td>
                <td class="text-center">
                    <a href="{{ route('buku.edit', $Buku->id) }}" class="btn btn-primary">Edit</a>
                </td>
                <td  class="text-center">
                    <form action = "{{ route('buku.destroy', $Buku->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button onclick="return confirm('Yakin mau dihapus')" type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            @endforeach
        </tbody>
      </table>
      <div style="margin-right: 20px">{{ $data_buku ->links('pagination::bootstrap-5') }}</div>
    <div class="d-flex justify-content-center mt-3 mb-3">
        <a href="{{ route('buku.create') }}" class="btn btn-primary" >Tambah Buku</a>
        <a href="{{ route('buku.show') }}" class="btn btn-secondary ms-2">Lihat Buku Hasil API</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

