
    <li>
        <a href="#projects" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="icofont-brand-windows"></i><?php echo e(__('Projects')); ?>

        </a>
        <ul class="collapse list-unstyled" id="projects" data-parent="#accordion">
            <li>
                <a href="<?php echo e(route('project-create')); ?>">
                    <span><i class="icofont-plus-square"></i>New Project</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('project-index')); ?>">
                    <span><i class="icofont-justify-all"></i>All Projects</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('project-working')); ?>">
                    <span><i class="icofont-address-book"></i>Working Projects</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('project-closed')); ?>">
                    <span><i class="icofont-address-book"></i>Closed Projects</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('project-offer')); ?>">
                    <span><i class="icofont-address-book"></i>Offerphase Projects</span>
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#menu3" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="icofont-user"></i><?php echo e(__('Customers')); ?>

        </a>
        <ul class="collapse list-unstyled" id="menu3" data-parent="#accordion">
            <li>
                <a href="<?php echo e(route('new-customer')); ?>"><span><i class="icofont-plus-square"></i><?php echo e(__('New Customer')); ?></span></a>
            </li>
            <li>
                <a href="<?php echo e(route('admin-customer-list')); ?>"><span><i class="icofont-people"></i><?php echo e(__('Customers List')); ?></span></a>
            </li>
        </ul>
    </li>

    <li>
        <a href="<?php echo e(route('invoices')); ?>" class=" wave-effect"><i class="icofont-file-document"></i><?php echo e(__('Invoices')); ?></a>
    </li>
    <li>
        <a href="<?php echo e(route('admin-message-index')); ?>" class=" wave-effect"><i class="icofont-speech-comments"></i><?php echo e(__('Communications')); ?></a>
    </li>

    <li>
        <a href="#events" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="icofont-megaphone-alt"></i><?php echo e(__('Events')); ?>

        </a>
        <ul class="collapse list-unstyled" id="events" data-parent="#accordion">
            <li>
                <a href="<?php echo e(route('new-event')); ?>">
                    <span><i class="icofont-plus-square"></i>New Event</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('all-events')); ?>">
                    <span><i class="icofont-justify-all"></i>All Events</span>
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="<?php echo e(route('guaratees')); ?>" class=" wave-effect"><i class="icofont-check-circled"></i><?php echo e(__('Guarantees')); ?></a>
    </li>

    <li>
        <a href="<?php echo e(route('admin-prod-import')); ?>"><i class="fas fa-upload"></i><?php echo e(__('Import / Export CSV')); ?></a>
    </li>

    <li>
        <a href="<?php echo e(route('admin-gs-contents')); ?>"><span><?php echo e(__('System Contents')); ?></span></a>
    </li>
    

    <li>
        <a href="#emails" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-at"></i><?php echo e(__('Email Settings')); ?>

        </a>
        <ul class="collapse list-unstyled" id="emails" data-parent="#accordion">
            <li><a href="<?php echo e(route('admin-mail-config')); ?>"><span><?php echo e(__('Email Configurations')); ?></span></a></li>
        </ul>
    </li>
    <li>
        <a href="#langs" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false">
            <i class="fas fa-language"></i><?php echo e(__('Language Settings')); ?>

        </a>
        <ul class="collapse list-unstyled" id="langs" data-parent="#accordion">
            <li><a href="<?php echo e(route('admin-tlang-index')); ?>"><span><?php echo e(__('Admin Panel Language')); ?></span></a></li>
        </ul>
    </li>
 
    <li>
        <a href="<?php echo e(route('admin-staff-index')); ?>" class=" wave-effect"><i class="fas fa-user-secret"></i><?php echo e(__('Manage Staffs')); ?></a>
    </li>

    

    <li>
        <a href="<?php echo e(route('admin-role-index')); ?>" class=" wave-effect"><i class="fas fa-user-tag"></i><?php echo e(__('Manage Roles')); ?></a>
    </li>

        