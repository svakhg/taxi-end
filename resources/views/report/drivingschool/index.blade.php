@extends('layouts.app')

@section('content')
<ul class="breadcrumb">
    <li><a href="{{ url('home') }}">Home</a></li>
    <li><a href="#">Report</a></li>
    <li class="active">Driving School</li>
</ul>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Driving School History</h3>
    </div>
    <div class="panel-body">
        <div class="row">          
            <div class="col-md-12">
                <form class="form-inline" action="" method="GET">
                    <div class="form-group">
                        <label for="from">Date From</label>
                        <input type="date" class="form-control" id="from" name="from">
                    </div>
                    <div class="form-group">
                        <label for="to">Date To</label>
                        <input type="date" class="form-control" id="to" name="to">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>                      
            </div>
            <div class="col-md-12">
                @if(request()->exists('to') AND request()->exists('from'))

                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>ID Card</th>
                            <th>Phone</th>
                            <th>Category</th>
                            <th>Instructor</th>
                            <th>Remarks</th>
                            <th>Driving Test</th>
                            <th>Theory Test</th>
                            <th>Joined on</th>
                            <th>Registered By</th>
                        </thead>
                        <tbody>
                            <?php $i = 0 ?>
                            @foreach ($students as $student)
                            <?php $i++ ?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $student->name }}</th>
                                    <td>{{ $student->id_card }}</td>
                                    <td>{{ $student->phone }}</td>
                                    <td>{{ $student->category }}</td>
                                    <td>{{ $student->instructor }}</td>
                                    <td>{{ $student->remarks }}</td>
                                    <td>{{ $student->finisheddate }}</td>
                                    <td>{{ $student->theorydate }}</td>
                                    <td>{{ $student->created_at->toFormattedDateString() }}</td>
                                    <td>{{ $student->user->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                
                @endif
            </div> 
        </div>
    </div>        
</div>
@endsection