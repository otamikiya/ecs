
<p id="pageTop"><a href="#"><i class="fa fa-chevron-up"></i></a></p>

<footer id="colophon" class="site-footer " role="contentinfo">
  <!--footer menu-->
  <div class="footerMenuWrapper">
    <div id="footerMenu" class="flexPc fai_stretchPc">
      
      <div id="footerSidebar01" class="">
        <?php dynamic_sidebar('footer-sidebar01');?>
      </div><!--/#footerSidebar01-->

      <div id="footerSidebar02" class="">
        <?php dynamic_sidebar('footer-sidebar02');?>
      </div><!--/#footerSidebar02-->
      
      <div id="footerSidebar03" class="">
        <?php dynamic_sidebar('footer-sidebar03');?>
      </div><!--/#footerSidebar03-->

    </div><!--/#footerMenu-->
  </div><!--/.footerMenuWrapper-->
 
  <div id="subFooter">
    <?php echo do_shortcode('[copyright]'); ?>
  </div><!--/#subFooter -->


</footer><!--/#colophon -->


<?php wp_footer(); ?>


</body>

</html>