@extends('layouts.dashboard-dosen')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard Dosen</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Laporan Absensi / {{$matkul->name}}</li>
            </ol>
            
            
            <div class="card mb-4">
                <div class="card-header">
                    {{-- <a href="{{ route('dosen.create') }}" class="btn btn-success" style="float: right"><i class="fas fa-plus"></i> Dosen</a> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Pertemuan</th>
                                   
                                  
                                    <th>Aksi</th>
                                   
                                </tr>
                            </thead>
                           
                            <tbody>
                                @forelse ($pertemuan as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name}}</td>
                                    
                                    <td>
                                        <a href="{{ route('absensi.pertemuan-show',$item->id) }}" data-toggle="tooltip" data-placement="top" title="Lihat Absensi  "  class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                        {{-- <a href="#" class="btn btn-danger" onClick="Delete(this.id)"  id="{{ $item->id }}"><i class="far fa-trash-alt"></i></a> --}}
                                    </td>
                                   
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada Absen</td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                        </table>
                        <a href="{{ route('absensi.pertemuan-showAll',$matkul->id) }}" data-toggle="tooltip" data-placement="top" title="Lihat Semua Absensi Pertemuan "  class="btn btn-warning">Absensi Semua Pertemuan</a>

                    </div>
                </div>
            </div>
        </div>
    </main>


@endsection
@push('addon-script')
<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
@endpush

