<?php
$page="dashboard";
$title=trans('site.dashboard');
?>
<?php $__env->startSection('title_page'); ?>
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1><?php echo app('translator')->getFromJson('site.dashboard'); ?></h1>
        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i> <?php echo app('translator')->getFromJson('site.dashboard'); ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="ion ion-ios-cart-outline"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo app('translator')->getFromJson('site.orders'); ?></span>
                                <span class="info-box-number"><?php echo e($orders); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="ion-ios-chatbubble-outline"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo app('translator')->getFromJson('site.inbox'); ?></span>
                                <span class="info-box-number"><?php echo e($inbox); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-user-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo app('translator')->getFromJson('site.customers'); ?></span>
                                <span class="info-box-number"><?php echo e($customers); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-th-list"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo app('translator')->getFromJson('site.sections'); ?></span>
                                <span class="info-box-number"><?php echo e($sections); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-align-left"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo app('translator')->getFromJson('site.categories'); ?></span>
                                <span class="info-box-number"><?php echo e($categories); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i
                                    class="glyphicon glyphicon-align-center"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo app('translator')->getFromJson('site.subCategories'); ?></span>
                                <span class="info-box-number"><?php echo e($subCategories); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="glyphicon glyphicon-align-right"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo app('translator')->getFromJson('site.products'); ?></span>
                                <span class="info-box-number"><?php echo e($products); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-align-justify"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><?php echo app('translator')->getFromJson('site.additions'); ?></span>
                                <span class="info-box-number"><?php echo e($additions); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>
                </div>
                <!-- /.row -->
            </div>

            <div class="col-md-6">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3><?php echo e($orders_pending); ?></h3>
                                <p><?php echo app('translator')->getFromJson('site.orders_pending'); ?></p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-newspaper-o"></i>
                            </div>
                           
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3><?php echo e($orders_total); ?></h3>
                                <p><?php echo app('translator')->getFromJson('site.total_orders'); ?></p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-dollar"></i>
                            </div>
                         </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3><?php echo e($customers); ?></h3>
                                <p><?php echo app('translator')->getFromJson('site.customers'); ?></p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                         </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3><?php echo e($products); ?></h3>
                                <p><?php echo app('translator')->getFromJson('site.products'); ?></p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-building-o"></i>
                            </div>
                         </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div>


            <div class="col-md-6">
                <!-- USERS LIST -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo app('translator')->getFromJson('site.customers'); ?></h3>
                        <div class="box-tools pull-right">
                            <span class="label label-danger"> <?php echo app('translator')->getFromJson('site.customers'); ?>( <?php echo e(count($customers_list)); ?> )
                            </span>
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <ul class="users-list clearfix">
                            <?php $__currentLoopData = $customers_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <img src="<?php echo e($item->image_path); ?>" alt="User Image">
                                <a class="users-list-name" href="#"><?php echo e($item->full_name); ?></a>
                                <span class="users-list-date">
                                    <?php echo e(\Carbon\Carbon::parse($item->created_at)->diffForHumans()); ?></span>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                        <a href="<?php echo e(url('dashboard/customers')); ?>" class="uppercase"><?php echo app('translator')->getFromJson('site.customers'); ?></a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!--/.box -->
            </div>


            
        </div>
        <div class="container-fluid">
            <h3 class="box-title">اخر المنتجات</h3>
            <div class="box">
                <div class="box-body table-responsive no-padding table-responsiveAll">
                    <table class="table table-hover">
                        <tbody>
                           <tr>
                            <th>#</th>
                            <th><?php echo app('translator')->getFromJson('site.category'); ?></th>
                            <th><?php echo app('translator')->getFromJson('site.name'); ?></th>
                            
                            <th><?php echo app('translator')->getFromJson('site.price'); ?></th>
                            <th><?php echo app('translator')->getFromJson('site.status'); ?></th>
                            <th><?php echo app('translator')->getFromJson('site.image'); ?></th>
              
                        </tr>
                            
                                <?php $__currentLoopData = $products_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td>
                                <?php echo e($product->section->title??"لا يوجد"); ?>>>
                                <?php echo e($product->category->title??"لا يوجد"); ?>>>
                                <?php echo e($product->subCategory->title??"لا يوجد"); ?>


                            </td>
                            <td> <?php echo e($product->title); ?></td>

                            <td>
                                <?php echo e($product->Total); ?> <?php echo e(__('site.'.currncy())); ?>

                            </td>

                            <td>
                                <?php echo e(__('site.'.$product->status)); ?>

                            </td>
                            <td>
                                <img src="<?php echo e($product->image_path); ?>" style="width: 100px;" class="img-thumbnail">

                            </td>
                          
                        </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                          
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </section>
 
</div><!-- end of content wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>