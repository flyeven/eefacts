@extends('front.layout')

@section('title', 'Statistics')

@section('description', 'Interesting statistics of Citizenship and Immigration Canada (CIC) Express Entry System')

@section('main')

	<!-- Post -->
	<article class="post">
		<header>
			<div class="title">
				<h2><span class="cred">Statistics</span></h2>
				<p>Interesting statistics about the Citizenship and Immigration Canada (CIC) Express Entry System.</p>
			</div>
			<div class="meta">
				<h3>EEfacts.com</h3>
			</div>
		</header>
			<p>
				<table id="rounds-table">
					<tbody>
						<tr>
							<td>Total number of rounds of invitations</td>
							<td>{{number_format($stats['cntrnds'], 0, '.', ',')}}</td>
						</tr>
						<tr>
							<td>Total number of invitations issued</td>
							<td>{{number_format($stats['cntinvs'], 0, '.', ',')}}</td>
						</tr>
						<tr>
							<td>Average number of draws each month</td>
							<td>{{number_format($stats['avginvmth'], 2, '.', ',')}}</td>
						</tr>
						<tr>
							<td>Lowest CRS score in an Express Entry round to date</td>
							<td class="cred">{{number_format($stats['mincrs'], 0, '.', ',')}}</td>
						</tr>
						<tr>
							<td>Highest CRS score in a round to date</td>
							<td>{{number_format($stats['maxcrs'], 0, '.', ',')}}</td>
						</tr>
						<tr>
							<td>Average CRS score of all Express Entry draws</td>
							<td>{{number_format($stats['avgcrs'], 2, '.', ',')}}</td>
						</tr>
						<tr>
							<td>Highest number of invitations in a round to date</td>
							<td>{{number_format($stats['maxinv'], 0, '.', ',')}}</td>
						</tr>
						<tr>
							<td>Lowest number of invitations in a round to date</td>
							<td>{{number_format($stats['mininv'], 0, '.', ',')}}</td>
						</tr>
						<tr>
							<td>Average number of invitations of Express Entry draws</td>
							<td>{{number_format($stats['avginv'], 2, '.', ',')}}</td>
						</tr>
						<tr>
							<td>Shortest interval between two rounds (days)</td>
							<td>{{number_format($stats['shortint'], 0, '.', ',')}}</td>
						</tr>
						<tr>
							<td>Longest interval between two rounds (days)</td>
							<td>{{number_format($stats['longint'], 0, '.', ',')}}</td>
						</tr>
					</tbody>
				</table>
			</p>
		<footer>
			<ul class="icons">
				<li>
				<a href="https://twitter.com/share" class="twitter-share-button" data-via="eefacts"></a>
				
				</li>
				<li>
					<div class="fb-like" data-href="http://eefacts.com/stats" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true">
						
					</div>
				</li>
				<li>
					<div class="g-plusone" data-size="tall"></div>
				</li>
			</ul>
		</footer>
	</article>
	
@endsection