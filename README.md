# Elementor Logos Slider Widget

A customizable and responsive logo slider widget for Elementor page builder. Features smooth infinite scroll animation, hover effects, and image protection.

## Requirements

- WordPress 5.0 or higher
- Elementor Page Builder (free version)
- PHP 7.0 or higher

## Installation

1. Upload the `elementor-logos-slider` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. The widget will be available in Elementor's widget panel under the 'Logo Widgets' category

## Features

- Infinite scroll animation
- Smooth hover zoom effect
- Grayscale to color transition
- Light/Dark/Custom background modes
- Customizable animation speed
- Responsive design
- Image protection against downloads
- RTL support
- Customizable title section

## Usage Instructions

### Adding the Widget

1. Edit your page with Elementor
2. Search for "Logos Slider" in the elements panel
3. Drag and drop the widget to your desired section

### Configuring the Widget

#### Title Section

- Toggle title visibility
- Choose heading tag (H1-H6)
- Customize typography, color, and spacing
- Default: H3, left-aligned

#### Logo Settings

1. Click "Add Logos" to open the media library
2. Select or upload your logo images
3. Adjust the following settings:
   - Logo size
   - Opacity
   - Hover opacity
   - Animation speed
   - Background mode

### Image Requirements

#### Recommended Dimensions

- **Base Display Size**: 120px × 120px
- **Recommended Upload Size**: 240px × 240px (2x for retina displays)
- **Maximum Size**: 400px × 400px
- **Aspect Ratio**: 1:1 (square) recommended

#### File Specifications

- **Format**: PNG or SVG preferred (for transparency)
- **Resolution**: 72-144 DPI
- **Color Mode**: RGB
- **File Size**: Under 100KB recommended

#### Best Practices

- Use transparent backgrounds (PNG/SVG)
- Maintain consistent dimensions across all logos
- Upload at 2x the display size for retina support
- Optimize images before uploading
- Keep similar visual weight across logos

### Performance Optimization

For best performance:

- Compress images before uploading
- Keep total number of logos under 20
- Use PNG/SVG format for best quality/size ratio
- Enable browser caching
- Use a CDN if available

## Customization Options

### Style Settings

- Logo size: 50px to 300px
- Base opacity: 0 to 1
- Hover opacity: 0 to 1
- Animation speed: 10s to 200s
- Background modes: Light/Dark/Custom

### Animation

- Auto-scroll speed adjustable
- Pause on hover
- Smooth transitions
- RTL support

### Responsive Behavior

- Fully responsive
- Maintains aspect ratio
- Adjusts speed on different screen sizes
- Touch-friendly on mobile devices

## Translation

The plugin is translation-ready and includes:

- English (default)
- Spanish
- POT file for additional translations

## Troubleshooting

Common issues and solutions:

1. **Logos Not Showing**
   - Check image dimensions
   - Verify file permissions
   - Clear browser cache

2. **Animation Issues**
   - Reduce number of logos
   - Check for conflicts with other animations
   - Verify JavaScript is enabled

3. **Mobile Display Problems**
   - Adjust logo size for smaller screens
   - Check responsive settings
   - Test on multiple devices

## Support

For support and bug reports:

- Create an issue on GitHub
- Contact through WordPress.org plugin page
- Email support: [your-support-email]

## License

GPL v2 or later

## Credits

Developed by Adalberto H. Vega

- LinkedIn: <https://linkedin.com/in/ahvega>

## Changelog

### 1.0.0

- Initial release
- Basic slider functionality
- Hover effects
- Image protection
- Title section
- Translation ready
