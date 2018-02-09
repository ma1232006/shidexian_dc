<table class="table">
    @foreach($titles as $title)
        <tr class="success">
            <td>
                {{ $title->id }}、{{ $title->title }}
            </td>
        </tr>
        @if(($title->type == 1) && $title->answer)
            @foreach($title->answer as $answer)
                <tr class="warning">
                    <td>
                        【{{ $answer->text }}】总计：<span style="color: red">{{ $answer->memberAnswer->count() }}</span>
                    </td>
                </tr>
            @endforeach
        @endif
    @endforeach
</table>