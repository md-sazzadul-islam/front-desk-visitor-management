<!-- design and development by md.masudrana -->
@extends('layouts.app')

@section('content')


    <!-- display success message -->
    @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

    <div class="panel panel-success">
        <div class="panel-heading">Today's Visitor</div>

        <div class="panel-body">

            <div class='table-responsive'>
                <table class='datatable mdl-data-table dataTable table table-bordered table-hover'>
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Mobile No.</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Address</th>
                            <th>In Time</th>
                            <th>Out Time</th>
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
            var table = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('today_serverSide') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
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

                ]
            });
        });
    </script>
@stop
