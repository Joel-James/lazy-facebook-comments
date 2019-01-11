<div class="wrap">
    <form method="post" action="options.php">
        <p>
        <?php settings_fields('lfc_options'); ?>
        <table class="form-table">
            <tbody>

                <tr>
                    <th><?php _e('FB Application ID', 'lazy-facebook-comments'); ?></th>
                    <td>
                        <input type="text" placeholder="1234567890" name="lfc_options[app_id]" value="<?php echo $options['app_id']; ?>" required>
                        <p class="description"><?php _e('Enter you facebook App ID that you get from', 'lazy-facebook-comments'); ?> <a href="https://developers.facebook.com/apps/" target="_blank"><?php _e('Facebook Developers', 'lazy-facebook-comments'); ?></a></p>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Comment Box Width (px)', 'lazy-facebook-comments'); ?></th>
                    <td>
                        <input type="number" min="350" placeholder="Default 100%" name="lfc_options[box_width]" value="<?php echo $options['box_width']; ?>">
                        <p class="description"><?php _e('Comments box width. Minimum is 350. Leave empty for responsive 100%.', 'lazy-facebook-comments'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Number of Comments', 'lazy-facebook-comments'); ?></th>
                    <td>
                        <input type="number" min="1" placeholder="10" name="lfc_options[comments_count]" value="<?php echo $options['comments_count']; ?>" required>
                        <p class="description"><?php _e('No. of comments to show by default', 'lazy-facebook-comments'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Sort Comments by', 'lazy-facebook-comments'); ?></th>
                    <td>
                        <select class="select" type="select" name="lfc_options[order_by]" required>
                            <option value="social" <?php selected( $options['order_by'], 'social' ); ?>>Social Ranking</option>
                            <option value="reverse_time" <?php selected( $options['order_by'], 'reverse_time' ); ?>>Oldest</option>
                            <option value="time" <?php selected( $options['order_by'], 'time' ); ?>>Newest</option>
			</select>
                        <p class="description"><?php _e('Comments will be sorted in this order. See more details', 'lazy-facebook-comments'); ?> <a href="https://developers.facebook.com/docs/plugins/comments#sorting" target="_blank"><?php _e('here', 'lazy-facebook-comments'); ?></a></p>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Color Scheme', 'lazy-facebook-comments'); ?></th>
                    <td>
                        <select class="select" type="select" name="lfc_options[color_scheme]" required>
                            <option value="light" <?php selected( $options['color_scheme'], 'light' ); ?>>Light</option>
                            <option value="dark" <?php selected( $options['color_scheme'], 'dark' ); ?>>Dark</option>
			</select>
                        <p class="description"><?php _e('Only these two color schemes are availble right now.', 'lazy-facebook-comments'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Language', 'lazy-facebook-comments'); ?></th>
                    <td>
                        <input type="text" placeholder="en_US" name="lfc_options[comments_lang]" value="<?php echo $options['comments_lang']; ?>" required>
                        <p class="description"><?php _e('Full list is available', 'lazy-facebook-comments'); ?> <a href="http://www.facebook.com/translations/FacebookLocales.xml" target="_blank"><?php _e('here', 'lazy-facebook-comments'); ?></a></p>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Load Comments', 'lazy-facebook-comments'); ?></th>
                    <td>
                        <select class="select" type="select" name="lfc_options[load_on]">
                            <option value="click" <?php selected( $options['load_on'], 'click' ); ?>>On Click</option>
                            <option value="scroll" <?php selected( $options['load_on'], 'scroll' ); ?>>On Scroll</option>
			</select>
                        <p class="description"><?php _e('Comments will be lazy loaded using this method.', 'lazy-facebook-comments'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Comments Div Class', 'lazy-facebook-comments'); ?></th>
                    <td>
                        <input type="text" placeholder="comments-area" name="lfc_options[div_class]" value="<?php echo $options['div_class']; ?>">
                        <p class="description"><?php _e('If you want to customize the comments area div using CSS, enter the div class here.', 'lazy-facebook-comments'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><?php _e('Button Text', 'lazy-facebook-comments'); ?></th>
                    <td>
                        <input type="text" placeholder="Load Comments" name="lfc_options[button_text]" value="<?php echo $options['button_text']; ?>" required>
                        <p class="description"><?php _e('Customize the button text, if you are using On Click method.', 'lazy-facebook-comments'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th colspan="2"><hr/></th>
                </tr>
                <tr>
                    <th colspan="2"><h3>Using Along With Other FB Plugins</h3></th>
                </tr>
                <tr>
                    <th><?php _e('Facebook SDK', 'lazy-facebook-comments'); ?></th>
                    <td>
                        <input type="radio" name="lfc_options[sdk_loaded]" <?php checked($options['sdk_loaded'], '0'); ?> value="0" required>Not Loaded
                        <input type="radio" name="lfc_options[sdk_loaded]" <?php checked($options['sdk_loaded'], '1'); ?> value="1">Already Loaded
                        <p class="description"><?php _e('If you are using any other facebook plugins, there is a chance that the FB sdk is already loaded. Please check "Already Loaded" if your comments are not working.', 'lazy-facebook-comments'); ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php submit_button(__('Save All Changes', 'lazy-facebook-comments')); ?>
        </p>
    </form>
</div>