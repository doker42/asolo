<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIT_CHE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .centered-div {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px; /* Adjust width as needed */
            padding: 20px;
            background: rgba(0, 0, 0, 0.8); /* Semi-transparent background */
            color: white;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body class="bg-light">

<div class="centered-div">
    <h4>INFORM MESSAGE</h4>
    <p>APPLICATION DOES NOT HAVE DATA</p>
    @isset($infoMessage)
        <p>{{$infoMessage}}</p>
    @endisset
{{--    <button class="btn btn-light btn-sm" onclick="this.parentElement.style.display='none'">Close</button>--}}
    <a class="btn btn-light btn-sm" href="{{route('admin')}}">Close and to Admin</a>
</div>

</body>
</html>
