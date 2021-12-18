@extends('layouts.tekshiruv')

@section('content')
    <table class="table table-bordered  yajra-datatable" id="myTable">
        <thead>
            <tr>
                <th>Id</th>
                <th>Tovar Kodi</th>
                <th>Nomi</th>
                <th>Miqdori</th>
                <th>USD</th>
                <th>UZS</th>
                <th>Action</th>
               
                
            </tr>
        </thead>
    </table>
    <?php $filial_name = 'buvayda'; ?>
@endsection

@section('scripts')
    <script type="text/javascript">
    $(function () {
        
        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('datatables.getusers') }}",
                data: function(data){
                    data.params = {
                        filial_name:"{{ $filial_name }}"
                    }   
                //    console.log(data);
                }
                
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'tovar_kodi', name: 'tovar_kodi'},
                {data: 'tovar_nomi', name: 'tovar_nomi'},
                {data: 'miqdori', name: 'miqdori'},
                {data: 'kirimnarx_usd', name: 'kirimnarx_usd'},
                {data: 'kirimnarx_uzs', name: 'kirimnarx_uzs'},
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: true, 
                    searchable: true
                },
            ]
        });
    });
    
    </script>

@endsection