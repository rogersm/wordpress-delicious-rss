<?php
/*
Plugin Name: deliciousRSS
Plugin URI: http://code.google.com/p/wordpress-delicious-rss/
Description: Allows you to integrate the urls from a delicious rss feed into your site.
Version: 1.0
License: GPL v.2
Author: Roger Sen
Author URI: http://rogersm.net/

    Copyright 2007  Roger Sen  (email : roger.sen@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

/*
   1. $userid - specify a user id
   2. $num_items - how many links you want to appear
   3. $tags - a comma separated list of tags
   4. $before_link - html appearing before each photo
   5. $after_link - html appearing after each photo
 */


function get_deliciousRSS() {

        // the function can accept up to seven parameters, otherwise it uses option panel defaults
        for($i = 0 ; $i < func_num_args(); $i++) {
        $args[] = func_get_arg($i);
        }
        if (!isset($args[0])) $userid         = stripslashes(get_option('deliciousRSS_userid')); else $userid       = $args[0];
  if (!isset($args[1])) $num_items      = get_option('deliciousRSS_display_numitems');     else $num_items    = $args[1];
  if (!isset($args[2])) $tags           = transform_tags(get_option('deliciousRSS_tags')); else $tags         = transform_tags($args[2]);
  if (!isset($args[3])) $before_link    = stripslashes(get_option('deliciousRSS_before')); else $before_link  = $args[3];
  if (!isset($args[4])) $after_link     = stripslashes(get_option('deliciousRSS_after'));  else $after_link   = $args[4];

  if (!function_exists('MagpieRSS')) { // Check if another plugin is using RSS, may not work
                include_once (ABSPATH . WPINC . '/rss.php');
                error_reporting(E_ERROR);
        }

        # get the feeds
        $rss_url = 'http://del.icio.us/rss/' . $userid . '/' . $tags;
        $rss = @ fetch_rss($rss_url);

  if( ! $rss ) {
        print "del.icio.us is having a massage (delicious Blog)";
        return FALSE;
  }

        $items = array_slice($rss->items, 0, $num_items);

        foreach ( $items as $item ) {
        $url   = $item['link'];
        $title = $item['title'];
        $description   = $item['description'];

    print $before_link . "<a href=\"$url\" title=\"$description\">$title</a>" . $after_link;
  }
}

// Transform "vamos, a ver, como,, va, esto  " into "vamos+a%20ver+como+va+esto"
// or "vamos a ver como va esto" into "vamos+a+ver+como+va+esto"
// 1. $list_of_tags - a comma separated list of tags

function transform_tags( $list_of_tags )
{
        if ( "" == $list_of_tags )
    return "";

  if( FALSE == strstr( $list_of_tags, ',' ) )
        return str_replace( " ", "+", trim( $list_of_tags ) );

  $array_of_tags = split( ",", $list_of_tags );

  for($i = 0, $j = 0; $i < count( $array_of_tags ); $i++ ){

    if( "" == $array_of_tags[ $i ] )
      continue;

    $return_tags[ $j ] = str_replace( " ", "%20", trim( $array_of_tags[ $i ] ) );
    $j++;
  }
  return implode("+", $return_tags );
}

function widget_deliciousRSS_init() {
        if (!function_exists('register_sidebar_widget')) return;

        function widget_deliciousRSS($args) {

                extract($args);

                $options = get_option('widget_deliciousRSS');
                $title = $options['title'];

                echo $before_widget . $before_title . $title . $after_title;
                get_deliciousRSS();
                echo $after_widget;
        }

        function widget_deliciousRSS_control() {
                $options = get_option('widget_deliciousRSS');
                if ( !is_array($options) )
                        $options = array('title'=>'');
                if ( $_POST['deliciousRSS-submit'] ) {
                        $options['title'] = strip_tags(stripslashes($_POST['deliciousRSS-title']));
                        update_option('widget_deliciousRSS', $options);
                }

                $title = htmlspecialchars($options['title'], ENT_QUOTES);

                echo '<p style="text-align:right;"><label for="deliciousRSS-title">Title: <input style="width: 200px;" id="gsearch-title" name="deliciousRSS-title" type="text" value="'.$title.'" /></label></p>';
                echo '<input type="hidden" id="deliciousRSS-submit" name="deliciousRSS-submit" value="1" />';
        }
        register_sidebar_widget('deliciousRSS', 'widget_deliciousRSS');
        register_widget_control('deliciousRSS', 'widget_deliciousRSS_control', 300, 100);
}

function deliciousRSS_subpanel() {
     if (isset($_POST['update_deliciousRSS'])) {
       $option_deliciousid = $_POST['delicious_nsid'];
       $option_tags = $_POST['tags'];
       $option_display_numitems = $_POST['display_numitems'];
       $option_before = $_POST['before_link'];
       $option_after = $_POST['after_link'];

       update_option('deliciousRSS_userid', $option_deliciousid);
       update_option('deliciousRSS_tags', $option_tags);
       update_option('deliciousRSS_display_numitems', $option_display_numitems);
       update_option('deliciousRSS_before', $option_before);
       update_option('deliciousRSS_after', $option_after);
       ?> <div class="updated"><p>Options changes saved.</p></div> <?php
     }
        ?>

        <div class="wrap">
                <h2>deliciousRSS Options</h2>
                <form method="post">

                <fieldset class="options">
                <table>
                 <tr>
                  <td><p><strong><label for="delicious_nsid">User ID</label>:</strong></p></td>
              <td><input name="delicious_nsid" type="text" id="delicious_nsid" value="<?php echo get_option('deliciousRSS_userid'); ?>" size="20" /></p></td>
         </tr>
         <tr>
          <td><p><strong>Display # of items:</strong></p></td>
          <td>
                                        <input name="display_numitems" id="display_numitems" type="text" value="<?php echo htmlspecialchars(stripslashes(get_option('deliciousRSS_display_numitems')))?>">
           </td>
         </tr>
         <tr>
                  <td><p><strong><label for="tag">Tags:</strong></label></p></td>
          <td><input name="tags" type="text" id="tags" value="<?php echo get_option('deliciousRSS_tags'); ?>" size="40" /></p>
         </tr>
         <tr>
          <td><p><strong><label for="before_link">Before</label>/<label for="after_link">After</label>:</strong></p></td>
          <td><input name="before_link" type="text" id="before_link" value="<?php echo htmlspecialchars(stripslashes(get_option('deliciousRSS_before'))); ?>" size="10" /> /
                  <input name="after_link" type="text" id="after_link" value="<?php echo htmlspecialchars(stripslashes(get_option('deliciousRSS_after'))); ?>" size="10" /> <em> e.g. &lt;li&gt;&lt;/li&gt;, &lt;p&gt;&lt;/p&gt;</em></p>
          </td>
         </tr>


         </table>
        </fieldset>
                <p><div class="submit"><input type="submit" name="update_deliciousRSS" value="<?php _e('Update deliciousRSS', 'update_deliciousRSS') ?>"  style="font-weight:bold;" /></div></p>
        </form>
    </div>
    </div>


<?php } // end deliciousRSS_subpanel()

function fR_admin_menu() {
   if (function_exists('add_options_page')) {
        add_options_page('deliciousRSS Options Page', 'deliciousRSS', 8, basename(__FILE__), 'deliciousRSS_subpanel');
        }
}

add_action('admin_menu', 'fR_admin_menu');
add_action('plugins_loaded', 'widget_deliciousRSS_init');
?>