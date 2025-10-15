<table>
    <thead>
    <tr>
        <th>name</th>
        <th>جنسیت</th>
        <th>مقطع</th>
        <th>سن</th>
        <th>نام درس</th>
        @foreach($texts as $item)
            <th>{{$item->text}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->gender_name}}</td>
            <td>{{$user->degree}}</td>
            <td>'1'</td>
            <td>{{$user->age}}</td>
            @foreach($user->user_answers as $key=>$item)
                <td>

                        {{$item[0]}}

                </td>
            @endforeach


        </tr>
    @endforeach
    </tbody>


</table>



