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
    <div class="wrapper">
        <div class="row">
            <div class="col-12 col-sm-2 col-md-2" style="background: #f0f0f0">
                <aside class="p-2">
                    <ul>
                        <li><a href="javascript:void(0)" onclick="showSection('1')">Leave Application</a></li>
                        <li><a href="javascript:void(0)" onclick="showSection('2')">Leave Details</a></li>
                        <li><a href="javascript:void(0)" onclick="showSection('3')">Leave Balance</a></li>
                    </ul>
                </aside>
            </div>
            <div class="col-12 col-sm-10 col-md-10">
                <div class="container" id="contentArea">
                    <div id="1" class="ative tabs">
                        <div class="col-md-12">
                            <h2>Leave Application</h2>
                            <div class="row">
                                <div class="col-md-8">
                                    <form action="{{ $action }}" method="post">
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
                                                    <select name="type" id="type" class="form-control">
                                                        <option value="-select-">--Select--</option>
                                                        <option value="Sick Leave">Sick Leave</option>
                                                        <option value="Emergency Leave">Emergency Leave</option>
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
                                                    <input class="form-control" type="date" name="to_date" id="to_date"
                                                        placeholder="To" />
                                                </div>
                                            </div>

                                            <!-- Half Day Selection -->
                                            <div class="row mb-4">
                                                <div class="col-3 text-start">
                                                    <label for="halfday">Half Day</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="radio" name="halfday" value="First Half"> First Half
                                                    <input type="radio" name="halfday" value="Second Half" class="ms-2">
                                                    Second Half
                                                    {{-- <input type="radio" name="halfday" value="Both Half"
                                                            class="ms-2"> Both Half --}}
                                                    <input type="radio" name="halfday" value="Full Day" class="ms-2">
                                                    Full Day
                                                </div>
                                            </div>

                                            <!-- Days -->
                                            <div class="row mb-4">
                                                <div class="col-3 text-start">
                                                    <label for="days">Days</label>
                                                </div>
                                                <div class="col-9">
                                                    <input class="form-control" type="number" name="days"
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

                                            <!-- Contact Address -->
                                            <div class="row mb-4">
                                                <div class="col-3 text-start">
                                                    <label for="contact_address">Contact Address</label>
                                                </div>
                                                <div class="col-9">
                                                    <input class="form-control mb-3" type="text"
                                                        name="contact_address1" id="contact_address1"
                                                        placeholder="Address Line 1">
                                                    <input class="form-control mb-3" type="text"
                                                        name="contact_address2" id="contact_address2"
                                                        placeholder="Address Line 2">
                                                    <input class="form-control mb-3" type="text"
                                                        name="contact_address3" id="contact_address3"
                                                        placeholder="Address Line 3">
                                                </div>
                                            </div>

                                            <!-- City -->
                                            <div class="row mb-4">
                                                <div class="col-3 text-start">
                                                    <label for="city">City</label>
                                                </div>
                                                <div class="col-9">
                                                    <input class="form-control mb-3" type="text" name="city"
                                                        id="city">
                                                </div>
                                            </div>

                                            <!-- PinCode -->
                                            <div class="row mb-4">
                                                <div class="col-3 text-start">
                                                    <label for="pincode">PinCode</label>
                                                </div>
                                                <div class="col-9">
                                                    <input class="form-control mb-3" type="number" name="pincode"
                                                        id="pincode">
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
                                        <h1 class="bg-dark text-white fs-4 p-2 mb-0">Selected Application Details</h1>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>Balance</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>Availed till Date</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>Total Applied</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>Total Approved</td>
                                                <td>0</td>
                                            </tr>
                                            <tr>
                                                <td>Pending for Approval</td>
                                                <td>0</td>
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
                                            @foreach ($forms as $item)
                                                <tr class="fontsize text-center">
                                                    <td class="col-2 text-centre">
                                                        <a href=""><button class="btn1 " title="View"><i
                                                                    class="fa-regular fa-eye"></i></button></a>
                                                        <a href="{{ route('catalog.edit', $item['leave_form_id']) }}"><button
                                                                class="btn1 " title="Edit"><i
                                                                    class="fa-regular fa-edit"></i></button></a>
                                                        <a href="{{ route('catalog.delete', $item['leave_form_id']) }}"><button
                                                                class="btn1  " title="Delete"><i
                                                                    class="fa-regular fa-trash-alt"></i></button></a>
                                                    </td>
                                                    <td class="col-2">{{ $item['emp_id'] }}</td>
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
                        <div class="w-100" style="height: 100vh" id="chartContainer"></div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // function showSection(id) {
            //     const sections = document.querySelectorAll('.tabs');
            //     sections.forEach(section => {
            //         section.classList.remove('active');
            //     });
            //     document.getElementById(id).classList.add('active');
            // }


            function showSection(id) {
                const sections = document.querySelectorAll('.tabs');

                // Remove 'active' class from all sections
                sections.forEach(section => {
                    section.classList.remove('active');
                });

                // Add 'active' class to the selected section
                document.getElementById(id).classList.add('active');

                // Save the current section to localStorage
                localStorage.setItem('activeSection', id);
            }

            // On page load, check if there's an active section saved in localStorage
            window.addEventListener('DOMContentLoaded', () => {
                const activeSection = localStorage.getItem('activeSection');

                if (activeSection) {
                    showSection(activeSection); // Show the last active section
                } else {
                    showSection('1'); // Show the first section as default if no section is stored
                }
            });






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