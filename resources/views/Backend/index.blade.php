@extends('backend.layouts.main') 
{{-- Extends the main layout from the backend layouts --}}

@section('title', 'Dashboard') 
{{-- Sets the title of the page to 'Dashboard' --}}

@section('main-section') 
{{-- Starts the main section of the page --}}
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Container for the main content with responsive padding --}}
        <div class="row">
            {{-- Row for layout --}}
            <div class="col mb-4 order-0">
                {{-- Column with bottom margin and default order --}}
                <div class="card">
                    {{-- Card component --}}
                    <div class="d-flex align-items-end row">
                        {{-- Row with flexbox alignment --}}
                        <div class="col-sm-7">
                            {{-- Column taking 7/12 of the row on small screens and up --}}
                            <div class="card-body">
                                {{-- Card body --}}
                                <h5 class="card-title text-primary">Congratulations John! 🎉</h5>
                                {{-- Card title with primary text color --}}
                                <p class="mb-4">
                                    {{-- Paragraph with bottom margin --}}
                                    You have done <span class="fw-bold">72%</span> more sales today. Check your new
                                    badge in
                                    your profile.
                                    {{-- Sales information with bold percentage --}}
                                </p>

                                <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                                {{-- Button to view badges --}}
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            {{-- Column taking 5/12 of the row on small screens and up, centered text on small screens --}}
                            <div class="card-body pb-0 px-0 px-md-4">
                                {{-- Card body with padding adjustments --}}
                                <img src="{{asset('backend/assets/img/illustrations/man-with-laptop-light.png')}}" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                                {{-- Image with responsive height and alternate images for dark/light modes --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
{{-- Ends the main section --}}
