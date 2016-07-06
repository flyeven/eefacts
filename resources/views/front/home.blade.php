@extends('front.layout')

@section('title', 'Rounds of Invitations (Express Entry Draws)')

@section('description', 'Information website on the Citizenship and Immigration Canada (CIC) Express Entry System.')

@section('main')

	<!-- Post -->
	<article class="post">
		<header>
			<div class="title">
				<h2><span class="cred">Express Entry Draws</span></h2>
				<p>Rounds of invitations :: Number of invitations issued & CRS score of lowest-ranked candidate invited graph</p>
			</div>
			@if($lastDraw)
				<div class="meta">
					<h3>Most recent draw: </h3>
					<time class="published" datetime="{{date("Y-m-d H:i:s", strtotime($lastDraw->valid_at))}}">{{date("F j, Y", strtotime($lastDraw->valid_at))}}</time>								
				</div>
			@endif
		</header>
		<div class="image featured" id="rounds-graph-current"></div>
		<div class="image featured" id="rounds-graph"></div>
		<p>
			Citizenship and Immigration Canada (CIC) regularly selects the highest-ranking candidates from a pool 
			by inviting them to apply to immigrate to Canada as permanent residents. 
			This is a graphical representation of the number of invitations issued and the CRS score from 
			all rounds of invitations that have taken place so far.
		</p>
		<input type="hidden" id="rounds-url" name="rounds-url" value="{{url('/get/rounds-json')}}">
		<table id="rounds-table" style="display:none;">
			<thead>
				<tr>
					<td>#</td>
					<td>Date</td>
					<td>No. of invitations</td>
					<td>CRS score</td>
				</tr>
			</thead>
			<tbody>
				@foreach($allDraws as $draw)
					<tr>
						<td>{{$draw->number}}</td>
						<td>{{date("F j, Y", strtotime($draw->valid_at))}}</td>
						<td>{{$draw->invitations}}</td>
						<td>{{$draw->score}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<footer>
			<ul class="actions">
				<li>
					<a href="#" id="rounds-table-toggle" class="button icon fa-angle-down">See full list</a>
				</li>
			</ul>
			<ul class="icons">
				<li>
				<a href="https://twitter.com/share" class="twitter-share-button" data-via="eefacts"></a>
				
				</li>
				<li>
					<div class="fb-like" data-href="http://eefacts.com/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true">
						
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
	<script type="text/javascript" src="http://code.highcharts.com/stock/highstock.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>

	<script src="js/rounds.js"></script>
@endsection