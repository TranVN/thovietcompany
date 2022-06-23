<x-app-layout>
    @section('title')
        Quản Lý Thợ
    @endsection
    @section('content')
    
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="col-lg-12 card">
                <div class="main-card mb-2">
                    <div class="card-hearder">
                        <h5 class="card-title">Tìm thông tin khách hàng</h5></div>
                    </div>
                    <div class="card-body ">
                        <table class="mb-0 table table-hover" id="hihi" >
                            <thead>
                                <tr>
                                    <th class="col-1">Nội dung </th>
                                    <th class="col-1">Thời gian</th>
                                    <th class="col-1">Tên khách</th>
                                    <th class="col-1">Địa chỉ</th>
                                    <th class="col-1">Số điện thoại</th>
                                    <th class="col-1">Ghi chú</th>
                                    <th class="col-1">Thợ làm</th>
                                    <th class="col-1">Tổng chi</th>
                                    <th class="col-1">Tổng thu</th>
                                    <th class="col-1">Số phiếu thu</th>
                                </tr>
                            </thead>
                            <tbody class="text-center"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    
    
    <script>
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    </script>
    
    <script>
        $(document).ready( function () {
            
        var table = $('#hihi').DataTable({
    
            "ajaxSource": "{{url('getSearch')}}",
            "columns": [
                { 'data': 'work_content' },
                
                { 'data':  null,
                    render: function(data, row, type ){
                        if(data.warranty_period == data.date_book)
                        {
                            return data.date_book;
                        }
                        else if (data.warranty_period == '1t' || data.warranty_period == '1 t'  )
                        {
                            
                            return '1 tháng';
                        }
                        else if (data.warranty_period == '3t' || data.warranty_period == '3 t'  )
                        {
                            return '3 tháng';
                        }
                        else 
                            return data.warranty_period ;
                    } 
                },
                { 'data': 'name_cus' },
                { 'data': null,
                    render: function(data, row, type ){
                        return data.add_cus+ ' , '+data.des_cus;
                    }
                },
                
                { 'data': 'phone_cus' },
                { 'data': null,
                    render: function(data, row, type ){
                        if(data.note_cus == null)
                        {
                            return ' ';
                        }
                        else
                            return data.note_cus;
                    }
                },
                { 'data': 'worker_name' },
                { 'data': 'spending_total' },
                { 'data': 'income_total' },
                { 'data': 'seri_number' },
                  
                ],
                
            });
            if ( $.fn.dataTable.isDataTable( '#hihi' ) ) {
                table = $('#hihi').DataTable();
            }
            else {
                table = $('#hihi').DataTable( {
                    paging: false
                } );
            }
   
    $('#hihi thead th').each( function () {
    var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Tìm '+title+'"  style="max-width:100px;"/>' );
    } );
 
    // DataTable
    var table = $('#hihi').DataTable({
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.headers() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
});   
    </script>
</x-app-layout>
    