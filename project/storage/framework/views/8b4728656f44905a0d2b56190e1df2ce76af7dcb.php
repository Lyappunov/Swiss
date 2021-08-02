<?php $__env->startSection('content'); ?>
<div class="content-area">
    <?php echo $__env->make('includes.form-success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    
    <?php if(Session::has('cache')): ?>

    <div class="alert alert-success validation">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">×</span></button>
        <h3 class="text-center"><?php echo e(Session::get("cache")); ?></h3>
    </div>


  <?php endif; ?>



    <div class="row row-cards-one">
 
        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bg4">
                <div class="left">
                    <h5 class="title"><?php echo e(__('Total Projects')); ?></h5>
                    <span class="number"><?php echo e(count($projects)); ?></span>
                    <a href="<?php echo e(route('project-index')); ?>" class="link"><?php echo e(__('View All')); ?></a>
                </div>
                <div class="right d-flex align-self-center">
                    <div class="icon">
                        <i class="icofont-brand-windows"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-4">
            <div class="mycard bg5">
                <div class="left">
                    <h5 class="title"><?php echo e(__('Total Customers')); ?></h5>
                    <span class="number"><?php echo e(count($customers)); ?></span>
                    <a href="<?php echo e(route('admin-customer-list')); ?>" class="link"><?php echo e(__('View All')); ?></a>
                </div>
                <div class="right d-flex align-self-center">
                    <div class="icon">
                        <i class="icofont-users-alt-5"></i>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row row-cards-one">
        <div class="col-md-6 col-xl-3">
            <div class="card c-info-box-area">
                <div class="c-info-box box1">
                    <p style='font-size:25px; font-weight:bold'><?php echo e(count($projects)); ?></p>
                </div>
                <div class="c-info-box-content">
                    <h6 class="title"><?php echo e(__('All Projects')); ?></h6>
                    <p class="text"><?php echo e(__('Total')); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card c-info-box-area">
                <div class="c-info-box box2">
                    <p style='font-size:25px; font-weight:bold'><?php echo e(count($working_projects)); ?></p>
                </div>
                <div class="c-info-box-content">
                    <h6 class="title"><?php echo e(__('Working Projects')); ?></h6>
                    <p class="text"><?php echo e(__('Total')); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card c-info-box-area">
                <div class="c-info-box box4">
                    <p style='font-size:25px; font-weight:bold'><?php echo e(count($closed_projects)); ?></p>
                </div>
                <div class="c-info-box-content">
                    <h6 class="title"><?php echo e(__('Closed Projects')); ?></h6>
                    <p class="text"><?php echo e(__('Total')); ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card c-info-box-area">
                <div class="c-info-box box3">
                    <p style='font-size:25px; font-weight:bold'><?php echo e(count($offer_projects)); ?></p>
                </div>
                <div class="c-info-box-content">
                    <h6 class="title"><?php echo e(__('Offerphase Projects')); ?></h6>
                    <p class="text"><?php echo e(__('Total')); ?></p>
                </div>
            </div>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>



<script type="text/javascript">
    $('#poproducts').dataTable( {
      "ordering": false,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : false,
          'responsive'  : true,
          'paging'  : false
    } );
    </script>


<script type="text/javascript">
    $('#pproducts').dataTable( {
      "ordering": false,
      'lengthChange': false,
          'searching'   : false,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : false,
          'responsive'  : true,
          'paging'  : false
    } );
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>