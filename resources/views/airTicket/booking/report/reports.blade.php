@extends('admin.master')
@section('air_ticket', 'active submenu')
@section('air_collapse', 'show')
@section('report','active')
@section('content')
    @push('style')
        <style>
            /* .reportrange-container {
                        background: #fff;
                        cursor: pointer;
                        padding: 5px 10px;
                        border: 1px solid #ccc;
                        width: 100%;
                        display: flex;
                        align-items: center;
                    }

                    .reportrange-container input {
                        border: none;
                        outline: none;
                        width: 100%;
                        padding-left: 8px;
                    }

                    .reportrange-container i.fa-calendar {
                        margin-right: 8px;
                    }

                    .reportrange-container i.fa-caret-down {
                        margin-left: 8px;
                    } */
        </style>
    @endpush
    <div class="col-md-12">
        <div class="card">
            <div class="row align-items-center justify-content-center">
                <div class="col-3 d-flex gap-3" style="margin-top: 10px">
                    <h3>Airticket Booking Reports</h3>
                </div>
            </div>
            <div class="row align-items-center justify-content-between">
                <div class="col-3 d-flex gap-3" style="margin-left: 10px">
                    <div class="reportrange-container">
                        <i class="fa fa-calendar"></i>
                        <input type="text" id="reportrange" name="date_range" class="datevalue">
                        <input type="hidden" value="" name="filterdate" class="filterdate" placeholder="">
                    </div>
                    <button type="button" class="btn btn-secondary ms-auto datefilter d-flex align-items-center gap-2">
                        <i class="fa fa-plus"></i>
                        Filter
                    </button>
                </div>
                <div class="col-3">
                    <div class="form-group d-flex align-items-center gap-2">
                        <label for="">search</label>
                        <input type="text" class="form-control searchData">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive showtable">
                    @include('airTicket.booking.report.list')
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        // Function to update the data table
        function updateDataTable() {
            const params = {
                searchData: $(".searchData").val(),
                date_range: $(".filterdate").val(),
                page: $(".page-item.active .page-link").text(),
            };
            const url = "{{ route('airticket.booking.reports') }}?" + $.param(params);

            $.get(url, function(response) {
                if (response) {
                    $(".showtable").html(response);
                    $('.pagination').html(response?.pagination);
                }
            });
        }
        $(document).on("keyup", ".searchData", updateDataTable);
        $(document).on("click", ".pagination li a", function(e) {
            e.preventDefault();
            $(this).parent().addClass("active").siblings().removeClass("active");
            updateDataTable();
        });
        $(document).on("click", ".datefilter", function(e) {
            var datevalue = $(".datevalue").val();
            $(".filterdate").val(datevalue);
            updateDataTable();
        });
    </script>
@endpush
