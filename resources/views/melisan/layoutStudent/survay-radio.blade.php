@foreach ($random->options as $key => $item)
    <p>
        <label>
            <input class="validate" 
            @if ($random->type == '2') required="" @endif 
            @if ($random->type == '2') type="radio" @else
             type="checkbox"
             @endif
             @if   ($random->type == '2') name="answer"
             @else 
             name="answer[{{ $key }}]"
              @endif
              value="{{ $item->id }}">
            <span>{{ $item->option }}</span>
        </label>
    </p>
    
@endforeach

