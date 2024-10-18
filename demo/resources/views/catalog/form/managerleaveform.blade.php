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

        .circular-chart {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 20px auto;
        }

        /* The background circle */
        .circle-bg {
            fill: none;
            stroke: #e6e6e6;
            stroke-width: 10;
        }

        /* The balance (green) and availed (orange) portions */
        .circle {
            fill: none;
            stroke-width: 10;
            stroke-linecap: round;
            transform: rotate(-90deg);
            transform-origin: 50% 50%;
        }

        .circle-balance {
            stroke: #4caf50;
            stroke-dasharray: 283;
        }

        .circle-progress {
            stroke: #ff9800;
            stroke-dasharray: 283;
        }

        /* Center the text inside the circle */
        .percentage-text {
            font-size: 1.5rem;
            fill: #333;
            text-anchor: middle;
            alignment-baseline: middle;
            dominant-baseline: central;
        }

        /* Responsive title styling */
        .chart-title {
            font-size: 1.2rem;
            text-align: center;
            margin-top: 10px;
        }

        .legend-box {
            width: 20px;
            height: 20px;
        }
    </style>
    </head>

    <body>

        <div class="wrapper">
            <div class="row">
                <div class="col-12 col-sm-2 col-md-2" style="background: #f0f0f0">
                    <aside class="p-2">
                        <ul>
                            <li><a href="javascript:void(0)" onclick="showSection('1')">Leave Application</a></li>
                            <li><a href="javascript:void(0)" onclick="showSection('2')">Leave Details</a></li>
                            <li><a href="javascript:void(0)" onclick="showSection('3')">Leave Balance</a></li>
                            <li><a href="javascript:void(0)" onclick="showSection('4')">Team-Leave Status</a></li>
                            <li><a href="javascript:void(0)" onclick="showSection('5')">Leave-Team Member</a></li>
                            <li><a href="javascript:void(0)" onclick="showSection('6')">Team-Leave Calendar</a></li>
                            <li><a href="javascript:void(0)" onclick="showSection('7')">Leave Reports</a></li>
                            <li><a href="javascript:void(0)" onclick="showSection('8')">Delegate To</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="col-12 col-sm-10 col-md-10">
                    <div class="container" id="contentArea">
                        <div id="1" class="active tabs">
                            <div class="col-md-12">
                                <h2>Leave Application</h2>
                                <div class="row">
                                    <div class="col-md-8">
                                        <form action="{{ $manageraction }}" method="post">
                                            @csrf
                                            <div class="row mb-4">
                                                <div class="col-10">
                                                    <input type="radio" name="application" id="application"
                                                        value="application"> Application
                                                    <input type="radio" name="application" id="plan" value="plan"
                                                        class="ms-2"> Plan
                                                </div>
                                            </div>

                                            <h1 class="bg-dark text-white fs-3 p-2 mb-3">Application</h1>

                                            <div class="p-3">
                                                <!-- Apply Date -->
                                                <div class="row mb-4">
                                                    <div class="col-3 text-start">
                                                        <label for="applydate">Apply Date</label>
                                                    </div>
                                                    <div class="col-9 text-end">
                                                        <input class="form-control" type="date" name="applydate"
                                                            id="applydate" />
                                                    </div>
                                                </div>

                                                <!-- Leave Type -->
                                                <div class="row mb-4">
                                                    <div class="col-3 text-start">
                                                        <label for="type">Type</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <select name="type" class="form-control" id="application_type">
                                                            <option value="">--Select--</option>
                                                            <option value="Bereavement Leave">Bereavement Leave</option>
                                                            <option value="Earned Leave">Earned Leave</option>
                                                            <option value="Happiness Leave">Happiness Leave</option>
                                                            <option value="Leave Without Pay">Leave Without Pay</option>
                                                            <option value="Paternity Leave">Paternity Leave</option>
                                                            <option value="Restricted Holiday">Restricted Holiday</option>
                                                            <option value="Short Leave">Short Leave</option>
                                                            <option value="Sick Leave">Sick Leave</option>
                                                            <option value="Wedding Leave">Wedding Leave</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Leave Dates -->
                                                <div class="row mb-4">
                                                    <div class="col-3 text-start">
                                                        <label for="from_date">Date</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <input class="form-control mb-3" type="date" name="from_date"
                                                            id="from_date" placeholder="From" />
                                                        <input class="form-control" type="date" name="to_date"
                                                            id="to_date" placeholder="To" />
                                                    </div>
                                                </div>

                                                <!-- Half Day Selection -->
                                                <div class="row mb-4">
                                                    <div class="col-3 text-start">
                                                        <label for="halfday">Half Day</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <input type="radio" name="halfday" value="First Half"> First Half
                                                        <input type="radio" name="halfday" value="Second Half"
                                                            class="ms-2"> Second Half
                                                        {{-- <input type="radio" name="halfday" value="Both Half"
                                                            class="ms-2"> Both Half --}}
                                                        <input type="radio" name="halfday" value="Full Day"
                                                            class="ms-2"> Full Day
                                                    </div>
                                                </div>

                                                <!-- Days -->
                                                <div class="row mb-4">
                                                    <div class="col-3 text-start">
                                                        <label for="days">Days</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <input class="form-control" type="text" name="days"
                                                            id="days">
                                                    </div>
                                                </div>

                                                <!-- Reason -->
                                                <div class="row mb-4">
                                                    <div class="col-3 text-start">
                                                        <label for="reason">Reason</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <input class="form-control" type="text" name="reason"
                                                            id="reason">
                                                    </div>
                                                </div>

                                                <!-- Manager Email -->
                                                <div class="row mb-4">
                                                    <div class="col-3 text-start">
                                                        <label for="managerEmail">Manager Email</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <input class="form-control" type="email" name="managerEmail"
                                                            id="managerEmail">
                                                    </div>
                                                </div>

                                                <!-- CC Email -->
                                                <div class="row mb-4">
                                                    <div class="col-3 text-start">
                                                        <label for="ccmail">CC Email (optional)</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <input class="form-control" type="email" name="ccmail"
                                                            id="ccmail">
                                                    </div>
                                                </div>

                                                <!-- Contact Number -->
                                                <div class="row mb-4">
                                                    <div class="col-3 text-start">
                                                        <label for="contact">Contact No</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <input class="form-control" type="number" name="contact"
                                                            id="contact">
                                                    </div>
                                                </div>


                                                <!-- Medical Certificate -->
                                                <div class="row mb-4">
                                                    <div class="col-3 text-start">
                                                        <label for="medical_certificate">Medical Certificate</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <input type="radio" name="medical_certificate" value="Yes">
                                                        Yes
                                                        <input type="radio" name="medical_certificate" value="No"
                                                            class="ms-2"> No
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Submit Buttons -->
                                            <div class="row mb-4">
                                                <div class="">
                                                    <button class="btn btn-dark" type="submit">Submit</button>
                                                    <button class="btn btn-dark" type="button">View Rejected
                                                        Applications</button>
                                                </div>
                                                <div class="mt-3">
                                                    <h6>Note</h6>
                                                    <p class="text-muted mb-0">Fields marked with * are mandatory.</p>
                                                    <p class="text-muted">Please refer to the leave policy before applying
                                                        for leave.</p>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="mt-5">
                                            <h1 class="bg-dark text-white fs-4 p-2 mb-0" id="txt_heading">Selected
                                                Application Details</h1>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Balance</td>
                                                    <td id="txt_balance">0</td>
                                                </tr>
                                                <tr>
                                                    <td>Availed till Date</td>
                                                    <td id="txt_avail_date">0</td>
                                                </tr>
                                                <tr>
                                                    <td>Total Applied</td>
                                                    <td id="txt_total_applied">0</td>
                                                </tr>
                                                <tr>
                                                    <td>Total Approved</td>
                                                    <td id="txt_total_approved">0</td>
                                                </tr>
                                                <tr>
                                                    <td>Pending for Approval</td>
                                                    <td id="txt_pending">0</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div id="2" class="tabs">
                            <h1>Application Details</h1>
                            <div class="container mt-3">
                                <div class="row">
                                    <div class="col">
                                        <table class="table table-hover">
                                            <thead class="table-dark">
                                                <tr class="text-center fontsize">
                                                    <th scope="col">Action</th>
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
                                                            placeholder="Supervisor">
                                                        Supervisor
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="ApprovedBy">
                                                        ApprovedBy
                                                    </th>
                                                    <th scope="col">
                                                        <input type="text" class="form-control form-control-sm"
                                                            placeholder="Status">
                                                        Status
                                                    </th>
                                                    <th scope="col">Position</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Repeat for each row -->
                                                @foreach ($managerLeaveForm as $item)
                                                    {{-- {{$forms}} --}}
                                                    <tr class="fontsize text-center">
                                                        <td class="col-2 text-centre">
                                                            <a href=""><button class="btn1 " title="View"><i
                                                                        class="fa-regular fa-eye"></i></button></a>
                                                            <a href="{{ route('catalog.edit', $item['leave_form_id']) }}"><button
                                                                    class="btn1 " title="Edit"><i
                                                                        class="fa-regular fa-edit"></i></button></a>
                                                            <a
                                                                href="{{ route('catalog.delete', $item['leave_form_id']) }}"><button
                                                                    class="btn1  " title="Delete"><i
                                                                        class="fa-regular fa-trash-alt"></i></button></a>
                                                        </td>
                                                        <td class="col-2">{{ $item['id'] }}</td>
                                                        <td class="col-2">
                                                            {{ date('d-m-Y', strtotime($item['leave_apply_date'])) }}</td>
                                                        <td class="col-2">
                                                            {{ date('d-m-Y', strtotime($item['leave_date_from'])) }}</td>
                                                        <td class="col-2">
                                                            {{ date('d-m-Y', strtotime($item['leave_date_to'])) }}</td>
                                                        <td class="col-2">{{ $item['leave_day'] }}</td>
                                                        <td class="col-2">{{ $item['leave_type'] }}</td>
                                                        <td class="col-2">{{ $item['approved_by'] }}</td>
                                                        <td class="col-2">{{ $item['approved_by'] }}</td>
                                                        <td class="col-2">
                                                            @if ($item['approvel_status'] == 'Approved')
                                                                <span
                                                                    class="text-success">{{ $item['approvel_status'] }}</span>
                                                            @elseif ($item['approvel_status'] == 'Unapproved')
                                                                <span
                                                                    class="text-warning">{{ $item['approvel_status'] }}</span>
                                                            @elseif ($item['approvel_status'] == 'Rejected')
                                                                <span
                                                                    class="text-danger">{{ $item['approvel_status'] }}</span>
                                                            @endif

                                                            @if ($item['leave_read'] == 'R')
                                                                <span
                                                                    class="text-success">{{ $item['leave_read'] }}</span>
                                                            @else
                                                                <span class="text-danger">{{ $item['leave_read'] }}</span>
                                                            @endif
                                                        </td>
                                                        <td class="col-2">Regular</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="3" class="tabs">
                            <div style="display: flex">
                                <div style="width: 300px; height: 300px">
                                    <canvas id="slChart"></canvas>
                                </div>
                                <div style="width: 300px; height: 300px">
                                    <canvas id="elChart"></canvas>
                                </div>
                                <div style="width: 300px; height: 300px">
                                    <canvas id="rhChart"></canvas>
                                </div>
                            </div>
                            <div class="w-100" style="height: 100vh">
                                <div id="chartContainer"></div>
                            </div>
                        </div>
                        
                        <script>
                            window.onload = function() {
                                // Initialize Sick Leave Chart
                                var slCtx = document.getElementById('slChart').getContext('2d');
                                var slChart = new Chart(slCtx, {
                                    type: 'doughnut',
                                    data: {
                                        labels: ['Availed', 'Balance'],
                                        datasets: [{
                                            data: [{{ $leaveData['availed_sick_leave'] }},
                                                   {{ $leaveData['total_sick_leave'] - $leaveData['availed_sick_leave'] }}],
                                            backgroundColor: ['orange', 'green'],
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false
                                    }
                                });
                        
                                // Initialize Earned Leave Chart
                                var elCtx = document.getElementById('elChart').getContext('2d');
                                var elChart = new Chart(elCtx, {
                                    type: 'doughnut',
                                    data: {
                                        labels: ['Availed', 'Balance'],
                                        datasets: [{
                                            data: [{{ $leaveData['availed_earned_leave'] }},
                                                   {{ $leaveData['total_earned_leave'] - $leaveData['availed_earned_leave'] }}],
                                            backgroundColor: ['orange', 'green'],
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false
                                    }
                                });
                        
                                // Initialize Restricted Holiday Chart
                                var rhCtx = document.getElementById('rhChart').getContext('2d');
                                var rhChart = new Chart(rhCtx, {
                                    type: 'doughnut',
                                    data: {
                                        labels: ['Availed', 'Balance'],
                                        datasets: [{
                                            data: [{{ $leaveData['availed_rh_leave'] }},
                                                   {{ $leaveData['total_rh_leave'] - $leaveData['availed_rh_leave'] }}],
                                            backgroundColor: ['orange', 'green'],
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false
                                    }
                                });
                        
                                // Initialize another chart (if needed for chartContainer)
                                var chartData = @json($chartData); // Pass dynamic chart data
                                var chart = new CanvasJS.Chart("chartContainer", {
                                    theme: "light1",
                                    animationEnabled: false,
                                    title: {
                                        text: "Total Used Leave per Month"
                                    },
                                    data: [{
                                        type: "column",
                                        dataPoints: chartData
                                    }]
                                });
                                chart.render();
                            }
                        </script>
                        
                        <div id="4" class="tabs">
                            <h1>Team Leave Status</h1>
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
                                                    <tr class="fontsize text-center">
                                                        <td class="col">{{ $item['emp_id'] }}</td>
                                                        <td class="col-2">
                                                            {{ date('d-m-Y', strtotime($item['leave_apply_date'])) ?? '' }}
                                                        </td>
                                                        <td class="col-2">
                                                            {{ date('d-m-Y', strtotime($item['leave_date_from'])) ?? '' }}
                                                        </td>
                                                        <td class="col-2">
                                                            {{ date('d-m-Y', strtotime($item['leave_date_to'])) ?? '' }}
                                                        </td>
                                                        <td class="col">{{ $item['leave_day'] ?? '' }}</td>
                                                        <td class="col-2">{{ $item['leave_type'] ?? '' }}</td>
                                                        <td class="col-2">{{ $item['emp_name'] ?? '' }}</td>
                                                        <td class="col-2">{{ session('userName') ?? '' }}</td>
                                                        <td class="col-2">
                                                            @if ($item['approvel_status'] == 'Approved')
                                                                <span
                                                                    class="text-success">{{ $item['approvel_status'] }}</span>
                                                            @elseif ($item['approvel_status'] == 'Unapproved')
                                                                <span
                                                                    class="text-warning">{{ $item['approvel_status'] }}</span>
                                                            @elseif ($item['approvel_status'] == 'Rejected')
                                                                <span
                                                                    class="text-danger">{{ $item['approvel_status'] }}</span>
                                                            @endif

                                                            @if ($item['leaveread'] == 'R')
                                                                <span class="text-success">{{ $item['leaveread'] }}</span>
                                                            @else
                                                                <span class="text-danger">{{ $item['leaveread'] }}</span>
                                                            @endif
                                                        </td>
                                                        <td class="col-2">Regular</td>
                                                        <td class="col-2">
                                                            @php
                                                                $read = 1;
                                                                $unread = 0;
                                                            @endphp
                                                            <a
                                                                href="{{ route('catalog.read', $item['leave_form_id']) }}">Read</a>
                                                            {{-- href="{{ route('catalog.read-status', ['read' => $read, 'leave_form_id' => $item['leave_form_id']]) }}">Read</a> --}}
                                                            @php
                                                                $unapproved = 0;
                                                                $approved = 1;
                                                                $rejected = 2;
                                                            @endphp
                                                            <a
                                                                href="{{ route('catalog.approvel', ['status' => $approved, 'leave_form_id' => $item['leave_form_id']]) }}">Approved</a>
                                                            <a
                                                                href="{{ route('catalog.approvel', ['status' => $unapproved, 'leave_form_id' => $item['leave_form_id']]) }}">Disapproved</a>
                                                            <a
                                                                href="{{ route('catalog.approvel', ['status' => $rejected, 'leave_form_id' => $item['leave_form_id']]) }}">Rejected</a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="5" class="tabs">
                            Leave Team Member
                        </div>
                        <div id="6" class="tabs">
                            Team Leave Calendar
                        </div>
                        <div id="7" class="tabs">
                            Leave Report Page
                        </div>
                        <div id="8" class="tabs">
                            Delegate Page
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
                    localStorage.setItem('activeSection', id);
                }
                window.addEventListener('load', function() {
                    const activeSection = localStorage.getItem('activeSection');

                    if (activeSection) {
                        showSection(activeSection);
                    } else {
                        showSection('1');
                    }
                });

                // balance and availed section




                // chart
                // window.onload = function() {
                //     var chartData = @json($chartData);

                //     var chart = new CanvasJS.Chart("chartContainer", {
                //         theme: "light1",
                //         animationEnabled: false,
                //         title: {
                //             text: "Total Used Leave per Month"
                //         },
                //         data: [{
                //             type: "column",
                //             dataPoints: chartData
                //         }]
                //     });
                //     chart.render();
                // }
            </script>


            <script>
                document.getElementById('application_type').addEventListener('change', function() {
                    const selectedValue = encodeURIComponent(this.value);
                    const heading = this.value;
                    const d = new Date();
                    let year = d.getFullYear();
                    const heading1 = heading.concat(" for ", year)
                    // console.log(heading1);
                    let isUser = {!! json_encode(session('isUser')) !!};

                    $.ajax({
                        url: 'application-type/' + selectedValue + '/' + isUser,
                        // console.lg(url)
                        method: 'GET',
                        success: function(response) {
                            // console.log(selectedValue);
                            document.getElementById('txt_heading').textContent = heading1
                            document.getElementById('txt_balance').textContent = response.total_balance
                            document.getElementById('txt_avail_date').textContent = response.total_avail_date
                            document.getElementById('txt_total_applied').textContent = response.total_applied
                            document.getElementById('txt_total_approved').textContent = response.total_approved
                            document.getElementById('txt_pending').textContent = response.total_pending
                        }
                    });
                })
            </script>

            {{-- <script>
                // Custom plugin to display text in the center of the doughnut chart
                const centerTextPlugin = {
                    id: 'centerText',
                    beforeDraw: (chart) => {
                        const ctx = chart.ctx;
                        const dataset = chart.data.datasets[0];
                        const used = dataset.data[0]; // Used leaves
                        const total = used + dataset.data[1]; // Total leaves

                        ctx.save();
                        ctx.font = 'bold 16px Arial'; // Set font size and family
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.fillStyle = 'black'; // Set the color of the text
                        ctx.fillText(`${used}/${total}`, chart.width / 2, chart.height / 2); // Center the text
                        ctx.restore();
                    }
                };

                // Register the custom plugin
                Chart.register(centerTextPlugin);

                // Initialize Sick Leave Chart
                var slCtx = document.getElementById('slChart').getContext('2d');
                var slChart = new Chart(slCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Availed', 'Balance'],
                        datasets: [{
                            data: [{{ $leaveData['availed_sick_leave'] }},
                                {{ $leaveData['total_sick_leave'] - $leaveData['availed_sick_leave'] }}
                            ], // Dynamic data
                            backgroundColor: ['orange', 'green'],
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });

                // Initialize Earned Leave Chart
                var elCtx = document.getElementById('elChart').getContext('2d');
                var elChart = new Chart(elCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Availed', 'Balance'],
                        datasets: [{
                            data: [{{ $leaveData['availed_earned_leave'] }},
                                {{ $leaveData['total_earned_leave'] - $leaveData['availed_earned_leave'] }}
                            ], // Dynamic data
                            backgroundColor: ['orange', 'green'],
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });

                // Initialize Restricted Holiday Chart
                var rhCtx = document.getElementById('rhChart').getContext('2d');
                var rhChart = new Chart(rhCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Availed', 'Balance'],
                        datasets: [{
                            data: [{{ $leaveData['availed_rh_leave'] }},
                                {{ $leaveData['total_rh_leave'] - $leaveData['availed_rh_leave'] }}
                            ], // Dynamic data
                            backgroundColor: ['orange', 'green'],
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });

                // Initialize another chart (if needed for chartContainer)
                var chartData = @json($chartData); // Pass dynamic chart data
                var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "light1",
                    animationEnabled: false,
                    title: {
                        text: "Total Used Leave per Month"
                    },
                    data: [{
                        type: "column",
                        dataPoints: chartData
                    }]
                });
                chart.render();
            </script> --}}
        @endsection
