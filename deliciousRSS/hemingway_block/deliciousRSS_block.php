<h2>Delicious links</h2>
<?php if ( (function_exists('get_deliciousRSS')) ) { ?>
                <?php  get_deliciousRSS();
                ?>
                <p><a href="http://del.icio.us/rogersm/papers+toread" class="flickrlink"><span>View to read</span></a></p>
<?php } else { ?>

                <p>If you have a del.icio.us account, you can display your links here using the <a href="http://code.google.com/p/wordpress-delicious-rss/">deliciousRSS</a> plugin.</p>

                <p>If you have already downloaded the deliciousRSS plugin, but are getting this message, <a href="<?php echo get_settings('home'); ?>/wp-admin/plugins.php">click here to make sure that the plugin is activated</a>.</p>

                <p>If you do not have a del.icio.us account you can:
                        <ul>
                                <li>Create a del.icio.us account at <a href="https://secure.del.icio.us/register">del.icio.us</a>.</li>
                                <li>Remove this block.</li>
                        </ul>
                </p>

<?php } ?>
<?php
/*
         Props to http://freshnecessity.net/
*/
?>