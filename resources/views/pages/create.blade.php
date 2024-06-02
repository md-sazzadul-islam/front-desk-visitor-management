@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-success" style="background-color: #ffffffa8">
                <div class="panel-heading">Insert Visitor</div>
                <form action="{{ route('visitors.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <label class="label-control">Visitor Mobile No.</label>
                                <input onkeyup="get_visitor_list(this.value);" type="text" name="visitor_mobile"
                                    class="form-control" placeholder="Visitor Mobile No" required="required">
                            </div>
                            <div class="col-md-4">
                                <label class="label-control">Date</label>
                                <input type="test" id="selector" name="date" class="form-control " placeholder="Date"
                                    required="required">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="label-control">Visitor Name</label>
                                <input type="text" name="vname" class="form-control vname"
                                    placeholder="Please input Visitor Name" required="required">
                            </div>
                            <div class="col-md-6">
                                <label class="label-control">Company</label>
                                <input type="text" name="company" class="form-control company"
                                    placeholder="Please input company">

                            </div>
                        </div>
                        <label class="label-control">Address</label>
                        <textarea name="address" class="form-control address" placeholder="Please input address"></textarea>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="label-control">To Whom</label>

                                <select name="employee" class="form-control select2">
                                    <option value=''>Please choose employee</option>
                                    <?php
								foreach ($users as $key => $value) {?>
                                    <option value='{{ $value->name }}'>{{ $value->name }}} - {{ $value->department }}
                                    </option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-md-6">

                                <label class="label-control">Purpose</label>
                                <input type="text" name="purpose" class="form-control" placeholder="Please input purpose"
                                    required="required">

                            </div>
                        </div>



                        <div class="row">

                            <div class="col-md-6">
                                <label class="label-control">Photo id</label>
                                <input type="text" name="nid" class="form-control nid"
                                    placeholder="Please input Photo id">

                            </div>
                            <div class="col-md-6">
                                <label class="label-control">Visitor Card No</label>
                                <input type="text" name="card_no" class="form-control"
                                    placeholder="Please input Visitor Card No">
                            </div>
                        </div>




                        <label class="label-control">Time</label>
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" placeholder="In Time" name="in_time"
                                    class="form-control datetimepicker3" required="required">
                            </div>
                            <div class="col-md-4">
                                <input type="text" placeholder="Out Time" name="out_time"
                                    class="form-control datetimepicker3" required="required">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="label-control">Visitor Comments</label>
                                <input type="text" name="comments" placeholder="Please input Visitor Comments"
                                    class="form-control">

                            </div>
                            <div class="col-md-3">
                                <label class="label-control">Visitor Picture</label>
                                <input type=button value="Take Image" onClick="take_snapshot()">
                                <input type="hidden" name="visitor_image" class="image-tag">

                            </div>
                        </div>

                        <div class="row" style="padding-top: 10px">
                            <div class="col-md-12">
                                <button type="submit" name="submit" class="btn btn-success">Insert</button>
                            </div>
                        </div>

                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success" style="background-color: #ffffffa8">
                    <div class="panel-heading">Previous Records</div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>In time</th>
                                    <th>Out time</th>
                                </tr>
                            </thead>
                            <tbody id="visitor_list">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div id="results" class="my_camera">Your captured image will appear here...</div>
            </div>
        </div>

    </div>
    </div>
@stop
@section('myjsfile')
    <script type="text/javascript" src="{{ asset('js/webcam.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".select2").select2();
        });
        $(function() {
            $('.datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
        $("#selector").datetimepicker({
            format: 'YYYY-MM-DD'
        });

        function get_visitor_list(number) {
            // console.log(number);
            // spinner();
            if (number.length > 7) {
                $.ajax({
                    type: 'POST',
                    url: '{{ URL('/get_visitor_list') }}',
                    data: {
                        number: number,
                        _token: "{{ csrf_token() }}"
                    },
                    dataType: 'html',
                    success: function(data) {
                        $('#visitor_list').html(data);
                        if (data != '') {
                            $.ajax({
                                type: 'POST',
                                url: '{{ URL('/get_visitor_data') }}',
                                data: {
                                    number: number,
                                    _token: "{{ csrf_token() }}"
                                },
                                dataType: 'json',
                                success: function(data) {
                                    // console.log(data);
                                    $('.vname').val(data.vname);
                                    $('.company').val(data.company);
                                    $('.address').val(data.address);
                                    $('.nid').val(data.nid);
                                }
                            });

                        } else {
                            $('.vname').val('');
                            $('.company').val('');
                            $('.address').val('');
                            $('.nid').val('');
                        }

                    },
                    error: function(textStatus, errorThrown) {

                    }
                });
            } else {
                $('#visitor_list').html('');
            }
        }
        Webcam.set({
            width: 300,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('.my_camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                $('#results').html('<img src="' + data_uri + '"/>');
            });
        }
    </script>

@stop
