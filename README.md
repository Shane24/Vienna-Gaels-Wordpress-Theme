# Vienna Gaels GAA WordPress Theme

A modern, responsive WordPress theme built for the Vienna Gaels Gaelic Athletic Association club. Features a clean design with Tailwind CSS and custom post types for events management.

![Vienna Gaels](screenshot.png)

## Features

- 🎨 Modern design with Tailwind CSS
- 📱 Fully responsive (mobile, tablet, desktop)
- 🌙 Dark mode support
- 📅 Custom Events post type with filtering
- 👥 Team pages with featured images
- 📝 Contact form with AJAX submission
- 💳 Membership page with pricing tiers
- 🎯 Optimized for GAA sports clubs
- ♿ Accessible and SEO-friendly

## Installation

1. Download the theme files
2. Upload to `wp-content/themes/vienna-gaels/`
3. Activate the theme in WordPress Admin → Appearance → Themes
4. Go to Settings → Permalinks and click "Save Changes" to flush rewrite rules

## Required Setup

### 1. Create Menus
- Go to **Appearance → Menus**
- Create a "Primary Menu" and assign to "Primary Menu" location
- Create a "Footer Menu" and assign to "Footer Menu" location

### 2. Create Pages
Create these pages with the following slugs:
- **Home** (set as static front page in Settings → Reading)
- **Contact** (use "Contact Page" template)
- **Membership** (use "Membership Page" template)
- **Men's Football** (slug: `mens-football`)
- **Ladies Football** (slug: `ladies-football`)
- **Hurling** (slug: `hurling`)
- **Camogie** (slug: `camogie`)

### 3. Upload Logo
- Go to **Appearance → Customize → Site Identity**
- Upload your club logo (recommended: 300x300px)

### 4. Set Hero Image
- Go to **Appearance → Customize → Homepage Hero**
- Upload hero image (recommended: 1200x1500px)

## Custom Post Types

### Events
Add training sessions, matches, and social events:
- Go to **Events → Add New**
- Fill in event details (date, time, location, type)
- Events appear on homepage and events archive page
- Filterable by type (Training, Match, Social)

## Page Templates

- **Default Template** - Standard page layout
- **Contact Page** - Contact form with contact information cards
- **Membership Page** - Pricing tiers with FAQ section

## Customization

### Colors
Edit in `functions.php` → `vienna_gaels_tailwind_head()`:
```php
colors: {
    "primary": "#008040",        // Main green
    "vienna-gold": "#DDBB5C",    // Accent gold
}
```

### Fonts
Theme uses **Lexend** font family. Change in Tailwind config if needed.

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Dependencies

- WordPress 5.0+
- PHP 7.4+
- Tailwind CSS (loaded via CDN)
- Google Fonts (Lexend, Material Symbols)

## File Structure

```
vienna-gaels/
├── style.css                 # Theme header & base styles
├── functions.php             # Theme functions & custom post types
├── index.php                 # Blog archive
├── front-page.php           # Homepage template
├── header.php               # Header & navigation
├── footer.php               # Footer
├── single.php               # Single blog post
├── single-events.php        # Single event
├── page.php                 # Default page
├── page-contact.php         # Contact page template
├── page-membership.php      # Membership page template
├── archive-events.php       # Events archive
├── 404.php                  # Error page
├── screenshot.png           # Theme screenshot
└── assets/
    ├── css/
    │   └── custom.css       # Additional styles
    └── js/
        └── scripts.js       # JavaScript functions
```

## Support

For issues or questions about this theme:
- Open an issue on GitHub
- Contact: secretary.vienna.europe@gaa.ie

## Credits

- Built for [Vienna Gaels GAA](https://gaavienna.at)
- Tailwind CSS - https://tailwindcss.com
- Google Fonts - https://fonts.google.com
- Material Symbols - https://fonts.google.com/icons

## License

This theme is licensed under the GNU General Public License v2 or later.

---

**Version:** 1.0  
**Author:** Vienna Gaels  
**Requires WordPress:** 5.0+  
**Tested up to:** 6.4  
**License:** GPLv2 or later