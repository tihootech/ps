@extends('layouts.app')
@section('title') {{$star->name}} @endsection
@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body met-pro-bg" @if($star->cover) style="background-image:url({{asset($star->cover->path)}})" @endif>
					<div class="met-profile">
						<div class="row">
							<div class="col-lg-4 align-self-center mb-3 mb-lg-0">
								<div class="met-profile-main">
									<div class="met-profile-main-pic">
										@if ($star->profile)
											<img src="{{asset($star->profile->path)}}" alt="{{$star->name}}" class="rounded-circle">
										@endif
										<a class="fro-profile_main-pic-change" href="{{route('image.upload_form', $star)}}">
											<i class="fas fa-camera"></i>
										</a>
									</div>
									<div class="met-profile_user-detail">
										<h5 class="met-user-name">{{$star->name}}</h5>
										<p class="mb-0 met-user-name-post">{{nf($star->points->sum('amount'))}} points</p>
									</div>
								</div>
							</div><!--end col-->
							<div class="col-lg-4 ml-auto">
								<ul class="list-unstyled personal-detail">
									<li>
										<i class="mdi mdi-account-arrow-right mr-2 text-primary font-18"></i>
										<b> This Month Rank </b> : {{$star->rank('month')}}
									</li>
									@for ($i=2019; $i <= now()->year; $i++)
										<li>
											<i class="mdi mdi-account-arrow-right mr-2 text-primary font-18"></i>
											<b> Rank In {{$i}} </b> : {{$star->rank('year', $i)}}
										</li>
									@endfor
								</ul>
								{{-- <div class="button-list btn-social-icon">
									<button type="button" class="btn btn-blue btn-circle">
										<i class="fab fa-facebook-f"></i>
									</button>

									<button type="button" class="btn btn-secondary btn-circle ml-2">
										<i class="fab fa-twitter"></i>
									</button>

									<button type="button" class="btn btn-pink btn-circle  ml-2">
										<i class="fab fa-dribbble"></i>
									</button>
								</div> --}}
							</div>
						</div>
					</div>
				</div>

				<div class="card-body">
					<ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="general_detail_tab" data-toggle="pill" href="#general_detail">
								<i class="mdi mdi-account-card-details mr-1"></i> General
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="recent_points_tab" data-toggle="pill" href="#recent_points">
								<i class="mdi mdi-format-list-bulleted mr-1"></i> Recent Points
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="awards_tab" data-toggle="pill" href="#awards">
								<i class="mdi mdi-trophy-award mr-1"></i> Awards
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="images_tab" data-toggle="pill" href="#images">
								<i class="mdi mdi-folder-image mr-1"></i> Images
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="edit_tab" data-toggle="pill" href="#edit">
								<i class="mdi mdi-pencil mr-1"></i> Edit
							</a>
						</li>
					</ul>
				</div><!--end card-body-->
			</div><!--end card-->
		</div><!--end col-->
	</div><!--end row-->
	<div class="row">
		<div class="col-12">
			<div class="tab-content detail-list" id="pills-tabContent">
				<div class="tab-pane fade show active" id="general_detail">
					<div class="row">
						<div class="col-lg-3">
							<div class="card">
								<div class="card-body text-center">
									<p>
										Born in <b class="text-primary"> {{$star->country}} </b>
										in <b class="text-primary"> {{$star->birthday ? $star->birthday->toFormattedDateString() : '-'}} </b>
										and she's <b class="text-primary"> {{$star->age}} </b> years old.
										<br>
										Persian birthdate is : <b class="text-primary"> {{pdate($star->birthday)}} </b>
										<br>
										She was discovered in : <b class="text-primary"> {{pdate($star->created_at)}} </b>
										<hr>
										<b class="text-danger"> GAwards </b>
										<div class="mt-2">
											@if ($star->gawards->count())
												@foreach ($star->gawards as $award)
													<span class="bg-danger d-inline-block text-light m-1 px-2 py-1">
														{{$award->title}} ({{$award->year}})
													</span>
												@endforeach
											@else
												None
											@endif
										</div>
										<hr>
										<b class="text-success"> Beauty Awards </b>
										<div class="mt-2">
											@if ($star->bawards->count())
												@foreach ($star->bawards as $award)
													<span class="bg-success d-inline-block text-light m-1 px-2 py-1">
														{{$award->title}} ({{$award->year}})
													</span>
												@endforeach
											@else
												None
											@endif
										</div>
									</p>
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<div class="table-responsive-lg">
										<table class="table">
											<thead>
												<tr>
													<th> Height </th>
													<th> Color </th>
													<th> Size </th>
													<th> Boobs </th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td> {{$star->height}} cm </td>
													<td> {{$star->color}} </td>
													<td> {{$star->size}} </td>
													<td> {{$star->boobs}} </td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-9">

							@for ($year_in_loop=2019; $year_in_loop <= now()->year; $year_in_loop++)
								<div class="card">
									<div class="card-body">
										<h4 class="header-title mt-0">Year {{$year_in_loop}}</h4>
										<canvas id="year-{{$year_in_loop}}" class="drop-shadow w-100" height="250"></canvas>
									</div>
								</div>
							@endfor

						</div>
					</div>

					<div class="card">
						<div class="card-body">
							@if ($star->awards->count())
								<div class="row justify-content-center">
									@foreach ($star->awards as $award)
										<div class="col-md-2 p-1">
											<div class="card text-dark text-center
												@if($award->type == 'gaward')
													bg-warning
												@elseif ($award->type == 'beauty')
													bg-success
												@else
													bg-info
												@endif
												">
												<div class="card-body">
													<p class="lead">{{$award->title}}</p>
													<hr>
													{{mn($award->month)}}, {{$award->year}}
												</div>
											</div>
										</div>
									@endforeach
								</div>
							@else
								<div class="alert alert-warning">
									No Awards Yet :(
								</div>
							@endif
						</div>
					</div>

				</div><!--end general detail-->

				<div class="tab-pane fade" id="awards">
					<div class="card">
						<div class="card-body">
							@include('includes.awards_table', ['awards' => $star->awards])
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="recent_points">
					<div class="row">
						<div class="col-lg-8">
							<div class="card">
								<div class="card-body">
									<h4 class="header-title mt-0 mb-4">Latest Points</h4>
									<div class="slimscroll profile-activity-height">
										<div class="activity">
											<!--
												bg-soft-success
												bg-soft-pink
												bg-soft-purple
												bg-soft-warning
												bg-soft-secondary
												bg-soft-info
											-->
											@foreach ($star->latest_points as $point)
												<div class="activity-info">
													<div class="icon-info-activity">
														@if ($point->type == 'instagram')
															<i class="mdi mdi-instagram bg-soft-pink"></i>
														@elseif ($point->type == 'master')
															<i class="mdi mdi-charity bg-soft-info"></i>
														@elseif ($point->type == 'kid')
															<i class="mdi mdi-face bg-soft-purple"></i>
														@elseif ($point->type == 'cloth')
															<i class="mdi mdi-human-female bg-soft-warning"></i>
														@elseif ($point->type == 'dream')
															<i class="mdi mdi-diamond bg-soft-danger"></i>
														@else
															<i class="mdi mdi-checkbox-marked-circle-outline bg-soft-success"></i>
														@endif
													</div>
													<div class="activity-info-text">
														<div class="d-flex justify-content-between align-items-center">
															<p class="mb-0 font-14 w-75">
																<span class="text-dark font-14">{{$star->name}}</span>
																gained <a href="{{route('point.edit', 3)}}" class="text-primary">{{nf($point->amount)}}</a> points
																as <b> {{$point->type}} </b>.
																{{$point->created_at->format('Y-m-d')}},
																{{$point->created_at->format('H:i')}}
															</p>
															<span class="text-muted">{{$point->created_at->diffForHumans()}}</span>
														</div>
													</div>
												</div>
											@endforeach


										</div><!--end activity-->
									</div><!--crypot dash activity-->
								</div><!--end card-body-->
							</div><!--end card-->
						</div><!--end col-->

						<div class="col-lg-4">
							<div class="card">
								<div class="card-body">
									<div class="skills">
										@foreach ($star->points_percents() as $base => $val)
											<div class="skill-box">
												<h4 class="skill-title"> {{$base}} <small class="text-info">({{nf($val['amount'])}})</small> </h4>
												<div class="progress-line">
													<span data-percent="78" style="width: {{$val['percent']}}%;">
														<span class="percent-tooltip">{{$val['percent']}}%</span>
													</span>
												</div>
											</div>
										@endforeach
									</div>
									<hr>
									<div class="text-center">
										<a href="{{route('point.index')}}?star={{$star->id}}" class="btn btn-primary"> All Her Points </a>
									</div>
								</div>  <!--end card-body-->
							</div><!--end card-->
						</div><!--end col-->

					</div><!--end row-->
				</div><!--end education detail-->

				<div class="tab-pane fade" id="images">
					<div class="card">
						<div class="card-body">
							Under Constructions...
						</div>
					</div>
					{{-- <div class="row">
						<div class="col-lg-8">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<ul class="col container-filter categories-filter mb-0" id="filter">
											<li><a class="categories active" data-filter="*">All</a></li>
											<li><a class="categories" data-filter=".branding">Branding</a></li>
											<li><a class="categories" data-filter=".design">Design</a></li>
											<li><a class="categories" data-filter=".photo">Photo</a></li>
											<li><a class="categories" data-filter=".coffee">coffee</a></li>
										</ul>
									</div><!-- End portfolio  -->
								</div><!--end card-body-->
							</div><!--end card-->

							<div class="card">
								<div class="card-body">
									<div class="row container-grid nf-col-3  projects-wrapper">
										<div class="col-lg-4 col-md-6 p-0 nf-item branding design coffee spacing">
											<div class="item-box">
												<a class="cbox-gallary1 mfp-image" href="../assets/images/small/img-1.jpg" title="Consequat massa quis">
													<img class="item-container " src="../assets/images/small/img-1.jpg" alt="7" />
													<div class="item-mask">
														<div class="item-caption">
															<h5 class="text-white">Consequat massa quis</h5>
															<p class="text-white">Branding, Design, Coffee</p>
														</div>
													</div>
												</a>
											</div><!--end item-box-->
										</div><!--end col-->

										<div class="col-lg-4 col-md-6 p-0 nf-item photo spacing">
											<div class="item-box">
												<a class="cbox-gallary1 mfp-image" href="../assets/images/small/img-2.jpg" title="Vivamus elementum semper">
													<img class="item-container mfp-fade" src="../assets/images/small/img-2.jpg" alt="2" />
													<div class="item-mask">
														<div class="item-caption">
															<h5 class="text-light">Vivamus elementum semper</h5>
															<p class="text-light">Photo</p>
														</div>
													</div>
												</a>
											</div><!--end item-box-->
										</div><!--end col-->

										<div class="col-lg-4 col-md-6 p-0 nf-item branding coffee spacing">
											<div class="item-box">
												<a class="cbox-gallary1 mfp-image" href="../assets/images/small/img-3.jpg" title="Quisque rutrum">
													<img class="item-container" src="../assets/images/small/img-3.jpg" alt="4" />
													<div class="item-mask">
														<div class="item-caption">
															<h5 class="text-light">Quisque rutrum</h5>
															<p class="text-light">Branding, Design, Coffee</p>
														</div>
													</div>
												</a>
											</div><!--end item-box-->
										</div><!--end col-->

										<div class="col-lg-4 col-md-6 p-0 nf-item branding design spacing">
											<div class="item-box">
												<a class="cbox-gallary1 mfp-image" href="../assets/images/small/img-4.jpg" title="Tellus eget condimentum">
													<img class="item-container" src="../assets/images/small/img-4.jpg" alt="5" />
													<div class="item-mask">
														<div class="item-caption">
															<h5 class="text-light">Tellus eget condimentum</h5>
															<p class="text-light">Design</p>
														</div>
													</div>
												</a>
											</div><!--end item-box-->
										</div><!--end col-->

										<div class="col-lg-4 col-md-6 p-0 nf-item branding design spacing">
											<div class="item-box">
												<a class="cbox-gallary1 mfp-image" href="../assets/images/small/img-5.jpg" title="Nullam quis ant">
													<img class="item-container" src="../assets/images/small/img-5.jpg" alt="6" />
													<div class="item-mask">
														<div class="item-caption">
															<h5 class="text-light">Nullam quis ant</h5>
															<p class="text-light">Branding, Design</p>
														</div>
													</div>
												</a>
											</div><!--end item-box-->
										</div><!--end col-->

										<div class="col-lg-4 col-md-6 p-0 nf-item photo spacing">
											<div class="item-box">
												<a class="cbox-gallary1 mfp-image" href="../assets/images/small/img-6.jpg" title="Sed fringilla mauris">
													<img class="item-container" src="../assets/images/small/img-6.jpg" alt="1" />
													<div class="item-mask">
														<div class="item-caption">
															<h5 class="text-light">Sed fringilla mauris</h5>
															<p class="text-light">Photo</p>
														</div>
													</div>
												</a>
											</div><!--end item-box-->
										</div><!--end col-->
									</div><!--end row-->
								</div><!--end card-body-->
							</div><!--end card-->
						</div><!--end col-->
						<div class="col-lg-4">
							<div class="card ">
								<div class="card-body">
									<div class="text-center">
										<h4><i class="fas fa-quote-left text-primary"></i></h4>
									</div>
									<div id="carouselExampleFade2" class="carousel slide" data-ride="carousel">
										<div class="carousel-inner">
											<div class="carousel-item">
												<div class="text-center">
													<p class="text-muted px-4">
														It is a long established fact that a reader will be distracted by
														the readable content of a page when looking at its layout.
														The point of using Lorem Ipsum is that it has a more-or-less
														normal distribution of letters, as opposed to using.
													</p>
													<div class="">
														<img src="../assets/images/users/user-10.jpg" alt="" class="rounded-circle thumb-lg mb-2">
														<p class="mb-0 text-primary"><b>- Mary K. Myers</b></p>
														<small class="text-muted">CEO Facebook</small>
													</div>
												</div>
											</div>
											<div class="carousel-item active">
												<div class="text-center">
													<p class="text-muted px-4">
														Where does it come from?
														Contrary to popular belief, Lorem Ipsum is not simply random text.
														It has roots in a piece of classical Latin literature from 45 BC,
														making it over 2000 years  popular belief,old.
													</p>
													<div class="">
														<img src="../assets/images/users/user-4.jpg" alt="" class="rounded-circle  thumb-lg mb-2">
														<p class="mb-0 text-primary"><b>- Michael C. Rios</b></p>
														<small class="text-muted">CEO Facebook</small>
													</div>
												</div>
											</div>
											<div class="carousel-item">
												<div class="text-center">
													<p class="text-muted px-4">
														There are many variations of passages of Lorem Ipsum available,
														but the majority have suffered alteration in some form, by injected humour,
														or randomised words which don't look even slightly believable.
														If you are going to use a passage of Lorem Ipsum.
													</p>
													<div class="">
														<img src="../assets/images/users/user-5.jpg" alt="" class="rounded-circle  thumb-lg mb-2">
														<p class="mb-0 text-primary"><b>- Lisa D. Pullen</b></p>
														<small class="text-muted">CEO Facebook</small>
													</div>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div><!--end row--> --}}
				</div><!--end portfolio detail-->

				<div class="tab-pane fade" id="edit">
					@include('includes.edit_star')
				</div>


			</div><!--end tab-content-->

		</div><!--end col-->
	</div><!--end row-->

@endsection

@section('charts')

	@for ($year_in_loop=2019; $year_in_loop <= now()->year; $year_in_loop++)

		@php
			$untill = ($year_in_loop == now()->year) ? now()->month : 12;
		@endphp
		<script>
			var ctx = document.getElementById('year-{{$year_in_loop}}');
			var colors = [
				@for ($i=1; $i <= $untill; $i++)
					'#3490DC',
				@endfor
			];
			var myChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: [
						@for ($i=1; $i <= $untill; $i++)
							'{{mn($i)}}',
						@endfor
					],
					datasets: [{
						label: 'Rank In That Month',
						fill : false,
						borderColor: "#3490DC",
						pointBackgroundColor: "#fff",
						pointBorderColor: "#3490DC",
						pointHoverBackgroundColor: "#3490DC",
						pointHoverBorderColor: "#3490DC",
						data: [
							@for ($i=1; $i <= $untill; $i++)
								-{{$star->rank('month', $year_in_loop, $i)}},
							@endfor
						],
						borderWidth: 2
					},
					{
						label: 'Rank In General',
						fill : false,
						borderColor: "#E3342F",
						pointBackgroundColor: "#fff",
						pointBorderColor: "#E3342F",
						pointHoverBackgroundColor: "#E3342F",
						pointHoverBorderColor: "#E3342F",
						data: [
							@for ($i=1; $i <= $untill; $i++)
								-{{$star->rank('general', $year_in_loop, $i)}},
							@endfor
						],
						borderWidth: 2
					}
				]
				},
				options: {
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true
							}
						}]
					}
				}
			});
		</script>
	@endfor

@endsection
