<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2016 <a href="//www.hdussta.cn/">HDUSSTA</a>.</strong> All rights reserved.
    </footer>

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="<?=DIR_JS?>jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=DIR_BT?>js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=DIR_ADMIN?>js/app.min.js"></script>
<!-- PACE -->
<script src="<?=DIR_PACE?>js/pace.min.js"></script>
<?php if (isset($extra_js)): ?>
<?php foreach ($extra_js as $each_js):?>
<script src="<?=$each_js?>"></script>
<?php endforeach ;?>
<?php endif ?>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
<?php if (isset($script)): ?>
<script type="text/javascript">
<?=$script?>
</script>
<?php endif ?>
</body>
</html>
