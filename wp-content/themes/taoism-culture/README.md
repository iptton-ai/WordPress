# Taoism Culture WordPress Theme

A beautiful and modern WordPress theme for Taoist culture and e-commerce, featuring WooCommerce integration.

## Features

- **Custom Design System**: Based on the design specifications with custom colors, typography, and components
- **WooCommerce Ready**: Full WooCommerce support with custom product layouts
- **Custom Post Types**: Culture articles and Taoism lectures
- **Product Categories**: Pre-configured categories (法器, 服饰, 书籍, 香品, 字画, 茶具)
- **Product Attributes**: Material and Style attributes for filtering
- **Dark Mode**: Built-in dark mode toggle
- **Responsive Design**: Mobile-first approach with responsive layouts
- **SEO Optimized**: Clean code and semantic HTML
- **Performance**: Optimized assets and lazy loading

## Installation

1. Upload the theme folder to `/wp-content/themes/`
2. Activate the theme through the 'Appearance' menu in WordPress
3. Install and activate WooCommerce plugin (required for shop functionality)
4. Go to Appearance > Customize to configure theme options

## Theme Configuration

### Required Plugins
- **WooCommerce** (required for e-commerce functionality)
- **Advanced Custom Fields** (recommended for custom fields)

### Recommended Setup

1. **Create Menus**:
   - Go to Appearance > Menus
   - Create a Primary Menu and assign it to "Primary Menu" location
   - Create a Footer Menu and assign it to "Footer Menu" location

2. **Configure WooCommerce**:
   - Go to WooCommerce > Settings
   - Set your store location, currency, and other preferences
   - The theme automatically creates product categories and attributes

3. **Customize Theme**:
   - Go to Appearance > Customize
   - Configure Hero section (image, title, description, button)
   - Set up footer text and copyright
   - Optionally enable dark mode by default

4. **Create Sample Content**:
   - Create Culture Articles (Posts > Culture Articles)
   - Add products through WooCommerce
   - Assign products to the pre-created categories

## Template Hierarchy

### Main Templates
- `front-page.php` - Homepage with hero, culture recommendations, and new products
- `index.php` - Default blog listing
- `archive-culture_article.php` - Culture articles archive
- `single-culture_article.php` - Single culture article

### WooCommerce Templates
- `woocommerce/archive-product.php` - Product archive with filters
- `woocommerce/content-single-product.php` - Single product layout
- `woocommerce/cart/cart.php` - Cart page

## Customization

### Colors
The theme uses CSS custom properties defined in `style.css`:
- `--primary-gold`: #b89b72 (for homepage)
- `--primary-green`: #11d493 (for other pages)
- `--bg-light`: #f5f5f1
- `--bg-dark`: #1a1a1a

### Typography
- Display Font: Noto Serif / Noto Serif SC
- Body Font: Noto Sans / Noto Sans SC

### Custom Post Types

#### Culture Articles
- Post Type: `culture_article`
- Taxonomy: `culture_category`
- Archive URL: `/culture/`
- Custom Fields: Author Title (道号)

#### Taoism Lectures
- Post Type: `taoism_lecture`
- Archive URL: `/lectures/`

### Product Attributes

#### Material (材质)
- Wood, Jade, Bronze, Ceramic, Fabric, Stone, Metal

#### Style (款式)
- Mountain, River, Lotus, Traditional, Modern, Classic

## Development

### File Structure
```
taoism-culture/
├── assets/
│   ├── css/
│   │   ├── main.css
│   │   └── woocommerce.css
│   ├── js/
│   │   ├── main.js
│   │   └── customizer.js
│   └── images/
├── inc/
│   ├── template-functions.php
│   ├── customizer.php
│   └── woocommerce.php
├── template-parts/
│   ├── content.php
│   ├── content-none.php
│   └── content-culture_article.php
├── woocommerce/
│   ├── archive-product.php
│   ├── content-single-product.php
│   └── cart/
│       └── cart.php
├── functions.php
├── style.css
├── header.php
├── footer.php
├── front-page.php
├── index.php
├── archive-culture_article.php
└── single-culture_article.php
```

### Hooks and Filters

The theme provides several hooks for customization:
- `taoism_culture_setup` - Runs during theme setup
- `taoism_culture_scripts` - Scripts and styles enqueue
- Custom WooCommerce filters for product display

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Credits

- Design inspired by traditional Taoist aesthetics
- Icons: Material Symbols
- Fonts: Google Fonts (Noto Serif, Noto Sans)

## License

This theme is licensed under the GPL v2 or later.

## Support

For support and documentation, please visit the theme documentation page or contact the developer.

## Changelog

### Version 1.0.0
- Initial release
- Custom design system implementation
- WooCommerce integration
- Custom post types for culture content
- Dark mode support
- Responsive design

