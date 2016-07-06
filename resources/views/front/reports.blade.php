@extends('front.layout')

@section('title', 'Reports')

@section('description', 'Mid-year reports on Citizenship and Immigration Canada (CIC) Express Entry System')

@section('main')

	<!-- Post -->
	<article class="post">
		<header>
			<div class="title">
				<h2><span class="cred">First mid-year report</span></h2>
				<p>This report, based on a data extract as of July 6, 2015 is a snapshot of the Citizenship and Immigration Canada (CIC) Express Entry system for the initial six months of implementation.</p>
			</div>
			<div class="meta">
				<h3>EEfacts.com</h3>
				<time class="published" datetime="6/7/2015">July 6, 2015</time>
			</div>
		</header>
			<p>
				<div id="profiles"></div>
			</p>
			<p>
				<div id="pool"></div>
			</p>
			<p>
				<div id="programs"></div>
			</p>
		<footer>
			<ul class="icons">
				<li>
				<a href="https://twitter.com/share" class="twitter-share-button" data-via="eefacts"></a>
				
				</li>
				<li>
					<div class="fb-like" data-href="http://eefacts.com/reports" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true">
						
					</div>
				</li>
				<li>
					<div class="g-plusone" data-size="tall"></div>
				</li>
			</ul>
		</footer>
	</article>
	
@endsection

@section('scripts')
	@parent
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/heatmap.js"></script>
	<script src="https://code.highcharts.com/modules/treemap.js"></script>
	<script src="js/reports.js"></script>
@endsection