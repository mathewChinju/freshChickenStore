# CSS Stylesheet Structure Documentation

## Overview
This document outlines the consolidated CSS architecture for the Kitchen & Meat Store E-commerce Application. The stylesheets are organized to maintain design consistency while eliminating redundancy and improving maintainability.

## Stylesheet Files

### 1. `common-styles.css` (Base Styles)
**Purpose**: Shared styles used across both frontend and admin interfaces.

**Contents**:
- CSS Variables (colors, typography, spacing, shadows)
- Typography definitions (Inter + Space Grotesk fonts)
- Common components (buttons, cards, badges, alerts, forms, tables)
- Utility classes and animations
- Responsive design base rules
- Loading states and empty states

**Key Features**:
- Comprehensive CSS custom properties system
- Consistent design tokens
- Reusable component styles
- Animation library
- Accessibility considerations

### 2. `frontend-styles.css` (Customer-Facing Interface)
**Purpose**: Styles specific to the customer-facing website.

**Contents**:
- Navigation and header styles
- Hero sections and banners
- Product cards and catalogs
- Feature sections
- Footer styling
- Customer-specific layout components
- Frontend responsive design

**Design Characteristics**:
- Modern blue-gray color palette
- Glass-morphism effects
- Smooth animations and transitions
- Mobile-first responsive design
- Product showcase components

### 3. `admin-enhanced.css` (Admin Panel)
**Purpose**: Styles specific to the administrative interface.

**Contents**:
- Sidebar navigation system
- Dashboard layouts
- Statistics cards
- Data tables and filters
- Modal dialogs
- Admin-specific components
- Management interface styling

**Design Characteristics**:
- Professional purple-blue theme
- Collapsible sidebar with tooltips
- Data-focused layouts
- Efficient navigation patterns
- Admin utility components

### 4. `admin-common.css` (Form Standards)
**Purpose**: Standardized form styles for admin interfaces.

**Contents**:
- Form layout standards
- Input field styling
- Validation states
- Form actions and buttons
- Responsive form design
- Modal form styles

## Design System

### Color Palette

#### Frontend Colors
- **Primary**: `#1e293b` (slate-800)
- **Accent**: `#3b82f6` (blue-500)
- **Secondary**: `#10b981` (emerald-500)
- **Success**: `#10b981`
- **Warning**: `#f59e0b`
- **Danger**: `#ef4444`

#### Admin Colors
- **Primary**: `#4f46e5` (indigo-500)
- **Secondary**: `#06b6d4` (cyan-500)
- **Sidebar**: `#111827` (dark slate)

### Typography

#### Font Stack
- **Primary**: 'Inter', sans-serif (body text, UI elements)
- **Secondary**: 'Space Grotesk', sans-serif (headings, display text)

#### Font Weights
- **Light**: 300
- **Regular**: 400
- **Medium**: 500
- **Semibold**: 600
- **Bold**: 700

### Spacing System
- **Base unit**: 0.25rem (4px)
- **Scale**: 0.25rem, 0.5rem, 0.75rem, 1rem, 1.25rem, 1.5rem, 2rem, 3rem, 4rem, 6rem

### Border Radius
- **Small**: 0.375rem (6px)
- **Medium**: 0.5rem (8px)
- **Large**: 0.75rem (12px)
- **Extra Large**: 1rem (16px)

### Shadow System
- **Small**: `0 1px 2px 0 rgb(0 0 0 / 0.05)`
- **Medium**: `0 4px 6px -1px rgb(0 0 0 / 0.1)`
- **Large**: `0 10px 15px -3px rgb(0 0 0 / 0.1)`
- **Extra Large**: `0 20px 25px -5px rgb(0 0 0 / 0.1)`

## Component Architecture

### Button System
All buttons share a common base class with modifier classes:
- `.btn` (base styles)
- `.btn-primary` (brand primary color)
- `.btn-outline-primary` (outlined variant)
- `.whatsapp-btn` (WhatsApp integration)
- `.btn-order` (product ordering)

### Card System
Consistent card styling across the application:
- `.card` (base container)
- `.product-card` (product display)
- `.product-card-modern` (enhanced product display)
- `.stat-card` (dashboard statistics)
- `.content-card` (admin content areas)

### Badge System
Semantic badge styling:
- `.badge` (base)
- `.status-badge` (status indicators)
- `.category-badge` (product categories)
- `.stock-badge` (inventory status)

## Responsive Design

### Breakpoints
- **Mobile**: < 576px
- **Tablet**: 576px - 768px
- **Desktop**: 768px - 992px
- **Large Desktop**: 992px - 1200px
- **Extra Large**: > 1200px

### Mobile-First Approach
All styles use mobile-first media queries with `min-width` breakpoints.

### Special Considerations
- Touch-friendly interface adjustments
- High DPI display optimizations
- Reduced motion support
- Dark mode compatibility

## Animation System

### Keyframes
- `fadeInUp`: Standard entrance animation
- `loading`: Skeleton loading animation

### Usage
Animations are applied through utility classes:
- `.fade-in-up` for entrance effects
- `.skeleton` for loading states

## Accessibility Features

### Focus Management
- Consistent focus indicators
- Keyboard navigation support
- Screen reader compatibility

### Color Contrast
- WCAG AA compliant color combinations
- Text contrast ratios > 4.5:1
- Large text contrast ratios > 3:1

### Responsive Design
- Flexible layouts that work with assistive technologies
- Semantic HTML structure
- ARIA label support

## Performance Considerations

### CSS Optimization
- Efficient selector usage
- Minimal specificity conflicts
- Optimized animations using `transform` and `opacity`

### File Organization
- Logical separation of concerns
- Minimal redundancy
- Consistent naming conventions
- Efficient CSS custom properties usage

## Maintenance Guidelines

### Adding New Components
1. Check if component exists in common styles
2. Add to appropriate stylesheet (common, frontend, or admin)
3. Follow established naming conventions
4. Include responsive variants
5. Document usage in this file

### Modifying Existing Styles
1. Consider impact across all interfaces
2. Test with different screen sizes
3. Verify accessibility compliance
4. Update documentation as needed

### Color and Font Changes
1. Update CSS variables in `common-styles.css`
2. Test across all components
3. Verify contrast ratios
4. Update documentation

## Browser Support

### Modern Browsers (Last 2 versions)
- Chrome/Chromium
- Firefox
- Safari
- Edge

### Legacy Support
- Graceful degradation for older browsers
- CSS feature detection where appropriate
- Fallback styling for unsupported features

## Future Enhancements

### Planned Improvements
- CSS Grid layouts for complex interfaces
- CSS Container Queries for component-based responsive design
- CSS Subgrid for nested grid layouts
- Enhanced dark mode support
- Component-based CSS architecture

### Scalability Considerations
- Modular CSS architecture for easy expansion
- Design token system for consistent theming
- Component library documentation
- Style guide integration

---

**Last Updated**: March 13, 2026
**Maintained by**: Development Team
**Version**: 1.0.0
