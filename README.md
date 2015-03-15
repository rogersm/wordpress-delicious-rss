 <title>flickrRSS Plugin Readme</title>

# deliciousRSS Plugin Readme

This plugin for WordPress allows you to display del.icio.us RSS feeds on your weblog. It's easy to setup and configure via an options panel.

## Installation

1.  Unzip the package in your plugins directory (wp-content/plugins/). Keep the name of the zip file.
2.  Activate the plugin
3.  Configure your settings via the panel in Options &rarr; deliciousRSS
4.  Add `<?php get_deliciousrss(); ?>` somewhere in your templates

## Advanced

The plugin also supports a number of parameters, allowing you to have multiple instances across your site.

1.  `$userid` - specify a del.icio.us user id r
2.  `$num_items` - how many links you want to appear
3.  `$tags` - a comma separated list of tags_papers, toread_
4.  `$before_link` - html appearing before each photo
5.  `$after_link` - html appearing after each photo

### Example 1

`<?php get_deliciousrss( "rogersm", 5, "ai, development" ); ?>`<p>
<p>This would show the 5 most recent links for the rogersm user tagged with ai and development.

### Example 2

`<?php get_deliciousrss( "rogersm", 10, "blogs", "» ", "<br/>"); ?>`

This would show the 10 most recent urls from the blogs category of user rogersm adding &raquo; in front of them and a break at the end.

## Hemingway theme support

With the plugin is included a file delicious_rss.php for integrating the plugin with [Hemingway's'](http://warpspire.com/hemingway/) Bottombar. Drop it in wp-content/themes/hemingway/blocks/ and activate it in Presentation &rarr; Hemingway Options.

## Feedback and Support

Visit the [Delicious RSS page](http://rogersm.net/wp/deliciousrss/) for help getting the plugin working. I'll do my best to respond, but sometimes I'm slow.

If you're having huge issues, you can try contacting me directly.

* * *

### Plugin History

**Latest Release:** January 7, 2008

*   1.0 - Initial release for Wordpress 2.3.x
*   1.0 - Same code working for Wordpress 4.1.1
