<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $subject }}</title>
    <style>

    </style>
</head>
<body>
    <h3>Dear {{ $managerdata->fullName }}</h3> 

    <p>{{ $userdata->fullName }} has applied for the following leave:</p>
    <p><strong>Type :</strong> {{ $array['leave_type'] }}</p>
    <p><strong>Date :</strong> {{ $array['leave_apply_date'] }}</p>
    <p><strong>Days :</strong>{{ $array['leave_day'] }}</p>
    <p><strong>Reason :</strong> {{ $array['leave_reason'] }}</p>

    <p>Employee's Current account details are as follows:</p>

    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr style="background-color: #4F4F4F; color: white; font-weight: bold;">
                <th colspan="2">Sick Leave for 2024</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Balance</td>
                <td>8</td>
            </tr>
            <tr>
                <td>Availed till Date</td>
                <td>1</td>
            </tr>
            <tr>
                <td>Total Applied</td>
                <td>1</td>
            </tr>
            <tr>
                <td>Total Approved</td>
                <td>1</td>
            </tr>
            <tr>
                <td>Pending for Approval</td>
                <td>0</td>
            </tr>
        </tbody>
    </table>
    

</body>
</html>