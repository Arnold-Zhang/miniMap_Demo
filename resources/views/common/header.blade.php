<!-- Navigation -->
<nav class="navbar navbar-custom navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#map_navbar" aria-expanded="false">
			  <span class="sr-only">Toggle navigation</span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">Map Demo</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="map_navbar">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/">Home</a>
                </li>

                <li>
                    <a href="{{ route('signIn') }}">Sign In</a>
                </li>

				<li>
                    <a href="{{ route('users.create') }}">Sign Up</a>
                </li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->

	</div>
	<!-- /.container -->
</nav>
