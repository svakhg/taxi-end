@extends('theory.layouts.main')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-body">
                    <div class="main">
                        <div class="score">
                            <span class="score-text">Final Score</span>
                            <br>
                            <span class="score-percent">
                            <?php
                                $percent = ($score / $total_score) * 100;
                                echo round($percent) . "%";
                            ?>
                            </span>
                            <br>
                            <span class="score-text">30 of 57 correct</span>
                        </div>
                        <hr>
                        <div class="details">
                            <?php
                            foreach ($questions as $question) {
                                $question_i = 'question-'.$question->id;
                                $user_answer = $request->input($question_i);
                                $correct_answer = $question->answers->where('is_correct', '1')->first();

                                echo $question_i;
                                echo "<br>";
                                if ($user_answer == $correct_answer->id) {
                                    echo 'Answer is correct';
                                    echo "<br>";
                                } 
                                else {
                                    echo 'Answer is wrong, The correct answer is '.$correct_answer->answer;
                                    echo "<br>";
                                }
                                echo "<hr>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection

@section('css')
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .main {
            min-height: 100vh;
        }
        .score {
            text-align: center;
        }
        .score-text {
            font-size: 60px;
            color: blue;
        }
        .score-percent {
            font-size: 55px;
            color: red;
        }
    </style>
@endsection

@section('js')
    <script defer src="/js/jquery.flexverticalcenter.js"></script>
    <script>
        $('.score').flexVerticalCenter();
    </script>

@endsection