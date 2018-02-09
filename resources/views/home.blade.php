@extends('app')

@section('css')
    <style>

        label{
            font-weight: normal;
        }

        input{
            border: none;
            background-color: #fcf8e3;
            border-bottom: 1px solid #826161;
        }
    </style>
@stop

@section('content')

    <div class="header">
        <h1 class="text-center">食得鲜员工调查问卷(匿名)</h1>
    </div>

    <div class="row">

        @if (session('error'))
            <div class="alert alert-error text-center">
                <h3 style="color: red">{{ session('error') }}</h3>
            </div>
        @endif

        <form method="post" action="{{ route('create') }}">
            <table class="table">
                @foreach($titles as $title)

                    <tr class="title success">
                        <td class="">
                            <h4>{{ $title->id }}、{{ $title->title }}</h4>
                        </td>
                    </tr>

                    @if(($title->type == 1) && $title->answer)
                        @foreach($title->answer as $answer)

                            <tr class="warning">
                                <td class="">&nbsp;<label style="display: block;">
                                        <input type="radio" @if (isset(old(($title->id - 1))['radio']) && (old(($title->id - 1))['radio'] == $answer->id)) checked @endif name="answer[{{ $title->id }}][radio]" value="{{ $answer->id }}">{{ $answer->text }}
                                    </label>
                                </td>
                            </tr>
                            <tr class="warning">
                                @if ($loop->last)
                                    <td class="">
                                        <label style="display: block;" for="objection" class="control-label">
                                            补充意见:
                                            <input type="text" name="answer[{{ $title->id }}][text]" value="@if (isset(old(($title->id - 1))['text']) && (! empty(old(($title->id - 1))['text']))) {{ old(($title->id - 1))['text'] }} @endif">
                                        </label>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endif

                    @if(($title->type == 2) && $title->message)
                        <tr class="warning">
                            <td class=""><textarea name="message[{{ $title->id }}][textarea]" class="form-control">@if (isset(old(($title->id - 1))['textarea']) && (! empty(old(($title->id - 1))['textarea']))) {{ old(($title->id - 1))['textarea'] }} @endif</textarea></td>
                        </tr>
                    @endif
                @endforeach
            </table>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary btn-lg btn-block">提交问卷</button>
        </form>
    </div>

@endsection