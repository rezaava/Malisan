{{--<table>--}}
    {{--<thead>--}}
    {{--<tr >--}}
        {{--<th>name</th>--}}
        {{--<th>جنسیت</th>--}}
        {{--<th>مقطع</th>--}}
        {{--<th>سن</th>--}}
        {{--<th>نام درس</th>--}}
        {{--@foreach($texts as $item)--}}
            {{--<th>{{$item->text}}</th>--}}
        {{--@endforeach--}}
    {{--</tr>--}}
    {{--</thead>--}}
    {{--<tbody>--}}
    {{--@foreach($users as $user)--}}
        {{--<tr>--}}
            {{--<td>{{$user->name}}</td>--}}
            {{--<td>{{$user->gender_name}}</td>--}}
            {{--<td>{{$user->degree}}</td>--}}
            {{--<td>'1'</td>--}}
                        {{--<td>{{$user->age}}</td>--}}
            {{--@foreach($texts as $key=>$item)--}}
                {{--<td>--}}
                    {{--@if(($user->user_answers[$key])!=null )--}}
                        {{--{{$user->user_answers[$key][0]->answer}}--}}

                    {{--@endif--}}
                {{--</td>--}}
            {{--@endforeach--}}


        {{--</tr>--}}
    {{--@endforeach--}}
    {{--</tbody>--}}


{{--</table>--}}



@foreach($texts as $text)
    <table>
        <thead>
        <tr>
            <th>{!! $text->text !!}</th>
            <th>تعداد پاسخ</th>

                <th>به این سوال به صورت تشریحی پاسخ داده شده است</th>

        </tr>
        </thead>
        <tr>
            <td>امار</td>
            <td>{{$text->count}}</td>

        </tr>
    </table>
@endforeach


<tr>
</tr>
@foreach($tests as $test)
    <table>
        <thead>
        <tr>
            <th>{!! $test->text !!}</th>
            <th>تعداد پاسخ</th>
        @foreach($test->options as $option)
                <th>{{$option->option}}</th>
            @endforeach

        </tr>
        </thead>
        <tr>
            <td>امار</td>
            <td>{{$test->all_ans}}</td>

            @foreach($test->count as $key=>$item)
                <td>
                        {{$item}}
                </td>
            @endforeach

        </tr>
    </table>
@endforeach
