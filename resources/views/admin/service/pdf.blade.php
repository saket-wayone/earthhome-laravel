<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Investment Advisor Agreement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
        }
        h1 {
            font-size: 18px;
            text-align: center;
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        td, th {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .question {
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://crm.growfortuna.com/admin/images/logo.webp" alt="Logo" style="width: 100px;">
        <h1>Risk Assessment Score</h1>
    </div>
    <table>
        <tr>
            <td>Name</td>
            <td colspan="5"><b style="color: blue;">{{$risk['riskmodel']->name ?? ''}}</b></td>
        </tr>
        <tr>
            <td>Risk Score</td>
            <td colspan="5"><b style="color: blue;">{{$risk['riskmodel']->totalpoints ?? ''}}</b></td>
        </tr>
        <tr>
            <td>Mobile Type</td>
            <td colspan="5"><b style="color: blue;">{{$risk['riskmodel']->phone ?? ''}}</b></td>
        </tr>
        <tr>
            <td colspan="3">Have you previously taken trading advisory from any other Investment Advisory Firm?</td>
            <td colspan="3"><b style="color: blue;">{{$risk['riskmodel']->previous_advisory ?? ''}}</b></td>
        </tr>
        <tr>
            <td colspan="3">Advisory Firm Name</td>
            <td colspan="3"><b style="color: blue;">{{$risk['riskmodel']->firm ?? ''}}</b></td>
        </tr>
        <tr>
            <td colspan="3">Have you previously had a loss in Trading?</td>
            <td colspan="3"><b style="color: blue;">{{$risk['riskmodel']->previous_loss ?? ''}}</b></td>
        </tr>
        <tr>
            <td colspan="3">If YES, then what is the Loss Percentage (%) as per the Capital Value?</td>
            <td colspan="3"><b style="color: blue;">{{$risk['riskmodel']->loss_percentage ?? ''}}</b></td>
        </tr>
        <tr>
            <td>What is Your Liability / Borrowing Details?</td>
            <td colspan="5"><b style="color: blue;">{{$risk['riskmodel']->liability ?? ''}}</b></td>
        </tr>
        <tr>
            <td>Other Liability / Borrowing Details?</td>
            <td colspan="5"><b style="color: blue;">{{$risk['riskmodel']->other_Liability ?? ''}}</b></td>
        </tr>
        <tr>
            <td>What is Your age?</td>
            <td colspan="5"><b style="color: blue;">{{$risk['riskmodel']->age ?? ''}}</b></td>
        </tr>
        <tr>
            <td colspan="3">Have you ever traded in the stock market? If yes, then select the segment.</td>
            <td colspan="3"><b style="color: blue;">{{$risk['riskmodel']->ever_did_trade ?? ''}}</b></td>
        </tr>
        @if(!empty($risk['questions']))
        @foreach($risk['questions'] as $key => $listing)
        <tr>
            <td colspan="6" class="question">{{ $listing->question ?? '' }}</td>
        </tr>
        @if(!$listing->subquestions->isEmpty())
        @php $subQuestionCount = 0; @endphp
        @foreach($listing->subquestions as $subquestionlist)
        @php $subQuestionCount++; @endphp
        <tr>
            <td colspan="6" class="question">{{ $subQuestionCount }}. {{ $subquestionlist->question ?? '' }}</td>
        </tr>
        @if(!empty($subquestionlist->options))
        @php $optionCount = 0; @endphp
        @foreach($subquestionlist->options as $option)
        @php $optionCount++; @endphp
        <tr>
            <td colspan="3" >{{ $subQuestionCount }}.{{ $optionCount }}. {{ $option->option ?? '' }}</td>
            <td colspan="3" >
                @php
                $answer = $risk['answers']->first(function($answer) use ($listing, $subquestionlist, $option) {
                return $answer->question_id == $listing->id
                && $answer->subquestion_id == $subquestionlist->id
                && $answer->option_id == $option->id;
                });
                @endphp
                <b style="color:blue;"> {{ $answer->option ?? '' }} </b>
            </td>
        </tr>
        @endforeach
        @endif
        @endforeach
        @else
        @if(!empty($listing->options))
        @php $optionCount = 0; @endphp
        @foreach($listing->options as $option)
        @php $optionCount++; @endphp
        <tr>
            <td  colspan="3" >{{ $optionCount }}. {{ $option->option ?? '' }}</td>
            <td  colspan="3" >
                @php
                $answer = $risk['answers']->first(function($answer) use ($listing, $option) {
                return $answer->question_id == $listing->id
                && $answer->option_id == $option->id;
                });
                @endphp
                <b style="color:blue;"> {{ $answer->option ?? '' }} </b>
            </td>
        </tr>
        @endforeach
        @endif
        @endif
        @endforeach
        @endif
    </table>
    <p>*According to your risk profile your risk score is High Risk, the product suitability pdf is attached with the mail.</p>
    <p>**The questions in the Risk profile management have a certain weight of score. Moreover, a few questions, like No. 1, 2, & 7, will be independent of the category depending on the total score.</p>
</body>
</html>
