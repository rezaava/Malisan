<section class="tabs-vertical mt-1 section">
    <div class="col l3 s12 mt-3">
        <!-- tabs  -->
        <div class="card-panel">
            <ul class="tabs">
                <li class="tab">
                    <a href="#general" class="active">
                        <i class="material-icons">brightness_low</i>
                        <span>بررسی نشده({{ $q_not }})</span>
                    </a>
                </li>
                <li class="tab">
                    <a href="#change-password">
                        <i class="material-icons">lock_open</i>
                        <span>تایید شده({{ $q_ok }})</span>
                    </a>
                </li>
                <li class="tab">
                    <a href="#info">
                        <i class="material-icons">error_outline</i>
                        <span>تایید نشده({{ $q_bad }})</span>
                    </a>
                </li>
                <li class="tab">
                    <a href="#social-link">
                        <i class="material-icons">chat_bubble_outline</i>
                        <span>نیازمند اصلاح({{ $q_ret }})</span>
                    </a>
                </li>
                <li class="indicator" style="left: 0px; right: 0px;"></li>
            </ul>
        </div>
    </div>
</section>
