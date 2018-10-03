@extends('layouts.admin')

@section('title')
<title>{{get_string('dashboard') . ' - ' . get_setting('site_name', 'site')}}</title>
@endsection

    @section('page_title')
        <h3 class="page-title mbot10">{{get_string('dashboard')}}</h3>
    @endsection
        @section('content')
            <div class="row mbot0">
                <div class="col s12">
                    <div class="col l3 m6 s12">
                        <div class="card">
                            <div class="card-content no-padding">
                                <div class="blue-card card-stats-body waves-effect">
                                    <div class="stats-icon right-align">
                                        <i class="medium material-icons">payment</i>
                                    </div>
                                    <div class="stats-text left-align">
                                        <strong class="counter">{{ $data['new_properties'] }}</strong><br>
                                        <span>{{get_string('new_listings')}}</span>
                                    </div>
                                </div>
                            </div><!--end .card-body -->
                        </div>
                    </div>
                    <div class="col l3 m6 s12">
                        <div class="card">
                            <div class="card-content no-padding">
                                <div class="blue-card card-stats-body waves-effect">
                                    <div class="stats-icon right-align">
                                        <i class="medium material-icons">info_outline</i>
                                    </div>
                                    <div class="stats-text left-align">
                                        <strong class="counter">{{ $data['new_visits'] }}</strong><br>
                                        <span>{{get_string('visits_today')}}</span>
                                    </div>
                                </div>
                            </div><!--end .card-body -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col l4 m12 s12 clearfix">
                <h3 class="page-title">{{get_string('latest_visits')}}</h3>
                <canvas id="visits-chart" width="420" height="297"></canvas>
            </div>
@endsection

@section('footer')
    <script src="{{URL::asset('assets/js/plugins/chart.min.js')}}"></script>
    <script>
        $(document).ready(function($) {
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            });

            // Generating chart
            Chart.defaults.global.legend.display = false;
            var ctx = $('#visits-chart');
            if(ctx.length){
                var myChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels:[
                                @foreach ($data['data_range'] as $date)
                                    "{{$date}}",
                                @endforeach
                            ],
                        datasets:[ {
                            label: "{{ get_string('data') }}",
                            backgroundColor: "rgba(0,150,136, 0.4)",
                            borderColor: "#009688",
                            pointBorderColor: "#009688",
                            pointBackgroundColor: "#009688",
                            pointHoverBackgroundColor: "#009688",
                            pointHoverBorderColor: "#009688",
                            pointBorderWidth: 1,
                            data: {{$data['visits_data'] }},
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    fontColor: '#009688',
                                    fontSize: 14,
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    fontColor: '#009688',
                                    fontSize: 14,
                                }
                            }]
                        }
                    }
                });
            }

            // Generating chart
            Chart.defaults.global.legend.display = false;
            var ctx = $('#booking-chart');
            if(ctx.length){
                var myChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels:[
                            @foreach ($data['data_range'] as $date)
                                    "{{$date}}",
                            @endforeach
                        ],
                        datasets:[ {
                            label: "{{ get_string('data') }}",
                            backgroundColor: "rgba(0,150,136, 0.4)",
                            borderColor: "#009688",
                            pointBorderColor: "#009688",
                            pointBackgroundColor: "#009688",
                            pointHoverBackgroundColor: "#009688",
                            pointHoverBorderColor: "#009688",
                            pointBorderWidth: 1,
                            data: {{$data['bookings_data'] }}
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    fontColor: '#009688',
                                    fontSize: 14,
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    fontColor: '#009688',
                                    fontSize: 14,
                                }
                            }]
                        }
                    }
                });
            }

            // Generating chart
            Chart.defaults.global.legend.display = false;
            var ctx = $('#purchases-chart');
            if(ctx.length){
                var myChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels:[
                            @foreach ($data['data_range'] as $date)
                                "{{$date}}",
                            @endforeach
                        ],
                        datasets:[ {
                            label: "{{ get_string('data') }}",
                            backgroundColor: "rgba(0,150,136, 0.4)",
                            borderColor: "#009688",
                            pointBorderColor: "#009688",
                            pointBackgroundColor: "#009688",
                            pointHoverBackgroundColor: "#009688",
                            pointHoverBorderColor: "#009688",
                            pointBorderWidth: 1,
                            data: {{$data['purchases_data'] }}
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    fontColor: '#009688',
                                    fontSize: 14,
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    fontColor: '#009688',
                                    fontSize: 14,
                                }
                            }]
                        }
                    }
                });
            }
        });
    </script>
@endsection
