@extends('theory.layouts.main')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <div class="panel panel-success">
                <div class="panel-body">
                    <center>
                        <h2 class="dhivehi-font">{{ $quiz->name }}</h2>
                    </center>
                    <form action="{{ url()->current() }}/post" class="dhivehi-font" method="POST" role="form">
                        {{ csrf_field() }}
                        <?php $i = 0 ?>
                        @foreach ($quiz->questions->shuffle() as $question)
                            <?php $i++ ?>
                            <fieldset class="">
                                <h4 class="">{{ $i }}) {{ $question->body }}</h4>
                                
                                @foreach ($question->answers->shuffle() as $answer)
                                    
                                    <div class=" radio">
                                        <label class="" style="font-size: 17px">
                                            <input type="radio" name="question-{{ $question->id }}" value="{{ $answer->id }}"> {{ $answer->answer }}
                                        </label>
                                    </div>    

                                @endforeach
                            </fieldset>
                            
                            <hr style="border-top: 1px solid #000000;">

                        @endforeach

                        
                        
                        <button type="submit" class="">Submit</button>
                    </form>
                    

                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection

@section('css')
    <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
@endsection