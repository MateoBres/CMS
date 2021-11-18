@extends('layouts.app')

@section('content')
    <div id="app" :stripePK="{{ getenv('STRIPE_KEY') }}">


    </div>

@endsection