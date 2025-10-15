<table>
    <thead>
    <tr>
        <th>سوال</th>
      
        @foreach( $all_users as $item)
            <th>{{$item->name}} {{$item->family}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
     
        @foreach($texts as $text)
        <tr>   
            <td>{{$text->text}}</td>
                    @foreach($text['anss'] as $ans)

            <td>{{$ans}}</td>
            @endforeach
</tr>
        @endforeach

    </tbody>


</table>



