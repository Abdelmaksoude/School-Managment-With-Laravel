<ul class="nav navbar-nav side-menu" id="sidebarnav">
    <!-- menu item Dashboard-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ trans('all_trans.Dashboard') }}</span>
            </div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{ route('dashboard') }}">{{ trans('all_trans.Dashboard') }}</a> </li>
        </ul>
    </li>
    <!-- menu title -->
    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Components </li>
    <!-- menu item Elements-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
            <div class="pull-left"><i class="ti-palette"></i><span
                    class="right-nav-text">{{ trans('all_trans.Grade') }}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="elements" class="collapse" data-parent="#sidebarnav">
            <li><a href="{{ route('grade.index') }}">{{ trans('all_trans.Grade_List') }}</a></li>
        </ul>
    </li>
    <!-- menu item calendar-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
            <div class="pull-left"><i class="ti-calendar"></i><span
                    class="right-nav-text">{{ trans('all_trans.Classes') }}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{ route('classes.index') }}">{{ trans('all_trans.Classes_List') }}</a> </li>
        </ul>
    </li>
    <!-- menu item todo-->
    <!-- menu item Charts-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#chart">
            <div class="pull-left"><i class="ti-pie-chart"></i><span
                    class="right-nav-text">{{ trans('all_trans.Section') }}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="chart" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{ route('section.index') }}">{{ trans('all_trans.Section_List') }}</a> </li>
        </ul>
    </li>

    <!-- menu font icon-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#font-icon">
            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ trans('all_trans.parents') }}
                    </span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="font-icon" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{url('add_parent')}}">{{ trans('all_trans.parents_list') }}</a> </li>
            {{-- <li> <a href="{{url('add_parent')}}">{{ trans('all_trans.parents_add') }}</a> </li> --}}
        </ul>
    </li>
    <!-- menu font icon-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#font-teacher">
            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ trans('all_trans.teachers') }}
                    </span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="font-teacher" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{route('Teachers.index')}}">{{ trans('all_trans.teachers_list') }}</a> </li>
        </ul>
    </li>
    <!-- menu font icon-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#font-student">
            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{ trans('all_trans.students') }}
                    </span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="font-student" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{route('Students.index')}}">{{ trans('all_trans.students_list') }}</a> </li>
            <li> <a href="{{route('Students.create')}}">{{ trans('all_trans.add_student') }}</a> </li>
            <li> <a href="{{route('Promotion.index')}}">{{ trans('all_trans.promotion_student') }}</a> </li>
            <li> <a href="{{route('Promotion.create')}}">{{ trans('all_trans.promotion_student_managment') }}</a> </li>
            <li> <a href="{{route('Graduated.create')}}">{{ trans('all_trans.Graduated_student') }}</a> </li>
            <li> <a href="{{route('Graduated.index')}}">{{ trans('all_trans.Graduated_student_managment') }}</a> </li>
        </ul>
    </li>
    <!-- menu item Form-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Form">
            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">
                    {{ trans('all_trans.fee') }}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="Form" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{ route('Fees.create') }}">{{ trans('all_trans.add_student_account') }}</a> </li>
            <li> <a href="{{ route('Fees.index') }}">{{ trans('all_trans.student_account_list') }}</a> </li>
            <li> <a href="{{ route('Fees_Invoices.index') }}">{{ trans('all_trans.invoices') }}</a> </li>
            <li> <a href="{{route('receipt_students.index')}}">سندات القبض</a> </li>
            <li> <a href="{{route('ProcessingFee.index')}}">استبعاد رسوم</a> </li>
            <li> <a href="{{route('Payment_students.index')}}">سند صرف</a> </li>
        </ul>
    </li>
    <!-- menu item table -->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#table">
            <div class="pull-left"><i class="ti-layout-tab-window"></i><span class="right-nav-text">{{ trans('all_trans.attendace') }}
                    </span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="table" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{ route('Attendance.index') }}">{{ trans('all_trans.attendace') }}</a> </li>
        </ul>
    </li>
    <!-- menu item Custom pages-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#custom-page">
            <div class="pull-left"><i class="ti-file"></i><span class="right-nav-text">{{ trans('all_trans.subject') }}
                    </span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="custom-page" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{ route('subject.index') }}">{{ trans('all_trans.subject') }}</a> </li>
        </ul>
    </li>
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#custom-page2">
            <div class="pull-left"><i class="ti-file"></i><span class="right-nav-text">{{ trans('all_trans.quiz') }}
                    </span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="custom-page2" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{ route('quiz.index') }}">{{ trans('all_trans.quiz') }}</a> </li>
            <li> <a href="{{ route('question.index') }}">{{ trans('all_trans.question') }}</a> </li>
        </ul>
    </li>
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#custom-page3">
            <div class="pull-left"><i class="ti-file"></i><span class="right-nav-text">{{ trans('all_trans.online') }}
                    </span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="custom-page3" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{route('online_classes.index')}}">حصص اونلاين عبر زوم</a> </li>
        </ul>
    </li>
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#custom-page4">
            <div class="pull-left"><i class="ti-file"></i><span class="right-nav-text">{{ trans('all_trans.library') }}
                    </span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="custom-page4" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{route('library.index')}}">{{ trans('all_trans.list_library') }}</a> </li>
        </ul>
    </li>
    <!-- menu item Authentication-->
    <!-- menu item maps-->
    <li>
        <a href="{{ route('settings.index') }}"><i class="ti-location-pin"></i><span class="right-nav-text">الاعدادات</span></a>
    </li>
    <!-- menu item timeline-->
    <li>
        <a href="timeline.html"><i class="ti-panel"></i><span class="right-nav-text">timeline</span>
        </a>
    </li>
    <!-- menu item Multi level-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#multi-level">
            <div class="pull-left"><i class="ti-layers"></i><span class="right-nav-text">Multi
                    level Menu</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="multi-level" class="collapse" data-parent="#sidebarnav">
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#auth">Level
                    item 1<div class="pull-right"><i class="ti-plus"></i></div>
                    <div class="clearfix"></div>
                </a>
                <ul id="auth" class="collapse">
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#login">Level
                            item 1.1<div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="login" class="collapse">
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse"
                                    data-target="#invoice">level item 1.1.1<div class="pull-right"><i
                                            class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="invoice" class="collapse">
                                    <li> <a href="#">level item 1.1.1.1</a> </li>
                                    <li> <a href="#">level item 1.1.1.2</a> </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li> <a href="#">level item 1.2</a> </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#error">level
                    item 2<div class="pull-right"><i class="ti-plus"></i></div>
                    <div class="clearfix"></div>
                </a>
                <ul id="error" class="collapse">
                    <li> <a href="#">level item 2.1</a> </li>
                    <li> <a href="#">level item 2.2</a> </li>
                </ul>
            </li>
        </ul>
    </li>
</ul>
