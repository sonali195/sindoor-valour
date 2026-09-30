=== Sindoor Valour ===

Contributors: sonaliprajapati
Requires at least: 6.0
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.2.3
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: blog, news, education, one-column, two-columns, right-sidebar, custom-background, custom-header, custom-logo, custom-menu, editor-style, featured-images, footer-widgets, full-width-template, rtl-language-support, sticky-post, theme-options, threaded-comments, translation-ready, block-styles, wide-blocks

A dignified, accessible theme for veterans welfare trusts and armed-forces family support NGOs.

== Description ==

Sindoor Valour is built for the organisations that look after service families: regimental
benevolent funds, veterans welfare trusts, war-widow support societies and ex-servicemen
associations. It is shaped around what those organisations actually publish — welfare
programmes, an events calendar, notices, appeals and updates — rather than around a generic
business layout.

The palette is olive and sindoor red on a sand ground, chosen to read as sober rather than
celebratory. Typography is a serif for headings and the system UI stack for body text, so
nothing is downloaded from a third-party font service and Devanagari and Gujarati text render
in the reader's own system faces.

= What is included =

* A sectioned front page: hero, impact figures, programmes, events, donation call to action
  and latest updates. Every section can be switched off, and a section with nothing to show
  removes itself rather than rendering an empty band.
* Display support for Programmes (`sv-programme`) and Events (`sv-event`) post types when a
  site registers them. The theme itself registers no post types; without them the
  programmes and events sections simply stay hidden.
* Two page templates: Full Width, and a Donation Page that ends with the call to action.
* Three footer widget columns and a main sidebar.
* Primary, footer and social menus, with accessible sub-menu toggles.
* A print stylesheet, so notices and appeals print cleanly without the site chrome.
* Right-to-left support.
* Starter content, so a new site is set up from the Customizer in one click, and a short
  getting-started checklist under Appearance > Theme Setup.
* Seven block style variations and four block patterns, filed under their own category in
  the inserter.

= Accessibility =

The theme is built to the accessibility-ready requirements, but the tag is not
claimed in style.css: that tag is only granted after a manual review by the
WordPress accessibility team.


* A skip link to the main content, visible on focus.
* Every interactive element has a visible focus outline that is never removed.
* Sub-menus open on hover, on keyboard focus and from an explicit toggle button carrying its
  own aria-expanded state; the markup is correct before any JavaScript runs.
* "Read more" links carry the title of the post they lead to, for anyone tabbing through a
  list of links out of context.
* Colour pairings in the default palette meet WCAG 2.1 AA contrast for body text.
* The prefers-reduced-motion setting is respected.

= A note on names and imagery =

This is an independent theme. It carries no government, ministry or armed-forces emblem,
crest, insignia or wordmark, and it is not affiliated with, endorsed by, or connected to any
such body. If you add a name, crest or photograph to a site built with it, make sure your
organisation actually holds the right to use it — regimental crests, unit insignia and
military photographs are usually restricted, and a welfare trust using one without permission
creates a real problem for itself. Nothing in the theme's default content names a real
person, unit or operation.

== Installation ==

1. In the admin, go to Appearance > Themes > Add New > Upload Theme.
2. Choose sindoor-valour.zip and click Install Now, then Activate.

= On a new site =

Open Appearance > Customize. WordPress shows the theme's starter content as a live preview:
five pages, three posts (plus four programmes and three dated events when those post types
are registered), a primary and footer menu,
sidebar and footer widgets, and the front page set to the new Home page. Look it over and
press Publish to keep it, or close the Customizer and nothing is saved.

= On a site that already has content =

WordPress only offers starter content on a site with nothing published. On an existing
install, follow the checklist under Appearance > Theme Setup, or the steps below.

= Setting it up by hand =

1. Go to Settings > Reading and set "Your homepage displays" to "A static page", then pick
   your home page. The sectioned front page only applies to a static front page.
2. Go to Appearance > Customize > Sindoor Valour Options to fill in the header contact
   details, hero, impact figures and donation call to action.
3. Create menus at Appearance > Menus and assign them to Primary, Footer and Social Links.

== Frequently Asked Questions ==

= The front page looks empty. What now? =

The sections only render when there is something to put in them, and they only render at all
when the front page is a static page. On a new site, open the Customizer and publish the
starter content. On an existing site, follow the checklist under Appearance > Theme Setup.
Both are described under Installation above.

= Does the theme take donations? =

No. The Donation Page template lays out your own content and ends with the call to action you
set in the Customizer. Payment is handled by whatever you put on that page — a payment
gateway plugin, your bank details, or a link to your existing donation portal. The theme never
asks a visitor for card details and stores nothing.

= Where do I change the colours? =

The palette is defined as CSS custom properties at the top of style.css (`--sv-olive`,
`--sv-sindoor`, `--sv-sand`). Change them there in a child theme and the whole theme follows,
including the block editor palette once you mirror the values in the editor palette.

= Why is the sidebar missing on my page? =

Pages, the front page, programme and event entries, and the two wide page templates are full-width by
design. The sidebar appears on posts, archives, search results and the blog page, and only
when the Main Sidebar widget area has something in it.

== Changelog ==

= 1.2.3 =
* The front page now has a proper main landmark, so screen-reader users can jump to it.
* Version numbers in readme.txt and the translation template now match style.css.

= 1.2.1 =
* Welcome notice now stays dismissed after a refresh (saved per user), with a "Dismiss permanently" link as a no-JavaScript fallback.
* Long post, page and card titles now wrap inside the content column instead of being clipped.
* Footer credit line is now a single-line text field (the theme uses three Customizer textareas).
* Theme URI now points to the theme's GitHub repository; Author URI points to the author's WordPress.org profile.
* Removed the demo-content importer; Appearance > Theme Setup is now a read-only checklist.
  Starter content is unchanged.
* Removed references to installing a companion plugin from a zip file.
* Removed the rewrite-rule flush on theme switch; the theme registers no rewrite rules.
* Header image on the hero is now escaped at the point of output.

= 1.2.0 =
* Moved the Programmes and Events content types out of the theme, as the theme
  requirements require. Existing posts are
  unaffected: the post type keys, the meta keys and the templates are all unchanged.
* The theme now degrades cleanly when that plugin is inactive — starter content and the demo
  importer skip the content types, and the two front-page sections stay hidden.
* Added seven block style variations and four block patterns.
* Counts are calculated before the _n() calls that use them, so the review tooling no longer
  misreads an array key as a second text domain.

= 1.1.0 =
* Added starter content: a new site is populated from the Customizer on activation, as a
  preview that is only kept if you press Publish.
* Added Appearance > Theme Setup, with a reversible demo-content importer for sites that
  already have content and so cannot use starter content.
* The donate buttons and the hero's secondary button now resolve their own targets from the
  Donation Page template and the programmes archive when no URL has been set.

= 1.0.0 =
* Initial release.

== Copyright ==

Sindoor Valour WordPress Theme, Copyright 2026 Sonali Prajapati.
Sindoor Valour is distributed under the terms of the GNU General Public License v2 or later.

This program is free software: you can redistribute it and/or modify it under the terms of
the GNU General Public License as published by the Free Software Foundation, either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See
the GNU General Public License for more details. The full text is bundled as LICENSE.

= Bundled resources =

The theme bundles no fonts, no images and no third-party libraries. Typography uses the
reader's own system fonts, and the only graphic in the package is screenshot.png, which was
produced for this theme and is released under the same GPL v2 or later licence.

Sindoor Valour is based on Underscores https://underscores.me/, (C) 2012-2020 Automattic,
Inc., licensed under the GNU General Public License v2 or later.

Normalising styles were informed by normalize.css https://necolas.github.io/normalize.css/,
(C) Nicolas Gallagher and Jonathan Neal, MIT licence.
