@extends('layouts.layout')
@section('content')

    <section class="slider-main">
        <div class="container">
            <div class="row">
                <div class="col-md-6 category-1">
                    <a href="#">
                        <h4>Relationship</h4>
                        <img src="{{ asset('img/relationships.png') }}" alt="images">
                        <p class="pt-2 mb-0">22 sessions</p>
                    </a>
                </div>
                <div class="col-md-6 category-2">
                    <a href="#">
                        <h4>Communication</h4>
                        <img src="{{ asset('img/communication.png') }}" alt="images">
                        <p class="pt-2 mb-0">06 sessions</p>
                    </a>
                </div>
                <div class="col-md-6 category-3">
                    <a href="#">
                        <h4>Stress Relief</h4>
                        <img src="{{ asset('img/exercise.png') }}" alt="images">
                        <p class="pt-2 mb-0">22 sessions</p>
                    </a>
                </div>
                <div class="col-md-6 category-4">
                    <a href="#">
                        <h4>Work Challenges</h4>
                        <img src="{{ asset('img/work-challenges.png') }}" alt="images">
                        <p class="pt-2 mb-0">06 sessions</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection