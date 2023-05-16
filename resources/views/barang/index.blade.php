@extends('layouts.layout')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
        <!-- Button trigger modal -->
        @hasanyrole('Admin|Kepala Lab')
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                + Tambah
            </button>
        @endhasanyrole

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kode_barang">Kode Barang :</label>
                            <input type="text" name="kode_barang" class="form-control" id="kode_barang" required>
                        </div>
                        <div class="form-group">
                            <label for="barang">Nama Barang :</label>
                            <input type="text" name="nama_barang" class="form-control" id="barang" required>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto Barang :</label>
                            <input type="file" name="image" class="form-control" id="foto" required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_barang">Jumlah Barang :</label>
                            <input type="number" name="jumlah_barang" class="form-control" id="jumlah_barang" required>
                        </div>
                    
                        <div class="form-group">
                            <label for="type">Merk type :</label>
                            <input type="text" name="merk_type" class="form-control" id="type" required>
                        </div>
                        <div class="form-group">
                            <label for="tahun">Tahun Perolehan :</label>
                            <input type="number" name="tahun" class="form-control" id="tahun" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
                        <input type="submit" class="btn btn-primary btn-send" value="Simpan">
                    </div>
            </div>
            </form>


        </div>
    </div>



    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Merk/Type </th>
                            <th>Tahun Perolehan</th>
                            <th>Foto Barang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $b)
                            <tr align="center">
                                <td>{{ $b->kode_barang }}</td>
                                <td>{{ $b->nama_barang }}</td>
                                <td>{{ $b->jumlah_barang }}</td>
                                <td>{{ $b->merk_type }}</td>
                                <td>{{ $b->tahun }}</td>
                                <td> <img width="150" height="150" src="/storage/{{ $b->image }}" alt="barang"></td>
                                <td align="center" width="10%">
                                    @hasanyrole('Admin|Kepala Lab')
                                        <a href="{{ route('barang.edit', [$b->id]) }}" data-toggle="tooltip" title="Edit"
                                            class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                            <i class="fas fa-edit fa-sm text-white-50"></i>
                                        </a>
                                        <a href="/barang/hapus/{{ $b->id }}" data-toggle="tooltip" title="Hapus"
                                            onclick="return confirm('Yakin Ingin menghapus data?')"
                                            class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                            <i class="fas fa-trash-alt fa-sm text-white-50"></i>
                                        </a>
                                    @endhasanyrole
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
