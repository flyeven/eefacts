@extends('front.layout')

@section('title', $post->title.' (News)')

@section('description', $post->title)

@section('main')
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
			<span class="image left"><img src="{{$post->picture}}" alt="{{$post->title}} image" /></span>
				{!! $post->text !!}
		<footer>
			<ul class="actions">
				<li><button onclick="history.go(-1);" class="button  big icon fa-chevron-left">Back</button></li>
				<li><button id="comment-form-toggle" class="button  big icon fa-commenting">Comment</button></li>
			</ul>
			<ul class="stats">
				@foreach($post->tags()->get() as $tag)
					<li><a href="/tag/{{$tag->name}}">{{strtoupper($tag->name)}}</a></li>
				@endforeach
				{{-- <li><a href="#" class="icon fa-heart">28</a></li> --}}
				{{-- <li><a href="#" class="icon fa-comment">128</a></li> --}}
			</ul>
		</footer>
		<section id="comment-form">
			<hr>
			<h3>Add a comment</h3>
			<form method="post" action="/news/post/comment/add">
				<div class="row uniform">
					<div class="6u 12u$(xsmall)">
						<input type="text" name="name" id="visitor-name-input" value="{{old('name')}}" placeholder="Name" />
					</div>
					<div class="6u$ 12u$(xsmall)">
						<input type="email" name="email" id="visitor-email-input" value="{{old('email')}}" placeholder="Email" />
					</div>
					<div class="12u$">
						<textarea name="message" id="visitor-message-input" placeholder="Enter your message" rows="6">{{old('message')}}</textarea>
						<input type="hidden" name="post-id" id="post-id-input" value="{{$post->id}}">
						<span id="visitor-message-count"></span>
					</div>
					<div class="12u$">
						<ul class="actions">
							<li><input type="submit" value="Send Message" /></li>
							<li><input type="reset" value="Reset Form" /></li>
							<li><input type="reset" class="visitor-cancel-comment" value="Cancel Message" /></li>
						</ul>
					</div>
				</div>
			</form>
			@if ($errors->any())
              <div id="comment-form-errors">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li class="form-error">{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif
		</section>
	</article>
	<a name="comments"></a>
	
		<h5>Comments ({{$post->comments()->count()}}) </h5>
		<hr>

		@foreach($post->comments()->orderBy('created_at', 'desc')->get() as $comment)
			<h4>{{$comment->visitor_name}}</h4> {{date('jS \of F Y, h:i:s A', strtotime($comment->created_at))}}
			<blockquote>{{$comment->visitor_message}}</blockquote>
		@endforeach
	</section>
@endsection
@section('scripts')
	@parent
	<script src="/js/post.js"></script>
@endsection