@extends('layouts.template') 
 
@section('content') 
    <div class="card card-outline card-primary"> 
        <div class="card-header"> 
          <h3 class="card-title">{{ $page->title }}</h3> 
            <div class="card-tools"> 
                <a href="{{ url('/stok/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export Stok (xlsx)</a>
                <a href="{{ url('/stok/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export Stok (pdf)</a> 
                <button onclick="modalAction('{{ url('/stok/import') }}')" class="btn btn-info">Import Stok</button> 
                <button onclick="modalAction('{{ url('/stok/create_ajax') }}')" class="btn btn-success">Tambah Data (Ajax)</button> 
            </div> 
        </div> 
        <div class="card-body"> 
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }} </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }} </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter: </label>
                        <div class="col-3">
                            <select class="form-control" id="barang_id" name="barang_id">
                                <option value="">- Semua Barang -</option>
                                @foreach($barang as $item)
                                    <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Barang</small>
                        </div>
                    </div> 
                </div> 
            </div> 

            <table class="table table-bordered table-sm table-striped table-hover" id="table-stok"> 
                <thead> 
                    <tr>
                        <th>No</th>
                        <th>Nama Supplier</th>
                        <th>Nama Barang</th>
                        <th>Tanggal</th>
                        <th>Jumlah Stok</th>
                        <th>Nama Pegawai</th>
                        <th>Aksi</th>
                    </tr> 
                </thead> 
            </table> 
            </div> 
        </div> 
    <div id="myModal" class="modal fade animate shake" tabindex="-1" data-backdrop="static" data-keyboard="false" data-width="75%"></div> 
                 
            @endsection 
            @push('css')
            @endpush

            @push('js') 
            <script> 
                function modalAction(url = ''){ 
                    $('#myModal').load(url,function(){ 
                        $('#myModal').modal('show'); 
                    }); 
                } 
             
            var dataStok; 
            $(document).ready(function(){ 
                dataStok = $('#table-stok').DataTable({ 

                    serverSide: true, 
                    ajax: { 
                        "url": "{{ url('stok/list') }}", 
                        "dataType": "json", 
                        "type": "POST", 
                        "data": function (d) { 
                            
                        d.barang_id = $('#barang_id').val();
                        d.supplier_id = $('#supplier_id').val();

                        } 
                    }, 
                    columns: [{ 
                            data: "DT_RowIndex",             
                            className: "text-center", 
                            orderable: false, 
                            searchable: false    
                        },{ 
                            data: "supplier.supplier_nama",  
                            className: "", 
                            orderable: true, 
                            searchable: true 
                        },{ 
                            data: "barang.barang_nama",  
                            className: "", 
                            orderable: true, 
                            searchable: true, 
                        },{ 
                            data: "stok_tanggal",
                            className: "",
                            orderable: true,
                            searchable: true
                        },{ 
                            data: "stok_jumlah",  
                            className: "", 
                            orderable: true, 
                            searchable: false, 
            },{ 
                data: "user.nama",  
                className: "", 
                orderable: true, 
                searchable: true 
            },{ 
                data: "aksi",  
                className: "text-center", 
                orderable: false, 
                searchable: false 
            } 
        ] 
    }); 
 
    $('#stok_id,#user_id, #barang_id, #supplier_id').on('change', function() {
        dataStok.ajax.reload();
      })
}); 
</script> 
@endpush