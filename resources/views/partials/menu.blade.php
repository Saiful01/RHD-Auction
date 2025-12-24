<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li>
                <a href="{{ route("admin.home") }}">
                    <i class="fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <span>{{ trans('cruds.userManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('permission_access')
                            <li class="{{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <a href="{{ route("admin.permissions.index") }}">
                                    <i class="fa-fw fas fa-unlock-alt">

                                    </i>
                                    <span>{{ trans('cruds.permission.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="{{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <a href="{{ route("admin.roles.index") }}">
                                    <i class="fa-fw fas fa-briefcase">

                                    </i>
                                    <span>{{ trans('cruds.role.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="{{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <a href="{{ route("admin.users.index") }}">
                                    <i class="fa-fw fas fa-user">

                                    </i>
                                    <span>{{ trans('cruds.user.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('auction_manage_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-gavel">

                        </i>
                        <span>{{ trans('cruds.auctionManage.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('auction_access')
                            <li class="{{ request()->is("admin/auctions") || request()->is("admin/auctions/*") ? "active" : "" }}">
                                <a href="{{ route("admin.auctions.index") }}">
                                    <i class="fa-fw fas fa-gavel">

                                    </i>
                                    <span>{{ trans('cruds.auction.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('lot_access')
                            <li class="{{ request()->is("admin/lots") || request()->is("admin/lots/*") ? "active" : "" }}">
                                <a href="{{ route("admin.lots.index") }}">
                                    <i class="fa-fw fas fa-file-archive">

                                    </i>
                                    <span>{{ trans('cruds.lot.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('lot_item_access')
                            <li class="{{ request()->is("admin/lot-items") || request()->is("admin/lot-items/*") ? "active" : "" }}">
                                <a href="{{ route("admin.lot-items.index") }}">
                                    <i class="fa-fw fas fa-tree">

                                    </i>
                                    <span>{{ trans('cruds.lotItem.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('package_access')
                            <li class="{{ request()->is("admin/packages") || request()->is("admin/packages/*") ? "active" : "" }}">
                                <a href="{{ route("admin.packages.index") }}">
                                    <i class="fa-fw fas fa-box">

                                    </i>
                                    <span>{{ trans('cruds.package.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('employee_manage_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-user-friends">

                        </i>
                        <span>{{ trans('cruds.employeeManage.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('employee_access')
                            <li class="{{ request()->is("admin/employees") || request()->is("admin/employees/*") ? "active" : "" }}">
                                <a href="{{ route("admin.employees.index") }}">
                                    <i class="fa-fw fas fa-user-graduate">

                                    </i>
                                    <span>{{ trans('cruds.employee.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('office_access')
                            <li class="{{ request()->is("admin/offices") || request()->is("admin/offices/*") ? "active" : "" }}">
                                <a href="{{ route("admin.offices.index") }}">
                                    <i class="fa-fw fas fa-briefcase">

                                    </i>
                                    <span>{{ trans('cruds.office.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('designation_access')
                            <li class="{{ request()->is("admin/designations") || request()->is("admin/designations/*") ? "active" : "" }}">
                                <a href="{{ route("admin.designations.index") }}">
                                    <i class="fa-fw fas fa-pen-nib">

                                    </i>
                                    <span>{{ trans('cruds.designation.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('office_type_access')
                            <li class="{{ request()->is("admin/office-types") || request()->is("admin/office-types/*") ? "active" : "" }}">
                                <a href="{{ route("admin.office-types.index") }}">
                                    <i class="fa-fw fas fa-clipboard-list">

                                    </i>
                                    <span>{{ trans('cruds.officeType.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('road_access')
                <li class="{{ request()->is("admin/roads") || request()->is("admin/roads/*") ? "active" : "" }}">
                    <a href="{{ route("admin.roads.index") }}">
                        <i class="fa-fw fas fa-road">

                        </i>
                        <span>{{ trans('cruds.road.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('financial_year_access')
                <li class="{{ request()->is("admin/financial-years") || request()->is("admin/financial-years/*") ? "active" : "" }}">
                    <a href="{{ route("admin.financial-years.index") }}">
                        <i class="fa-fw fas fa-calendar-alt">

                        </i>
                        <span>{{ trans('cruds.financialYear.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('division_access')
                <li class="{{ request()->is("admin/divisions") || request()->is("admin/divisions/*") ? "active" : "" }}">
                    <a href="{{ route("admin.divisions.index") }}">
                        <i class="fa-fw fas fa-map-marker">

                        </i>
                        <span>{{ trans('cruds.division.title') }}</span>

                    </a>
                </li>
            @endcan
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="{{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}">
                        <a href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>
    </section>
</aside>