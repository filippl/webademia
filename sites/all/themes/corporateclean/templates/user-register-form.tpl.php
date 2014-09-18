<!-- Custom user registration form -->


<!-- Print Fb connect button if fboauth module loaded -->
<div>
 <?php if (module_exists('fboauth')) { print fboauth_action_display('connect'); } ?>
</div>

<!-- Print login form -->
<div>
 <?php print drupal_render_children($form) ?>
</div>

<!-- Print create account and password reset links -->
<div>
 <a href="./user/login" title="Zaloguj się">Zaloguj się</a> |
 <a href="./user/password" title="Zapomniane hasło">Zapomniałeś hasło?</a>
</div>
