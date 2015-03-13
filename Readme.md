# deliciousRSS Plugin Readme #

This plugin for WordPress allows you to display del.icio.us RSS feeds on your weblog. It's easy to setup and configure via an options panel.

## Installation ##

  1. Unzip the package in your plugins directory (wp-content/plugins/). Keep the name of the zip file.
  1. Activate the plugin
  1. Configure your settings via the panel in Options → deliciousRSS
  1. Add <?php get\_deliciousrss(); ?> somewhere in your templates

## Advanced ##

The plugin also supports a number of parameters, allowing you to have multiple instances across your site.

  1. $userid - specify a del.icio.us user id r
  1. $num\_items - how many links you want to appear
  1. $tags - a comma separated list of tagspapers, toread
  1. $before\_link - html appearing before each photo
  1. $after\_link - html appearing after each photo

### Example 1 ###
```
<?php get_deliciousrss( "rogersm", 5, "ai, development" ); ?>
```
This would show the 5 most recent links for the rogersm user tagged with ai and development.

### Example 2 ###
```
<?php get_deliciousrss( "rogersm", 10, "blogs", "» ", "<br/>"); ?>
```
This would show the 10 most recent urls from the blogs category of user rogersm adding » in front of them and a break at the end.

## Hemingway theme support ##

With the plugin is included a file delicious\_rss.php for integrating the plugin with [Hemingway's](http://warpspire.com/hemingway/)' Bottombar. Drop it in wp-content/themes/hemingway/blocks/ and activate it in Presentation → Hemingway Options.

## Feedback and Support ##

Reread this page for help getting the plugin working. I'll do my best to respond, but sometimes I'm slow.

If you're having huge issues, you can try contacting me directly to roger.sen@gmail.com