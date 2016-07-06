<!DOCTYPE HTML>
<!--
	Future Imperfect by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html lang="en">
	<head>
		<title>Express Entry Facts -  @yield('title')</title>
		<meta charset="utf-8" />
		@yield('rel')
		<meta name="description" content="@yield('description')">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="/css/ie8.css" /><![endif]-->
		<!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent -->
		<script type="text/javascript">
		    window.cookieconsent_options = {"message":"This website uses cookies to ensure you get the best experience on our website","dismiss":"Got it!","learnMore":"More info","link":null,"theme":"dark-bottom"};
		</script>

		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js"></script>
		<!-- End Cookie Consent plugin -->

	</head>
	<body>
		<div id="fb-root"></div>
			<script>
				(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=956614827704465";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script>
			<script src="https://apis.google.com/js/platform.js" async defer></script>
  
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<h1><span class="cred">Express Entry Facts</span></h1>
						<nav class="links">
							<ul>
								<li><a href="/">Home</a></li>
								<li><a href="/news">News</a></li>
								<li><a href="/stats">Statistics</a></li>
								<li><a href="/reports">Reports</a></li>
								<li><a href="/useful">Useful</a></li>
								<li><a href="/about">About</a></li>
							</ul>
						</nav>
						<nav class="main">
							<ul>
								{{-- <li class="search">
									<a class="fa-search" href="#search">Search</a>
									<form id="search" method="get" action="#">
										<input type="text" name="query" placeholder="Search" />
									</form>
								</li> --}}
								<li class="menu">
									<a class="fa-bars" href="#menu">Menu</a>
								</li>
							</ul>
						</nav>
					</header>

				<!-- Menu -->
					<section id="menu">

						<!-- Search -->
							{{-- <section>
								<form class="search" method="get" action="#">
									<input type="text" name="query" placeholder="Search" />
								</form>
							</section> --}}

						<!-- Links -->
							<section>
								<ul class="links">
									<li>
										<a href="/">
											<h3>Home</h3>
											<p>Rounds of invitations</p>
										</a>
									</li>
									<li>
										<a href="/news">
											<h3>News</h3>
											<p>Latest news</p>
										</a>
									</li>
									<li>
										<a href="/stats">
											<h3>Statistics</h3>
											<p>Intersting statistics</p>
										</a>
									</li>
									<li>
										<a href="/reports">
											<h3>Reports</h3>
											<p>Mid-year reports</p>
										</a>
									</li>
									<li>
										<a href="/useful">
											<h3>Useful</h3>
											<p>Useful info and links</p>
										</a>
									</li>
									<li>
										<a href="/about">
											<h3>About</h3>
											<p>About EEFacts.com</p>
										</a>
									</li>
								</ul>
							</section>

						<!-- Actions -->
							{{-- <section>
								<ul class="actions vertical">
									<li><a href="#" class="button big fit">Log In</a></li>
								</ul>
							</section> --}}

					</section>

				{{-- Main --}}
					<div id="main">
						@yield('main')
					</div>

				<!-- Sidebar -->
					<section id="sidebar">

						<!-- Intro -->
							<section id="intro">
								<a href="/" class="logo"><img class="logo" src="/logo.png" alt="eefacts.com logo image" /></a>
								<header>
									<h2>Express Entry Facts</h2>
									<p>News, Reports and Statistics related to Express Entry</p>
								</header>
							</section>
						@if($lastDraw)
						<!-- Mini Posts -->
							<section>
								<div class="mini-posts">

									<!-- Mini Post -->
										<article class="mini-post">
											<header>
												<h3>Most recent draw</h3>									
													<time class="published" datetime="{{date("Y-m-d H:i:s", strtotime($lastDraw->valid_at))}}">{{date("F j, Y", strtotime($lastDraw->valid_at))}}</time>
												<ul class="cred alt">
													<li>{{$lastDraw->score}} points</li>
													<li>{{$lastDraw->invitations}} invitations issued</li>
												</ul>
											</header>
											
										</article>
								</div>
							</section>
						@endif
						<section>

						@foreach($lastPosts as $post)
						<!-- Posts List -->
							<section>
								<ul class="posts">
									<li>
										<article>
											<header>
												<h3><a href="/news/{{$post->slug}}">{{$post->title}}</a></h3>
												<time class="published" datetime="{{date("Y-m-d H:i:s", strtotime($post->published_at))}}">{{date("F j, Y", strtotime($post->published_at))}}</time>
											</header>
											<a href="/news/{{$post->slug}}" class="image"><img src="{{$post->picture}}" alt="{{$post->title}} article picture" /></a>
										</article>
									</li>
								</ul>
							</section>
						@endforeach
						<!-- About -->
							<section class="blurb">
								<h2>About</h2>
								<p>
									eefacts.com is your source of information on the Express Entry System. 
									Express Entry is used to manage applications for permanent residence under the following economic immigration programs:
									the Federal Skilled Worker Program, the Federal Skilled Trades Program and the Canadian Experience Class.
								</p>
								{{-- <ul class="actions">
									<li><a href="#" class="button">Read More</a></li>
								</ul> --}}
							</section>

						<!-- Footer -->
							<section id="footer">
								<ul class="icons">
									<li><a href="https://twitter.com/eefacts" class="fa-twitter" target="_blank"><span class="label">Twitter</span></a></li>
									<li><a href="https://www.facebook.com/eefacts/" class="fa-facebook" target="_blank"><span class="label">Facebook</span></a></li>
									{{-- <li><a href="#" class="fa-instagram"><span class="label">Instagram</span></a></li>
									<li><a href="#" class="fa-rss"><span class="label">RSS</span></a></li> --}}
									{{-- <li><a href="" class="fa-envelope"><span class="label">Email</span></a></li> --}}
								</ul>
								<p class="copyright">&copy; EEFACTS. </p>
							</section>

					</section>

			</div>

		<!-- Scripts -->
		@section('scripts')
			<script>
				!function(d,s,id)
				{var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
					if(!d.getElementById(id)){js=d.createElement(s);
						js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
						fjs.parentNode.insertBefore(js,fjs);}
				}(document, 'script', 'twitter-wjs');
			</script>
			<script src="/js/jquery.min.js"></script>
			<script src="/js/skel.min.js"></script>
			<script src="/js/util.js"></script>
			<!--[if lte IE 8]><script src="js/ie/respond.min.js"></script><![endif]-->
			<script src="/js/main.js"></script>
			<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			  ga('create', 'UA-71678246-1', 'auto');
			  ga('send', 'pageview');

			</script>
			<script type="text/javascript"> var infolinks_pid = 2689110; var infolinks_wsid = 0; </script> <script type="text/javascript" src="//resources.infolinks.com/js/infolinks_main.js"></script>
		@show
	</body>

</html>