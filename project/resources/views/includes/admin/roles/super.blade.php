
    <li>
        <a href="#projects" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="icofont-brand-windows"></i>{{ __('Projects') }}
        </a>
        <ul class="collapse list-unstyled" id="projects" data-parent="#accordion">
            <li>
                <a href="{{route('project-create')}}">
                    <span><i class="icofont-plus-square"></i>New Project</span>
                </a>
            </li>
            <li>
                <a href="{{ route('project-index') }}">
                    <span><i class="icofont-justify-all"></i>All Projects</span>
                </a>
            </li>
            <li>
                <a href="{{ route('project-working') }}">
                    <span><i class="icofont-address-book"></i>Working Projects</span>
                </a>
            </li>
            <li>
                <a href="{{ route('project-closed') }}">
                    <span><i class="icofont-address-book"></i>Closed Projects</span>
                </a>
            </li>
            <li>
                <a href="{{ route('project-offer') }}">
                    <span><i class="icofont-address-book"></i>Offerphase Projects</span>
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#menu3" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="icofont-user"></i>{{ __('Customers') }}
        </a>
        <ul class="collapse list-unstyled" id="menu3" data-parent="#accordion">
            <li>
                <a href="{{ route('new-customer') }}"><span><i class="icofont-plus-square"></i>{{ __('New Customer') }}</span></a>
            </li>
            <li>
                <a href="{{ route('admin-customer-list') }}"><span><i class="icofont-people"></i>{{ __('Customers List') }}</span></a>
            </li>
        </ul>
    </li>

    <li>
        <a href="{{ route('invoices') }}" class=" wave-effect"><i class="icofont-file-document"></i>{{ __('Invoices') }}</a>
    </li>
    <li>
        <a href="{{ route('admin-message-index') }}" class=" wave-effect"><i class="icofont-speech-comments"></i>{{ __('Communications') }}</a>
    </li>

    <li>
        <a href="#events" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="icofont-megaphone-alt"></i>{{ __('Events') }}
        </a>
        <ul class="collapse list-unstyled" id="events" data-parent="#accordion">
            <li>
                <a href="{{ route('new-event') }}">
                    <span><i class="icofont-plus-square"></i>New Event</span>
                </a>
            </li>
            <li>
                <a href="{{ route('all-events') }}">
                    <span><i class="icofont-justify-all"></i>All Events</span>
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="{{ route('guaratees') }}" class=" wave-effect"><i class="icofont-check-circled"></i>{{ __('Guarantees') }}</a>
    </li>

    <li>
        <a href="{{ route('admin-prod-import') }}"><i class="fas fa-upload"></i>{{ __('Import / Export CSV') }}</a>
    </li>

    <li>
        <a href="{{ route('admin-gs-contents') }}"><span>{{ __('System Contents') }}</span></a>
    </li>
    

    <li>
        <a href="#emails" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-at"></i>{{ __('Email Settings') }}
        </a>
        <ul class="collapse list-unstyled" id="emails" data-parent="#accordion">
            <li><a href="{{route('admin-mail-config')}}"><span>{{ __('Email Configurations') }}</span></a></li>
        </ul>
    </li>
    <li>
        <a href="#langs" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-language"></i>{{ __('Language Settings') }}
        </a>
        <ul class="collapse list-unstyled" id="langs" data-parent="#accordion">
            <li><a href="{{route('admin-tlang-index')}}"><span>{{ __('Admin Panel Language') }}</span></a></li>
        </ul>
    </li>
 
    <li>
        <a href="{{ route('admin-staff-index') }}" class=" wave-effect"><i class="fas fa-user-secret"></i>{{ __('Manage Staffs') }}</a>
    </li>

    

    <li>
        <a href="{{ route('admin-role-index') }}" class=" wave-effect"><i class="fas fa-user-tag"></i>{{ __('Manage Roles') }}</a>
    </li>

        