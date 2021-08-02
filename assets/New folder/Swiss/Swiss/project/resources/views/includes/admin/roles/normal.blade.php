@if(Auth::guard('admin')->user()->role_id != 0)
    <li>
        <a href="{{ route('admin-hotel-index') }}" class=" wave-effect"><i class="icofont-user"></i>{{ __('Hotel Storage (Customers) List') }}</a>
    </li>
    <li>
        <a href="{{ route('admin-storage-index') }}" class=" wave-effect"><i class="fas fa-dollar-sign"></i>{{ __('Storage (All Tires) List') }}</a>
    </li>
    @if(Auth::guard('admin')->user()->sectionCheck('stand_by_list'))
    <li>
        <a href="{{ route('admin-standby-index') }}"><i class="fas fa-pause-circle"></i>{{ __('Stand by List') }}</a>
    </li>
    @endif
    @if(Auth::guard('admin')->user()->sectionCheck('booking_list'))
    <li>
        <a href="{{ route('admin-booking-index') }}"><i class="fas fa-upload"></i>{{ __('Booking List') }}</a>
    </li>
    @endif

    @if(Auth::guard('admin')->user()->sectionCheck('picked_up_list'))
    <li>
        <a href="{{ route('admin-picked-index') }}"><i class="fas fa-truck-pickup"></i>{{ __('Picked Up List') }}</a>
    </li>
    @endif
    @if(Auth::guard('admin')->user()->sectionCheck('trashed_list'))
    <li>
        <a href="{{ route('admin-trashed-index') }}"><i class="fas fa-trash-alt"></i>{{ __('Trashed List') }}</a>
    </li>
    @endif
    @if(Auth::guard('admin')->user()->sectionCheck('old_storage_list'))
    <li>
        <a href="{{ route('admin-oldstorage-index') }}"><i class="fas fa-hand-holding"></i>{{ __('Old Storage List') }}</a>
    </li>
    @endif
    @if(Auth::guard('admin')->user()->sectionCheck('import_and_export_data'))
    <li>
        <a href="{{ route('admin-prod-import') }}"><i class="fas fa-upload"></i>{{ __('Import(Export) Tire from(to) CSV') }}</a>
    </li>
    @endif

@endif