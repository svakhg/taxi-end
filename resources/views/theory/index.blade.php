@extends('theory.layouts.main')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <div class="panel panel-success">
                <div class="panel-body">
                    <div class="first-panel">
                        <center>
                            <img src="/bismilah.jpg" height="90px">
                            <br>
                            <img src="/Taviyani_Logo.png" height="250px">
                            <hr>
                            <span style="font-size: 60px" class="dhivehi-font">{{ $quiz->name }}</span>
                            <hr>
                            <a name="" id="" class="btn btn-primary btn-lg dhivehi-font" href="#question1" role="button">
                                ޓެސްޓް ފަށާ
                            </a>
                        </center>
                    </div>
                    <hr>
                    <div class="questions">
                        <form action="{{ url()->current() }}/post" class="dhivehi-font" method="POST" role="form">
                            {{ csrf_field() }}
                            <?php $i = 0 ?>
                            @foreach ($quiz->questions->shuffle() as $question)
                                <?php $i++ ?>
                                <fieldset class="question" id="question{{ $i }}">
                                    <h1 class="">{{ $i }}) {{ $question->body }}</h1>
                                    <div class="answers">
                                        @if ($question->answers[0]->photo_url)
                                            <img src="{{ \App\Helpers\Helper::s3_url_gen($answer->photo_url) }}" alt="">
                                        @endif
                                        @foreach ($question->answers->shuffle() as $answer)
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
                                    <br>
                                    <br>
                                    <div>
                                        @if ($i !== $quiz->questions->count())
                                            <a name="" id="" class="btn btn-primary" href="#question{{ $i + 1 }}" role="button">
                                                ކުރިޔަށް
                                            </a>
                                        @else
                                            <button type="submit" class="btn btn-primary">
                                                ޓެސްޓް ނިންމާ
                                            </button>
                                        @endif
                                        @if ($i !== 1)
                                            <a name="" id="" class="btn btn-info" href="#question{{ $i - 1 }}" role="button">
                                                ފަހަތަށް
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
</div>

@endsection

@section('css')
    <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
@endsection