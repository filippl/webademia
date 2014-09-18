<?php
/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return
 *   A string containing the breadcrumb output.
 */
function corporateclean_breadcrumb($variables){
  $breadcrumb = $variables['breadcrumb'];
  $breadcrumb_separator=theme_get_setting('breadcrumb_separator','corporateclean');
  
  $show_breadcrumb_home = theme_get_setting('breadcrumb_home');
  if (!$show_breadcrumb_home) {
  array_shift($breadcrumb);
  }
  
  if (!empty($breadcrumb)) {
    $breadcrumb[] = drupal_get_title();
    return '<div class="breadcrumb">' . implode(' <span class="breadcrumb-separator">' . $breadcrumb_separator . '</span>', $breadcrumb) . '</div>';
  }
}

function corporateclean_page_alter($page) {

	if (theme_get_setting('responsive_meta','corporateclean')):
	$mobileoptimized = array(
		'#type' => 'html_tag',
		'#tag' => 'meta',
		'#attributes' => array(
		'name' =>  'MobileOptimized',
		'content' =>  'width'
		)
	);

	$handheldfriendly = array(
		'#type' => 'html_tag',
		'#tag' => 'meta',
		'#attributes' => array(
		'name' =>  'HandheldFriendly',
		'content' =>  'true'
		)
	);

	$viewport = array(
		'#type' => 'html_tag',
		'#tag' => 'meta',
		'#attributes' => array(
		'name' =>  'viewport',
		'content' =>  'width=device-width, initial-scale=1'
		)
	);
	
	drupal_add_html_head($mobileoptimized, 'MobileOptimized');
	drupal_add_html_head($handheldfriendly, 'HandheldFriendly');
	drupal_add_html_head($viewport, 'viewport');
	endif;
	
}

function corporateclean_preprocess_page(&$vars){
  if (arg(0) == 'blog')  {
    unset($vars['title']);
  }
}

function corporateclean_preprocess_html(&$variables) {

	if (!theme_get_setting('responsive_respond','corporateclean')):
	drupal_add_css(path_to_theme() . '/css/basic-layout.css', array('group' => CSS_THEME, 'browsers' => array('IE' => '(lte IE 8)&(!IEMobile)', '!IE' => FALSE), 'preprocess' => FALSE));
	endif;
	
	drupal_add_css(path_to_theme() . '/css/ie.css', array('group' => CSS_THEME, 'browsers' => array('IE' => '(lte IE 8)&(!IEMobile)', '!IE' => FALSE), 'preprocess' => FALSE));
}

/**
 * Override or insert variables into the html template.
 */
function corporateclean_process_html(&$vars) {
	// Hook into color.module
	if (module_exists('color')) {
	_color_html_alter($vars);
	}

}

/**
 * Override or insert variables into the page template.
 */
function corporateclean_process_page(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_page_alter($variables);
  }
 
}

function corporateclean_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') {
  
    unset($form['search_block_form']['#title']);
	
    $form['search_block_form']['#title_display'] = 'invisible';
	$form_default = t('Search');
    $form['search_block_form']['#default_value'] = $form_default;
    $form['actions']['submit'] = array('#type' => 'image_button', '#src' => base_path() . path_to_theme() . '/images/search-button.png');

 	$form['search_block_form']['#attributes'] = array('onblur' => "if (this.value == '') {this.value = '{$form_default}';}", 'onfocus' => "if (this.value == '{$form_default}') {this.value = '';}" );
  }

  if ($form_id == 'user_register_form') {
    $form['account']['name']['#title'] = t('Name');
    $form['account']['name']['#description'] = t('Podaj nazwę użytkownika jaką chcesz używac na stronie');
    $form['account']['mail']['#title'] = t('E-mail address');
    $form['account']['mail']['#description'] = t('Podaj swój prawdziwy adres e-mail');
    $form['actions']['submit']['#value'] = t('Odbierz dostęp'); 
  }
}
/**
 * Add javascript files for jquery slideshow.
 */
if (theme_get_setting('slideshow_js','corporateclean')):

	drupal_add_js(drupal_get_path('theme', 'corporateclean') . '/js/jquery.cycle.all.js');
	
	//Initialize slideshow using theme settings
	$effect=theme_get_setting('slideshow_effect','corporateclean');
	$effect_time=theme_get_setting('slideshow_effect_time','corporateclean')*1000;
	$slideshow_randomize=theme_get_setting('slideshow_randomize','corporateclean');
	$slideshow_wrap=theme_get_setting('slideshow_wrap','corporateclean');
	$slideshow_pause=theme_get_setting('slideshow_pause','corporateclean');
	
	drupal_add_js('jQuery(document).ready(function($) {
	
	$(window).load(function() {
	
		$("#slideshow img").show();
		$("#slideshow").fadeIn("slow");
		$("#slider-controls-wrapper").fadeIn("slow");
	
		$("#slideshow").cycle({
			fx:    "'.$effect.'",
			speed:  "slow",
			timeout: "'.$effect_time.'",
			random: '.$slideshow_randomize.',
			nowrap: '.$slideshow_wrap.',
			pause: '.$slideshow_pause.',
			pager:  "#slider-navigation",
			pagerAnchorBuilder: function(idx, slide) {
				return "#slider-navigation li:eq(" + (idx) + ") a";
			},
			slideResize: true,
			containerResize: false,
			height: "auto",
			fit: 1,
			before: function(){
				$(this).parent().find(".slider-item.current").removeClass("current");
			},
			after: onAfter
		});
	});
	
	function onAfter(curr, next, opts, fwd) {
		var $ht = $(this).height();
		$(this).parent().height($ht);
		$(this).addClass("current");
	}
	
	$(window).load(function() {
		var $ht = $(".slider-item.current").height();
		$("#slideshow").height($ht);
	});
	
	$(window).resize(function() {
		var $ht = $(".slider-item.current").height();
		$("#slideshow").height($ht);
	});
	
	});',
	array('type' => 'inline', 'scope' => 'footer', 'weight' => 5)
	);

endif;

function corporateclean_rate_preprocess_rate_template_number_up_down(&$variables) {
  extract($variables);

  $up_classes = 'rate-number-up-down-btn-up';
  $down_classes = 'rate-number-up-down-btn-down';
  if (isset($results['user_vote'])) {
    switch ($results['user_vote']) {
      case $links[0]['value']:
        $up_classes .= ' rate-voted';
        break;
      case $links[1]['value']:
        $down_classes .= ' rate-voted';
        break;
    }
  }

  $variables['up_button'] = theme('rate_button', array('text' => $links[0]['text'], 'href' => $links[0]['href'], 'class' => $up_classes));
  $variables['down_button'] = theme('rate_button', array('text' => $links[1]['text'], 'href' => $links[1]['href'], 'class' => $down_classes));
  if ($results['rating'] > 0) {
    $score = '+' . $results['rating'];
    $score_class = 'positive';
  }
  elseif ($results['rating'] < 0) {
    $score = $results['rating'];
    $score_class = 'negative';
  }
  else {
    $score = 0;
    $score_class = 'neutral';
  }
  $variables['score'] = $score;
  $variables['score_class'] = $score_class;

  $info = array();
  if ($mode == RATE_CLOSED) {
    $info[] = t('Voting is closed.');
  }
  if ($mode != RATE_COMPACT && $mode != RATE_COMPACT_DISABLED) {
    if (isset($results['user_vote'])) {
      $info[] = t('Dupa \'@option\'.', array('@option' => $results['user_vote'] == 1 ? $links[0]['text'] : $links[1]['text']));
    }
  }
  $variables['info'] = implode(' ', $info);
}
/**
 * Custom template files for user login and registration pages
 */

function corporateclean_theme() {
 $items = array();
   
 $items['user_login'] = array(
   'render element' => 'form',
   'path' => drupal_get_path('theme', 'corporateclean') . '/templates',
   'template' => 'user-login',
 );
 $items['user_register_form'] = array(
   'render element' => 'form',
   'path' => drupal_get_path('theme', 'corporateclean') . '/templates',
   'template' => 'user-register-form',
 );
 
 return $items;
}
