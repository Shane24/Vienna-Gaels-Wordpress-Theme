# Vienna Gaels Website - Complete User Documentation

**Last Updated:** January 2025  
**For:** Committee Members & Content Editors  
**WordPress Version:** 6.4+

This comprehensive guide will help you manage and update the Vienna Gaels website.

---

## Table of Contents

1. [Getting Started](#getting-started)
2. [Managing Events](#managing-events)
3. [Editing Homepage Content](#editing-homepage-content)
4. [Managing Team Pages](#managing-team-pages)
5. [Publishing News Articles](#publishing-news-articles)
6. [Managing Navigation Menus](#managing-navigation-menus)
7. [Updating Images & Media](#updating-images--media)
8. [Managing Pages](#managing-pages)
9. [Common Tasks](#common-tasks)
10. [Troubleshooting](#troubleshooting)

---

## Getting Started

### Logging In

1. Navigate to: `https://yoursite.com/wp-admin`
2. Enter your username and password
3. Click **"Log In"**

**Forgot your password?**
- Click "Lost your password?" on the login screen
- Enter your email address
- Check your email for reset link

### WordPress Dashboard Overview

After logging in, you'll see the WordPress Dashboard with a menu on the left side:

- **Dashboard** - Overview and quick stats
- **Posts** - News articles and blog posts
- **Events** - Manage training, matches, and social events
- **Pages** - Team pages, contact page, membership page
- **Appearance** - Customize colors, menus, and homepage settings
- **Users** - Manage committee member accounts

---

## Managing Events

Events appear on the homepage and the Events page. They include training sessions, matches, and social gatherings.

### Adding a New Event

1. Click **Events → Add New** in the left menu
2. **Enter Event Title**
   - Example: "Football Training" or "Central European Championship"

3. **Add Event Description** (optional)
   - Use the main editor to add details about the event
   - Example: "Weekly football training session. All levels welcome."

4. **Fill in Event Details** (scroll down to "Event Details" box):

   **Start Date:** (Required)
   - Click the date field and select the date
   - Format: YYYY-MM-DD

   **End Date:** (Optional)
   - Leave empty for single-day events
   - Add end date for multi-day tournaments

   **Start Time:** (Required)
   - Format: 24-hour time (e.g., 19:00)

   **End Time:** (Optional)
   - Leave empty if not applicable
   - Example: 21:00 for a 19:00-21:00 training session

   **Location:**
   - Full address or venue name
   - Example: "Hauptallee, 1020 Vienna" or "Prater"

   **Type:**
   - Select from dropdown:
     - **Training** - Regular training sessions
     - **Match Day** - Competitive matches
     - **Social** - Social events, gatherings

   **Spond Event URL:** (Optional)
   - If you create the event in Spond first, paste the Spond link here
   - Example: `https://spond.com/client/sponds/ABC123/events/XYZ789`
   - This makes the "View Event on Spond" button work

5. **Add Featured Image** (optional)
   - Click "Set featured image" in the right sidebar
   - Upload or select an image
   - Recommended size: 800x600px

6. Click **"Publish"** to make it live

### Editing an Existing Event

1. Go to **Events → All Events**
2. Hover over the event title
3. Click **"Edit"**
4. Make your changes
5. Click **"Update"**

### Deleting an Event

1. Go to **Events → All Events**
2. Hover over the event
3. Click **"Trash"**
4. To permanently delete: Click **"Trash"** at the top, then **"Delete Permanently"**

### Event Display Tips

- Events on the homepage show the **3 most recent upcoming events**
- Events are automatically sorted by start date
- Past events won't show on the homepage (but remain in the archive)

---

## Editing Homepage Content

The homepage has several editable sections that you can customize without touching code.

### Editing Hero Section (Top Banner)

1. Go to **Appearance → Customize**
2. Click **"Homepage Hero"**
3. You can edit:

   **Hero Image:**
   - Click "Select image" to upload or choose an image
   - Recommended size: 1200x1500px (portrait)
   - Shows on the right side of the homepage

   **Hero Headline:**
   - Default: "Experience the Heart of Ireland in Vienna."
   - Change the main headline text

   **Hero Description:**
   - The paragraph below the headline
   - Keep it to 2-3 sentences

   **Primary Button Text:**
   - Default: "Start Your Journey"
   - This is the green button

   **Primary Button URL:**
   - Where the green button links to
   - Examples:
     - `/membership` - Links to membership page
     - `/contact` - Links to contact page
     - `https://spond.com/...` - External link

   **Secondary Button Text:**
   - Default: "View Teams"
   - This is the outline button

   **Secondary Button URL:**
   - Where the outline button links to
   - Use `#teams` to scroll to teams section on same page

4. Click **"Publish"** to save changes

### Editing Header Button (Top Right)

The "Join Us" button in the top right corner is also customizable:

1. Go to **Appearance → Customize**
2. Click **"Header CTA Button"**
3. You can edit:

   **Show Header Button:**
   - Check to show the button
   - Uncheck to hide it completely

   **Button Text:**
   - Default: "Join Us"
   - Change to anything you want

   **Button URL:**
   - Where the button links to
   - Default: `/membership`

4. Click **"Publish"**

**Note:** This button only appears on large desktop screens (1280px+)

---

## Managing Team Pages

Each sport (Football, Hurling, Handball, Camogie) has its own page.

### Creating/Editing a Team Page

1. Go to **Pages → All Pages**
2. Find the team page (e.g., "Men's Football")
3. Click **"Edit"**

**Or create a new team page:**

1. Click **Pages → Add New**
2. **Important:** The page slug must match exactly:
   - `mens-football`
   - `ladies-football`
   - `hurling`
   - `camogie`
   - `handball`

### What to Include on Team Pages

**Typical content:**
- Training schedule (day, time, location)
- Team achievements
- Contact person for the team
- Current squad or roster
- Photos from matches/training

**Example:**
```
Our Men's Football team competes in the Central European Championship.

Training Schedule:
- Day: Tuesday
- Time: 19:00-21:00
- Location: Hauptallee, Prater

Contact: mensfooty@viennagaels.at

We welcome players of all levels!
```

### Adding a Featured Image

1. While editing the page, look for **"Featured Image"** in the right sidebar
2. Click **"Set featured image"**
3. Upload an action photo of the team
4. Recommended size: 800x1200px (portrait orientation)
5. This image will appear on the homepage team cards

---

## Publishing News Articles

News articles appear on the homepage (latest 3) and the blog page.

### Adding a News Article

1. Click **Posts → Add New**
2. **Enter Title**
   - Example: "Vienna Gaels Secure Victory in Munich"

3. **Write Content**
   - Use the editor to write your article
   - You can add:
     - **Headings** - Use Heading 2 for main sections
     - **Bold/Italic** - Highlight important text
     - **Lists** - Bullet points or numbered lists
     - **Images** - Click the + icon and add Image block
     - **Links** - Highlight text and click the link icon

4. **Add Featured Image**
   - Click "Set featured image" (right sidebar)
   - Upload a photo related to the article
   - Recommended size: 1200x800px (landscape)
   - This appears on the homepage and at the top of the article

5. **Select Category**
   - In the right sidebar under "Categories"
   - Create categories like:
     - Tournament
     - Training
     - Social
     - Club News
   - Check the appropriate category

6. **Add Tags** (optional)
   - Keywords like: "championship", "victory", "munich"
   - Helps readers find related articles

7. **Set Publish Date**
   - Default: Publishes immediately
   - To schedule: Click "Publish" dropdown → "Schedule"

8. Click **"Publish"**

### Editing a News Article

1. Go to **Posts → All Posts**
2. Find your article
3. Click **"Edit"**
4. Make changes
5. Click **"Update"**

---

## Managing Navigation Menus

The main menu appears at the top of the site.

### Editing the Main Menu

1. Go to **Appearance → Menus**
2. Select **"Primary Menu"** from the dropdown (if you have multiple menus)

### Adding a Menu Item

1. On the left side, you'll see sections:
   - Pages
   - Posts
   - Custom Links
   - Events

2. **To add a page:**
   - Check the box next to the page name
   - Click "Add to Menu"

3. **To add a custom link:**
   - Click "Custom Links"
   - Enter URL and Link Text
   - Click "Add to Menu"

4. **Drag and drop** menu items to reorder them

5. Click **"Save Menu"**

### Creating Dropdown Menus

To create a submenu (like Teams with Football, Hurling underneath):

1. Add all items to your menu first
2. **Drag** the child item slightly to the RIGHT under the parent
3. It will indent, showing it's now a sub-item

**Example structure:**
```
Home
Teams (parent)
    Men's Football (child)
    Ladies Football (child)
    Hurling (child)
    Camogie (child)
    Handball (child)
About
Contact
```

4. Click **"Save Menu"**

### Desktop vs Mobile Behavior

- **Desktop:** Hover over "Teams" to see dropdown
- **Mobile:** Tap the arrow (▼) next to "Teams" to expand

---

## Updating Images & Media

### Uploading Images

1. Go to **Media → Library**
2. Click **"Add New"**
3. Drag and drop images or click **"Select Files"**
4. Wait for upload to complete

### Image Size Recommendations

- **Homepage Hero:** 1200x1500px (portrait)
- **Team Cards:** 800x1200px (portrait)
- **News Featured Images:** 1200x800px (landscape)
- **Event Images:** 800x600px (landscape)

### Image Best Practices

- **Use JPG** for photos
- **Use PNG** for logos with transparency
- **Compress images** before uploading (use tinypng.com)
- **Keep files under 500KB** for faster loading
- **Use descriptive filenames:** `mens-football-training.jpg` not `IMG_1234.jpg`

### Replacing an Image

**For featured images:**
1. Edit the post/page/event
2. Click "Remove featured image"
3. Click "Set featured image"
4. Select new image

**For the hero image:**
1. Go to **Appearance → Customize → Homepage Hero**
2. Click "Change Image"
3. Select new image

### Adding Alt Text (Important for Accessibility)

1. Click on an image in the Media Library
2. Find "Alt Text" field on the right
3. Enter a description: "Men's football team celebrating after victory"
4. Click **"Update"**

---

## Managing Pages

Pages are different from Posts - they're for permanent content like "About Us", "Contact", "Membership".

### Creating a New Page

1. Go to **Pages → Add New**
2. Enter page title
3. Add content using the editor
4. **Page Template:** Some pages have special templates:
   - Contact Page
   - Membership Page
   - Default Template

5. To use a template:
   - Look for "Template" dropdown in right sidebar
   - Select the template
   - The page will use that design

6. Click **"Publish"**

### Editing Existing Pages

1. Go to **Pages → All Pages**
2. Click **"Edit"** on the page you want to change
3. Make changes
4. Click **"Update"**

### Setting a Page as Homepage

1. Go to **Settings → Reading**
2. Under "Your homepage displays":
   - Select "A static page"
   - Choose your homepage from the dropdown
3. Click **"Save Changes"**

---

## Common Tasks

### Quick Reference Guide

#### Task: Add an Event
**Steps:** Events → Add New → Fill in details → Publish

#### Task: Edit Homepage Button
**Steps:** Appearance → Customize → Homepage Hero → Edit button text/URL → Publish

#### Task: Add News Article
**Steps:** Posts → Add New → Write article → Add featured image → Publish

#### Task: Change Menu Items
**Steps:** Appearance → Menus → Add/Remove items → Save Menu

#### Task: Update Team Page
**Steps:** Pages → Find team page → Edit → Update content → Update

#### Task: Upload Logo
**Steps:** Appearance → Customize → Site Identity → Select Logo → Publish

#### Task: Hide Header Button
**Steps:** Appearance → Customize → Header CTA Button → Uncheck "Show Header Button" → Publish

---

## Troubleshooting

### "I can't find the Customize option"

**Solution:** Make sure you're logged in and have Administrator or Editor permissions.

### "My changes aren't showing on the website"

**Solutions:**
1. Make sure you clicked **"Publish"** or **"Update"**
2. **Hard refresh** your browser: Ctrl+Shift+R (Windows) or Cmd+Shift+R (Mac)
3. Check if you're viewing a cached version - try in incognito/private mode

### "I uploaded an image but it looks blurry"

**Solution:** Your image might be too small. Use the recommended sizes from the "Image Size Recommendations" section.

### "The menu dropdown isn't working"

**Solution:** 
1. Make sure items are properly indented in Appearance → Menus
2. Child items should be dragged slightly to the right under the parent
3. Click "Save Menu" after making changes

### "Events aren't showing on the homepage"

**Solutions:**
1. Make sure the event has a **Start Date** in the future
2. Check that the event is **Published** (not Draft)
3. Only the 3 most recent upcoming events show on homepage

### "I accidentally deleted something important"

**Solution:**
1. Go to **Posts/Pages/Events**
2. Click **"Trash"** at the top
3. Find the item and click **"Restore"**

### "I need to give someone access to edit the website"

**Solution:**
1. Go to **Users → Add New**
2. Enter their email, username, and password
3. **Role:** 
   - **Editor** - Can publish and manage posts, pages, events (Recommended for committee)
   - **Administrator** - Full access to everything (Be careful with this!)
4. Click **"Add New User"**
5. They'll receive an email with login details

### "The website is completely broken"

**Emergency Contacts:**
1. Contact the web developer who set up the theme
2. Have your hosting provider login details ready
3. Don't panic - WordPress has automatic backups

---

## Getting Help

### Built-in WordPress Help

Click the **"Help"** tab in the top-right corner of any WordPress admin screen for context-specific help.

### Support Resources

- **WordPress Beginner's Guide:** https://wordpress.org/support/article/first-steps-with-wordpress/
- **YouTube Tutorials:** Search "WordPress for beginners"
- **Committee Slack/Email:** Ask other committee members who have used the site

### Contact Developer

For theme-specific issues or custom modifications, contact:
- GitHub Repository: [Your repo link]
- Email: [Your contact email]

---

## Best Practices

### Content Guidelines

- **Write clearly** - Keep sentences short and simple
- **Use headings** - Break up long text with Heading 2 and Heading 3
- **Add images** - Articles with images get more engagement
- **Proofread** - Check spelling and grammar before publishing
- **Mobile-friendly** - Most visitors use phones - keep paragraphs short

### Regular Maintenance Tasks

**Weekly:**
- Add upcoming events for next 2-3 weeks
- Publish news articles about recent matches/events
- Check that all events have correct dates/times

**Monthly:**
- Review and delete old events (keep archive clean)
- Update team pages with new achievements
- Check that all links still work

**Quarterly:**
- Review menu structure
- Update team photos
- Archive old news articles

### Security Tips

- **Use strong passwords** - Mix of letters, numbers, symbols
- **Don't share login details** - Give each person their own account
- **Log out when done** - Especially on shared computers
- **Keep WordPress updated** - Install updates when prompted

---

## Appendix: Event Types Reference

### Training
- Regular weekly training sessions
- Practice matches
- Skills workshops

### Match Day
- Competitive fixtures
- Tournaments
- Championships

### Social
- Club dinners
- Fundraisers
- Social gatherings
- AGM meetings

---

**Document Version:** 1.0  
**Last Updated:** January 2025  
**Maintained by:** Vienna Gaels Web Team

For suggestions or corrections to this documentation, please submit an issue on GitHub or contact the web team.