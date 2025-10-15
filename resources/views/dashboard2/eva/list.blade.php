<div class="tab-pane fade show " id="d" role="tabpanel"
     aria-labelledby="animated-underline-home-tab" style="margin-top:-30px ">


    <div class="widget-content widget-content-area simple-pills">
        <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist"
            style="margin-top: -1rem!important;">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill"
                   href="#dn" role="tab" aria-controls="pills-home"
                   aria-selected="true"> بررسی نشده({{$d_not}})
                </a>
            </li>
            @if(Laratrust::hasRole('student') && Route::current()->getName() != 'referee')
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill"
                       href="#da" role="tab" aria-controls="pills-contact"
                       aria-selected="false">همه</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill"
                       href="#do" role="tab" aria-controls="pills-contact"
                       aria-selected="false">تایید
                        شده</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill"
                       href="#db" role="tab" aria-controls="pills-contact"
                       aria-selected="false">تایید
                        نشده</a>
                </li>


            @endif
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="dn" role="tabpanel"
                 aria-labelledby="pills-home-tab">
                {{--rn cont--}}
                @foreach($disscussions as $disc)
                    @if(!$disc->status)
                        <div class="card col-12">
                            <div class="card-header">
                                <div class="row">
                                    <h6>جلسه {{$disc->session->number}}
                                        : {{$disc->session->name}}</h6>
                                </div>
                                <div class="row">
                                    <h5>{!!$disc->text!!}</h5>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="row">
                                            @if(Laratrust::hasRole('teacher') ||  Route::current()->getName() == 'referee')
                                                <div class=" col-md-12">
                                                    <form method="post"
                                                          action="{{"/dashboard/discussion/scoring?discussion_id=".$disc->id}}"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        <label>امتیاز</label>
                                                        <div class="col">

                                                            <input type="radio" id="awli"
                                                                   name="score"
                                                                   value="1" {{$disc->status == 1 ? "checked":''}}>
                                                            <label for="awli">عالی</label><br>
                                                            <input type="radio" id="khob"
                                                                   name="score"
                                                                   value="2" {{$disc->status == 2 ? "checked":''}}>
                                                            <label for="khob">خوب</label><br>
                                                            <input type="radio"
                                                                   id="motevaset"
                                                                   name="score"
                                                                   value="3" {{$disc->status == 3 ? "checked":''}}>
                                                            <label for="motevaset">متوسط</label><br>
                                                            <input type="radio" id="bad"
                                                                   name="score"
                                                                   value="4" {{$disc->status == 4 ? "checked":''}}>
                                                            <label for="bad">ضعیف</label><br>

                                                        </div>
                                                        <div class="form-group @if ($errors->has('disc')) has-error @endif">
                                                            <label>نظر</label>
                                                            <div class="input-group mb-3">
                                                                <div class="col-lg-12">
<textarea class="form-control btn-square" name="comment"
          id="comment"></textarea>
                                                                </div>
                                                            </div>
                                                            <span class="text-danger"
                                                                  id="comment"
                                                                  style="color: red;">{{$errors->first('disc')}}</span>
                                                        </div>
                                                        <div class="card-footer">
                                                            <button class="btn btn-primary"
                                                                    type="submit">
                                                                ثبت
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                {{--end rn--}}
            </div>
            @if(Laratrust::hasRole('student') && Route::current()->getName() != 'referee' )

                <div class="tab-pane fade" id="da" role="tabpanel"
                     aria-labelledby="pills-profile-tab">
                    {{--ra cont--}}
                    @foreach($disscussions as $disc)
                        <div class="card col-12">
                            <div class="card-header">
                                <div class="row">
                                    <h6>جلسه {{$disc->session->number}}
                                        : {{$disc->session->name}}</h6>
                                </div>
                                <div class="row">
                                    <h5>{!!$disc->text!!}</h5>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="card-body">
                                        <div class="row">
                                            @if(Laratrust::hasRole('teacher'))
                                                <div class=" col-md-12">
                                                    <form method="post"
                                                          action="{{"/dashboard/discussion/scoring?discussion_id=".$disc->id}}"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        <label>امتیاز</label>
                                                        <div class="col">

                                                            <input type="radio" id="awli"
                                                                   name="score"
                                                                   value="1" {{$disc->status == 1 ? "checked":''}}>
                                                            <label for="awli">عالی</label><br>
                                                            <input type="radio" id="khob"
                                                                   name="score"
                                                                   value="2" {{$disc->status == 2 ? "checked":''}}>
                                                            <label for="khob">خوب</label><br>
                                                            <input type="radio"
                                                                   id="motevaset"
                                                                   name="score"
                                                                   value="3" {{$disc->status == 3 ? "checked":''}}>
                                                            <label for="motevaset">متوسط</label><br>
                                                            <input type="radio" id="bad"
                                                                   name="score"
                                                                   value="4" {{$disc->status == 4 ? "checked":''}}>
                                                            <label for="bad">ضعیف</label><br>

                                                        </div>
                                                        <div class="form-group @if ($errors->has('disc')) has-error @endif">
                                                            <label>نظر</label>
                                                            <div class="input-group mb-3">
                                                                <div class="col-lg-12">
<textarea class="form-control btn-square" name="comment"
          id="comment"></textarea>
                                                                </div>
                                                            </div>
                                                            <span class="text-danger"
                                                                  id="comment"
                                                                  style="color: red;">{{$errors->first('disc')}}</span>
                                                        </div>
                                                        <div class="card-footer">
                                                            <button class="btn btn-primary"
                                                                    type="submit">
                                                                ثبت
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{--end ra--}}
                </div>
                <div class="tab-pane fade" id="do" role="tabpanel"
                     aria-labelledby="pills-profile-tab2">

                    {{--ro cont--}}
                    @foreach($disscussions as $disc)
                        @if($disc->status=='1' ||$disc->status=='2')
                            <div class="card col-12">
                                <div class="card-header">
                                    <div class="row">
                                        <h6>جلسه {{$disc->session->number}}
                                            : {{$disc->session->name}}</h6>
                                    </div>
                                    <div class="row">
                                        <h5>{!!$disc->text!!}</h5>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="row">
                                                @if(Laratrust::hasRole('teacher'))
                                                    <div class=" col-md-12">
                                                        <form method="post"
                                                              action="{{"/dashboard/discussion/scoring?discussion_id=".$disc->id}}"
                                                              enctype="multipart/form-data">
                                                            @csrf
                                                            <label>امتیاز</label>
                                                            <div class="col">

                                                                <input type="radio"
                                                                       id="awli"
                                                                       name="score"
                                                                       value="1" {{$disc->status == 1 ? "checked":''}}>
                                                                <label for="awli">عالی</label><br>
                                                                <input type="radio"
                                                                       id="khob"
                                                                       name="score"
                                                                       value="2" {{$disc->status == 2 ? "checked":''}}>
                                                                <label for="khob">خوب</label><br>
                                                                <input type="radio"
                                                                       id="motevaset"
                                                                       name="score"
                                                                       value="3" {{$disc->status == 3 ? "checked":''}}>
                                                                <label for="motevaset">متوسط</label><br>
                                                                <input type="radio" id="bad"
                                                                       name="score"
                                                                       value="4" {{$disc->status == 4 ? "checked":''}}>
                                                                <label for="bad">ضعیف</label><br>

                                                            </div>
                                                            <div class="form-group @if ($errors->has('disc')) has-error @endif">
                                                                <label>نظر</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="col-lg-12">
<textarea class="form-control btn-square" name="comment"
          id="comment"></textarea>
                                                                    </div>
                                                                </div>
                                                                <span class="text-danger"
                                                                      id="comment"
                                                                      style="color: red;">{{$errors->first('disc')}}</span>
                                                            </div>
                                                            <div class="card-footer">
                                                                <button class="btn btn-primary"
                                                                        type="submit">
                                                                    ثبت
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                @endif
                                                @if($disc->comment)
                                                    <div class="row"
                                                         style="color: red;  margin-bottom: 10px">
                                                        نظر استاد.{{$disc->comment}}
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    {{--ro end--}}
                </div>
                <div class="tab-pane fade" id="db" role="tabpanel"
                     aria-labelledby="pills-profile-tab">
                    {{--rb cont--}}
                    @foreach($disscussions as $disc)
                        @if($disc->status=='3' ||$disc->status=='4')
                            <div class="card col-12">
                                <div class="card-header">
                                    <div class="row">
                                        <h6>جلسه {{$disc->session->number}}
                                            : {{$disc->session->name}}</h6>
                                    </div>
                                    <div class="row">
                                        <h5>{!!$disc->text!!}</h5>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="row">
                                                @if(Laratrust::hasRole('teacher'))
                                                    <div class=" col-md-12">
                                                        <form method="post"
                                                              action="{{"/dashboard/discussion/scoring?discussion_id=".$disc->id}}"
                                                              enctype="multipart/form-data">
                                                            @csrf
                                                            <label>امتیاز</label>
                                                            <div class="col">

                                                                <input type="radio"
                                                                       id="awli"
                                                                       name="score"
                                                                       value="1" {{$disc->status == 1 ? "checked":''}}>
                                                                <label for="awli">عالی</label><br>
                                                                <input type="radio"
                                                                       id="khob"
                                                                       name="score"
                                                                       value="2" {{$disc->status == 2 ? "checked":''}}>
                                                                <label for="khob">خوب</label><br>
                                                                <input type="radio"
                                                                       id="motevaset"
                                                                       name="score"
                                                                       value="3" {{$disc->status == 3 ? "checked":''}}>
                                                                <label for="motevaset">متوسط</label><br>
                                                                <input type="radio" id="bad"
                                                                       name="score"
                                                                       value="4" {{$disc->status == 4 ? "checked":''}}>
                                                                <label for="bad">ضعیف</label><br>

                                                            </div>
                                                            <div class="form-group @if ($errors->has('disc')) has-error @endif">
                                                                <label>نظر</label>
                                                                <div class="input-group mb-3">
                                                                    <div class="col-lg-12">
<textarea class="form-control btn-square" name="comment"
          id="comment"></textarea>
                                                                    </div>
                                                                </div>
                                                                <span class="text-danger"
                                                                      id="comment"
                                                                      style="color: red;">{{$errors->first('disc')}}</span>
                                                            </div>
                                                            <div class="card-footer">
                                                                <button class="btn btn-primary"
                                                                        type="submit">
                                                                    ثبت
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                @endif
                                                @if($disc->comment)
                                                    <div class="row"
                                                         style="color: red;  margin-bottom: 10px">
                                                        نظر استاد.{{$disc->comment}}
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    {{--end rb--}}
                </div>
            @endif

        </div>
        {{----}}


    </div>
    {{--r content--}}
    <div class="tab-pane fade" id="r" role="tabpanel"
         aria-labelledby="animated-underline-profile-tab">
        <div class="media">

            {{----}}
        </div>
    </div>
    {{--e content--}}
    <div class="tab-pane fade" id="e" role="tabpanel"
         aria-labelledby="animated-underline-contact-tab">

        {{----}}
    </div>
</div>
