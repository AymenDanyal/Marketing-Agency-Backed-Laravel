<!DOCTYPE html>
<html>
<head>
    <title>Job Application</title>
</head>
<body>
    <h1>New Job Application</h1>
    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Contact:</strong> {{ $data['contact'] }}</p>
    <p><strong>Applied For:</strong> {{ $data['appliedfor'] }}</p>
    <p><strong>Portfolio:</strong> {{ $data['portfolio'] }}</p>
    <p><strong>CV:</strong> <a href="{{ asset('storage/' . $data['cv']) }}">Download CV</a></p>
</body>
</html>