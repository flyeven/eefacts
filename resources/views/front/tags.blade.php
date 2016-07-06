@extends('front.layout')

@section('title', $tagName.' related news')

@section('rel')
	@if($allPosts->currentPage() > 1)
		<link rel="prev" href="{{$allPosts->previousPageUrl()}}" />
	@endif
	@if($allPosts->currentPage() < $allPosts->lastPage())
		<link rel="next" href="{{$allPosts->nextPageUrl()}}" />
	@endif
@endsection

@section('description', $tagName.' related news page on eefacts.com')

@section('main')
	<h2>{{$tagName}} related news</h2>
	<ul class="actions">
		<li><button onclick="history.go(-1);" class="button icon fa-chevron-left">Back</button></li>
	</ul>
	@foreach($allPosts as $post)
		<article class="post">
			<header>
				<div class="title">
					<h2><a href="/news/{{$post->slug}}">{{$post->title}}</a></h2>
				</div>
				<div class="meta">
					<time class="published" datetime="{{date("Y-m-d H:i:s", strtotime($post->published_at))}}">{{date("F j, Y", strtotime($post->published_at))}}</time>
					<a href="/news" class="author"><span class="name">EE Facts</span><img src="/images/eefacts-maple.jpg" alt="{{$post->title}} author picture" /></a>
				</div>
			</header>
				<a href="/news/{{$post->slug}}" class="image featured"><img src="{{$post->picture}}" alt="{{$post->title}} image"/></a>
				@if(strlen(strip_tags($post->text)) > 450)
					{!! substr(strip_tags($post->text,'<br><p><em><strong>'),0,446) !!} ...
				@else
					{!! strip_tags($post->text,'<br><p><em><strong>') !!}
				@endif
				
			<footer>
				<ul class="actions">
					@if(strlen(strip_tags($post->text)) > 450)
						<li><a href="/news/{{$post->slug}}" class="button big">Continue Reading</a></li>
					@endif
				</ul>
				<ul class="stats">
					@foreach($post->tags()->get() as $tag)
						<li><a href="/tag/{{$tag->name}}">{{strtoupper($tag->name)}}</a></li>
					@endforeach
					{{-- <li><a href="#" class="icon fa-heart">28</a></li> --}}
					{{-- <li><a href="#" class="icon fa-comment">128</a></li> --}}
				</ul>
			</footer>
		</article>
	@endforeach
	<ul class="actions pagination">
		@if($allPosts->currentPage() <= 1)
			<li><a href="#" class="button fit icon fa-angle-double-left disabled">First</a></li>
			<li><a href="#" class="button fit previous disabled">Previous </a></li>
		@else
			<li><a href="{{$allPosts->url(1)}}" class="button fit icon fa-angle-double-left">First</a></li>
			<li><a href="{{$allPosts->previousPageUrl()}}" class="button fit previous">Previous</a></li>
		@endif
			<li><a href="#" class="button fit disabled">{{$allPosts->currentPage()}} / {{$allPosts->lastPage()}}</a></li>
		@if($allPosts->currentPage() >= $allPosts->lastPage())
			<li><a href="#" class="button fit next disabled">Next </a></li>
			<li><a href="#" class="button fit icon fa-angle-double-right disabled">Last</a></li>
		@else
			<li><a href="{{$allPosts->nextPageUrl()}}" class="button fit next">Next</a></li>
			<li><a href="{{$allPosts->url($allPosts->lastPage())}}" class="button fit icon fa-angle-double-right">Last</a></li>
		@endif
	</ul>
@endsection