@extends('layouts.app')

@section('title', 'Templatenesia - Official Store')

@section('head')
{{-- Vue.js - hanya digunakan di homepage --}}
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
@endsection

@section('content')

@include('partials.homepage_full')

@endsection 
