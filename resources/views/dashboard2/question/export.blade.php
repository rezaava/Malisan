<table>
    <thead>
    <tr>
        <th>سوال</th>
        <th>گزینه 1</th>
        <th>گزینه 2</th>
        <th>گزینه 3</th>
        <th>گزینه 4</th>
        <th>گزینه صحیح</th>
        <th>سطخ</th>

    </tr>
    </thead>
    <tbody>
    @foreach($questions as $q)
        <tr>
            <td>{{$q->question}}</td>
            <td>{{$q->answer1}}</td>
            <td>{{$q->answer2}}</td>
            <td>{{$q->answer3}}</td>
            <td>{{$q->answer4}}</td>
            <td>{{$q->answer}}</td>
            <td>{{$q->level}}</td>
        </tr>
    @endforeach
    </tbody>


</table>



