@extends('admin.layouts.app')
@php 
@endphp

@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10">
            <div class="card-body p-0">
                <div class="table-responsive--md table-responsive">
                    <table class="table--light style--two table">
                        <thead>
                            <tr>
                                <th>@lang('Service Name')</th>
                                <th>@lang('Price')</th>
                                <th>@lang('Description')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Per Day ?')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($services as $service)
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ showAmount($service->default_price) }}</td>
                                    <td>{{ $service->description }}</td>
                                    <td>
                                        @if($service->active)
                                            <span class="badge badge--success">@lang('Active')</span>
                                        @else
                                            <span class="badge badge--danger">@lang('Inactive')</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($service->is_per_day)
                                            <span class="badge badge--success">@lang('Yes')</span>
                                        @else
                                            <span class="badge badge--danger">@lang('No')</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="button--group">
                                            <button class="btn btn-sm btn-outline--primary editButton" data-service="{{ $service }}">
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
            @if ($services->hasPages())
                <div class="card-footer py-4">
                    {{ paginateLinks($services) }}
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="serviceModal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>@lang('Service Name')</label>
                        <input class="form-control" name="name" type="text" required>
                    </div>
                    <div class="form-group">
                        <label>@lang('Price')</label>
                        <input class="form-control" name="default_price" type="number" step="0.01" min="0" required>
                    </div>
                    <div class="form-group">
                        <label>@lang('Description')</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>@lang('Status')</label>
                        <select name="active" class="form-control" required>
                            <option value="1">@lang('Active')</option>
                            <option value="0">@lang('Inactive')</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>@lang('Per Day')</label>
                        <select name="is_per_day" class="form-control" required>
                            <option value="1">@lang('Yes')</option>
                            <option value="0">@lang('No')</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
    <button class="btn btn--lg btn-outline--primary createButton" type="button">
        <i class="las la-plus"></i>@lang('Add New Service')
    </button>
@endpush

@push('script')
<script>
(function($){
    "use strict"

    let modal = $('#serviceModal');

    $('.createButton').on('click', function(){
        modal.find('.modal-title').text(`@lang('Add New Service')`);
        modal.find('form').attr('action', `{{ route('admin.extra-services.store') }}`);
        modal.find('form')[0].reset();
        modal.modal('show');
    });

    $('.editButton').on('click', function(){
        let service = $(this).data('service');
        modal.find('.modal-title').text(`@lang('Edit Service')`);
        modal.find('form').attr('action', `{{ route('admin.extra-services.update', '') }}/${service.id}`);
        modal.find('[name=name]').val(service.name);
        modal.find('[name=default_price]').val(service.default_price);
        modal.find('[name=description]').val(service.description);
        modal.find('[name=active]').val(service.active);
        modal.find('[name=is_per_day]').val(service.is_per_day);
        modal.modal('show');
    });

})(jQuery);
</script>
@endpush
