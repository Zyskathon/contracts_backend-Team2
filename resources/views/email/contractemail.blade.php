<!DOCTYPE html>
<html>
<head>
    <title>New Project Notification: {{ $mailData['projectName'] }}</title>
    <style>
        /* Define CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0; /* Remove default margin to fill the entire viewport */
            padding: 0; /* Remove default padding */
        }

        .container {
            background-color: #fff; /* White background for the container */
            border: 1px solid #ddd; /* Gray border around the container */
            padding: 20px; /* Add some padding to the container */
            border-radius: 5px; /* Rounded corners for the container */
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2); /* Box shadow for the container */
        }

        h2 {
            color: #333;
        }

        p {
            color: #555;
        }

        strong {
            color: #010101; /* Blue color for strong text */
        }

        ul {
            list-style-type: disc;
            color: #777;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body style="background-color: #f4f4f4;">
    <div class="container">
        <p>Dear Team,</p>

        <p>We are excited to announce the creation of a new project in our Contract Management Application that may be of significant interest to you. Here are the project details:</p>

        <p>
            <strong>Project Name:</strong> {{ $mailData['projectName'] }}<br>
            <strong>Project Description:</strong> {{ $mailData['projectDescription'] }}
        </p>

        <p>
            <strong>Purpose:</strong> {{ $mailData['projectPurpose'] }}
        </p>

        <p>As you are an essential part of this project and its associated contracts, we want to ensure that you are well-informed from the outset.</p>

        <p><strong>Key Details:</strong></p>

        <ul>
            <li><strong>Project Manager:</strong> {{ $mailData['projectManager'] }}</li>
            <li><strong>Contract Owners:</strong> {{ $mailData['contractOwners'] }}</li>
            <li><strong>Project Start Date:</strong> {{ $mailData['projectStartDate'] }}</li>
            <li><strong>Project End Date:</strong> {{ $mailData['projectEndDate'] }}</li>
        </ul>

        <!-- Add a flyer/image -->
       

        <p>We will be providing regular updates and progress reports regarding this project to keep you informed about its status and developments. Your expertise and contributions will be vital to the success of this initiative.</p>

        <p>Please feel free to reach out if you have any questions or require additional information. Your active involvement and collaboration are highly valued.</p>

        <p>Thank you for your dedication to our organization's success.</p>

        <p style="color: #888;">Best regards, {{ $mailData['organizationName'] }}</p>
        <img src="{{ asset('https://www.zyskathon.com/_next/static/media/Zyskathon.0629d85d.svg') }}" alt="Flyer Image" width="50" height="10">

    </div>
</body>
</html>
