<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Web Developer Resume</title>

    <!-- Bootstrap 2.0 CSS -->
{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.0.4/css/bootstrap.min.css" rel="stylesheet">--}}
    <link href="{{asset('css/bootstrap2.min.css')}}" rel="stylesheet">
{{--    <link href="{{public_path('css/bootstrap2.min.css')}}" rel="stylesheet">--}}

    <style>

        /* Set A4 size */
        @page {
            size: A4;
            margin: 15mm;
        }

        body {
            padding: 20px;
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
        }
        .resume-container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .profile-photo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h3 {
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
        }
    </style>
</head>
<body>

<div class="resume-container">
    <!-- Header Section -->
    <div class="row-fluid header">
        <div class="span12">
            <img src="" class="profile-photo">
            <h2>John Doe</h2>
            <p class="muted">Laravel Web Developer</p>
        </div>
    </div>

    <!-- About Me -->
    <div class="row-fluid section">
        <div class="span12">
            <h3>About Me</h3>
            <p>Experienced Laravel Web Developer with a passion for backend development, APIs, and modern web technologies.</p>
        </div>
    </div>

    <!-- Experience -->
    <div class="row-fluid section">
        <div class="span12">
            <h3>Experience</h3>
            <ul>
                <li><strong>Senior Laravel Developer - ABC Tech (2021 - Present)</strong></li>
                <li>Developed scalable web applications using Laravel, MySQL, and Redis.</li>
                <li>Designed RESTful APIs for mobile and web platforms.</li>
                <li>Implemented CI/CD pipelines and optimized performance.</li>
            </ul>
        </div>
    </div>

    <!-- Courses -->
    <div class="row-fluid section">
        <div class="span12">
            <h3>Courses & Certifications</h3>
            <ul>
                <li>Laravel Advanced Masterclass - Udemy</li>
                <li>Docker for Developers - Coursera</li>
                <li>PHP Security Best Practices - Pluralsight</li>
            </ul>
        </div>
    </div>

    <!-- Used Libraries -->
    <div class="row-fluid section">
        <div class="span12">
            <h3>Used Libraries & Tools</h3>
            <ul class="unstyled">
                <li>Laravel 11, PHP 8</li>
                <li>MySQL, PostgreSQL</li>
                <li>Livewire, Vue.js</li>
                <li>RESTful APIs, GraphQL</li>
                <li>Redis, Queue Management</li>
                <li>Docker, Nginx</li>
                <li>Git, GitHub, GitLab</li>
            </ul>
        </div>
    </div>

    <!-- Contact Info -->
    <div class="row-fluid section">
        <div class="span12">
            <h3>Contact</h3>
            <p><strong>Email:</strong> johndoe@example.com</p>
            <p><strong>Phone:</strong> +123 456 7890</p>
            <p><strong>GitHub:</strong> github.com/johndoe</p>
            <p><strong>LinkedIn:</strong> linkedin.com/in/johndoe</p>
        </div>
    </div>

    <!-- Download Resume Button -->
    <div class="row-fluid">
        <div class="span12 text-center">
            <a href="{{route('resume.download')}}" class="btn btn-primary">Download Resume (PDF)</a>
        </div>
    </div>

</div>

<!-- Bootstrap 2.0 JS (Optional) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.0.4/js/bootstrap.min.js"></script>

</body>
</html>
