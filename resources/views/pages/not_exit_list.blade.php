<!-- design and development by md.masudrana -->
@extends('layouts.app')

@section('content')


    <!-- display success message -->
    @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

    <div class="panel panel-success">
        <div class="panel-heading">Not Exit Visitor</div>

        <div class="panel-body">

            <div class='table-responsive'>
                <table class='datatable mdl-data-table dataTable table table-bordered table-hover'>
                    <thead>
                        <tr>
                            <th>Mobile No.</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Card No</th>
                            <th>Company</th>
                            <th>Address</th>
                            <th>In Time</th>
                            <th>Out Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
@section('myjsfile')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('not_exit_serverSide') }}',

                columns: [{
                        data: 'visitor_mobile',
                        name: 'visitor_mobile'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'vname',
                        name: 'vname'
                    },
                    {
                        data: 'card_no',
                        name: 'card_no'
                    },
                    {
                        data: 'company',
                        name: 'company'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },

                    {
                        data: 'in_time',
                        name: 'in_time'
                    }, {
                        data: 'out_time',
                        name: 'out_time'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                createdRow: function(row, data, index) {
                    if (data['10'] == 0) {
                        $('td', row).eq(6).addClass('success');
                    } else {
                        $('td', row).eq(6).addClass('danger');
                    }
                }
            });
        });
    </script>
@stop
