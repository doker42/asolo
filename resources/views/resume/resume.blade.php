<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    {{--        <meta name="description" content="" />--}}
            <meta name="author" content="acode source" />

    @php  use Artesaos\SEOTools\Facades\SEOTools; @endphp
    {!! SEOTools::generate() !!}

    <title>VIT_CHE</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicons/favicon-32x32.png')}}"/>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet"
          type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css"/>

    <!-- Core theme CSS (includes Bootstrap)-->
    @vite(['resources/css/resume.css', 'resources/js/resume.js'])

</head>
<body id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
    <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-block d-lg-none">VITALII CHEBOTNIKOV</span>
        <span class="d-none d-lg-block">
                    @if(isset($about->image?->name))
                <img class="img-fluid img-profile rounded-circle mx-auto mb-2"
                     src="{{ Storage::url($about->image->name) }}" alt="..."/>
            @else
                <img class="img-fluid img-profile rounded-circle mx-auto mb-2"
                     src="{{ asset('assets/img/default/developer.jpeg') }}" alt="..."/>
            @endif
                </span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">{{__('About')}}</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#experience">{{__('Experience')}}</a></li>
            {{--                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#education">Education</a></li>--}}
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#skills">{{__('Skills')}}</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contacts">{{__('Contacts')}}</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#cv">{{__('CV')}}</a></li>
        </ul>
    </div>
</nav>
<!-- Page Content-->
<div class="container-fluid p-0">
    <!-- About-->
    <section class="resume-section" id="about">
        <div class="resume-section-content">
            <h1 class="mb-0">
                <span class="f-name">Vitalii</span>
                {{--                        <span class="text-primary s-name">Chebotnikov</span>--}}
                <span class="s-name">Chebotnikov</span>
            </h1>
            <div class="subheading mb-5">
                BUCHAREST ROMANIA ·
                <a href="mailto:{{$about->email}}">{{$about->email}}</a>
            </div>
            <p class="lead mb-5">{{$about->about}}</p>
            <div class="social-icons">
                <a class="social-icon" href="{{$about->linkdin}}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                <a class="social-icon" href="{{$about->git}}" target="_blank"><i class="fab fa-github"></i></a>
            </div>
        </div>
    </section>
    <hr class="m-0"/>
    <!-- Experience-->
    <section class="resume-section" id="experience">
        <div class="resume-section-content">
            <h2 class="mb-5">Experience</h2>
            @if($works && count($works))
                @foreach($works as $work)
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">{{$work->position}}</h3>
                            <div class="subheading mb-3">
                                @if($work->company_link)
                                    <a class="company-link" href="{{$work->company_link}}" target="_blank">
                                        {{$work->company_name}}
                                    </a>
                                @else
                                    {{$work->company_name}}
                                @endif
                            </div>
                            <p class="lead">{{$work->resp}}</p>
                            <p><strong>used stack</strong>: {{$work->stack}}</p>
                        </div>
                        <div class="flex-shrink-0"><span
                                    class="text-primary">{{$work->start_date}} - {{$work->finish_date}}</span></div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>
    <hr class="m-0"/>
    <!-- Skills-->
    <section class="resume-section" id="skills">
        <div class="resume-section-content">
            <h2 class="mb-5">Skills</h2>
            <div class="subheading mb-3">Programming Languages & Tools</div>
            <ul class="list-inline dev-icons">
                <li class="list-inline-item"><i class="fab fa-php"></i></li>
                <li class="list-inline-item"><i class="fab fa-laravel"></i></li>
                <li class="list-inline-item"><i class="fab fa-html5"></i></li>
                <li class="list-inline-item"><i class="fab fa-css3-alt"></i></li>
                <li class="list-inline-item"><i class="fab fa-js-square"></i></li>
                <li class="list-inline-item"><i class="fa-solid fa-database"></i></li>
                {{--                        <li class="list-inline-item"><i class="fab fa-react"></i></li>--}}
                {{--                        <li class="list-inline-item"><i class="fab fa-node-js"></i></li>--}}
                {{--                        <li class="list-inline-item"><i class="fab fa-sass"></i></li>--}}
                {{--                        <li class="list-inline-item"><i class="fab fa-less"></i></li>--}}
                {{--                        <li class="list-inline-item"><i class="fab fa-npm"></i></li>--}}

            </ul>
            <div class="subheading mb-3">Workflow</div>
            <ul class="fa-ul mb-0">
                <li>
                    <span class="fa-li"><i class="fas fa-check"></i></span>
                    Cross Functional Teams
                </li>
                <li>
                    <span class="fa-li"><i class="fas fa-check"></i></span>
                    Agile Development & Scrum
                </li>
            </ul>
        </div>
    </section>
    <hr class="m-0"/>
    <!-- Contacts-->
    <section class="resume-section" id="contacts">
        <div class="resume-section-content">
            <h2 class="mb-5">{{__('Contacts')}}</h2>
            <ul class="fa-ul mb-3 contacts">
                <li class="mb-3">
                    <span class="fa-lg cont"><i class="fab fa-telegram contact"></i></span>
                    <a class="js-tg contact" href="https://t.me/vit_che">vit_che</a>
                </li>
                <li class="mb-3">
                    <span class="fa-lg cont"><i class="fa fa-envelope contact" aria-hidden="true"></i></span>
                    <a class="js-email contact" href="mailto:vit.chebotnikov@gmail.com">vit.chebotnikov@gmail.com</a>
                </li>
            </ul>
        </div>
    </section>
    <hr class="m-0"/>
    <!-- CV-->
    <section class="resume-section" id="cv">
        <div class="resume-section-content">
            <h2 class="mb-5">{{__('CV download')}}</h2>

            <div class="image-container" id="downloadImage">
                <img src="{{asset('assets/img/default/resume_pdf.png')}}" alt="Downloadable Image"
                     class="download-image">
                <div id="loadingIndicator" class="loading-indicator">
                    <div class="spinner-border text-light"></div>
                </div>
            </div>

        </div>
    </section>
</div>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.getElementById('downloadImage').addEventListener('click', function () {
        let indicator = document.getElementById('loadingIndicator');
        // Show loading indicator
        indicator.style.display = 'block';
        // Simulate download delay (real download happens via AJAX)
        setTimeout(() => {
            window.location.href = "{{ route('resume.download') }}";
            setTimeout(() => indicator.style.display = 'none', 2000); // Hide spinner after 3s
        }, 1000);
    });
</script>

</body>
</html>


