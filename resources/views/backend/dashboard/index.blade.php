@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
	<!-- breadcrumb -->
	<div class="breadcrumb-header justify-content-between">
		<div class="left-content">
			<div>
			  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"> Welcome {{auth()->user()->name}}</h2>
			</div>
		</div>
	</div>
	<!-- /breadcrumb -->
@endsection
@section('content')
				<!-- row -->
<div class="row row-sm">
	<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-success-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">Count Albums</h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 ml-5 text-white">{{$albums}}</h4>
                        </div>
                        <div class="">
							<h4 class="tx-20 font-weight-bold mb-1 mr-5 ml-5 text-dark">{{$publicalbums}}</h4>
						</div>
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1  mr-5  text-danger">{{$privatealbums}}</h4>
						</div>

					</div>
				</div>
			</div>
		</div>
    </div>
	<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-warning-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">Count Users </h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$users}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    @can('view admins')
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
		<div class="card overflow-hidden sales-card bg-primary-gradient">
			<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
				<div class="">
					<h6 class="mb-3 tx-12 text-white">Count Admins </h6>
				</div>
				<div class="pb-0 mt-0">
					<div class="d-flex">
						<div class="">
							<h4 class="tx-20 font-weight-bold mb-1 text-white">{{$admins}}</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    @endcan
</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">({{$albums}}) Albums</div>
            <div class="card-body">
                <canvas id="albums"></canvas>
            </div>
        </div>
    </div>
</div>

  </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
var ctx2 = document.getElementById('albums').getContext('2d');


var chart2 = new Chart(ctx2, {
    // The type of chart we want to create
    type: 'pie',

    // The data for our dataset
    data: {
        labels: ['Private Albums ', 'Public Albums'],
        datasets: [{
            label: 'Albums',
            backgroundColor:['red','green'],
            borderColor: 'rgb(255, 255, 255)',
            data: [{{$privatealbums}}, {{$publicalbums}}]
        }]
    },

    // Configuration options go here
    options: {
        legend: {
            labels: {
                // This more specific font property overrides the global property
                fontColor: 'black',
                fontSize:15,
            }
        }
    }
});
</script>
@endsection
