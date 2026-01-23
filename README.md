# 🦷 Ocean Dental - Modern Landing Page

A premium, modern landing page for Ocean Dental Indonesia featuring stunning visuals, smooth animations, and comprehensive service information.

![Ocean Dental](https://img.shields.io/badge/Status-Production%20Ready-success)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black)

---

## ✨ Features

- 🎨 **Modern Design**: Premium aesthetics with turquoise/cyan color palette
- 📱 **Fully Responsive**: Perfect on mobile, tablet, and desktop
- ⚡ **Smooth Animations**: Fade-ins, slides, and micro-interactions
- 🏥 **Complete Services**: All 7 dental treatments listed
- 📍 **25+ Branches**: Multiple locations across Jabodetabek
- 💬 **WhatsApp Integration**: Easy appointment booking
- ♿ **Accessible**: ARIA labels, keyboard navigation, semantic HTML
- 🚀 **SEO Optimized**: Meta tags, proper heading hierarchy
- 🖼️ **Professional Imagery**: High-quality AI-generated photos

---

## 📁 Project Structure

```
dental-landing-page/
├── index.html          # Main HTML file
├── style.css           # CSS design system
├── script.js           # JavaScript interactions
└── README.md           # This file
```

---

## 🚀 Quick Start

### 1. Local Development

```bash
# Navigate to project directory
cd dental-landing-page

# Option 1: Python (usually pre-installed)
python3 -m http.server 8000

# Option 2: Node.js
npx http-server -p 8000

# Option 3: PHP
php -S localhost:8000
```

Then open: **http://localhost:8000**

---

## 🌐 Deployment

### Vercel (Recommended)

```bash
# Install Vercel CLI
npm i -g vercel

# Deploy
vercel --prod
```

### Netlify

1. Drag and drop the folder to [Netlify Drop](https://app.netlify.com/drop)
2. Your site is live!

### GitHub Pages

```bash
# Create repository
git init
git add .
git commit -m "Initial commit"
git branch -M main
git remote add origin https://github.com/username/repo.git
git push -u origin main

# Enable GitHub Pages in Settings > Pages
# Select branch: main
```

### Traditional Web Hosting

Upload all files via FTP to your web server's public directory (usually `public_html` or `www`).

---

## ⚙️ Customization

### Update Phone Number

Find and replace in `index.html`:

```html
<!-- Find all instances of: -->
6281234567890

<!-- Replace with your actual WhatsApp number -->
```

### Update Branch Information

Edit the branch cards in `index.html` (around line 318):

```html
<div class="branch-card">
    <h3>Ocean Dental [Branch Name]</h3>
    <p class="branch-address">[City/Area]</p>
    <!-- Update phone, hours, links -->
</div>
```

### Change Colors

Edit CSS variables in `style.css` (line 9):

```css
:root {
    --primary-color: #00bcd4;  /* Main brand color */
    --primary-dark: #0097a7;   /* Darker shade */
    --primary-light: #b2ebf2;  /* Lighter shade */
}
```

### Add Social Media Links

Update footer links in `index.html`:

```html
<a href="https://instagram.com/oceandental.id">
    <i class="fab fa-instagram"></i>
</a>
```

---

## 📋 Content Sections

### Navigation
- Fixed header with smooth scroll
- Mobile hamburger menu
- WhatsApp CTA button

### Hero Section
- Engaging headline with gradient text
- Brand statistics (10+ years, 25+ branches)
- Dual CTAs (WhatsApp + Explore Services)
- Hero image with floating rating card

### About Us
- Founder profile: drg. Aersy Henny Paramitha
- Company history since 2013
- Statistics showcase (branches, doctors, patients)
- Core values and mission

### Services
1. Tambal Gigi (Fillings)
2. Crown & Bridge
3. Bracket / Behel (Braces)
4. Implan Gigi (Implants)
5. Veneer
6. Scaling & Bleaching
7. Gummy, Stain & Fissure Sealant

### Branches
- 6+ featured locations
- Operating hours: Daily 09:00-21:00
- Waze navigation links
- WhatsApp reservation buttons

### Testimonials
- 4 real patient reviews
- 5-star ratings
- Patient names and locations

### Gallery
- 6 professional clinic photos
- Hover overlays
- Responsive grid

### Footer
- Contact information
- Social media links
- NIB: 9120317081259
- Service links

---

## 🎨 Design System

### Color Palette

```css
Primary:    #01215E (Blue Ocean)
Secondary:  #FCF3E9 (Cream)
Accent:     #4a6fa5 (Light Blue)
Background: #F8F8F8 (White)
Text:       #424242
```

### Typography

- **Display Font**: Outfit (Headlines, CTAs)
- **Body Font**: Inter (Content, descriptions)

### Spacing Scale

```css
xs:  0.5rem (8px)
sm:  1rem   (16px)
md:  1.5rem (24px)
lg:  2rem   (32px)
xl:  3rem   (48px)
2xl: 4rem   (64px)
3xl: 6rem   (96px)
```

### Breakpoints

```css
Mobile:  < 768px
Tablet:  768px - 1024px
Desktop: > 1024px
Large:   > 1440px
```

---

## 🛠️ Technical Details

### Technologies

- **HTML5**: Semantic markup
- **CSS3**: Custom properties, Grid, Flexbox
- **Vanilla JavaScript**: No framework dependencies
- **Google Fonts**: Inter, Outfit
- **Font Awesome**: Icons (v6.4.0)

### Browser Support

- ✅ Chrome/Edge 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Mobile browsers (iOS Safari, Chrome Mobile)

### Performance

- Minimal HTTP requests
- GPU-accelerated animations
- Lazy loading setup
- Optimized images
- No heavy frameworks

---

## 📊 SEO Checklist

- ✅ Descriptive title tag
- ✅ Meta description
- ✅ Meta keywords
- ✅ Proper heading hierarchy (H1, H2, H3)
- ✅ Alt text on all images
- ✅ Semantic HTML5 elements
- ✅ Mobile-friendly design
- ✅ Fast loading speed

---

## ♿ Accessibility Features

- Semantic HTML5 elements (`<nav>`, `<section>`, `<article>`)
- ARIA labels on interactive elements
- Keyboard navigation support
- Focus indicators
- High contrast ratios (WCAG 2.1 AA)
- Responsive text sizing

---

## 📱 WhatsApp Integration

WhatsApp links are integrated throughout:

- Navigation bar
- Hero section CTAs
- Service consultation links
- Branch reservation buttons
- Floating action button
- Footer contact

**Format:**
```html
<a href="https://wa.me/6281234567890?text=YOUR_MESSAGE">
```

Replace `6281234567890` with your actual WhatsApp number (country code + number, no spaces or symbols).

---

## 🎯 Future Enhancements

Potential additions:

- [ ] Lightbox for gallery images
- [ ] Online appointment booking form
- [ ] Google Maps integration
- [ ] Blog section for dental tips
- [ ] Before/After treatment gallery
- [ ] FAQ accordion
- [ ] Live chat widget
- [ ] Google Analytics tracking
- [ ] Multi-language support (EN/ID)
- [ ] Newsletter subscription

---

## 📝 License

This project is created for Ocean Dental Indonesia. All content, branding, and imagery are property of Ocean Dental.

---

## 🙋 Support

For technical issues or questions:

1. Review the code comments in each file
2. Check the [walkthrough documentation](walkthrough.md)
3. Test locally before deploying

---

## 👨‍💻 Development Notes

### Adding New Services

1. Copy a `.service-card` div in `index.html`
2. Update icon, title, description
3. Update WhatsApp link with service name

### Adding New Branches

1. Copy a `.branch-card` div
2. Update branch name, address, phone
3. Update Waze link
4. Update WhatsApp reservation link

### Modifying Animations

All animations are in `style.css` under the `Animations` section. Adjust:
- `animation-duration` for speed
- `animation-delay` for timing
- `@keyframes` for custom animations

---

## 🔧 Troubleshooting

### Images Not Loading

- Check file paths in `index.html`
- Ensure images are in the correct directory
- Use absolute paths or relative paths correctly

### WhatsApp Links Not Working

- Verify phone number format: country code + number
- Remove all spaces and special characters
- Test link format: `https://wa.me/6281234567890`

### Mobile Menu Not Working

- Check JavaScript is loaded
- Open browser console for errors
- Ensure `script.js` is linked in HTML

---

## 📞 Contact

**Ocean Dental**  
📍 25+ Branches in Jabodetabek  
⏰ Daily 09:00 - 21:00  
💬 WhatsApp: +62 812-3456-7890  
📧 info@oceandental.co.id  
📱 Instagram: @oceandental.id  
🆔 NIB: 9120317081259

---

**Built with ❤️ for healthy smiles**  
*Senyum Sehat Bersama Ocean Dental*
