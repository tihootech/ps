<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link @if(rn() == 'home') active @endif" href="{{route('home')}}">
					<i class="material-icons">home</i> Home
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link @if(rn() == 'results') active @endif" href="{{route('results')}}">
					<i class="material-icons">assessment</i> Result
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link @if(rn() == 'point.index') active @endif" href="{{route('point.index')}}">
					<i class="material-icons">list</i> Recent Points
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link @if(rn() == 'star.index') active @endif" href="{{route('star.index')}}">
					<i class="material-icons">star</i> Stars List
				</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="material-icons">apps</i> More Actions
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{route('settings')}}">
						<i class="material-icons icon">settings</i>
						Settings
					</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="javascript:void" onclick="$('#logout-form').submit()">
						<i class="material-icons icon">lock</i>
						Logout
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
						@csrf
					</form>
				</div>
			</li>
		</ul>
		<form class="form-inline my-2 my-lg-0" action="{{route('home')}}">
			<input class="form-control mr-sm-2" type="search" placeholder="Search" id="header-search" name="search" autocomplete="off">
			<button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
		</form>
	</div>
</nav>
