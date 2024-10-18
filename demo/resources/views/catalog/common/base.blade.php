<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="{{ URL::asset('catalog/home.css') }}">

    <title>Home</title>

</head>

<body>

    @include('catalog.common.navbar')

    @yield('content')

    @include('catalog.common.footer')

    
    {{-- <script>
        function calculateDays() {
            const fromDate = document.getElementById('from_date').value;
            const toDate = document.getElementById('to_date').value;
            if (fromDate && toDate) {
                const from = new Date(fromDate);
                const to = new Date(toDate);

                const timeDiff = to - from;

                const days = Math.ceil(timeDiff / (1000 * 60 * 60 * 24)) + 1; // Including both dates

                document.getElementById('days').value = days > 0 ? days : 0;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('from_date').addEventListener('change', calculateDays);
            document.getElementById('to_date').addEventListener('change', calculateDays);
        });
    </script> --}}
{{-- calculate days --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const fromDate = document.getElementById('from_date');
            const toDate = document.getElementById('to_date');
            const halfDayRadios = document.querySelectorAll('input[name="halfday"]');
            const daysInput = document.getElementById('days');
            function calculateDays() {
                const from = new Date(fromDate.value);
                const to = new Date(toDate.value);
                let differenceInTime = to - from;
                let differenceInDays = differenceInTime / (1000 * 3600 * 24) + 1; 
    
                if (fromDate.value && toDate.value && differenceInDays > 0) {
                    halfDayRadios.forEach((radio) => {
                        if (radio.checked) {
                            if (radio.value === 'First Half' || radio.value === 'Second Half') {
                                daysInput.value = (differenceInDays - 1) + 0.5; 
                            } else if (radio.value === 'Full Day') {
                                daysInput.value = differenceInDays;
                            }
                        }
                    });
                } else {
                    daysInput.value = 0;
                }
            }
            fromDate.addEventListener('change', calculateDays);
            toDate.addEventListener('change', calculateDays);
            halfDayRadios.forEach((radio) => {
                radio.addEventListener('change', calculateDays);
            });
        });
    </script>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>
