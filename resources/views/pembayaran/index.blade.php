@extends('main.bootstrap')

@section('content')
<div class="text-center py-5 h-100 bg-dark text-white">
    <h3>Kelola Pembayaran</h3>
</div>

<div class="container mt-4">
    <div class="d-flex justify-content-between">
        <div>
            <h4>Data Pembayaran</h4>
        </div>
        <form class="row row-cols-lg-auto g-1 align-items-center" action="{{ url('pembayaran') }}" method="GET">
        <div class="col-12">
           <input type="text" name="cari" id="cari" name="cari" value="{{ $keyword != null ? $keyword : ''}}" class="form-control" placeholder="Cari data...">
        </div>    
        <div class="col-12">
           <button type="submit" class="btn btn-success ms-3">Cari</button>
        </div>    
        </form>
    </div>
    @if(Session::has('sukses'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sukses!</strong> {{ Session::get('sukses') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(Session::has('gagal'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal!</strong> {{ Session::get('gagal') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <hr>
    <div class="text-end">
        <a href="{{ url('pembayaran/cetak') }}" class="btn btn-info"><i class="bi bi-printer-fill mx-2"></i>Print All</a>
    </div>

    <div class="container mt-4">
    <table class="table table-striped table-border">
    <thead>
            <tr>
                <th>#</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
           @if($siswa->count() == 0)
            <tr class="text-center">
                <td colspan="7"><strong>Data Belum Ada</strong></td>
            </tr>
            @else    
            @foreach($siswa as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nis }}</td>
                <td>{{ $data->user->name }}</td>
                <td>{{ $data->kelas->kelas }}</td>
                <td>

                    @if (auth()->user()->level == 'siswa')
                    <a href='{{ url("pembayaran/transaksi/history/$data->id") }}' class="btn btn-info btn-sm"><i class="bi bi-credit-card mx-1">History</i></a>
                    @else 
                    <a href='{{ url("pembayaran/transaksi/$data->id") }}' class="btn btn-info btn-sm"><i class="bi bi-credit-card mx-1"></i>Transaksi</a>
                    @endif
                    <a href='{{ url("pembayaran/cetak/$data->id") }}' class="btn btn-info btn-sm"><i class="bi bi-printer-fill mx-2"></i>Print Id</a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>

    </table>
</div>
</div>
@endsection