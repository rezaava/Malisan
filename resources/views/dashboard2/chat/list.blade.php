@extends('dashboard2.layout.app')

@section('start')

    <link href="{{("/style/assets/css/apps/mailing-chat.css")}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{("/style/assets/css/widgets/modules-widgets.css")}}">

    <link href="{{("/style/assets/css/scrollspyNav.css")}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{("/style/assets/css/forms/switches.css")}}">

    <script>
        $ex_c = 0;
    </script>

@endsection
@section('main')
    <div id="content" class="main-content">
        @include('dashboard.layout.message')

        <div class="layout-px-spacing">

            <div class="chat-section layout-top-spacing">
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12">

                        <div class="chat-system">
                            <div class="hamburger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-menu mail-menu d-lg-none">
                                    <line x1="3" y1="12" x2="21" y2="12"></line>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <line x1="3" y1="18" x2="21" y2="18"></line>
                                </svg>
                            </div>
                            <div class="user-list-box">
                                <div class="search">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                    <input type="text" class="form-control" placeholder="جستجو کنید..."/>
                                </div>
                                <div class="people">
                                    @foreach($chats as $chat)
                                        <div class="person" data-chat="chat{{$chat->chat_id}}">

                                            <div class="user-info">
                                                {{--<div class="f-head">--}}
                                                {{--<img src="assets/img/90x90.jpg" alt="avatar">--}}
                                                {{--</div>--}}
                                                <div class="f-body">
                                                    <div class="meta-info">
                                                        <span class="user-name"
                                                              data-name="مینا حاتمی"  >
                                                                                                        @if(\Illuminate\Support\Facades\Auth::user()->hasRole('student'))
                                                                {{$chat->name}}
                                                                @if($chat->seen==0 || $chat->seen==2)<span style="color: red"> (جدید) </span>@endif


                                                            @else
                                                                {{$chat->course->name}}-{{$chat->student->name}} {{$chat->student->family}}

                                                                @if($chat->status==0 || $chat->status==1)<span style="color: red"> (جدید) </span>@endif

                                                            @endif

                                                        </span>
                                                    </div>
                                                    {{--<span class="preview">چطوری؟</span>--}}
                                                </div>

<div style="visibility: hidden">
                                                <span class="chat-id"
                                                      data-name="{{$chat->chat_id}}">{{$chat->chat_id}}</span>

                                                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('student'))
                                                    <span class="course-id"
                                                          data-name="{{$chat->id}}">{{$chat->id}}</span>
                                                @else
                                                    <span class="course-id"
                                                          data-name="{{$chat->id}}">{{$chat->id}}</span>
                                                @endif

</div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="chat-box">

                                <div class="chat-not-selected">
                                    <p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-message-square">
                                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                        @if(Laratrust::hasRole('student'))
                                        با انتخاب درس به استاد پیام بدهید
                                            @else
                                        چنانچه پیامی دریافت کرده اید از لیست سمت راست آنرا انتخاب کنید
                                            @endif
                                    </p>
                                </div>


                                <div class="chat-box-inner">
                                    <div class="chat-meta-user">
                                        <div class="current-chat-user-name"><span>
                                                {{--<img src="assets/img/90x90.jpg"--}}
                                                {{--alt="dynamic-image">--}}
                                                <span
                                                        class="name"></span></span></div>


                                    </div>
                                    <div class="chat-conversation-box">
                                        <div id="chat-conversation-box-scroll" class="chat-conversation-box-scroll">
                                            @foreach($chats as  $chat)
                                                <div class="chat" data-chat="chat{{$chat->chat_id}}"
                                                     id="chat{{$chat->chat_id}}">
                                                    @foreach($chat->messages as  $message)
                                                        <div
                                                                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('student'))
                                                                @if($message->sender==2)
                                                                class="bubble you"
                                                                @else
                                                                class="bubble me"
                                                                @endif
                                                                @else
                                                                @if($message->sender==2)
                                                                class="bubble me"
                                                                @else
                                                                class="bubble you"
                                                                @endif
                                                                @endif

                                                        >
                                                            {{$message->text}}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="chat-footer">
                                        <div class="chat-input">
                                            <form class="chat-form" id="form-id" action="/dashboard/chat" method="post">
                                                @CSRF
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-message-square">
                                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                                </svg>
                                                <div class="row">
                                                    <div class="col-md-10">

                                                        <input type="text" name="text" id="text_message"
                                                               class="form-control"
                                                               placeholder="پیام" required minlength="1"/>
                                                    </div>
                                                    <div class="col-md-2">

                                                        <div class="col-md-2">
                                                            <button class="ajaxLink btn btn-primary" type="submit">
                                                                ارسال
                                                            </button>
                                                        </div>
                                                        <input type="text" name="id"  id="text_id" style="width: 0px;height: 0px;visibility: hidden"
                                                               class="form-control"
                                                        />
                                                        <input type="text" name="crs_id" style="width: 0px;height: 0px;visibility: hidden"  id="crs_id"
                                                               class="form-control"
                                                        />
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        @include('dashboard2.layout.footer')

    </div>


@endsection

@section('end')

    <script src="{{("/style/assets/js/apps/mailbox-chat.js")}}"></script>

    <script src="{{("/style/assets/js/widgets/modules-widgets.js")}}"></script>

    <script src="{{("/style/assets/js/scrollspyNav.js")}}"></script>

    <script>
        $('.ajaxLink').click(function (e) {
            let form = document.getElementById("form-id");
            form.onsubmit = function (e) {
                e.preventDefault();
                fetch(form.action, {
                    method: "post",
                    body: new FormData(form)
                }).then(response => {
                    // do something with the response...

                    $idd = 'chat' + document.getElementById("text_id").value;
                    var p = document.getElementById($idd);
                    var newElement = document.createElement('div');
                    newElement.setAttribute('class', 'bubble me');
                    newElement.innerHTML = document.getElementById("text_message").value;
                    p.appendChild(newElement);
                    document.getElementById("text_message").value = "";

                });
            }
        });

    </script>


    <script>
        $('.user-list-box .person').on('click', function (event) {
            $idd = $(this).find('.chat-id').text();
            $course = $(this).find('.course-id').text();

            document.getElementById("text_id").value = $idd;
            document.getElementById("crs_id").value = $course;

        });

    </script>

@endsection
