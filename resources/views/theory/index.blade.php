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
                    <hr>
                    <form action="{{ url()->current() }}/post" class="dhivehi-font" method="POST" role="form">
                        {{ csrf_field() }}
                        <?php $i = 0 ?>
                        @foreach ($quiz->questions->shuffle() as $question)
                            <?php $i++ ?>
                            <fieldset class="question" id="question{{ $i }}">
                                <h1 class="">{{ $i }}) {{ $question->body }}</h1>
                                <div class="answers">
                                    @foreach ($question->answers->shuffle() as $answer)
                                        @if ($answer->photo_url)
                                            <img src="{{ \App\Helpers\Helper::s3_url_gen($answer->photo_url) }}" alt="">
                                        @endif
                                        <div class="radio">
                                            <label class="" style="font-size: 25px">
                                                <input type="radio" name="question-{{ $question->id }}" value="{{ $answer->id }}" style="margin-top: 18px; margin-left: 10px;">
                                                <span class="answer">
                                                    {{ $answer->answer }}
                                                </span>
                                            </label>
                                        </div>    
                                    @endforeach
                                </div>
                                <div>
                                    @if ($i !== $quiz->questions->count())
                                        <a name="" id="" class="btn btn-primary" href="#question{{ $i + 1 }}" role="button">
                                            Next
                                        </a>
                                    @else
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    @endif
                                    @if ($i !== 1)
                                        <a name="" id="" class="btn btn-info" href="#question{{ $i - 1 }}" role="button">
                                            Previous
                                        </a>
                                    @endif
                                </div>
                            </fieldset>
                            
                            <hr style="border-top: 1px solid #000000;">

                        @endforeach
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