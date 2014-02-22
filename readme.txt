=== Kento Post View Counter ===
Contributors: hasanrang05
Donate link: 
Tags:  Kento Post View Counter, post view by city, post view by country, page view counter, view counter, Post View Counter
Requires at least: 3.7
Tested up to: 3.8.1
Stable tag: 2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Post View Counter by City or Country or by Date.

== Description ==

Real post view counter for wordpress post, page or custome post type

Plugin details and support:<br />
http://kentothemes.com/items/plugins/kento-post-view-counter/





Plugin Features

* Reefer site hit count(New).
* Display Post View Counter to your Language(New).
* Top 10 City List by visitors.(New)
* Top 10 Country list by visitors.(New)
* Top 10 reefer site list.
* Display via shortcodes only today's count or total count or both(New)
* refer site list where visitors come from(new).
* Filter post type to trace count(new).
* hide stats on content but still can trace view count(new).
* Total Post View Count.
* Total Post View Count Daily.
* Top Viewed Post List on Admin.
* Top Viewed By Date on Admin.
* Recent Viewed by City on Admin.
* Recent Viewed Post by City with real time and date.



== Installation ==


1. Install as regular WordPress plugin.
2. Go your Pluings setting via WordPress Dashboard and activate it.
3. After Activate Visit your Single Post.
4. and after activate you will see menu on dashboard "Kento PVC" will get stats.
<br /><br />

<strong>How to use shortcodes ?</strong><br />
To display views count manually via shortcodes you can display only today's view count or total view count on single post.
Before use shotcodes you need to <strong>"Hide Count on Post"</strong> checked and <strong>"Trace These Post Type Only"</strong> checked for custom post type<br /><br />

And use these shortcode as your need<br />

<strong>Display whithout customize</strong><br />
`[kpvc_single]` <br />
`<?php echo do_shortcode("[kpvc_single]"); ?>` Anywhere on single.php or custom post type single.php
Also same way you can php code for bellow shortcodes<br />
<strong>Display only today views count or hide total views count.</strong><br />
`[kpvc_single total="no"]`<br />

<strong>Display only total views count or hide today views count.</strong><br />
`[kpvc_single today="no"]`<br />

<strong>Display Custom text for today or total views count</strong><br />
Go "Kento Post View Counter Settings" page and add text for "Text For Today View" and "Text For Total View" and save.



<br />

<strong>How to use shortcodes in loop or excerpt mode ?</strong><br />
To display views count manually via shortcodes in loop or excerpt mode you can use shortcode bellow<br />

N.B. We have removed custom text adding feature via shortcode you can do same this by saving custom text via "Kento Post View Counter Settings" page

<strong>Display whitout customize</strong><br />
`<?php do_shortcode('[kpvc_loop post_id='.get_the_ID().']'); ?>`

<strong>Display only total views count or hide today views count.</strong><br />
`<?php do_shortcode('[kpvc_loop post_id='.get_the_ID().' today="no" ] '); ?>`<br />
same way you can hide total count by adding today="no"<br />

<strong>Display Custom text for today or total views count</strong><br />
`<?php do_shortcode('[kpvc_loop post_id='.get_the_ID().' ] '); ?>`<br />

<br />
<strong>Display post view counter number to your language</strong><br />
You can display post view counter to your language, please go "Kento Post View Counter Settings" page and <strong>"Numbers Language"</strong> box fill numbers as following 0,1,2,3,4,5,6,7,8,9

Like for Bangle: ০,১,২,৩,৪,৫,৬,৭,৮,৯
or for Arabic/Persian: ۰,۱,۲,۳,۴,۵,۶,۷,۸,۹

** Please do not change the numbers orders otherwise it will wrong result for post view counter. 

== Screenshots ==

1. View Counter on post.
2. Admin - Top viewed post and Top Viewed By Date.
3. Admin - Recent Viewed by City and Recent Viewed Post by City with time.
4. Settings page.
5. Top 10 City And Country List.
6. Top 10 Referrer site list.



== Changelog ==

= 2.0 =
* Reefer site hit count.
* Top 10 Reefer site list by Date.
* Problem fix rank count start from 0 to 1.

= 1.9 =
* Fix WP_DEBUG Error.
* Added Top 10 City on Stats Page.
* Custom text for total and today view count via setting page.
* Removed custom text via shortcodes.
* Display Post View Count to your Language. 

= 1.8 =
* Added Top 10 Country on Stats Page.

= 1.7 =
* Display Post view Counter on loop or excerpt mode.

= 1.6 =
* Add Top 10 refer site list.

= 1.5 =
* Add Shortcode support to display single post.

= 1.4 =
* Added refer site to details report.
* Added send us feedback link.

= 1.3 =
* Added icon for total and daily counter.
* Added New Page for setting.
* Filter post type.
* Simply hid on post stats but still can trcae.
* Added different stats page on admin.

= 1.2 =
* Fixing problem with Pagination

= 1.1 =
* Added Paginate "Recent Viewed By City & Country

= 1.0 =
* Initial release

