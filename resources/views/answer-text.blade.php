<table class="table">
    @foreach($titles as $title)
        <tr class="success">
            <td>
                {{ $title->id }}、{{ $title->title }}
            </td>
        </tr>

        @if($title->memberAnswer)
            @foreach($title->memberAnswer()->where('text', '!=', '')->get() as $answer)
                <tr class="warning">
                    <td>
                        {{ $answer->text }}
                    </td>
                </tr>
            @endforeach
        @endif
    @endforeach
</table>