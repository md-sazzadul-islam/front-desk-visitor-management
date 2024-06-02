@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div>{{ __('Dashboard') }}</div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                    <i class="ri-money-dollar-circle-fill align-middle"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="text-uppercase fw-medium fs-12 text-muted mb-1">Not Exit Visitors</p>
                                <h4 class="mb-0">{{ $not_exit }}</h4>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                    <i class="ri-money-dollar-circle-fill align-middle"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="text-uppercase fw-medium fs-12 text-muted mb-1">Today's Visitors</p>
                                <h4 class="mb-0">{{ $today_visitor }}</h4>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-light text-primary rounded-circle fs-3">
                                    <i class="ri-money-dollar-circle-fill align-middle"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="text-uppercase fw-medium fs-12 text-muted mb-1">Total Visitors</p>
                                <h4 class="mb-0">{{ $total_visitor }}</h4>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-body chart">

                        <div id="barchart_material" style="width: 100%; height: 350px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('myjsfile')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {


            var data = google.visualization.arrayToDataTable([

                ['Year', 'Visitor'],
                @php
                    for ($i = 1; $i <= 12; $i++) {
                        $month_name = date('F', strtotime(date('Y-' . $i . '-d')));
                        $value = $visitorPerMonth[$month_name]->total ?? 0;
                        echo "['" . $month_name . "'," . $value . '],';
                    }
                @endphp
            ]);

            var options = {
                chart: {
                    title: 'Monthly Visitor'
                },
                bars: 'vertical' // Required for Material Bar Charts.
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
@stop
