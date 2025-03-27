<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Web Developer Resume</title>
    <style>
        /* Set A4 size */
        @page {
            size: A4;
            margin: 15mm;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: white;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .resume-container {
            width: 100%;
            max-width: 700px; /* Ensure it fits A4 width */
            margin: auto;
            padding: 15px;
            /*border: 1px solid #ddd;*/
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            padding: 8px;
            /*border: 1px solid #ddd;*/
            vertical-align: top;
        }

        .section-title {
            background-color: #9ca3a5;
            color: white;
            font-weight: bold;
            padding: 8px;
        }

        .profile-photo {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: block;
            margin: auto;
        }

        .text-center {
            text-align: center;
        }

        .main-content {
            width: 70%;
        }

        .sidebar {
            width: 30%;
            background-color: #f8f8f8;
        }

        /* Prevent content from breaking in the middle */
        .page-break {
            page-break-before: always;
        }
        .section-top {
            background-color: #9ca3a5;
            color: white;
        }
        p strong {
            color: rgba(117, 113, 113, 0.73);
        }
        span {
            color: rgba(27, 28, 30, 0.4) !important;
        }
        .text-content {
            font-family: 'Gilroy-Regular', sans-serif;
            line-height: 1.5;
        }
    </style>
</head>
<body>

<div class="resume-container">
    <!-- Header -->
    <table>
        <tr>
            <td colspan="2" class="text-center section-top">
                <img src="{{asset('assets/img/paint_dev.jpg')}}" class="profile-photo">
                <h2>VITALII CHEBOTNIKOV</h2>
                <p>Laravel Web Developer</p>
            </td>
        </tr>
    </table>

    <!-- Main Layout -->
    <table>
        <tr>
            <!-- Sidebar -->
            <td class="sidebar">
                <!-- Contact Info -->
                <table>
                    <tr>
                        <th class="section-title">Contacts</th>
                    </tr>
                    <tr>
                        <td>
                            <p class="text-center"><strong>Email:</strong><br><br> <span class="contact">{{$about->email}}</span></p>
                            <p class="text-center"><strong>Phone:</strong><br><br> <span class="contact">{{$info->phone_b}}</span></p>
                            <p class="text-center"><strong>Telegram:</strong><br><br> <span class="contact">{{$about->telegram}}</span></p>
                        </td>
                    </tr>
                </table>

                <!-- Skills -->
                <table>
                    <tr>
                        <th class="section-title">Skills</th>
                    </tr>
                    <tr>
                        <td>
                            <ul>
                                <li>PHP & Laravel</li>
                                <li>REST API Development</li>
                                <li>MySQL & PostgreSQL</li>
                                <li>Vue.js & Livewire</li>
                                <li>Docker & CI/CD</li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </td>
            <!-- Main Content -->
            <td class="main-content">

                <!-- About Me -->
                <table>
                    <tr>
                        <th class="section-title">About Me</th>
                    </tr>
                    <tr>
                        <td class="text-content">{{$about->about}}</td>
                    </tr>
                </table>

                <!-- Experience -->
                <table>
                    <tr>
                        <th class="section-title">Experience</th>
                    </tr>
                    <tr>
                        <td>
                            <strong>Senior Laravel Developer - ABC Tech (2021 - Present)</strong>
                            <ul>
                                <li>Developed scalable web applications using Laravel.</li>
                                <li>Designed RESTful APIs.</li>
                                <li>Implemented CI/CD pipelines.</li>
                            </ul>
                        </td>
                    </tr>
                </table>

                <!-- Courses -->
                <table>
                    <tr>
                        <th class="section-title">Courses & Certifications</th>
                    </tr>
                    <tr>
                        <td>
                            <ul>
                                <li>Laravel Advanced Masterclass - Udemy</li>
                                <li>PHP Security Best Practices - Pluralsight</li>
                            </ul>
                        </td>
                    </tr>
                </table>

                <!-- Used Libraries -->
                <table>
                    <tr>
                        <th class="section-title">Used Libraries & Tools</th>
                    </tr>
                    <tr>
                        <td>
                            <ul>
                                <li>Laravel 11, PHP 8</li>
                                <li>MySQL, PostgreSQL</li>
                                <li>Vue.js, Livewire</li>
                                <li>Docker, Redis, Queue Management</li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Page Break for PDF -->
    <div class="page-break"></div>

    <!-- Download Button -->
    <table>
        <tr>
            <td colspan="2" class="text-center">
                <a href="{{route('resume.download')}}" style="background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">Download Resume (PDF)</a>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
