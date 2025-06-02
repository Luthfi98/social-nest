@if($menu->status === 'active')
    <span class="badge bg-success">{{ __('Active') }}</span>
@else
    <span class="badge bg-danger">{{ __('Inactive') }}</span>
@endif 