@extends('components.user.navbar')

@section('content')

@include('/components/pagenews/latest_news')
@include('/components/pagenews/hashtag')
@include('/components/pagenews/breaking_news')
@include('/components/pagenews/activity')
@include('/components/pagenews/video')
@include('/components/pagenews/meeting')
@include('/components/pagenews/funeral')

@endsection
