<!-- Custom login form -->

<!-- Print Fb connect button if fboauth module loaded -->
<div>
 <?php if (module_exists('fboauth')) {
   print fboauth_action_display('connect');
   }
 ?>
</div>

<!-- Print login form -->
<div>
 <?php print drupal_render_children($form) ?>
</div>
