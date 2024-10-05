@extends('catalog.common.base')

@section('content')
<div class="container mt-5">
    <h1>Edit Leave Form</h1>

    <form action="{{ route('catalog.update', $leave->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="application">Application</label>
            <input type="text" name="application" class="form-control" value="{{ $leave->leave_application_type }}">
        </div>
        <div class="form-group">
            <label for="applydate">Apply Date</label>
            <input type="text" name="applydate" class="form-control" value="{{ $leave->leave_apply_date }}">
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" name="type" class="form-control" value="{{ $leave->leave_type }}">
        </div>
        <div class="form-group">
            <label for="from_date">From Date</label>
            <input type="text" name="from_date" class="form-control" value="{{ $leave->leave_date_from }}">
        </div>
        <div class="form-group">
            <label for="to_date">To Date</label>
            <input type="text" name="to_date" class="form-control" value="{{ $leave->leave_date_to }}">
        </div>
        <div class="form-group">
            <label for="halfday">Half Day</label>
            <input type="text" name="halfday" class="form-control" value="{{ $leave->leave_half_day }}">
        </div>
        <div class="form-group">
            <label for="days">Days</label>
            <input type="number" name="days" class="form-control" value="{{ $leave->leave_day }}">
        </div>
        <div class="form-group">
            <label for="reason">Reason</label>
            <input type="text" name="reason" class="form-control" value="{{ $leave->leave_reason }}">
        </div>
        <div class="form-group">
            <label for="managerEmail">Manager Email</label>
            <input type="email" name="managerEmail" class="form-control" value="{{ $leave->leave_manager_email }}">
        </div>
        <div class="form-group">
            <label for="ccmail">CC Mail</label>
            <input type="email" name="ccmail" class="form-control" value="{{ $leave->leave_cc_email }}">
        </div>
        <div class="form-group">
            <label for="contact">Contact</label>
            <input type="text" name="contact" class="form-control" value="{{ $leave->leave_contact_no }}">
        </div>

        <div class="form-group">
            <label for="contact">Contact Address</label>
            <input type="text" name="contact_address1" class="form-control" value="{{ $leave->leave_contact_address1 }}">
        </div>
        <div class="form-group">
            <label for="contact">Contact Address</label>
            <input type="text" name="contact_address2" class="form-control" value="{{ $leave->leave_contact_address2 }}">
        </div>
        <div class="form-group">
            <label for="contact">Contact Address</label>
            <input type="text" name="contact_address3" class="form-control" value="{{ $leave->leave_contact_address3 }}">
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" class="form-control" value="{{ $leave->leave_city }}">
        </div>
        <div class="form-group">
            <label for="pincode">Pincode</label>
            <input type="text" name="pincode" class="form-control" value="{{ $leave->leave_pincode }}">
        </div>
        <div class="form-group">
            <label for="medical_certificate">Medical Certificate</label>
            <input type="text" name="medical_certificate" class="form-control" value="{{ $leave->leave_medical_certificate }}">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
    {{-- <form action="{{ route('catalog.delete', $forms->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-3">Delete</button>
    </form> --}}

    
</div>
@endsection

