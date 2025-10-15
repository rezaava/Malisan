<div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
        <div class="row">
            <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{ isset($pageTitle) ? $pageTitle : '' }}</span></h5>
                <ol class="breadcrumbs mb-0">
                    <li class="breadcrumb-item"><a href="/">خانه</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">صفحه</a>
                    </li>
                    <li class="breadcrumb-item active">{{ isset($pageName) ? $pageName : '' }}
                    </li>
                </ol>
            </div>
            <div class="col s2 m6 l6"><a class="btn dropdown-settings waves-effect waves-light breadcrumbs-btn right"
                    href="#!" data-target="dropdown1"><i class="material-icons hide-on-med-and-up">settings</i><span
                        class="hide-on-small-onl">تنظیمات</span><i class="material-icons right">arrow_drop_down</i></a>
                <ul class="dropdown-content" id="dropdown1" tabindex="0">
                    <li tabindex="0"><a class="grey-text text-darken-2" href="user-profile-page.html">پروفایل<span
                                class="new badge red">۲</span></a>
                    </li>
                    <li tabindex="0"><a class="grey-text text-darken-2" href="app-contacts.html">تماس با
                            ما</a></li>
                    <li tabindex="0"><a class="grey-text text-darken-2" href="page-faq.html">سوالات
                            متداول</a></li>
                    <li class="divider" tabindex="-1"></li>
                    <li tabindex="0"><a class="grey-text text-darken-2" href="user-login.html">خروج</a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>
