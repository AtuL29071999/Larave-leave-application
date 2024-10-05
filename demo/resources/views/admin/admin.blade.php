@extends('catalog.common.base')

@section('content')
    <style>
        .container,
        .tabs {
            display: none;
        }

        .container,
        .tabs.active {
            display: block;
        }

        .canvasjs-chart-canvas {
            width: 100% !important;
            height: 500px !important;
        }

        .btn1 {
            width: 1.4rem;
            height: 1.4rem;
            border: none;
        }

        .fontsize {
            font-size: 12px;
        }
    </style>
    </head>

    <body>

        <?php
        // foreach ($users as $value) {
        //     // You can echo the values properly inside HTML
        //     echo "<h1>Name: " . htmlspecialchars($value['name']) . "</h1>";
        // }
        
        // echo $title;
        ?>

        <div class="wrapper">
            <div class="row">
                <div class="col-12 col-sm-2 col-md-2" style="background: #f0f0f0">
                    <aside class="p-2">
                        <ul>
                            <li><a href="javascript:void(0)" onclick="showSection('1')">User Details</a></li>
                            <li><a href="javascript:void(0)" onclick="showSection('2')">Manager Details</a></li>
                        </ul>
                    </aside>  
                </div>
                <div class="col-12 col-sm-10 col-md-10">
                    <div class="container" id="contentArea">
                        <div id="1" class="active tabs">
                            <h1>User Details</h1>
                            <div class="container mt-3">
                                <div class="row">
                                    <div class="col">
                                        <table class="table table-hover">
                                            <thead class="table-dark">
                                                <tr class="text-center fontsize">
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="Code">
                                                        Code
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="AppDate">
                                                        AppDate
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="From">
                                                        from
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="To">
                                                        To
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="Days">
                                                        Days
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="Type">
                                                        Type
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="Employee">
                                                        Employee
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="Supervisor">
                                                        Supervisor
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="ApprovedBy">
                                                        Status
                                                    </th>
                                                    <th scope="col">Position</th>

                                                    <th scope="col">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Repeat for each row -->
                                                @foreach ($leaveDetails as $item)
                                                    @if ($item['role'] === 'user')
                                                        <tr class="fontsize text-center">
                                                            <td class="col-2">{{ $item['emp_id'] }}</td>
                                                            <td class="col-2">{{ date('d-m-Y', strtotime($item['leave_apply_date'])) ?? '' }}</td>
                                                            <td class="col-2">{{ date('d-m-Y', strtotime($item['leave_date_from'])) ?? ''}}</td>
                                                            <td class="col-2">{{ date('d-m-Y', strtotime($item['leave_date_to'])) ?? '' }}</td>
                                                            <td class="col-2">{{ $item['leave_day']?? '' }}</td>
                                                            <td class="col-2">{{ $item['leave_type'] ?? '' }}</td>
                                                            <td class="col-2">{{ $item['emp_name'] ?? '' }}</td>
                                                            <td class="col-2">{{ session('userName') ?? '' }}</td>
                                                            <td class="col-2">
                                                                @if ($item['approvel_status'] == 'Approved')
                                                                    <span class="text-success">{{ $item['approvel_status'] }}</span>
                                                                @elseif ($item['approvel_status'] == 'Unapproved')
                                                                    <span class="text-warning">{{ $item['approvel_status'] }}</span>
                                                                @elseif ($item['approvel_status'] == 'Rejected')
                                                                    <span class="text-danger">{{ $item['approvel_status'] }}</span>
                                                                @endif
                                                            </td>
                                                            <td class="col-2">Regular</td>
                                                            <td class="col-2">
                                                                <a href="">Read</a>
                                                                @php
                                                                    $unapproved = 0;
                                                                    $approved = 1;
                                                                    $rejected = 2;
                                                                @endphp
                                                                <a href="{{ route('admin.approvel', ['status' => $approved, 'leave_form_id' => $item['leave_form_id']]) }}">Approved</a>
                                                                <a href="{{ route('admin.approvel', ['status' => $unapproved, 'leave_form_id' => $item['leave_form_id']]) }}">Disapproved</a>
                                                                <a href="{{ route('admin.approvel', ['status' => $rejected, 'leave_form_id' => $item['leave_form_id']]) }}">Rejected</a>
                                                            </td>
                                                        </tr>                                                  
                                                    @endif
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="2" class="tabs">
                            <h1>Manager Details</h1>
                            <div class="container mt-3">
                                <div class="row">
                                    <div class="col">
                                        <table class="table table-hover">
                                            <thead class="table-dark">
                                                <tr class="text-center fontsize">
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="Code">
                                                        Code
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="AppDate">
                                                        AppDate
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="From">
                                                        from
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="To">
                                                        To
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="Days">
                                                        Days
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="Type">
                                                        Type
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="Employee">
                                                        Employee
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="Supervisor">
                                                        Supervisor
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="ApprovedBy">
                                                        Status
                                                    </th>
                                                    <th scope="col">Position</th>

                                                    <th scope="col">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Repeat for each row -->
                                                @foreach ($leaveDetails as $item)
                                                    @if ($item['role'] === 'manager')
                                                        <tr class="fontsize text-center">
                                                            <td class="col-2">{{ $item['emp_id'] }}</td>
                                                            <td class="col-2">{{ date('d-m-Y', strtotime($item['leave_apply_date'])) ?? '' }}</td>
                                                            <td class="col-2">{{ date('d-m-Y', strtotime($item['leave_date_from'])) ?? ''}}</td>
                                                            <td class="col-2">{{ date('d-m-Y', strtotime($item['leave_date_to'])) ?? '' }}</td>
                                                            <td class="col-2">{{ $item['leave_day']?? '' }}</td>
                                                            <td class="col-2">{{ $item['leave_type'] ?? '' }}</td>
                                                            <td class="col-2">{{ $item['emp_name'] ?? '' }}</td>
                                                            <td class="col-2">{{ session('userName') ?? '' }}</td>
                                                            <td class="col-2">
                                                                @if ($item['approvel_status'] == 'Approved')
                                                                    <span class="text-success">{{ $item['approvel_status'] }}</span>
                                                                @elseif ($item['approvel_status'] == 'Unapproved')
                                                                    <span class="text-warning">{{ $item['approvel_status'] }}</span>
                                                                @elseif ($item['approvel_status'] == 'Rejected')
                                                                    <span class="text-danger">{{ $item['approvel_status'] }}</span>
                                                                @endif
                                                            </td>
                                                            <td class="col-2">Regular</td>
                                                            <td class="col-2">
                                                                <a href="">Read</a>
                                                                @php
                                                                    $unapproved = 0;
                                                                    $approved = 1;
                                                                    $rejected = 2;
                                                                @endphp
                                                                <a href="{{ route('admin.approvel', ['status' => $approved, 'leave_form_id' => $item['leave_form_id']]) }}">Approved</a>
                                                                <a href="{{ route('admin.approvel', ['status' => $unapproved, 'leave_form_id' => $item['leave_form_id']]) }}">Disapproved</a>
                                                                <a href="{{ route('admin.approvel', ['status' => $rejected, 'leave_form_id' => $item['leave_form_id']]) }}">Rejected</a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function showSection(id) {
                    const sections = document.querySelectorAll('.tabs');
                    sections.forEach(section => {
                        section.classList.remove('active');
                    });
                    document.getElementById(id).classList.add('active');
                }


                // chart
                window.onload = function() {

                    var chart = new CanvasJS.Chart("chartContainer", {
                        theme: "light1", // "light2", "dark1", "dark2"
                        animationEnabled: false, // change to true		
                        title: {
                            text: "Basic Column Chart"
                        },
                        data: [{
                            // Change type to "bar", "area", "spline", "pie",etc.
                            type: "column",
                            dataPoints: [{
                                    label: "jan",
                                    y: 1
                                },
                                {
                                    label: "Feb",
                                    y: 5
                                },
                                {
                                    label: "Mar",
                                    y: 2
                                },
                                {
                                    label: "Apr",
                                    y: 0
                                },
                                {
                                    label: "May",
                                    y: 2
                                },
                                {
                                    label: "jun",
                                    y: 1
                                },
                                {
                                    label: "jul",
                                    y: 1
                                },
                                {
                                    label: "aug",
                                    y: 2
                                },
                                {
                                    label: "sep",
                                    y: 3
                                },
                                {
                                    label: "oct",
                                    y: 2
                                },
                                {
                                    label: "nov",
                                    y: 3
                                },
                                {
                                    label: "dec",
                                    y: 2
                                },
                            ]
                        }]
                    });
                    chart.render();

                }
            </script>
        @endsection
