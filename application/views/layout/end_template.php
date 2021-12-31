<div id="fb-root"></div>
<script>
  
  logged_in = "<?php echo $this->session->has_userdata("logged_in"); ?>";
  base_urlft = "<?php echo base_url(); ?>";
	base_url = "<?php echo base_url('perfil/openMensajeModal/'); ?>";
  var total_calificaciones = "<?php if (isset($total_cali)) {echo $total_cali->cant;}else{ echo "";} ?>";
  var total_estrellas = "<?php if (isset($total_estrellas)) {echo $total_estrellas->total;}else{ echo "";} ?>";

</script>
<script type="text/javascript" src="<?php echo base_url("resources/js/jquery.min.js");?>"></script>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script> -->
<script type="text/javascript" src="<?php echo base_url("resources/js/popper.js");?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/js/bootstrap.min.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/js/jquery.mCustomScrollbar.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/lib/slick/slick.min.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/js/scrollbar.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/js/script.js")?>"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> -->
<script type="text/javascript" src="<?php echo base_url("resources/src/js/global/global.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/src/js/global/functions.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/src/js/login/facebook.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/lobibox-master/dist/js/lobibox.js")?>"></script>
<!-- <script type="text/javascript" src="<?php echo base_url("resources/lobibox-master/demo/demo.js")?>"></script> -->
<script type="text/javascript" src="<?php echo base_url("resources/lobibox-master/dist/js/messageboxes.min.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/lobibox-master/dist/js/notifications.min.js")?>"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url("resources/editable/bootstrap4-editable.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/tags/tagsinput.js")?>"></script>
<script type="text/javascript" src="<?php echo base_url("resources/src/sweet_alert/sweetalert.min.js")?>"></script>
<script type="text/javascript">

  // if ($('#fb-root').length > 0) {
    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "https://connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
  // }
</script>
