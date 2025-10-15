<table>
    <thead>
    <tr>
        <th>نام</th>
        <th>نام خانوادگی</th>

        <th>نمره سوالات طراحی شده</th>
        <th>نمره گزارش ارسال شده</th>
        
        <th>امتیاز پیشرفت</th>
        <th>نمره تلاش</th>
        <th>امتیاز کل</th>
        



    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->family}}</td>

           
            <td>{{$user['q']}}</td>

          
            <td>{{$user['d']}}</td>
            <td>{{$user['pishraft']}}</td>
            <td>{{$user['talash']}}</td>
            <td>{{$user['total']}}</td>



        </tr>
    @endforeach
    </tbody>


</table>



