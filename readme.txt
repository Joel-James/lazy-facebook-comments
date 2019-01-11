=== Lazy FB Comments ===
Contributors: joelcj91,duckdev
Tags: facebook comments, lazy laod, lazy comments, lazy fb comment, fb comments, facebook lazy comments, lazy load fb
Donate link: https://www.paypal.me/JoelCJ
Requires at least: 3.0
Tested up to: 5.0
Stable tag: 2.0.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Facebook Comments for WordPress with lazy loading feature. Load FB comments after button click or scroll down.

== Description ==

Use Facebook comments system in your website without slowing down your website. This plugin add an extra feature to lazy load Facebook comments after clicking a button or scrolling down.

Simple plugin to add Facebook Comments to your website easily. It works perfectly with latest version of WordPress.


> #### Lazy FB Comments - Features
>
> - Add most popular Facebook commenting system in your website.<br />
> - **Lazy Load Facebook scripts and comments only after clicking a button or scrolling down.**<br />
> - **Translation ready!**<br />
> - Adjust number of comments, color scheme, language, width, sorting order etc..<br />
> - Facebook comments increases your audience.<br />
> - Customize button label.<br />
> - **Super Light weight.**<br />
> - Completely free to use with lifetime updates.<br />
> - **Developer friendly.**<br />
> - Follows best WordPress coding standards.<br />
> - Of course, available in [GitHub](https://github.com/joel-james/lazy-facebook-comments/)<br />
>
> [Installation](https://wordpress.org/plugins/lazy-facebook-comments/installation/) | [Screenshots](https://wordpress.org/plugins/lazy-facebook-comments/screenshots/)


**Bug Reports**

Bug reports are always welcome. [Report here](https://duckdev.com/support/).

**More information**

- Follow the developer [@Twitter](https://twitter.com/Joel_James)
- Other [WordPress plugins](https://profiles.wordpress.org/joelcj91/#content-plugins) by Joel James for [Duck Dev](https://duckdev.com)

**Other Requirements**

You need to create an APP in your Facebook developer console, and get the APP ID from [here](https://developers.facebook.com/apps/).


== Installation ==


= Installing the plugin - Simple =
1. In your WordPress admin panel, go to *Plugins > New Plugin*, search for **Lazy FB Comments** and click "*Install now*"
2. Alternatively, download the plugin and upload the contents of `lazy-facebook-comments.zip` to your plugins directory, which usually is `/wp-content/plugins/`.
3. Activate the plugin
4. Go to Lazy FB Comments sub settings page under WordPress Settings page.
5. Give your facebook app ID.
6. Configure the plugin options with available settings.

OR, See detailed doc, [how to install a WordPress plugin](https://codex.wordpress.org/Managing_Plugins#Installing_Plugins).


= Need more help? =
Please [open a support request](http://wordpress.org/support/plugin/lazy-facebook-comments/).

= Missing something? =
If you would like to have an additional feature for this plugin, [let me know](http://duckdev.com/support/)

== Frequently Asked Questions ==

= Why this plugin? =

Normal Facebook comments plugins will drag your website speed down. This plugin won't.

= Wait, how? =

By lazy loading FB scripts and comments only when needed.

= Please explain, how this plugin lazy loads? =

Comments and scripts will be loaded only after user clicking on a "Load Comments" (of course you can customize this button text too) button, or after scrolling down. You select any of these lazy load methods.

= How can I add custom post type support? =

It's easy. You can use `lfc_supported_post_types` filter to add custom post type support. Add following line to your theme's functions.php or in your custom plugin.


`
add_filter( 'lfc_supported_post_types', 'mycustom_add_lfc_cpt_support' );

function mycustom_add_lfc_cpt_support( $post_types ) {
    // Here mycpt is your custom post type name.
    $post_types[] = 'mycpt';

    return $post_types;
}
`
= Where can I moderate the comments? =

Once you configure the plugin with APP ID, you will find the moderation page link on the plugin settings page.

== Other Notes ==

= Bug Reports =

Bug reports are always welcome. [Report here](https://duckdev.com/support/).


== Screenshots ==

1. **Settings** - Settings page.
2. **Lazy Load Button** - (If you set scroll method, no button will be added).
3. **Facebook Comments** - Sample of comments box.


== Changelog ==

= 2.0.4 (11/01/2019) =

- 📦 Added comment moderation link.

= 2.0.3 (11/09/2018) =

- 📦 New filter (lfc_supported_post_types) to add custom post support.
- 🐛 Fixed cpt support.

= 2.0.2 (08/03/2018) =

- Tested with WP 4.9
- Plugin name change.

= 2.0.1 (21/08/2016) =
**New Feature**

- On Scroll lazy load method.
- Ability to work with other FB plugins.

**Improvements**

- Complete revamp of plugin code.
- Tested with WordPress 4.6.
- Improved performance.

= 1.0.2 =
* Bug fix

= 1.0.1 =
* Added official support forum

= 1.0.0 =
* Added first version

== Upgrade Notice ==

= 2.0.4 (11/01/2019) =

- 📦 Added comment moderation link.
