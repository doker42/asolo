@php use Illuminate\Support\Facades\Storage; @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIT_CHE</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicons/favicon-32x32.png')}}" />

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>

        /* Set A4 size */
        @page {
            size: A4;
            margin: 5mm;
        }

        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .resume-container {
            max-width: 1000px;
            margin: 40px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .top-bar {
            background: #a4a8ad;
            color: white;
            padding: 20px;
            margin: 20px;
            text-align: center;
            border-radius: 10px;
        }
        .profile-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
        }
        .resume-section {
            padding: 20px;
        }
        .resume-section h3 {
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        .contact-info p {
            margin: 0;
        }
        .used-libraries ul {
            columns: 2;
        }
        .position {
            color: #545d63;
            font-size: large;
        }
        .company {
            color: #6993a5;
        }
        .date {
            font-size: small;
            color: #718c9c;
        }
    </style>
</head>
<body>

<div class="container resume-container">
    <!-- Top-bar -->
    <div class="top-bar">
        @if(isset($export) && $export && $about)
            @php($image = Storage::disk('public')->path($about->image->name))
        @else
            @php($image = $image = Storage::url($about->image->name))
        @endif
            <img src="{{$image}}"
             alt="Profile Photo"
             class="profile-photo"
        >
        <h3>Vitalii Chebotnikov</h3>
        <p class="">web developer</p>
        <hr>
        <div class="contact-info">
            <p><strong>Email:</strong> {{$about->email}}</p>
            <hr>
            <p><strong>Phone:</strong> {{$info->phone_b}}</p>
            <hr>
        </div>
    </div>

    <!-- Main Content -->
        <!-- About Me -->
        <div class="resume-section">
            <h3>About Me</h3>
            <p>{{$about->about}}</p>
        </div>

        <!-- Experience -->
        <div class="resume-section">
            <h3>Experience</h3>
            @if($works && count($works))
                @foreach($works as $work)
                    <p><strong><span class="position">{{$work->position}}</span> <span class="company">  -  {{$work->company_name}}  -  {{$work->company_link}}</span></strong></p>
                    <p><strong><span class="date">{{mb_strtolower($work->start_date)}} - {{mb_strtolower($work->finish_date)}}</span></strong></p>

                    @php($resps = $work->respToUl())
                    @if(count($resps))
                        <ul>
                        @foreach($resps as $resp)
                           <li>{{$resp}}</li>
                        @endforeach
                        </ul>
                    @else
                        <ul>
                            <li>Lorem ipsum...</li>
                            <li>Developed scalable web applications using Laravel and MySQL.</li>
                            <li>Designed RESTful APIs for mobile and web applications.</li>
                            <li>Implemented CI/CD pipelines and optimized app performance.</li>
                        </ul>
                    @endif

                    <p class="date"><strong>used stack: </strong> {{$work->stack}}</p>

                    <hr>
                @endforeach
            @endif

        </div>

        <!-- Courses -->
        <div class="resume-section">
            <h3>Education & Courses</h3>
            <ul>
                <li>Kharkiv Aviation Engineering School, Communications Engineer,
                    Specialist. Organization of digital communication equipment
                    operation (5 years) </li>
                <li>"Step” IT Academy - WebDevelopment (1 year)</li>
                <li>Course “Fundamentals of automatization testing Web
                    applications” Training Center QATestLab (2 months)</li>
            </ul>
        </div>

        <!-- Used Libraries -->
        <div class="resume-section used-libraries">
            <h3>Skills & Tools</h3>
            <ul>
                <li>Laravel 11, PHP 8, MySQL</li>
                <li>RESTful APIs, GraphQL</li>
                <li>Redis, Queue Management</li>
                <li>Docker, Apache</li>
                <li>Git, GitHub, GitLab</li>
                <li>Laravel Sanctum & Passport</li>
                <li>basic JS,VueJS,React</li>
            </ul>
        </div>

        <!-- Download PDF -->
{{--        <div class="resume-section text-center">--}}
{{--            <a href="{{ route('resume.download') }}" class="btn btn-primary">Download as PDF</a>--}}
{{--        </div>--}}
    </div>

</body>
</html>
