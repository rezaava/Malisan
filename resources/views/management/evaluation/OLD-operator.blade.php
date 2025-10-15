<section class="tabs-vertical mt-1 section">
    <div class="col l3 s12 mt-3">
        <!-- tabs  -->
        <div class="card-panel">
            <ul class="tabs">
                <li class="btn btn-block mb-2">
                    <a href="/dashboard/evaluation?course_id={{$course->id}}&&page=questions" class="active custom-main-tab-link"
                    >
                        <i class="material-icons dp48">question_answer</i>
                        @if (Laratrust::hasRole('teacher'))
                            <span
                                سوالات({{ $q_not }})
                                @else
                                سوالات
                        @endif
                    </a>
                </li>
                <li class="btn btn-block mb-2">
                    <a class="custom-main-tab-link" href="/dashboard/evaluation?course_id={{$course->id}}&&page=reports"
                    >
                        <i class="material-icons dp48">record_voice_over</i>
                        @if (Laratrust::hasRole('teacher'))
                            گزارش({{ $d_not }})
                        @else
                            گزارش
                        @endif
                    </a>
                </li>
                <li class="btn btn-block mb-2">
                    <a href="/dashboard/evaluation?course_id={{$course->id}}&&page=operator" class="custom-main-tab-link"
                    >
                        <i class="material-icons dp48">work</i>
                        @if (Laratrust::hasRole('teacher'))
                            تکلیف({{ $e_not }})
                        @else
                            تکلیف
                        @endif
                    </a>
                </li>
                <li class="tab" style="visibility: hidden">
                    <a  class="custom-main-tab-link">
                    </a>
                </li>
                <li class="indicator" style="left: 0px; right: 0px;"></li>
            </ul>
        </div>
    </div>
</section>
