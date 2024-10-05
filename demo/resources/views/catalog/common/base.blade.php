<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ URL::asset('catalog/home.css') }}">

    <title>Home</title>

</head>

<body>

    @include('catalog.common.navbar')

    @yield('content')

    @include('catalog.common.footer')

    
    <script>
        function calculateDays() {
            // Get the from_date and to_date values
            const fromDate = document.getElementById('from_date').value;
            const toDate = document.getElementById('to_date').value;

            // Check if both dates are selected
            if (fromDate && toDate) {
                // Convert the date strings to Date objects
                const from = new Date(fromDate);
                const to = new Date(toDate);

                // Calculate the difference in time (milliseconds)
                const timeDiff = to - from;

                // Convert the difference from milliseconds to days (1000 ms * 60 sec * 60 min * 24 hours)
                const days = Math.ceil(timeDiff / (1000 * 60 * 60 * 24)) + 1; // Including both dates

                // Set the calculated days in the "Days" input field
                document.getElementById('days').value = days > 0 ? days : 0;
            }
        }

        // Attach event listeners to the date input fields
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('from_date').addEventListener('change', calculateDays);
            document.getElementById('to_date').addEventListener('change', calculateDays);
        });
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>

</html>
