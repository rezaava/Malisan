@extends('management.layout.master')
@section('title', 'داوری دوستان')
@section('add-styles')
@endsection
@section('main-content')
    <div class="scurvy_section_parent gradient-45deg-yellow-green padding-5 medium-small">
        <div class="row">
            <div class="col s12">
                <div id="radio-buttons" class="card card-tabs custom_survay_box">
                    <div class="card-content">
                        <div class="card-title">
                            <div class="row">
                                <!--<div class="col s12 m12 l12">-->
                                <!--    <h4 class="card-title">-->
                                <!--        <div class="question_number_container">-->
                                <!--            <p class="custom_survay_lable">Q</p>-->
                                <!--        </div>-->
                                <!--    </h4>-->
                                <!--</div>-->
                            </div>
                        </div>
                        <form action="{{ route('judments.post', $pageData->id) }}" method="post" id="formId">
                            @csrf
                            <input type="hidden" value="{{ $pageData->type }}" name="type">
                            <div id="view-radio-buttons" class="active">
                                <p class="survay_title">
                                    {!! $pageData->content ?? '' !!}
                                </p>
                                @isset($pageData->answers)
                                    @foreach ($pageData->answers as $key => $value)
                                        <div class="col l3 m4 s12">
                                            <div class="custom_answer_box_wrapper @if ($key == $pageData->bestAnswer) tru_answer @else false_answer  @endif">
                                                <div class="best_answer_title">
                                                    @if ($key == $pageData->bestAnswer)
                                                        <img class="custom_best_answer_icon"
                                                             src="{{ asset('app-assets/images/icon/true.png') }}" alt="">
                                                    @else
                                                        <img class="custom_best_answer_icon"
                                                             src="{{ asset('app-assets/images/icon/false.png') }}" alt="">
                                                    @endif
                                                </div>
                                                <div class="custom_divider @if ($key == $pageData->bestAnswer) custom_bg_success @else custom_bg_danger  @endif"></div>
                                                <div class="best_answer_content">
                                                    <strong class="@if ($key == $pageData->bestAnswer) custom_text_success @else custom_text_danger  @endif">
                                                        {{ $value }}
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endisset
                                <hr>
                                @isset($pageData->answers)
                                    <p>سوال و گزینه ها دارای ایراد نگارشی و غلط املایی است؟</p>
                                @else
                                    <p>گزارش یا تحقیق دارای ایراد نگارشی و غلط املایی است؟</p>

                                @endif
                                <div class="custom_choice_container">



                                    <p class="mb-1">

                                        <label>
                                            <input name="answer1" type="radio" value="true"  onclick="hideDesc1()">
                                            <span>خیر</span>
                                           </label>
                                    </p>
                                    <p class="mb-1">
                                        <label>
                                            <input name="answer1" value="incorrect" checked="" type="radio" onclick="showDesc1()">
                                            <span>بله</span>
                                        </label>
                                    </p>
                                    <div class="input-group mb-3"  id="description1" style="">
                                        <div class="col-lg-12">
                                            <p style="color:red">
                                                @isset($pageData->answers)
                                                    <span>غلط املایی یا نگارشی را ذکر کنید</span>
                                                @else
                                                    <span>غلط املایی یا نگارشی را ذکر کنید</span>
                                                @endif
                                            </p>

{{--                                            <span>دلیل:</span>--}}
                                            <textarea class="form-control btn-square" name="description1" minlength="5"
                                                      id="desc1" name="description1" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom_choice_container">
                                    @isset($pageData->answers)
                                        <p>سوال طرح شده گویا و اموزنده است؟</p>
                                    @else
                                        <p>گزارش یا تحقیق توسط خود دانشجو نوشته شده است؟</p>

                                    @endif
                                    <p class="mb-1">
                                        <label>
                                            <input name="answer2" type="radio" value="true"  onclick="hideDesc2()">
                                            <span>بله</span>
                                        </label>
                                    </p>
                                    <p class="mb-1">
                                        <label>
                                            <input name="answer2" value="incorrect" checked="" type="radio" onclick="showDesc2()">
                                            <span>خیر</span>

                                        </label>
                                    </p>
                                    <div class="input-group mb-3"  id="description2" style="">
                                        <div class="col-lg-12">
                                            <p style="color:red">
                                                @isset($pageData->answers)
                                                    <span>ایراد سوال را ذکر کنید</span>
                                                @else
                                                    <span> مستنداتی در این خصوص ارائه کنید</span>
                                                @endif
                                            </p>

{{--                                            <span>دلیل:</span>--}}
                                            <textarea class="form-control btn-square" name="description2" minlength="5"
                                                      id="desc2" name="description2" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom_choice_container">
                                    <p class="mb-1">
                                    @isset($pageData->answers)
                                        <p>گزینه های سوال مناسب انتخاب شده اند؟</p>
                                    @else
                                        <p>محتوای گزارش یا تحقیق خوب و آموزنده است؟</p>

                                    @endif
                                        <label>
                                            <input name="answer3" type="radio" value="true"  onclick="hideDesc3()">

                                            <span>بله</span>
                                        </label>
                                    </p>
                                    <p class="mb-1">
                                        <label>
                                            <input name="answer3" value="incorrect" checked="" type="radio" onclick="showDesc3()">
                                            <span>خیر</span>



                                        </label>
                                    </p>
                                    <div class="input-group mb-3"  id="description3" style="">
                                        <div class="col-lg-12">
                                            <p style="color:red">
                                                @isset($pageData->answers)
                                                    <span>ایراد گزینه ها را ذکر کنید.مثلا بیش از یک پاسخ صحیح،نادرست بودن پاسخ صحیح،اشاره به شماره ترتیبی گزینه های دیگر</span>
                                                @else
                                                    <span> ایراد های آن را ذکر کنید</span>
                                                @endif
                                            </p>

{{--                                            <span>دلیل:</span>--}}
                                            <textarea class="form-control btn-square" name="description3" minlength="5"
                                                      id="desc3" name="description3" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                                                              @if($objectRendered->level==1)

                                    <pre><p style="color:red;border:1px dotted black;display: none">
                                        در داوری مقدماتی لازم است موارد زیر بررسی شوند:
1-	وجود غلط های فاحش نگارشی و املایی (به خصوص در سوالات)
2-	طولانی بودن بیش از حد گزارش یا تهی بودن گزارش از محتوای علمی
3-	طولانی یا پیچیده بودن سوال یا گزینه ها به نحوی که نتوان در مدت زمان یک دقیقه به آن پاسخ داد.
4-	به هم ریخته بودن گزینه ها و سخت بودن خواندن اینها (مثلا به دلیل شروع جمله با عدد)
5-	ذکر گزینه هایی که به شماره گزینه های دیگر ارجاع می دهد (مثال: گزینه الف و ب)
                                    </p>
                                    </pre>
                                    @endif
                                </div>
                                <div class="submit_survay">
                                    <input type="submit"
                                           class="mb-6 btn waves-effect waves-light gradient-45deg-amber-amber gradient-shadow submitBtn"
                                           value="ثبت">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
    $("#formId").submit(function () {
        $(".submitBtn").attr("disabled", true);
        return true;
    });
});
</script>
    <script>
        function showDesc1(){
            document.getElementById("description1").style.display = 'block';
            document.getElementById("desc1").setAttribute("required", "");

        }
        function hideDesc1(){
            document.getElementById("description1").style.display = 'none';
            document.getElementById("desc1").removeAttribute("required");
        }

        function showDesc2(){
            document.getElementById("description2").style.display = 'block';
            document.getElementById("desc2").setAttribute("required", "");

        }
        function hideDesc2(){
            document.getElementById("description2").style.display = 'none';
            document.getElementById("desc2").removeAttribute("required");
        }

        function showDesc3(){
            document.getElementById("description3").style.display = 'block';
            document.getElementById("desc3").setAttribute("required", "");

        }
        function hideDesc3(){
            document.getElementById("description3").style.display = 'none';
            document.getElementById("desc3").removeAttribute("required");
        }
    </script>
@endsection
