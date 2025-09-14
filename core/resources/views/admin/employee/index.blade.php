@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table--light style--two table">
                            <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Email')</th>
                                    <th>@lang('Created At')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->name }}</td>
                                        <td>
                                            {{ $employee->email }}
                                        </td>
                                        <td>
                                            {{ $employee->created_at }}
                                        </td>
                                        <td>
                                            <div class="button--group">
                                                <button class="btn btn-sm btn-outline--primary editButton" data-employee="{{ $employee }}">
                                                    <i class="la la-pencil"></i> @lang('Edit')
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($employees->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($employees) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" id="employeeModal" role="dialog" tabindex="-1">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form method="post" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group">
                                <label>@lang('Name')</label>
                                <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}" required>
                                <label>@lang('Username')</label>
                                <input class="form-control" id="username" name="username" type="text" value="{{ old('username') }}" required>
                                <label>@lang('Email')</label>
                                <input class="form-control" id="email" name="email" type="text" value="{{ old('email') }}" required>
                                <label>@lang('Password')</label>
                                <input class="form-control" id="password" name="password" type="text" value="{{ old('password') }}" required>
                                
                                <div class="checkbox-grid">
                                    <!-- Existing Checkboxes with Edit Clones -->
                                    <div class="grid-item">
                                        <label for="vehcile">Dashboard</label>
                                        <input data-id='0' type="checkbox" id="dashboard" name="dashboard">
                                    </div>
                                    <div class="grid-item">
                                        <label for="vehcile">Extra Service</label>
                                        <input data-id='19' type="checkbox" id="extra_services" name="extra_services">
                                    </div>
                                    <div class="grid-item">
                                        <label for="vehcile">Coupons</label>
                                        <input data-id='17' type="checkbox" id="coupons" name="coupons">
                                    </div>
                                    <div class="grid-item">
                                        <label for="vehcile">Vehicle</label>
                                        <input data-id='1' type="checkbox" id="vehcile" name="vehcile">
                                    </div>
                                    <div class="grid-item">
                                        <label for="brands">Brands</label>
                                        <input data-id='16' type="checkbox" id="brands" name="brands">
                                    </div>
                                    <div class="grid-item">
                                        <label for="zones">Zones</label>
                                        <input data-id='2' type="checkbox" id="zones" name="zones">
                                    </div>
                                    <div class="grid-item">
                                        <label for="employees">Employees</label>
                                        <input data-id='3' type="checkbox" id="employees" name="employees">
                                    </div>
                                    <div class="grid-item">
                                        <label for="stores">Manage Stores</label>
                                        <input data-id='4' type="checkbox" id="stores" name="stores">
                                    </div>
                                    <div class="grid-item">
                                        <label for="manage_vehcile">Manage Vehicles</label>
                                        <input data-id='5' type="checkbox" id="manage_vehcile" name="manage_vehcile">
                                    </div>
                                    <div class="grid-item">
                                        <label for="manage_rentals">Manage Rentals</label>
                                        <input data-id='6' type="checkbox" id="manage_rentals" name="manage_rentals">
                                    </div>
                                    <div class="grid-item">
                                        <label for="users">Users</label>
                                        <input data-id='7' type="checkbox" id="users" name="users">
                                    </div>
                                    <div class="grid-item">
                                        <label for="payments">Payments</label>
                                        <input data-id='8' type="checkbox" id="payments" name="payments">
                                    </div>
                                    <div class="grid-item">
                                        <label for="withdraw">Withdraw</label>
                                        <input data-id='9' type="checkbox" id="withdraw" name="withdraw">
                                    </div>
                                    <div class="grid-item">
                                        <label for="support">Support</label>
                                        <input data-id='10' type="checkbox" id="support" name="support">
                                    </div>
                                    <div class="grid-item">
                                        <label for="reports">Reports</label>
                                        <input data-id='11' type="checkbox" id="reports" name="reports">
                                    </div>
                                    <div class="grid-item">
                                        <label for="subscibers">Subscriber</label>
                                        <input data-id='12' type="checkbox" id="subscibers" name="subscibers">
                                    </div>
                                    <div class="grid-item">
                                        <label for="system_settings">System Settings</label>
                                        <input data-id='13' type="checkbox" id="system_settings" name="system_settings">
                                    </div>
                                    <div class="grid-item">
                                        <label for="reports2">Report & Request</label>
                                        <input data-id='14' type="checkbox" id="reports2" name="reports">
                                    </div>
                                    <div class="grid-item">
                                        <label for="notifications">Notifications</label>
                                        <input data-id='15' type="checkbox" id="notifications" name="notifications">
                                    </div>
                                    <!-- New Checkboxes -->
                                    <div class="grid-item">
                                        <label for="general_setting">General Setting</label>
                                        <input data-id='18' type="checkbox" id="general_setting" name="general_setting">
                                    </div>
                                    <div class="grid-item">
                                        <label for="logo_favicon">Logo and Favicon</label>
                                        <input data-id='19' type="checkbox" id="logo_favicon" name="logo_favicon">
                                    </div>
                                    <div class="grid-item">
                                        <label for="system_configuration">System Configuration</label>
                                        <input data-id='20' type="checkbox" id="system_configuration" name="system_configuration">
                                    </div>
                                    <div class="grid-item">
                                        <label for="notification_setting">Notification Setting</label>
                                        <input data-id='21' type="checkbox" id="notification_setting" name="notification_setting">
                                    </div>
                                    <div class="grid-item">
                                        <label for="payment_gateways">Payment Gateways</label>
                                        <input data-id='22' type="checkbox" id="payment_gateways" name="payment_gateways">
                                    </div>
                                    <div class="grid-item">
                                        <label for="withdrawal_methods">Withdrawal Methods</label>
                                        <input data-id='23' type="checkbox" id="withdrawal_methods" name="withdrawal_methods">
                                    </div>
                                    <div class="grid-item">
                                        <label for="seo_configuration">SEO Configuration</label>
                                        <input data-id='24' type="checkbox" id="seo_configuration" name="seo_configuration">
                                    </div>
                                    <div class="grid-item">
                                        <label for="manage_frontend">Manage Frontend</label>
                                        <input data-id='25' type="checkbox" id="manage_frontend" name="manage_frontend">
                                    </div>
                                    <div class="grid-item">
                                        <label for="manage_pages">Manage Pages</label>
                                        <input data-id='26' type="checkbox" id="manage_pages" name="manage_pages">
                                    </div>
                                    <div class="grid-item">
                                        <label for="kyc_setting">KYC Setting</label>
                                        <input data-id='27' type="checkbox" id="kyc_setting" name="kyc_setting">
                                    </div>
                                    <div class="grid-item">
                                        <label for="store_kyc_setting">Store KYC Setting</label>
                                        <input data-id='28' type="checkbox" id="store_kyc_setting" name="store_kyc_setting">
                                    </div>
                                    <div class="grid-item">
                                        <label for="social_login_setting">Social Login Setting</label>
                                        <input data-id='29' type="checkbox" id="social_login_setting" name="social_login_setting">
                                    </div>
                                    <div class="grid-item">
                                        <label for="language">Language</label>
                                        <input data-id='30' type="checkbox" id="language" name="language">
                                    </div>
                                    <div class="grid-item">
                                        <label for="extensions">Extensions</label>
                                        <input data-id='31' type="checkbox" id="extensions" name="extensions">
                                    </div>
                                    <div class="grid-item">
                                        <label for="policy_pages">Policy Pages</label>
                                        <input data-id='32' type="checkbox" id="policy_pages" name="policy_pages">
                                    </div>
                                    <div class="grid-item">
                                        <label for="maintenance_mode">Maintenance Mode</label>
                                        <input data-id='33' type="checkbox" id="maintenance_mode" name="maintenance_mode">
                                    </div>
                                    <div class="grid-item">
                                        <label for="gdpr_cookie">GDPR Cookie</label>
                                        <input data-id='34' type="checkbox" id="gdpr_cookie" name="gdpr_cookie">
                                    </div>
                                    <div class="grid-item">
                                        <label for="custom_css">Custom CSS</label>
                                        <input data-id='35' type="checkbox" id="custom_css" name="custom_css">
                                    </div>
                                    <div class="grid-item">
                                        <label for="sitemap_xml">Sitemap XML</label>
                                        <input data-id='36' type="checkbox" id="sitemap_xml" name="sitemap_xml">
                                    </div>
                                    <div class="grid-item">
                                        <label for="robots_txt">Robots txt</label>
                                        <input data-id='37' type="checkbox" id="robots_txt" name="robots_txt">
                                    </div>
                                </div>

                                <style>
                                    .checkbox-grid {
                                        display: grid;
                                        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                                        gap: 15px;
                                        padding: 15px;
                                    }

                                    .grid-item {
                                        display: flex;
                                        align-items: center;
                                        gap: 8px;
                                        padding: 10px;
                                        background-color: #f5f5f5;
                                        border-radius: 5px;
                                    }

                                    .grid-item label {
                                        margin: 0;
                                        cursor: pointer;
                                    }

                                    .grid-item input[type="checkbox"] {
                                        margin: 0;
                                        cursor: pointer;
                                    }

                                    /* Responsive adjustments */
                                    @media (max-width: 768px) {
                                        .checkbox-grid {
                                            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                                        }
                                    }

                                    @media (max-width: 480px) {
                                        .checkbox-grid {
                                            grid-template-columns: 1fr;
                                        }
                                    }
                                </style>
                            </div>
                        </div>
                        <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form />
    <button class="btn btn--lg btn-outline--primary createButton" type="button"><i class="las la-plus"></i>@lang('Add New')</button>
@endpush

@push('style')
    <style>
        table .user {
            justify-content: center;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict"

            let modal = $('#employeeModal');
            $('.createButton').on('click', function() {
                modal.find('.modal-title').text(`@lang('Add New Employee')`);
                modal.find('form').attr('action', `{{ route('admin.employee.store', '') }}`);
                modal.find('[name=password]').prop('required', true);
                modal.modal('show');
            });
            $('.editButton').on('click', function() {
                var employee = $(this).data('employee');
                console.log(employee.access);

                $('[type=checkbox]').each((i, e) => {
                    const dataId = $(e).data('id');
                    console.log(dataId);
                    if (JSON.parse(employee.access).includes(dataId)) {
                        e.checked = true;
                    }
                });

                modal.find('.modal-title').text(`@lang('Update Employee')`);
                modal.find('form').attr('action', `{{ route('admin.employee.store', '') }}/${employee.id}`);
                modal.find('[name=name]').val(employee.name);
                modal.find('[name=email]').val(employee.email);
                modal.find('[name=username]').val(employee.username);
                modal.find('[name=password]').prop('required', false);
                modal.modal('show');
            });
            modal.on('hidden.bs.modal', function() {
                $('#employeeModal form')[0].reset();
                $('[type=checkbox]').prop('checked', false);
            });

        })(jQuery);
    </script>
@endpush