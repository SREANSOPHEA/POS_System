@extends('admin.masterPage')
@section('content_Title','Create new customer')
@section('title',' - Add Customer')
@section('content')
    <div class="card p-3">
        <form action="/admin/add-customer-submit" method="post">
            @csrf
            <table class="w-100">
                <tr class="align-top">
                    <th>Name</th>
                    <td><input type="text" name="name" class="form-control border-2 border-dark"></td>
                </tr>
                <tr class="align-top">
                    <th>Gender</th>
                    <td class="d-flex justify-content-around">
                        <div class="align-center d-flex"><label for="Male">Male</label><input type="radio" name="gender" value="Male" id="Male" checked></div>
                        <div class="align-center d-flex"><label for="Female">Female</label><input type="radio" name="gender" value="Female" id="Female"></div>
                    </td>
                </tr>
                <tr class="align-top">
                    <th>Email</th>
                    <td><input type="text" name="email" class="form-control border-2 border-dark"></td>
                </tr>
                <tr class="align-top">
                    <th>Phone</th>
                    <td><input type="text" name="phone" class="form-control border-2 border-dark"></td>
                </tr>
                <tr class="align-top">
                    <th>Address</th>
                    <td><input type="text" name="address" class="form-control border-2 border-dark"></td>
                </tr>
                <tr class="align-top">
                    <th>Status</th>
                    <td>
                        <select name="status" class="form-select border-2 border-dark">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center"><button class="btn btn-primary">Save</button></td>
                </tr>
            </table>
        </form>
    </div>
   
@endsection