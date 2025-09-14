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
                                    <th>@lang('Type')</th>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Uses')</th>
                                    <th>@lang('Created At')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon->name }}</td>
                                        <td>
                                            {{ $coupon->type==0?"Precentage":"Period" }}
                                        </td>
                                        <td>
                                            {{ $coupon->start_date }} - {{ $coupon->end_date }}
                                        </td>
                                        <td>
                                            {{ $coupon->status==0?"Unactive":"Active" }}
                                        </td>
                                        <td>
                                            {{ $coupon->use_count }} - {{ $coupon->max_use }}
                                        </td>
                                        <td>
                                            {{ $coupon->created_at }}
                                        </td>
                                        <td>
                                            <div class="button--group">
                                                <button class="btn btn-sm btn-outline--primary editButton" data-coupon="{{ $coupon }}">
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
                @if ($coupons->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($coupons) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" id="couponModal" role="dialog" tabindex="-1">
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
                                <input class="form-control" name="name" type="text" value="{{ old('name') }}" required>
                                <label>@lang('Code')</label>
                                <input class="form-control" name="code" type="text" value="{{ old('code') }}" required>
                                <label>@lang('Start Date')</label>
                                <input class="form-control" name="start_date" type="date" value="{{ old('start_date') }}" required>
                                <label>@lang('End Date')</label>
                                <input class="form-control" name="end_date" type="date" value="{{ old('end_date') }}" required>
                                <label>@lang('Max Use')</label>
                                <input class="form-control" name="max_use" type="number" value="{{ old('max_use') }}" required>
                                <label>@lang('Type')</label>
                                <select class="form-control" name="type" type="text" value="{{ old('type') }}" required>
                                    <option value="0">Precentage</option>
                                    <option value="1">Period</option>
                                    </select>
                                <label>@lang('Status')</label>
                                <select class="form-control" name="status" type="text" value="{{ old('status') }}" required>
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                    </select>
                                <label>@lang('Value')</label>
                                <input class="form-control" name="value" type="number" value="{{ old('value') }}" required>
                                <label>@lang('Unlimited Value Discounted')</label>
                                <select class="form-control" name="unlimited_value_check" type="text" value="{{ old('Unlimited Value Discounted') }}" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                    </select>
                                <label>@lang('Description')</label>
                                <input class="form-control" name="description" type="text" value="{{ old('description') }}">
                                
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

            let modal = $('#couponModal');
            $('.createButton').on('click', function() {
                modal.find('.modal-title').text(`@lang('Add New coupon')`);
                modal.find('form').attr('action', `{{ route('admin.coupons.store', '') }}`);
                modal.modal('show');
            });
            $('.editButton').on('click', function() {
                
                var coupon = $(this).data('coupon');
                console.log(coupon)
                modal.find('.modal-title').text(`@lang('Update coupon')`);
                modal.find('form').attr('action', `{{ route('admin.coupons.store', '') }}/${coupon.id}`);
                modal.find('[name=name]').val(coupon.name);
                modal.find('[name=description]').val(coupon.description);
                modal.find('[name=unlimited_value_check]').val(coupon.unlimited_value);
                modal.find('[name=value]').val(coupon.value);
                modal.find('[name=status]').val(coupon.status);
                document.querySelector("#unlimited_value_check").value=parseInt(coupon.unlimited_value)
                modal.find('[name=type]').val(coupon.type);
                modal.find('[name=max_use]').val(coupon.max_use);
                modal.find('[name=end_date]').val(coupon.end_date);
                modal.find('[name=start_date]').val(coupon.start_date);;
                modal.find('[name=code]').val(coupon.code);
                modal.modal('show')
            });
            modal.on('hidden.bs.modal', function() {
                $('#couponModal form')[0].reset();
            });

        })(jQuery);
    </script>
@endpush
