<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Brief Query</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        .details {
            margin-bottom: 20px;
        }
        .details p {
            margin: 5px 0;
        }
        .message {
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Brief Query Submitted</h1>

        <div class="details">
            <p><strong>Name:</strong> {{ $data['name'] }}</p>
            <p><strong>Email:</strong> {{ $data['email'] }}</p>
            <p><strong>Contact:</strong> {{ $data['contact'] }}</p>
            <p><strong>Company:</strong> {{ $data['company'] }}</p>
            <p><strong>Budget:</strong> {{ $data['budget'] }}</p>
            <p><strong>Website URL:</strong> <a href="{{ $data['webUrl'] }}">{{ $data['webUrl'] }}</a></p>
            <p><strong>Date:</strong> {{ $data['date'] }}</p>
        </div>

        <div class="message">
            <h3>Message:</h3>
            <p>{{ $data['message'] }}</p>
        </div>

        <div class="footer">
            <p>This is an automated message from your website.</p>
        </div>
    </div>
</body>
</html>
