@extends('frontend.layout.master')
@section('mainContent')

@include('frontend.home.components.HeroSlider')
@include('frontend.home.components.JobGuaranteeCourses')
@include('frontend.home.components.AmazingFacts')
@include('frontend.home.components.demo-class-practice-lab')
@include('frontend.home.components.TeamTrainers')
@include('frontend.home.components.VirtualTour')
@include('frontend.home.components.OutClient')
@endsection
