@extends('layouts.app')

@section('content')                 
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Users</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                <style>
                 .table{
                     width:100%;
                 }
                 </style>
                 <div class="table-responsive">
                     <table class="table">
                         <!-- Don't forget to wrap you table inside a div with the table-responsive class -->
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Field 1</th>
                <th>Field 2</th>
                <th>Field 3</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Value 1</td>
                <td>Value 2</td>
                <td>Value 3</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Value 1</td>
                <td>Value 2</td>
                <td>Value 3</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Value 1</td>
                <td>Value 2</td>
                <td>Value 3</td>
            </tr>
        </tbody>
    </table>
</div>
                     </table>
                 </div>
                </div>    
            </div>
        </div>
    </section>
@endsection