@extends('layouts.app')

@section('css')
<style>
        #myInput {
            background-image: url('/searchicon.png');
            background-position: 10px 12px; 
            background-repeat: no-repeat; 
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px; 
            border: 1px solid #ddd; 
            margin-bottom: 12px; 
        }
</style>
@endsection

@section('content')

<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="{{ url('driving-school') }}">Driving School</a></li>
    <li><a href="{{ url('driving-school') }}" class="active">All Registered Driving Students</a></li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">All Driving School Students</h3>
    </div>
    <div class="panel-body">
        <div class="row">          
                <div class="col-md-12">
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
        
                                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                
                                @endif
                            @endforeach
                        </div>
                    </div>          
            <div class="col-md-12">
                    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for student names..">
                    <table id="taxi" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>                            
                                    <th>Name</th>
                                    <th>ID Card</th>
                                    <th>Phone</th>
                                    <th>Category</th>
                                    <th>Instructor</th>
                                    <th>Remarks</th>
                                    <th>Registered By</th>
                                    <th>Joined on</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->name }}</th>
                                    <td>{{ $student->id_card }}</td>
                                    <td>{{ $student->phone }}</td>
                                    <td>{{ $student->category }}</td>
                                    <td>{{ $student->instructor }}</td>
                                    <td>{{ $student->remarks }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td>{{ $student->created_at->toFormattedDateString() }}</td>
                                    <td>
                                        <a style="margin:1px" class="btn btn-warning" href="{{ url()->current() }}/students/{{ $student->id }}/edit">Edit</a>
                                        <a style="margin:1px" class="btn btn-info" href="{{ url()->current() }}/view/">View</a>
                                        <a style="margin:1px" class="btn btn-success" href="{{ url()->current() }}/students/{{ $student->id }}">Reciept</a>
                                    </td>
                                </tr>                            
                                @endforeach
                            </tbody>
                        </table>
            </div> 
        </div>
    </div>        
</div>                



@endsection
@section('js')
<script>
        function myFunction() {
          // Declare variables 
          var input, filter, table, tr, td, i;
          input = document.getElementById("myInput");
          filter = input.value.toUpperCase();
          table = document.getElementById("taxi");
          tr = table.getElementsByTagName("tr");
        
          // Loop through all table rows, and hide those who don't match the search query
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
              if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            } 
          }
        }
        </script>
@endsection