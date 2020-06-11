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
							<a class="nav-link active" id="general_detail_tab" data-toggle="pill" href="#general_detail">General</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="activity_detail_tab" data-toggle="pill" href="#activity_detail">Activity</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="portfolio_detail_tab" data-toggle="pill" href="#portfolio_detail">Portfolio</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="settings_detail_tab" data-toggle="pill" href="#settings_detail">Settings</a>
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
						<div class="col-xl-4">
							<div class="card">
								<div class="card-body text-center">
									<p>
										Born in <b class="text-primary"> {{$star->country}} </b>
										in <b class="text-primary"> {{$star->birthday->toFormattedDateString()}} </b>
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

						<div class="col-lg-8">
							<div class="card">
								<div class="card-body">
									<div class="float-lg-right float-none eco-revene-history justify-content-end">
										<ul class="nav">
											<li class="nav-item">
												<a class="nav-link active" href="#">This Week</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#">Last Week</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#">Last Month</a>
											</li>
										</ul>
									</div>
									<h4 class="header-title mt-0">Revenue</h4>
									<canvas id="bar" class="drop-shadow w-100"  height="350"></canvas>
								</div><!--end card-body-->
							</div><!--end card-->
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

				<div class="tab-pane fade" id="activity_detail">
					<div class="row">
						<div class="col-lg-6">
							<div class="card">
								<div class="card-body">
									<h4 class="header-title mt-0 mb-4">Latest Activity</h4>
									<div class="slimscroll profile-activity-height">
										<div class="activity">
											<div class="activity-info">
												<div class="icon-info-activity">
													<i class="mdi mdi-checkbox-marked-circle-outline bg-soft-success"></i>
												</div>
												<div class="activity-info-text">
													<div class="d-flex justify-content-between align-items-center">
														<p class="text-muted mb-0 font-14 w-75"><span class="text-dark font-14">Donald</span>
															updated the status of <a href="" class="text-dark">Refund #1234</a> to awaiting customer response
														</p>
														<span class="text-muted">10 Min ago</span>
													</div>
												</div>
											</div>

											<div class="activity-info">
												<div class="icon-info-activity">
													<i class="mdi mdi-timer-off bg-soft-pink"></i>
												</div>
												<div class="activity-info-text">
													<div class="d-flex justify-content-between align-items-center">
														<p class="text-muted mb-0 font-14 w-75"><span class="text-dark font-14">Lucy Peterson</span>
															was added to the group, group name is <a href="" class="text-dark">Overtake</a>
														</p>
														<span class="text-muted">50 Min ago</span>
													</div>
												</div>
											</div>

											<div class="activity-info">
												<div class="icon-info-activity">
													<i class="mdi mdi-alert-decagram bg-soft-purple"></i>
												</div>
												<div class="activity-info-text">
													<div class="d-flex justify-content-between align-items-center">
														<p class="text-muted mb-0 font-14 w-75"><span class="text-dark font-14">Joseph Rust</span>
															opened new showcase <a href="" class="text-dark">Mannat #112233</a> with theme market
														</p>
														<span class="text-muted">10 hours ago</span>
													</div>
												</div>
											</div>

											<div class="activity-info">
												<div class="icon-info-activity">
													<i class="mdi mdi-clipboard-alert bg-soft-warning"></i>
												</div>
												<div class="activity-info-text">
													<div class="d-flex justify-content-between align-items-center">
														<p class="text-muted mb-0 font-14 w-75"><span class="text-dark font-14">Donald</span>
															updated the status of <a href="" class="text-dark">Refund #1234</a> to awaiting customer response
														</p>
														<span class="text-muted">Yesterday</span>
													</div>
												</div>
											</div>
											<div class="activity-info">
												<div class="icon-info-activity">
													<i class="mdi mdi-clipboard-alert bg-soft-secondary"></i>
												</div>
												<div class="activity-info-text">
													<div class="d-flex justify-content-between align-items-center">
														<p class="text-muted mb-0 font-14 w-75"><span class="text-dark font-14">Lucy Peterson</span>
															was added to the group, group name is <a href="" class="text-dark">Overtake</a>
														</p>
														<span class="text-muted">14 Nov 2019</span>
													</div>
												</div>
											</div>
											<div class="activity-info">
												<div class="icon-info-activity">
													<i class="mdi mdi-clipboard-alert bg-soft-info"></i>
												</div>
												<div class="activity-info-text">
													<div class="d-flex justify-content-between align-items-center">
														<p class="text-muted mb-0 font-14 w-75"><span class="text-dark font-14">Joseph Rust</span>
															opened new showcase <a href="" class="text-dark">Mannat #112233</a> with theme market
														</p>
														<span class="text-muted">15 Nov 2019</span>
													</div>
												</div>
											</div>
										</div><!--end activity-->
									</div><!--crypot dash activity-->
								</div><!--end card-body-->
							</div><!--end card-->
						</div><!--end col-->

						<div class="col-lg-6">
							<div class="card">
								<div class="card-body">
									<h4 class="header-title mt-0 mb-3">Sales Category</h4>
									<div class="row">
										<div class="col-4">
											<img src="../assets/images/widgets/sales-re.svg" alt="" class="img-fluid">
										</div>
										<div class="col-8 align-self-center">
											<p class="skill-detail">Contrary to popular belief, Lorem Ipsum is not simply random text.
												It has roots in a piece of classical Latin literature from 45 BC,
												making it over 2000 years old. Richard McClintock, a Latin professor
												at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words.
											</p>
										</div>
									</div>
									<div class="skills mt-4">
										<div class="skill-box">
											<h4 class="skill-title">Electronic</h4>
											<div class="progress-line">
												<span data-percent="78" style="width: 78%;">
													<span class="percent-tooltip">78%</span>
												</span>
											</div>
										</div>
										<div class="skill-box">
											<h4 class="skill-title">Clothes</h4>
											<div class="progress-line">
												<span data-percent="90" style="width: 90%;">
													<span class="percent-tooltip">90%</span>
												</span>
											</div>
										</div>
										<div class="skill-box">
											<h4 class="skill-title">Phones</h4>
											<div class="progress-line">
												<span data-percent="80" style="width: 80%;">
													<span class="percent-tooltip">80%</span>
												</span>
											</div>
										</div>
										<div class="skill-box">
											<h4 class="skill-title">Medicine</h4>
											<div class="progress-line">
												<span data-percent="95" style="width: 95%;">
													<span class="percent-tooltip">95%</span>
												</span>
											</div>
										</div>
									</div>
								</div>  <!--end card-body-->
							</div><!--end card-->
						</div><!--end col-->

					</div><!--end row-->
				</div><!--end education detail-->

				<div class="tab-pane fade" id="portfolio_detail">
					<div class="row">
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
					</div><!--end row-->
				</div><!--end portfolio detail-->

				<div class="tab-pane fade" id="settings_detail">
					<div class="row">
						<div class="col-lg-12 col-xl-9 mx-auto">
							<div class="card">
								<div class="card-body">
									<form method="post" class="card-box">
										<input type="file" id="input-file-now-custom-1" class="dropify" data-default-file="../assets/images/users/user-4.jpg"/>
										<span class="input-icon icon-right">
											<textarea rows="4" class="form-control" placeholder="Post a new message"></textarea>
										</span>
										<div class="float-right my-3">
											<a class="btn btn-sm btn-gradient-primary px-4 mb-0">Send</a>
										</div>
										<ul class="list-inline mt-1">
											<li class="list-inline-item">
												<a href="#"><i class=" fas fa-video font-18 mr-2 mt-2 text-primary"></i></a>
											</li>
											<li class="list-inline-item">
												<a href="#"><i class="fas fa-camera  font-18 mt-2 text-primary"></i></a>
											</li>
										</ul>
									</form>

									<div class="">
										<form class="form-horizontal form-material mb-0">
											<div class="form-group">
												<input type="text" placeholder="Full Name" class="form-control">
											</div>

											<div class="form-group row">
												<div class="col-md-4">
													<input type="email" placeholder="Email" class="form-control" name="example-email" id="example-email">
												</div>
												<div class="col-md-4">
													<input type="password" placeholder="password" class="form-control">
												</div>
												<div class="col-md-4">
													<input type="password" placeholder="Re-password" class="form-control">
												</div>
											</div>
											<div class="form-group row">
												<div class="col-md-6">
													<input type="text" placeholder="Phone No" class="form-control">
												</div>
												<div class="col-md-6">
													<select class="form-control">
														<option>London</option>
														<option>India</option>
														<option>Usa</option>
														<option>Canada</option>
														<option>Thailand</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<textarea rows="5" placeholder="Message" class="form-control"></textarea>
												<button class="btn btn-gradient-primary btn-sm px-4 mt-3 float-right mb-0">Update Profile</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div> <!--end col-->
					</div><!--end row-->
				</div><!--end settings detail-->
			</div><!--end tab-content-->

		</div><!--end col-->
	</div><!--end row-->

@endsection


@section('charts')


@endsection
