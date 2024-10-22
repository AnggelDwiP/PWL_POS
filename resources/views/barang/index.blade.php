@extends('layouts.template') 
 
@section('content') 
    <div class="card card-outline card-primary"> 
        <div class="card-header"> 
            <h3 class="card-title">{{ $page->title }}</h3> 
            <div class="card-tools"> 
                <a href="{{ url('/barang/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export Barang (xlsx)</a>
                <a href="{{ url('/barang/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export Barang (pdf)</a> 
                <button onclick="modalAction('{{ url('/barang/import') }}')" class="btn btn-info">Import Barang</button> 
                <button onclick="modalAction('{{ url('/barang/create_ajax') }}')" class="btn btn-success">Tambah Data (Ajax)</button> 
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
                            <select class="form-control" id="kategori_id" name="kategori_id" required>
                                <option value="">- Semua -</option> 
                                @foreach($kategori as $k) 
                                    <option value="{{ $k->kategori_id }}">{{ $k->kategori_nama }}</option> 
                                @endforeach 
                            </select> 
                            <small class="form-text text-muted">Kategori Barang</small> 
                        </div> 
                    </div> 
                </div> 
            </div> 
            <table class="table table-bordered table-sm table-striped table-hover" id="table-barang"> 
                        <thead> 
                            <tr>
                              <th>No</th>
                              <th>Kode Barang</th>
                              <th>Nama Barang</th>
                              <th>Harga Beli</th>
                              <th>Harga Jual</th>
                              <th>Kategori</th>
                              <th>Aksi</th>
                            </tr> 
                        </thead> 
                        <tbody></tbody> 
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
             
            var dataBarang; 
            $(document).ready(function(){ 
                dataBarang = $('#table-barang').DataTable({ 
                    processing: true,
                    serverSide: true, 
                    ajax: { 
                        "url": "{{ url('barang/list') }}", 
                        "dataType": "json", 
                        "type": "POST", 
                        "data": function (d) { 
                            d.kategori_id = $('#kategori_id').val(); 
                        } 
                    }, 
                    columns: [
                        { 
                            data: "DT_RowIndex",             
                            className: "text-center", 
                            orderable: false, 
                            searchable: false    
                        },{ 
                            data: "barang_kode",  
                            className: "", 
                            orderable: true, 
                            searchable: true 
                        },{ 
                            data: "barang_nama",  
                            className: "", 
                            orderable: true, 
                            searchable: true, 
                        },{ 
                            data: "harga_beli",  
                            className: "",  
                            orderable: true, 
                            searchable: false, 
                            render: function(data, type, row){ 
                                return new Intl.NumberFormat('id-ID').format(data); 
                            } 
                        },{ 
                            data: "harga_jual",  
                            className: "", 
                            orderable: true, 
                            searchable: false, 
                            render: function(data, type, row){ 
                                return new Intl.NumberFormat('id-ID').format(data); 
                            } 
            },{ 
                data: "kategori.kategori_nama",  
                className: "", 
                orderable: true, 
                searchable: false 
            },{ 
                data: "aksi",  
                className: "text-center", 
                orderable: false, 
                searchable: false 
            } 
        ] 
    }); 

    $('#kategori_id').on('change', function() {
        dataBarang.ajax.reload();
      })
}); 
</script> 
@endpush