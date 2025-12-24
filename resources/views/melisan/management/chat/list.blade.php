@extends('melisan.layout.master')
@section('add-styles')

<link href="{{("/all-css/assets/css/apps/mailing-chat.css")}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{("/all-css/assets/css/widgets/modules-widgets.css")}}">

<link rel="stylesheet" type="text/css" href="{{("/all-css/assets/css/forms/switches.css")}}">

<script>
    $ex_c = 0;
</script>
<style>
    .people {
        background: linear-gradient(-45deg, #303f9f, #7b1fa2) !important;
    }

    .search {
        background: linear-gradient(-45deg, #303f9f, #7b1fa2) !important;
    }
    .form-control{
        color: #fff !important;
    }

    /* ===== Chat UI Cleaner Override ===== */

    .chat-system {
        box-shadow: none !important;
        border-radius: 10px;
        overflow: hidden;
    }

    /* لیست کاربران */
    .chat-system .user-list-box {
        width: 280px !important;
    }

    .chat-system .user-list-box .people .person {
        padding: 12px 14px !important;
    }

    .chat-system .user-list-box .people .person .user-name {
        font-size: 13px !important;
        font-weight: 500;
    }

    /* سرچ */
    .chat-system .user-list-box input {
        font-size: 13px !important;
        padding: 8px 36px 8px 12px !important;
    }

    /* باکس چت */
    .chat-system .chat-box {
        background: #f8fafc !important;
    }

    /* اسکرول پیام‌ها */
    .chat-system .chat-box .chat-conversation-box .chat {
        padding: 16px 20px !important;
    }

    /* حباب پیام */
    .chat-system .chat-box .bubble {
        font-size: 14px !important;
        padding: 8px 12px !important;
        border-radius: 14px !important;
        max-width: 65%;
        line-height: 1.7;
    }

    /* پیام من */
    .chat-system .chat-box .bubble.me {
        background: #2563eb !important;
        box-shadow: none !important;
        border-bottom-right-radius: 4px !important;
    }

    /* پیام طرف مقابل */
    .chat-system .chat-box .bubble.you {
        background: #e5e7eb !important;
        color: #111827 !important;
        box-shadow: none !important;
        border-bottom-left-radius: 4px !important;
    }

    /* فلش حباب‌ها حذف */
    .chat-system .chat-box .bubble:before {
        display: none !important;
    }

    /* فوتر */
    .chat-system .chat-box .chat-footer.chat-active {
        padding: 8px 12px !important;
        box-shadow: none !important;
    }

    /* اینپوت پیام */
    .chat-system .chat-box .chat-input input {
        font-size: 14px !important;
        padding: 10px 40px 10px 12px !important;
        border-radius: 10px;
        background: #fff !important;
        border: 1px solid #e5e7eb !important;
        color: #111827 !important;
    }

    /* دکمه ارسال */
    .chat-system .chat-form button {
        font-size: 13px;
        padding: 8px;
    }

 

    /* موبایل */
    @media (max-width: 768px) {
        .chat-system .user-list-box {
            width: 240px !important;
        }

        .chat-system .chat-box .bubble {
            max-width: 85%;
        }
    }
    /* ستون لیست چت */
.chat-system {
    display: flex;
    height: calc(100vh - 260px); /* هماهنگ با داشبورد */
}

/* لیست سمت راست */
.user-list-box {
    width: 320px;
    display: flex;
    flex-direction: column;
    height: 100%;
}

/* باکس جستجو */
.user-list-box .search {
    flex-shrink: 0;
}

/* 🔥 خود لیست اسکرول‌دار */
.user-list-box .people {
    flex: 1;
    overflow-y: auto;
    overflow-x: hidden;
}

</style>
@endsection
@section('title', 'گفتگو')
@section('title', 'گفتگو')
@section('main-content')
<div id="content" class="main-content mb-5" style="margin: 0 !important;">
    <div class="layout-px-spacing">

        <div class="chat-section layout-top-spacing">
            <div class="row">
                <div class="col-12">

                    <div class="chat-system">

                        {{-- Hamburger (mobile) --}}
                        <div class="hamburger d-lg-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-menu mail-menu">
                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <line x1="3" y1="18" x2="21" y2="18"></line>
                            </svg>
                        </div>

                        {{-- User List --}}
                        <div class="user-list-box">
                            <div class="search">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                                <input type="text" class="form-control" placeholder="جستجو کنید...">
                            </div>

                            <div class="people">
                                @foreach($chats as $chat)
                                <div class="person" data-chat="chat{{ $chat->chat_id }}">
                                    <div class="user-info">
                                        <div class="f-body">
                                            <div class="meta-info">
                                                <span class="user-name">
                                                    @if(Auth::user()->hasRole('student'))
                                                    {{ $chat->name }}
                                                    @if($chat->seen == 0 || $chat->seen == 2)
                                                    <span class="text-danger">(جدید)</span>
                                                    @endif
                                                    @else
                                                    {{ $chat->course->name }} -
                                                    {{ $chat->student->name }} {{ $chat->student->family }}
                                                    @if($chat->status == 0 || $chat->status == 1)
                                                    <span class="text-danger">(جدید)</span>
                                                    @endif
                                                    @endif
                                                </span>
                                            </div>
                                        </div>

                                        {{-- hidden data --}}
                                        <div class="d-none">
                                            <span class="chat-id">{{ $chat->chat_id }}</span>
                                            <span class="course-id">{{ $chat->id }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Chat Box --}}
                        <div class="chat-box">

                            {{-- Empty state --}}
                            <div class="chat-not-selected">
                                <p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                    </svg>
                                    @if(Laratrust::hasRole('student'))
                                    با انتخاب درس به استاد پیام بدهید
                                    @else
                                    یک گفتگو را از لیست انتخاب کنید
                                    @endif
                                </p>
                            </div>

                            <div class="chat-box-inner">

                                {{-- Chat Header --}}
                                <div class="chat-meta-user">
                                    <div class="current-chat-user-name">
                                        <span class="name"></span>
                                    </div>
                                </div>

                                {{-- Messages --}}
                                <div class="chat-conversation-box">
                                    <div id="chat-conversation-box-scroll">
                                        @foreach($chats as $chat)
                                        <div class="chat" data-chat="chat{{ $chat->chat_id }}" id="chat{{ $chat->chat_id }}">
                                            @foreach($chat->messages as $message)
                                            <div
                                                class="bubble
                                                        @if(Auth::user()->hasRole('student'))
                                                            {{ $message->sender == 2 ? 'you' : 'me' }}
                                                        @else
                                                            {{ $message->sender == 2 ? 'me' : 'you' }}
                                                        @endif">
                                                {{ $message->text }}
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Footer / Send --}}
                                <div class="chat-footer">
                                    <form class="chat-form d-flex gap-2" id="form-id" method="post" action="/dashboard/chat">
                                        @csrf

                                        <input type="text"
                                            name="text"
                                            id="text_message"
                                            class="form-control"
                                            placeholder="پیام"
                                            required>

                                        <button type="submit" class="btn btn-primary ajaxLink">
                                            ارسال
                                        </button>

                                        <input type="hidden" name="id" id="text_id">
                                        <input type="hidden" name="crs_id" id="crs_id">
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
@endsection

@section('js')

<script src="{{("/all-css/assets/js/apps/mailbox-chat.js")}}"></script>

<script src="{{("/all-css/assets/js/widgets/modules-widgets.js")}}"></script>

<script src="{{("/all-css/assets/js/scrollspyNav.js")}}"></script>

<script>
    $('.ajaxLink').click(function(e) {
        let form = document.getElementById("form-id");
        form.onsubmit = function(e) {
            e.preventDefault();
            fetch(form.action, {
                method: "post",
                body: new FormData(form)
            }).then(response => {
                // do something with the response...

                $idd = 'chat' + document.getElementById("text_id").value;
                $idd2 = convert($idd)
                var p = document.getElementById($idd2);
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
    function convert(tt) {
        persinaDigits1 = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
        persinaDigits2 = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
        // $allPersianDigits=array_merge($persinaDigits1, $persinaDigits2);
        // alert($persinaDigits1)
        replaces = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        tt = tt.replace('۰', '0');
        tt = tt.replace('۱', '1');
        tt = tt.replace('۲', '2');
        tt = tt.replace('۳', '3');
        tt = tt.replace('۴', '4');
        tt = tt.replace('۵', '5');
        tt = tt.replace('۶', '6');
        tt = tt.replace('۷', '7');
        tt = tt.replace('۸', '8');
        tt = tt.replace('۹', '9');
        tt = tt.replace('۸', '8');

        return tt;
    }
    $('.user-list-box .person').on('click', function(event) {
        $idd = $(this).find('.chat-id').text();
        $idd2 = convert($idd)

        $course = $(this).find('.course-id').text();
        $course2 = convert($idd)

        document.getElementById("text_id").value = $idd2;
        document.getElementById("crs_id").value = $course2;

    });
</script>
@endsection