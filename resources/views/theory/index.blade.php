@extends('theory.layouts.main')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <div class="panel panel-success">
                <div class="panel-body">
                    <div class="first-panel">
                        <div class="no-dhivehi timer" id="countTime"></div>
                        <center>
                            <img src="/bismilah.jpg" height="90px">
                            <br>
                            <img src="/Taviyani_Logo.png" height="250px">
                            <hr>
                            <span style="font-size: 60px" class="dhivehi-font">{{ $quiz->name }}</span>
                            <hr>
                            <a name="" id="" class="btn btn-primary btn-lg dhivehi-font" href="#question1" role="button" onclick="startTimer()">
                                ޓެސްޓް ފަށާ
                            </a>
                        </center>
                    </div>
                    <hr>
                    <div class="questions">
                        <form action="{{ url()->current() }}/post" class="dhivehi-font" id="theory-submit" method="POST" role="form">
                            {{ csrf_field() }}
                            <?php $i = 0 ?>
                            @foreach ($quiz->questions->shuffle() as $question)
                                <?php $i++ ?>
                                <fieldset class="question" id="question{{ $i }}">
                                    <div class="question-inner">
                                        <h1 class="">{{ $i }}) {{ $question->body }}</h1>
                                        <div class="answers">
                                            <div class="row">
                                                <div class="col-md-8">
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
                                                @if ($question->answers->first()->photo_url)
                                                    <div class="col-md-3">
                                                        <img src="{{ \App\Helpers\Helper::s3_url_gen($question->answers->first()->photo_url) }}" alt="">
                                                    </div>
                                                @endif
                                            </div>
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
                                    </div>
                                </fieldset>
                                
                                <hr style="border-top: 1px solid #000000;">
                                <br>
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
    <style>
        body {
            overflow: hidden;
        }
    </style>
@endsection

@section('js')
    <script>
        $(function() {
            console.log("Disabling Scrollg");

            if (window.addEventListener) // older FF
            window.addEventListener('DOMMouseScroll', preventDefault, false);
            window.onwheel = preventDefault; // modern standard
            window.onmousewheel = document.onmousewheel = preventDefault; // older browsers, IE
            window.ontouchmove  = preventDefault; // mobile
            document.onkeydown  = preventDefaultForScrollKeys;

            console.log("Scrolling Disabled");
        });

        function startTimer() {
            var countdown = 5 * 1000;
            var timerId = setInterval(function(){
                countdown -= 1000;
                var min = Math.floor(countdown / (60 * 1000));
                //var sec = Math.floor(countdown - (min * 60 * 1000));  // wrong
                var sec = Math.floor((countdown - (min * 60 * 1000)) / 1000);  //correct

                if (countdown <= 0) {
                    clearInterval(timerId);
                    document.getElementById("theory-submit").submit();
                    //doSomething();
                } else {
                    $("#countTime").html(min + " : " + sec);
                }
            }, 1000); //1000ms. = 1sec.
        }

        // left: 37, up: 38, right: 39, down: 40,
        // spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
        var keys = {37: 1, 38: 1, 39: 1, 40: 1};

        function preventDefault(e) {
            e = e || window.event;
            if (e.preventDefault)
                e.preventDefault();
            e.returnValue = false;  
        }

        function preventDefaultForScrollKeys(e) {
            if (keys[e.keyCode]) {
                preventDefault(e);
                return false;
            }
        }
    </script>

@endsection