<?php if(auth()->user()->hasRole(['super_admin'])): ?>

  <li class="dropdown messages-menu hidden"  >
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >
          <i class="fa fa-envelope"></i>
          <span class="label label-danger"  >
            <span id='count_notification' >
               2
            </span>
        </span>
      </a>
      <ul class="dropdown-menu" >
          <li class="header"> <?php echo app('translator')->getFromJson('site.quotes'); ?> </li>
          <li id='list_notification'>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                  <!-- start message -->

                  <li>
                      <a href="#">
                           <h4>
                              name
                              <small><i class="fa fa-clock-o"></i>dddd</small>
                          </h4>
                          <p>xxxxx...</p>
                      </a>
                  </li>

                  <!-- end message -->
              </ul>
          </li>
        <li class="footer"><a href="<?php echo e(url('/dashboard/quotes')); ?>"><?php echo app('translator')->getFromJson('site.quotes'); ?> </a></li>
      </ul>
  </li>

<?php endif; ?>
<li>
     <a href="<?php echo e(route('home')); ?>" target="_blank"   >
             <i class="fa fa-globe"></i>
      </a>
</li>




<script>
    // setInterval(function() {
    //     $("#count_notification").load(window.location.href + " #count_notification");
    //    $("#list_notification").load(window.location.href + " #list_notification");
    // }, 5000);
</script>
