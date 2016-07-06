@extends('front.layout')

@section('title', 'About US Page')

@section('description', 'About US and Contact Information Page of eefacts.com')

@section('main')

	<!-- Post -->
	<article class="post">
		<header>
			<div class="title">
				<h2><span class="cred">About us</span></h2>
				<p>Your source of information on the Express Entry System.</p>
			</div>
			<div class="meta">
				<h3><a href="/">EEfacts.com</a></h3>
			</div>
		</header>
			<p>
				<a href="/">EEFacts.com</a> aims to offer you well documented news, reports, statistics, web links and graphs related to the Express Entry System and to become the favorite source of information for candidates.
			</p>
			<p>
				Express Entry is an online application management system introduced by Citizenship and Immigration Canada (CIC) in January 2015. Express Entry applies to the following economic immigration programs: the <em>Federal Skilled Worker Program</em>, the <em>Federal Skilled Trades Program</em> and the <em>Canadian Experience Class</em>. Provincial and territorial governments in Canada will also be able to select people from the pool for the <em>Provincial Nominee Program</em>.
			</p>
			<p>
				Feel free to contact us with questions, partnership proposals, other inquiries, or just to say “hi!”. Your comments and suggestions are important to us. All suggestions you will give will be highly appreciated. Thank you so much! 
			</p>
			<p>
				You can contact us via <icon class="icon fa-envelope"> e-mail </icon>(<img src="/images/email.png" height="12px">),  <a href="https://www.facebook.com/eefacts/" target="_blank" class="icon fa-facebook"> Facebook</a> or <a href="https://twitter.com/eefacts" target="_blank" class="icon fa-twitter"> Twitter</a>.
			</p>
		<footer>
			<ul class="icons">
				<li>
				<a href="https://twitter.com/share" class="twitter-share-button" data-via="eefacts"></a>
				
				</li>
				<li>
					<div class="fb-like" data-href="http://eefacts.com/about" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true">
						
					</div>
				</li>
				<li>
					<div class="g-plusone" data-size="tall"></div>
				</li>
			</ul>
		</footer>
	</article>
	
@endsection