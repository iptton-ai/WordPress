# Quick Start Guide - Taoism Culture Theme

## Immediate Steps to Get Started

### Step 1: Activate the Theme (2 minutes)
1. Go to WordPress Admin → **Appearance** → **Themes**
2. Find **"Taoism Culture"** theme
3. Click **"Activate"**

### Step 2: Ensure WooCommerce is Active (1 minute)
1. Go to **Plugins** → **Installed Plugins**
2. Find **WooCommerce** and ensure it's activated
3. If not installed, go to **Plugins** → **Add New** and search for "WooCommerce"

### Step 3: Generate Sample Content (2 minutes)
1. Open your browser and navigate to:
   ```
   https://your-domain.com/wp-content/themes/taoism-culture/sample-content.php
   ```
2. Wait for the script to complete (creates 6 articles + 6 products)
3. **Delete the file** after running for security:
   ```
   rm WordPress/wp-content/themes/taoism-culture/sample-content.php
   ```

### Step 4: Configure Basic Settings (5 minutes)

#### A. Create Navigation Menu
1. Go to **Appearance** → **Menus**
2. Create a new menu called "Primary Menu"
3. Add these items:
   - Home (link to homepage)
   - Culture (link to `/culture/`)
   - Shop (link to `/shop/`)
   - About Us (custom link)
4. Assign to **"Primary Menu"** location
5. Save Menu

#### B. Set Hero Section
1. Go to **Appearance** → **Customize**
2. Find **"Hero Section"**
3. Upload a hero background image (recommended: 1920x800px)
4. Set Hero Title: "The Way of Nature"
5. Set Hero Description: "Embrace the harmony of the natural world..."
6. Set Button Text: "Explore More"
7. Set Button Link: `/culture/`
8. Click **"Publish"**

#### C. Configure WooCommerce (if not done)
1. Go to **WooCommerce** → **Settings**
2. **General tab:**
   - Set your store location
   - Set currency (USD or CNY)
3. **Products tab:**
   - Shop page: Select or create "Shop" page
4. **Inventory tab:**
   - Enable stock management (optional)
5. Save changes

### Step 5: Verify Everything Works (3 minutes)

Visit these pages to check:
- ✅ Homepage: `https://your-domain.com/`
- ✅ Shop page: `https://your-domain.com/shop/`
- ✅ Culture archive: `https://your-domain.com/culture/`
- ✅ Sample product: Click any product from shop
- ✅ Sample article: Click any article from culture page
- ✅ Dark mode: Toggle the moon icon in header
- ✅ Mobile menu: Resize browser to mobile width

## Optional Enhancements

### Add a Logo (2 minutes)
1. Go to **Appearance** → **Customize** → **Site Identity**
2. Click **"Select Logo"**
3. Upload your logo (recommended: 400x100px PNG with transparency)
4. Click **"Publish"**

### Add Footer Widgets (5 minutes)
1. Go to **Appearance** → **Widgets**
2. Find **"Footer 1"**, **"Footer 2"**, **"Footer 3"**
3. Drag widgets into these areas (e.g., Recent Posts, Custom HTML with links)
4. Save changes

### Customize Colors (3 minutes)
Edit the theme colors in `style.css` (lines 24-33):
```css
--primary-gold: #b89b72;    /* Change homepage accent color */
--primary-green: #11d493;    /* Change shop page accent color */
```

### Add Real Product Images (ongoing)
1. Go to **Products** → **All Products**
2. Edit each product
3. Set Featured Image (800x800px recommended)
4. Add Gallery Images in Product Gallery section
5. Update product

### Create More Content (ongoing)
1. **Culture Articles:**
   - Go to **Culture Articles** → **Add New**
   - Add title, content, featured image
   - Set Author Title (道号) in the sidebar meta box
   - Select a category
   - Publish

2. **Products:**
   - Go to **Products** → **Add New**
   - Fill in product details
   - Set price, inventory, etc.
   - Select categories and attributes
   - Publish

## Troubleshooting

### Issue: Theme looks broken / no styles
**Solution:** Clear browser cache and WordPress cache
```
1. In browser: Ctrl+Shift+R (hard refresh)
2. In WordPress: Clear cache plugin if using one
3. Go to Settings → Permalinks and click "Save" (regenerates rules)
```

### Issue: WooCommerce categories not showing
**Solution:** They're created automatically, but you can manually verify
```
1. Go to Products → Categories
2. Check if categories exist (法器, 服饰, etc.)
3. If not, re-activate the theme
```

### Issue: Dark mode not working
**Solution:** Check if JavaScript is loading
```
1. Open browser console (F12)
2. Check for JavaScript errors
3. Try clearing browser cache
4. Ensure jQuery is loaded
```

### Issue: Products don't have filters
**Solution:** Products need attributes assigned
```
1. Edit each product
2. Go to "Attributes" section
3. Add "Material" and/or "Style" attributes
4. Save product
```

### Issue: Sample content script not working
**Solution:** Check file permissions and login status
```
1. Ensure you're logged in as Administrator
2. Check file exists at correct path
3. Check PHP error logs for details
```

## Quick Reference

### Key URLs
- Homepage: `/`
- Shop: `/shop/`
- Culture: `/culture/`
- Cart: `/cart/`
- Checkout: `/checkout/`
- My Account: `/my-account/`

### Key Files to Customize
- **Colors/Fonts:** `style.css`
- **Homepage Content:** `front-page.php`
- **Product Layout:** `woocommerce/archive-product.php`
- **Header/Nav:** `header.php`
- **Footer:** `footer.php`

### Admin Areas
- **Theme Options:** Appearance → Customize
- **Menus:** Appearance → Menus
- **Widgets:** Appearance → Widgets
- **Products:** Products → All Products
- **Culture Articles:** Culture Articles → All Culture Articles
- **WooCommerce Settings:** WooCommerce → Settings

## Support Resources

- **WordPress Codex:** https://codex.wordpress.org/
- **WooCommerce Docs:** https://woocommerce.com/documentation/
- **Theme README:** See `README.md` in theme folder
- **Full Implementation Details:** See `IMPLEMENTATION-SUMMARY.md`

## Next Steps

Once basic setup is complete:
1. ✅ Add real product images
2. ✅ Write authentic culture articles
3. ✅ Configure payment gateways (WooCommerce → Settings → Payments)
4. ✅ Set up shipping methods (WooCommerce → Settings → Shipping)
5. ✅ Add site icon/favicon (Appearance → Customize → Site Identity)
6. ✅ Configure email settings (WooCommerce → Settings → Emails)
7. ✅ Test checkout process with test orders
8. ✅ Set up SSL certificate (https://)
9. ✅ Configure backup solution
10. ✅ Launch! 🎉

---

**Total Setup Time: ~15-20 minutes for basic setup**

**Questions?** Refer to `README.md` for detailed documentation or `IMPLEMENTATION-SUMMARY.md` for technical details.

