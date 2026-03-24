<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Kitchen & Meat Store')</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #1e293b;
            --primary-light: #334155;
            --primary-dark: #0f172a;
            --accent-color: #3b82f6;
            --accent-light: #60a5fa;
            --secondary-color: #10b981;
            --secondary-light: #34d399;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --light-bg: #f8fafc;
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-50);
            color: var(--text-primary);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 600;
            color: var(--text-primary);
            line-height: 1.2;
        }

        h1 { font-size: 2.5rem; font-weight: 700; }
        h2 { font-size: 2rem; font-weight: 600; }
        h3 { font-size: 1.75rem; font-weight: 600; }
        h4 { font-size: 1.5rem; font-weight: 600; }
        h5 { font-size: 1.25rem; font-weight: 600; }
        h6 { font-size: 1.125rem; font-weight: 600; }

        /* Navigation */
        .navbar {
            background: var(--white) !important;
            backdrop-filter: blur(20px);
            box-shadow: var(--shadow-sm);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary) !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: var(--radius-md);
            transition: all 0.3s ease;
            margin: 0 0.25rem;
        }

        .nav-link:hover {
            color: var(--accent-color) !important;
            background: var(--gray-100);
        }

        .nav-link.active {
            color: var(--accent-color) !important;
            background: var(--accent-light);
            background: linear-gradient(135deg, var(--accent-light), var(--accent-color));
            color: var(--white) !important;
            transform: translateY(-2px);
        }

        .hero-section {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem 0;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: #6c757d;
            font-weight: 300;
            max-width: 600px;
            margin: 0 auto;
        }

        .product-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            background: white;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .product-card .card-img-top {
            border-radius: 16px 16px 0 0;
            height: 220px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .product-card:hover .card-img-top {
            transform: scale(1.1);
        }

        .product-card .card-body {
            padding: 1.5rem;
        }

        .product-card .card-title {
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--dark-text);
            margin-bottom: 0.5rem;
        }

        .product-card .card-text {
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .price-tag {
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--success-color);
        }

        .price-weight {
            font-size: 0.85rem;
            color: #6c757d;
            font-weight: 400;
        }

        .badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.75rem;
        }

        .btn {
            border-radius: 25px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            font-size: 0.9rem;
        }

        .btn-outline-primary {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(44, 62, 80, 0.2);
        }

        .whatsapp-btn {
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .whatsapp-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.3);
        }

        .whatsapp-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .whatsapp-btn:hover::before {
            left: 100%;
        }

        .footer {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: white;
            padding: 3.5rem 0 1.5rem;
            margin-top: 0;
            border-top: 4px solid #fbbf24;
            position: relative;
            left: 0;
            right: 0;
            z-index: 1;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.15);
        }

        .footer .container {
            max-width: 100%;
            padding: 0 2rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-brand {
            text-align: left;
        }

        .footer-brand h5 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-brand h5 i {
            color: #fbbf24;
            font-size: 1.5rem;
        }

        .footer-brand p {
            font-size: 0.9rem;
            margin-bottom: 1rem;
            opacity: 0.9;
            line-height: 1.5;
        }

        .footer-contact {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .footer-contact span {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .footer-contact i {
            color: #fbbf24;
            font-size: 1rem;
            width: 20px;
        }

        .footer-links h6,
        .footer-social h6 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: white;
        }

        .footer-links ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links ul li {
            margin-bottom: 0.5rem;
        }

        .footer-links ul li a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            display: inline-block;
        }
 
        .footer-links ul li a:hover {
            color: #fbbf24;
            transform: translateX(3px);
        }

        .footer-social .social-icons {
            display: flex;
            gap: 0.75rem;
        }

        .social-icon {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .social-icon:hover {
            background: #fbbf24;
            color: #047857;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(251, 191, 36, 0.4);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem;
            text-align: center;
        }

        .footer-bottom p {
            font-size: 0.8rem;
            margin: 0;
            color: rgba(255, 255, 255, 0.7);
        }

        .footer-bottom .heart {
            color: #ef4444;
            animation: heartbeat 1.5s ease-in-out infinite;
        }

        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        /* Footer Responsive */
        @media (max-width: 992px) {
            .footer-content {
                grid-template-columns: 1fr 1fr;
                gap: 1.5rem;
            }
            
            .footer-brand {
                grid-column: span 2;
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .footer {
                padding: 2rem 0 1rem;
            }
            
            .footer-content {
                grid-template-columns: 1fr;
                gap: 1rem;
                text-align: center;
            }
            
            .footer-brand {
                grid-column: span 1;
            }
            
            .footer-contact {
                align-items: center;
            }
            
            .footer-social .social-icons {
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .footer .container {
                padding: 0 1rem;
            }
            
            .footer-brand h5 {
                font-size: 1.1rem;
            }
            
            .footer-brand p {
                font-size: 0.8rem;
            }
            
            .social-icon {
                width: 32px;
                height: 32px;
                font-size: 0.8rem;
            }
        }

        .alert {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
        }

        .alert-info {
            background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
            color: #0c5460;
        }

        .btn-link {
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .btn-link:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .stock-badge {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            color: #1b5e20;
            font-weight: 600;
        }

        .category-badge {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: #495057;
            border: 1px solid var(--border-color);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .main-container {
                margin: 0;
                padding: 0;
                padding-top: 80px;
            }
            
            .product-card {
                margin-bottom: 1.5rem;
            }
        }

        /* Loading animation */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Hero Banner Styles */
        .hero-banner {
            position: relative;
            min-height: 90vh;
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 50%, var(--accent-color) 100%),
                        url('https://images.unsplash.com/photo-1603020356471-7531b712d65e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80') center/cover;
            display: flex;
            align-items: center;
            margin-bottom: 0;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, 
                rgba(30, 41, 59, 0.85) 0%, 
                rgba(51, 65, 85, 0.75) 50%, 
                rgba(59, 130, 246, 0.65) 100%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 4rem 0;
        }

        .hero-title {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            color: white;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: clamp(1rem, 2.5vw, 1.375rem);
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 2.5rem;
            line-height: 1.6;
            font-weight: 400;
            max-width: clamp(300px, 90%, 600px);
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .hero-buttons .btn {
            padding: clamp(0.75rem, 2vw, 1rem) clamp(1.5rem, 4vw, 2rem);
            font-size: clamp(0.9rem, 2vw, 1.1rem);
            font-weight: 600;
            border-radius: var(--radius-lg);
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            min-height: 48px;
        }

        .hero-buttons .btn-primary {
            background: linear-gradient(135deg, var(--accent-color), var(--accent-light));
            border: none;
            color: white;
            box-shadow: var(--shadow-md);
        }

        .hero-buttons .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            color: white;
        }

        .hero-buttons .btn-outline-light {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            backdrop-filter: blur(10px);
        }

        .hero-buttons .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
            transform: translateY(-2px);
        }

        .hero-image {
            position: relative;
            display: none;
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-xl);
            border: 4px solid rgba(255, 255, 255, 0.1);
        }

        .hero-image::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            right: -20px;
            bottom: -20px;
            background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
            border-radius: var(--radius-xl);
            z-index: -1;
            opacity: 0.3;
        }

        /* Responsive Design */
        @media (min-width: 768px) {
            .hero-banner {
                min-height: 85vh;
            }
            
            .hero-image {
                display: block;
            }
        }

        @media (min-width: 1024px) {
            .hero-banner {
                min-height: 80vh;
            }
        }

        @media (max-width: 767px) {
            .hero-content {
                padding: 2rem 0;
                text-align: center;
            }
            
            .hero-buttons {
                justify-content: center;
                flex-direction: column;
                align-items: center;
            }
            
            .hero-buttons .btn {
                width: 100%;
                max-width: 300px;
            }
        }

        @media (max-width: 480px) {
            .hero-banner {
                min-height: 100vh;
            }
            
            .hero-title {
                font-size: 2rem;
                margin-bottom: 1rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
                margin-bottom: 2rem;
            }
        }

        /* Features Section */
        .features-section {
            background: linear-gradient(135deg, var(--white) 0%, var(--gray-50) 100%);
            padding: 6rem 0;
            border-top: none;
            position: relative;
        }

        .features-section::before {
            content: '';
            position: absolute;
            top: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, 
                transparent 0%, 
                var(--accent-color) 20%, 
                var(--secondary-color) 50%, 
                var(--accent-color) 80%, 
                transparent 100%);
        }

        .feature-card {
            padding: 2.5rem;
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-color), var(--secondary-color));
            transform: translateY(-100%);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: var(--accent-light);
        }

        .feature-card:hover::before {
            transform: translateY(0);
        }

        .feature-icon {
            width: 72px;
            height: 72px;
            margin: 0 auto 2rem;
            background: linear-gradient(135deg, var(--accent-light), var(--accent-color));
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: white;
            box-shadow: var(--shadow-md);
        }

        .feature-card h4 {
            color: var(--text-primary);
            margin-bottom: 1rem;
            font-weight: 600;
            font-size: 1.25rem;
        }

        .feature-card p {
            color: var(--text-secondary);
            margin-bottom: 0;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Products Section */
        .products-section {
            background: linear-gradient(135deg, var(--gray-50) 0%, var(--white) 100%);
            padding: 6rem 0;
            position: relative;
        }

        .products-section::before {
            content: '';
            position: absolute;
            top: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, 
                transparent 0%, 
                var(--secondary-color) 20%, 
                var(--accent-color) 50%, 
                var(--secondary-color) 80%, 
                transparent 100%);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: var(--dark-text);
            opacity: 0.8;
            margin-bottom: 0;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 50%, var(--accent-color) 100%);
            color: white;
            padding: 6rem 0;
            position: relative;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, 
                transparent 0%, 
                var(--accent-color) 20%, 
                var(--secondary-color) 50%, 
                var(--accent-color) 80%, 
                transparent 100%);
        }

        .cta-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* Products Page Styles */
        .products-page-header {
            background: var(--white);
            border-bottom: 1px solid var(--border-color);
            padding: 2rem 0 3rem;
        }

        .products-breadcrumb .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 1rem;
        }

        .products-breadcrumb .breadcrumb-item {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .products-breadcrumb .breadcrumb-item a {
            color: var(--accent-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .products-breadcrumb .breadcrumb-item a:hover {
            color: var(--accent-light);
        }

        .products-page-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .products-page-subtitle {
            font-size: 1.1rem;
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 0;
        }

        .products-stats .stat-item {
            display: inline-block;
            text-align: center;
            padding: 1rem;
            background: var(--gray-50);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-color);
        }

        .stat-number {
            display: block;
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent-color);
        }

        .stat-label {
            display: block;
            font-size: 0.9rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Products Grid Section */
        .products-grid-section {
            background: var(--gray-50);
            padding: 3rem 0;
        }

        .products-filters {
            background: var(--white);
            padding: 1.5rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            margin-bottom: 2rem;
        }

        .filter-tabs {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.5rem 1rem;
            border: 1px solid var(--border-color);
            background: var(--white);
            border-radius: var(--radius-md);
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            border-color: var(--accent-color);
            color: var(--accent-color);
        }

        .filter-btn.active {
            background: var(--accent-color);
            border-color: var(--accent-color);
            color: var(--white);
        }

        .sort-options .form-select {
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 0.9rem;
        }

        /* Modern Product Card */
        .product-card-modern {
            background: var(--white);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .product-card-modern:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .product-image-container {
            position: relative;
            overflow: hidden;
            height: 200px;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card-modern:hover .product-image {
            transform: scale(1.05);
        }

        .product-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .product-card-modern:hover .product-overlay {
            opacity: 1;
        }

        .quick-view-btn {
            background: var(--white);
            border: none;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-primary);
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .quick-view-btn:hover {
            background: var(--accent-color);
            color: var(--white);
            transform: scale(1.1);
        }

        .product-body {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .product-categories {
            display: flex;
            gap: 0.25rem;
            flex-wrap: wrap;
        }

        .category-tag {
            background: var(--gray-100);
            color: var(--text-secondary);
            padding: 0.25rem 0.5rem;
            border-radius: var(--radius-sm);
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .product-stock {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .product-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .product-description {
            margin-bottom: 1.5rem;
            flex: 1;
        }

        .description-text {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 0;
        }

        .read-more-btn {
            background: none;
            border: none;
            color: var(--accent-color);
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0;
            margin-left: 0.25rem;
            cursor: pointer;
            text-decoration: underline;
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 1.5rem;
        }

        .product-price {
            display: flex;
            flex-direction: column;
        }

        .current-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent-color);
        }

        .price-unit {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .product-code {
            text-align: right;
        }

        .product-actions {
            margin-top: auto;
        }

        .btn-order {
            width: 100%;
            padding: 0.75rem;
            background: linear-gradient(135deg, var(--accent-color), var(--accent-light));
            border: none;
            border-radius: var(--radius-md);
            color: var(--white);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-order:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: var(--white);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state-content {
            max-width: 500px;
            margin: 0 auto;
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 2rem;
            background: var(--gray-100);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--text-muted);
        }

        .empty-state h3 {
            font-size: 1.5rem;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: var(--text-secondary);
            margin-bottom: 2rem;
        }

        /* Comprehensive Responsive Design */
        @media (max-width: 1200px) {
            .hero-title {
                font-size: clamp(2rem, 4vw, 3.5rem);
            }
            
            .section-title {
                font-size: 2.2rem;
            }
            
            .cta-title {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 992px) {
            .features-section {
                padding: 4rem 0;
            }
            
            .products-section {
                padding: 4rem 0;
            }
            
            .cta-section {
                padding: 4rem 0;
            }
            
            .feature-card {
                padding: 2rem;
            }
        }

        @media (max-width: 768px) {
            .features-section {
                padding: 3rem 0;
            }
            
            .products-section {
                padding: 3rem 0;
            }
            
            .cta-section {
                padding: 3rem 0;
            }
            
            .feature-card {
                padding: 1.5rem;
                margin-bottom: 2rem;
            }
            
            .section-title {
                font-size: 2rem;
                margin-bottom: 0.75rem;
            }
            
            .section-subtitle {
                font-size: 1rem;
            }
            
            .cta-title {
                font-size: 2rem;
                margin-bottom: 0.75rem;
            }
            
            .cta-subtitle {
                font-size: 1rem;
                margin-bottom: 1.5rem;
            }
            
            .cta-buttons {
                flex-direction: column;
                align-items: center;
                gap: 0.75rem;
            }
            
            .cta-buttons .btn {
                width: 100%;
                max-width: 280px;
            }
        }

        @media (max-width: 576px) {
            .features-section {
                padding: 2rem 0;
            }
            
            .products-section {
                padding: 2rem 0;
            }
            
            .cta-section {
                padding: 2rem 0;
            }
            
            .feature-card {
                padding: 1.25rem;
            }
            
            .feature-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
            
            .section-title {
                font-size: 1.75rem;
            }
            
            .cta-title {
                font-size: 1.75rem;
            }
        }

        /* Touch-friendly adjustments */
        @media (hover: none) and (pointer: coarse) {
            .hero-buttons .btn {
                min-height: 52px;
            }
            
            .btn-order {
                min-height: 52px;
            }
            
            .filter-btn {
                min-height: 44px;
                padding: 0.75rem 1rem;
            }
            
            .product-card-modern {
                margin-bottom: 1.5rem;
            }
        }

        /* High DPI displays */
        @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
            .hero-banner {
                background-size: cover;
            }
            
            .product-image {
                image-rendering: -webkit-optimize-contrast;
                image-rendering: crisp-edges;
            }
        }

        /* Modern Responsive Design inspired by Enterprise Websites */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
        }

        body {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 50%, #e2e8f0 100%) !important;
            font-family: 'Inter', sans-serif !important;
            line-height: 1.6 !important;
            color: var(--text-primary) !important;
            overflow-x: hidden;
        }

        .site-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        /* Enhanced Modern Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%) !important;
            min-height: 60vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            margin: 0 !important;
            padding: 0 !important;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.3;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
            padding: 2rem;
        }

        .hero-title {
            font-size: clamp(2rem, 5vw, 3.5rem) !important;
            font-weight: 700 !important;
            margin-bottom: 1.5rem !important;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3) !important;
            animation: fadeInUp 1s ease-out;
        }

        .hero-subtitle {
            font-size: clamp(1rem, 2.5vw, 1.5rem) !important;
            margin-bottom: 2rem !important;
            opacity: 0.9 !important;
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .hero-cta {
            display: inline-flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .btn-hero {
            padding: 1rem 2rem !important;
            font-size: 1.1rem !important;
            font-weight: 600 !important;
            border-radius: 50px !important;
            text-decoration: none !important;
            transition: all 0.3s ease !important;
            border: 2px solid transparent !important;
            position: relative;
            overflow: hidden;
        }

        .btn-hero-primary {
            background: white !important;
            color: var(--primary-color) !important;
        }

        .btn-hero-primary:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2) !important;
        }

        .btn-hero-secondary {
            background: transparent !important;
            color: white !important;
            border-color: white !important;
        }

        .btn-hero-secondary:hover {
            background: white !important;
            color: var(--primary-color) !important;
            transform: translateY(-3px) !important;
        }

        /* Modern Feature Cards */
        .features-modern {
            padding: 4rem 0;
            background: white;
            position: relative;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .feature-card-modern {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1) !important;
            transition: all 0.3s ease !important;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .feature-card-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-color), var(--secondary-color));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .feature-card-modern:hover {
            transform: translateY(-10px) !important;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15) !important;
        }

        .feature-card-modern:hover::before {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--accent-color), var(--secondary-color)) !important;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 2rem;
            color: white;
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3) !important;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }

        .feature-description {
            color: var(--text-secondary);
            line-height: 1.7;
            font-size: 1rem;
        }

        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, var(--gray-50), white);
            padding: 4rem 0;
            position: relative;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .stat-item {
            text-align: center;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08) !important;
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px) !important;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--accent-color), var(--secondary-color)) !important;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 1.1rem;
            font-weight: 600;
        }

        /* Modern CTA Section */
        .cta-modern {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color)) !important;
            padding: 5rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-modern::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 20s ease-in-out infinite;
        }

        .cta-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .cta-title {
            font-size: clamp(2rem, 4vw, 3rem) !important;
            font-weight: 800 !important;
            color: white !important;
            margin-bottom: 1.5rem !important;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3) !important;
        }

        .cta-description {
            font-size: 1.2rem;
            color: rgba(255,255,255,0.9) !important;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        /* Responsive Design Improvements */
        @media (max-width: 1200px) {
            .feature-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 1.5rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 1.5rem;
            }
        }

        @media (max-width: 992px) {
            .hero-title {
                font-size: clamp(1.8rem, 4vw, 2.8rem);
            }
            
            .hero-subtitle {
                font-size: clamp(0.9rem, 2.2vw, 1.2rem);
            }
            
            .feature-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 1.5rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }
            
            .cta-title {
                font-size: clamp(1.5rem, 3.5vw, 2.5rem);
            }
            
            .cta-description {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                min-height: 50vh;
                padding: 1rem;
            }
            
            .hero-title {
                font-size: clamp(1.5rem, 5vw, 2rem);
            }
            
            .hero-subtitle {
                font-size: clamp(0.85rem, 2.5vw, 1rem);
                margin-bottom: 1.5rem;
            }
            
            .btn-hero {
                padding: 0.875rem 1.5rem;
                font-size: 1rem;
            }
            
            .hero-cta {
                flex-direction: column;
                align-items: center;
                gap: 0.75rem;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
            
            .stat-number {
                font-size: 2.5rem;
            }
            
            .stat-label {
                font-size: 1rem;
            }
            
            .feature-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .feature-card-modern {
                padding: 2rem;
            }
            
            .feature-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
            
            .feature-title {
                font-size: 1.3rem;
            }
            
            .cta-modern {
                padding: 3rem 0;
            }
            
            .cta-title {
                font-size: clamp(1.3rem, 4vw, 2rem);
            }
            
            .cta-description {
                font-size: 1rem;
                margin-bottom: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .hero-section {
                min-height: 40vh;
            }
            
            .hero-title {
                font-size: 1.5rem;
            }
            
            .hero-subtitle {
                font-size: 0.9rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .stat-item {
                padding: 1.5rem;
            }
            
            .stat-number {
                font-size: 2rem;
            }
            
            .feature-card-modern {
                padding: 1.5rem;
            }
            
            .feature-icon {
                width: 50px;
                height: 50px;
                font-size: 1.25rem;
            }
            
            .cta-title {
                font-size: 1.5rem;
            }
            
            .cta-description {
                font-size: 0.95rem;
            }
        }

        /* Enhanced Mobile Experience */
        @media (max-width: 480px) {
            .hero-badge .badge {
                font-size: 0.8rem;
                padding: 0.5rem 1rem;
            }
            
            .btn-hero {
                width: 100%;
                max-width: 280px;
                padding: 1rem;
                text-align: center;
            }
            
            .stat-number {
                font-size: 1.8rem;
            }
            
            .stat-label {
                font-size: 0.9rem;
            }
            
            .feature-title {
                font-size: 1.1rem;
            }
            
            .feature-description {
                font-size: 0.9rem;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translate(0, 0) rotate(0deg);
            }
            50% {
                transform: translate(-30px, -30px) rotate(180deg);
            }
        }

        /* Main Content Adjustments */
        .main-container {
            background: transparent;
            backdrop-filter: none;
            border-radius: 0;
            box-shadow: none;
            margin: 0;
            padding: 0;
            max-width: 100%;
            padding-top: 80px; /* Account for fixed navbar */
        }

        .content-wrapper {
            padding: 0;
            max-width: 100%;
        }

        /* Enhanced Theme Colors - Fresh Green Theme */
        :root {
            --primary-color: #059669;
            --primary-light: #10b981;
            --primary-dark: #047857;
            --accent-color: #0891b2;
            --accent-light: #06b6d4;
            --accent-dark: #0e7490;
            --secondary-color: #f97316;
            --secondary-light: #fb923c;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --success-color: #10b981;
            --light-bg: #f0fdf4;
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border-color: #d1fae5;
            --shadow-sm: 0 1px 2px 0 rgb(5 150 105 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(5 150 105 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(5 150 105 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(5 150 105 / 0.1);
        }

        /* Enhanced Navbar */
        .navbar {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(5, 150, 105, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.25rem;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            color: var(--secondary-light) !important;
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--secondary-light) !important;
            transform: translateY(-1px);
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--secondary-color);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .navbar-nav .nav-link:hover::after {
            width: 80%;
        }

        .dropdown-menu {
            background: linear-gradient(135deg, #059669, #047857);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            box-shadow: var(--shadow-xl);
            backdrop-filter: blur(10px);
        }

        .dropdown-item {
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
        }

        .dropdown-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(3px);
        }

        /* Enhanced Alert Messages */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-md);
            backdrop-filter: blur(10px);
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border-left: 4px solid var(--success-color);
        }

        .alert-info {
            background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
            color: #0c5460;
            border-left: 4px solid var(--accent-color);
        }

        .alert-warning {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeeba 100%);
            color: #856404;
            border-left: 4px solid var(--warning-color);
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border-left: 4px solid var(--danger-color);
        }

        /* Auth Modal Styles */
        .auth-modal {
            min-height: auto;
            max-height: 80vh;
            overflow: hidden;
        }

        .auth-modal-form {
            padding: 1.5rem;
            max-height: 80vh;
            overflow-y: auto;
        }

        .auth-modal-side {
            background: linear-gradient(135deg, #059669, #0891b2);
            color: white;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
            min-height: 400px;
        }

        .auth-modal-side h5 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .auth-modal-side p {
            margin-bottom: 1rem;
            opacity: 0.9;
            line-height: 1.4;
            font-size: 0.9rem;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .auth-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
        }

        .auth-logo i {
            font-size: 1.5rem;
            color: #059669;
        }

        .auth-logo h4 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0;
        }

        .auth-subtitle {
            color: var(--text-secondary);
            font-size: 0.85rem;
            margin: 0;
        }

        .auth-modal .form-group {
            margin-bottom: 1rem;
        }

        .auth-modal .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.4rem;
            display: block;
            font-size: 0.8rem;
        }

        .auth-modal .input-group-text {
            background: var(--gray-50);
            border: 2px solid var(--border-color);
            border-right: none;
            color: var(--text-secondary);
            font-size: 0.85rem;
        }

        .auth-modal .form-control {
            border: 2px solid var(--border-color);
            border-left: none;
            padding: 0.625rem;
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .auth-modal .form-control:focus {
            border-color: #059669;
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
        }

        .auth-modal .form-control.is-invalid {
            border-color: var(--danger-color);
        }

        .auth-modal .invalid-feedback {
            color: var(--danger-color);
            font-size: 0.75rem;
            margin-top: 0.25rem;
            display: flex;
            align-items: center;
        }

        .auth-modal #modalTogglePassword,
        .auth-modal #modalTogglePasswordReg,
        .auth-modal #modalToggleConfirmPassword {
            border: 2px solid var(--border-color);
            border-left: none;
            background: var(--gray-50);
            padding: 0.625rem;
        }

        .auth-modal .custom-checkbox {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .auth-modal .custom-checkbox input[type="checkbox"] {
            display: none;
        }

        .auth-modal .custom-checkbox .checkmark {
            width: 16px;
            height: 16px;
            border: 2px solid var(--border-color);
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            position: relative;
        }

        .auth-modal .custom-checkbox input[type="checkbox"]:checked + .checkmark {
            background: #059669;
            border-color: #059669;
        }

        .auth-modal .custom-checkbox input[type="checkbox"]:checked + .checkmark::after {
            content: '✓';
            color: white;
            font-size: 9px;
            font-weight: bold;
        }

        .auth-modal .btn-auth {
            width: 100%;
            padding: 0.75rem;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 8px;
            background: linear-gradient(135deg, #059669, #10b981);
            border: none;
            color: white;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .auth-modal .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(5, 150, 105, 0.3);
        }

        .auth-modal .btn-spinner {
            display: none;
        }

        .auth-modal .btn-auth:disabled .btn-spinner {
            display: inline-block;
        }

        .auth-modal .auth-links {
            text-align: center;
            margin-top: 0.75rem;
        }

        .auth-modal .forgot-link {
            color: #059669;
            text-decoration: none;
            font-size: 0.8rem;
            transition: color 0.3s ease;
        }

        .auth-modal .forgot-link:hover {
            color: #10b981;
            text-decoration: underline;
        }

        .auth-modal .auth-switch {
            text-align: center;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }

        .auth-modal .auth-switch p {
            color: var(--text-secondary);
            margin: 0;
            font-size: 0.8rem;
        }

        .auth-modal .register-link,
        .auth-modal .login-link {
            color: #059669;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .auth-modal .register-link:hover,
        .auth-modal .login-link:hover {
            color: #10b981;
            text-decoration: underline;
        }

        .auth-modal .features-list {
            margin-bottom: 0.5rem;
        }

        .auth-modal .feature-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            padding: 0.4rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 6px;
            backdrop-filter: blur(10px);
        }

        .auth-modal .feature-item i {
            font-size: 0.9rem;
        }

        .auth-modal .feature-item span {
            font-size: 0.8rem;
        }

        .auth-modal .password-strength {
            margin-top: 0.4rem;
        }

        .auth-modal .strength-bar {
            height: 3px;
            background: var(--gray-200);
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 0.2rem;
        }

        .auth-modal .strength-fill {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .auth-modal .strength-text {
            color: var(--text-muted);
            font-size: 0.65rem;
        }

        /* Modal Customizations */
        .modal-content {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            max-height: 90vh;
        }

        .modal-dialog {
            border-radius: 16px;
            max-height: 90vh;
        }

        .modal-header {
            background: transparent;
            padding: 1rem 1.5rem 0;
        }

        .btn-close {
            font-size: 1.25rem;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }

        .btn-close:hover {
            opacity: 1;
        }

        /* Responsive Modal */
        @media (max-width: 768px) {
            .auth-modal-side {
                display: none;
            }
            
            .auth-modal-form {
                padding: 1rem;
            }
            
            .modal-dialog {
                margin: 0.5rem;
                max-height: 95vh;
            }
            
            .modal-content {
                max-height: 95vh;
            }
        }

        @media (max-width: 576px) {
            .auth-modal-form {
                padding: 0.75rem;
            }
            
            .auth-header {
                margin-bottom: 1rem;
            }
            
            .auth-logo h4 {
                font-size: 1.1rem;
            }
            
            .auth-modal .form-group {
                margin-bottom: 0.75rem;
            }
        }
    </style>
    
    @stack('styles')
    
    </head>
<body>
    <div class="site-wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    🥩 Kitchen & Meat Store
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-home me-2"></i>Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">
                                <i class="fas fa-shopping-basket me-2"></i>Products
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">
                                    <i class="fas fa-user-plus me-2"></i>Register
                                </a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user me-2"></i>{{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    @if(Auth::user()->hasAnyRole(['Super Admin', 'Admin']))
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                                <i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                            <i class="fas fa-user-edit me-2"></i>Edit Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

    <div class="main-container" data-aos="fade-up">
        <div class="content-wrapper">
            @include('partials.messages')
            @yield('content')
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="auth-modal">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <div class="auth-modal-form">
                                    <div class="auth-header">
                                        <div class="auth-logo">
                                            <i class="fas fa-store"></i>
                                            <h4>Welcome Back</h4>
                                        </div>
                                        <p class="auth-subtitle">Login to your account</p>
                                    </div>

                                    <form method="POST" action="{{ route('login') }}" class="login-form">
                                        @csrf

                                        <div class="form-group">
                                            <label for="modal-email" class="form-label">
                                                <i class="fas fa-envelope me-2"></i>Email Address
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                                <input id="modal-email" type="email" 
                                                       class="form-control @error('email') is-invalid @enderror" 
                                                       name="email" 
                                                       value="{{ old('email') }}" 
                                                       placeholder="Enter your email address"
                                                       required 
                                                       autocomplete="email" 
                                                       autofocus>
                                            </div>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    <i class="fas fa-exclamation-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="modal-password" class="form-label">
                                                <i class="fas fa-lock me-2"></i>Password
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </span>
                                                <input id="modal-password" type="password" 
                                                       class="form-control @error('password') is-invalid @enderror" 
                                                       name="password" 
                                                       placeholder="Enter your password"
                                                       required 
                                                       autocomplete="current-password">
                                                <button class="btn btn-outline-secondary" type="button" id="modalTogglePassword">
                                                    <i class="fas fa-eye" id="modalEyeIcon"></i>
                                                </button>
                                            </div>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    <i class="fas fa-exclamation-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- <div class="form-group">
                                            <div class="custom-checkbox">
                                                <input class="form-check-input" type="checkbox" name="remember" id="modal-remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="modal-remember">
                                                    <span class="checkmark"></span>
                                                    Remember Me
                                                </label>
                                            </div>
                                        </div> --}}

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-auth w-100">
                                                <i class="fas fa-sign-in-alt me-2"></i>
                                                <span>Login to Account</span>
                                                <div class="btn-spinner">
                                                    <i class="fas fa-spinner fa-spin"></i>
                                                </div>
                                            </button>
                                        </div>

                                        @if (Route::has('password.request'))
                                            <div class="auth-links">
                                                <a href="{{ route('password.request') }}" class="forgot-link">
                                                    <i class="fas fa-question-circle me-1"></i>
                                                    Forgot Your Password?
                                                </a>
                                            </div>
                                        @endif
                                    </form>

                                    <div class="auth-switch">
                                        <p>Don't have an account? 
                                            <a href="#" class="register-link" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal">
                                                Sign Up
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="auth-modal-side">
                                    <h5>Join Our Fresh Food Community</h5>
                                    <p>Get access to exclusive deals and fresh products delivered to your doorstep.</p>
                                    
                                    <div class="features-list">
                                        <div class="feature-item">
                                            <i class="fas fa-truck"></i>
                                            <span>Fast Delivery</span>
                                        </div>
                                        <div class="feature-item">
                                            <i class="fas fa-shield-alt"></i>
                                            <span>Quality Guaranteed</span>
                                        </div>
                                        <div class="feature-item">
                                            <i class="fas fa-certificate"></i>
                                            <span>Halal Certified</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="auth-modal">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <div class="auth-modal-form">
                                    <div class="auth-header">
                                        <div class="auth-logo">
                                            <i class="fas fa-store"></i>
                                            <h4>Create Account</h4>
                                        </div>
                                        <p class="auth-subtitle">Join our fresh food community</p>
                                    </div>

                                    <form method="POST" action="{{ route('register') }}" class="register-form">
                                        @csrf

                                        <div class="form-group">
                                            <label for="modal-name" class="form-label">
                                                <i class="fas fa-user me-2"></i>Full Name
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-user"></i>
                                                </span>
                                                <input id="modal-name" type="text" 
                                                       class="form-control @error('name') is-invalid @enderror" 
                                                       name="name" 
                                                       value="{{ old('name') }}" 
                                                       placeholder="Enter your full name"
                                                       required 
                                                       autocomplete="name" 
                                                       autofocus>
                                            </div>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    <i class="fas fa-exclamation-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="modal-email-reg" class="form-label">
                                                <i class="fas fa-envelope me-2"></i>Email Address
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                                <input id="modal-email-reg" type="email" 
                                                       class="form-control @error('email') is-invalid @enderror" 
                                                       name="email" 
                                                       value="{{ old('email') }}" 
                                                       placeholder="Enter your email address"
                                                       required 
                                                       autocomplete="email">
                                            </div>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    <i class="fas fa-exclamation-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="modal-password-reg" class="form-label">
                                                <i class="fas fa-lock me-2"></i>Password
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </span>
                                                <input id="modal-password-reg" type="password" 
                                                       class="form-control @error('password') is-invalid @enderror" 
                                                       name="password" 
                                                       placeholder="Create a strong password"
                                                       required 
                                                       autocomplete="new-password">
                                                <button class="btn btn-outline-secondary" type="button" id="modalTogglePasswordReg">
                                                    <i class="fas fa-eye" id="modalEyeIconReg"></i>
                                                </button>
                                            </div>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    <i class="fas fa-exclamation-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="password-strength" id="modalPasswordStrength">
                                                <div class="strength-bar">
                                                    <div class="strength-fill"></div>
                                                </div>
                                                <small class="strength-text">Password strength</small>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="modal-password-confirm" class="form-label">
                                                <i class="fas fa-lock me-2"></i>Confirm Password
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </span>
                                                <input id="modal-password-confirm" type="password" 
                                                       class="form-control @error('password_confirmation') is-invalid @enderror" 
                                                       name="password_confirmation" 
                                                       placeholder="Confirm your password"
                                                       required 
                                                       autocomplete="new-password">
                                                <button class="btn btn-outline-secondary" type="button" id="modalToggleConfirmPassword">
                                                    <i class="fas fa-eye" id="modalConfirmEyeIcon"></i>
                                                </button>
                                            </div>
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">
                                                    <i class="fas fa-exclamation-circle me-1"></i>
                                                    Passwords must match
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-auth w-100">
                                                <i class="fas fa-user-plus me-2"></i>
                                                <span>Create Account</span>
                                                <div class="btn-spinner">
                                                    <i class="fas fa-spinner fa-spin"></i>
                                                </div>
                                            </button>
                                        </div>
                                    </form>

                                    <div class="auth-switch">
                                        <p>Already have an account? 
                                            <a href="#" class="login-link" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">
                                                Sign In
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="auth-modal-side">
                                    <h5>Start Your Fresh Food Journey</h5>
                                    <p>Create your account to unlock exclusive features and start ordering the freshest products.</p>
                                    
                                    <div class="features-list">
                                        <div class="feature-item">
                                            <i class="fas fa-box"></i>
                                            <span>Track Orders</span>
                                        </div>
                                        <div class="feature-item">
                                            <i class="fas fa-heart"></i>
                                            <span>Save Favorites</span>
                                        </div>
                                        <div class="feature-item">
                                            <i class="fas fa-gift"></i>
                                            <span>Loyalty Rewards</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <h5><i class="fas fa-store"></i> Fresh Kitchen & Meat Store</h5>
                    <p>Quality fresh products delivered to your doorstep. We bring the best kitchen essentials, fresh meat, and vegetables right to your home.</p>
                    <div class="footer-contact">
                        <span><i class="fas fa-phone"></i> +1 234 567 890</span>
                        <span><i class="fas fa-envelope"></i> orders@kitchenstore.com</span>
                        <span><i class="fas fa-map-marker-alt"></i> 123 Fresh Street, Market City</span>
                    </div>
                </div>
                
                <div class="footer-links">
                    <h6>Quick Links</h6>
                    <ul>
                        <li><a href="{{ route('home') }}"><i class="fas fa-home me-1"></i> Home</a></li>
                        <li><a href="{{ route('products.index') }}"><i class="fas fa-shopping-basket me-1"></i> Products</a></li>
                        <li><a href="#aboutUs"><i class="fas fa-info-circle me-1"></i> About Us</a></li>
                        {{-- <li><a href="#"><i class="fas fa-bullhorn me-1"></i> Offers</a></li> --}}
                    </ul>
                </div>
                
                <div class="footer-links">
                    <h6>Services</h6>
                    <ul>
                        <li> <i class="fas fa-truck me-1"></i> Fast Delivery </li>
                        <li>  <i class="fas fa-shield-alt me-1"></i> Quality Guarantee   </li>
                        {{-- <li><a href="#"><i class="fas fa-certificate me-1"></i> Halal Certified</a></li> --}}
                        <li> <i class="fas fa-headset me-1"></i> 24/7 Support </li>
                    </ul>
                </div>
                
                <div class="footer-social">
                    <h6>Follow Us</h6>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Kitchen & Meat Store. All rights reserved.</p>
                <p class="mb-0 small">
                    Made with <i class="fas fa-heart heart"></i> with Freshness in Laravel
                </p>
            </div>
        </div>
    </footer>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        // Modal Password Toggle Functions
        document.getElementById('modalTogglePassword')?.addEventListener('click', function() {
            const passwordInput = document.getElementById('modal-password');
            const eyeIcon = document.getElementById('modalEyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });

        document.getElementById('modalTogglePasswordReg')?.addEventListener('click', function() {
            const passwordInput = document.getElementById('modal-password-reg');
            const eyeIcon = document.getElementById('modalEyeIconReg');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });

        document.getElementById('modalToggleConfirmPassword')?.addEventListener('click', function() {
            const confirmPasswordInput = document.getElementById('modal-password-confirm');
            const confirmEyeIcon = document.getElementById('modalConfirmEyeIcon');
            
            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
                confirmEyeIcon.classList.remove('fa-eye');
                confirmEyeIcon.classList.add('fa-eye-slash');
            } else {
                confirmPasswordInput.type = 'password';
                confirmEyeIcon.classList.remove('fa-eye-slash');
                confirmEyeIcon.classList.add('fa-eye');
            }
        });

        // Password Strength Checker for Register Modal
        document.getElementById('modal-password-reg')?.addEventListener('input', function() {
            const password = this.value;
            const strengthFill = document.querySelector('#modalPasswordStrength .strength-fill');
            const strengthText = document.querySelector('#modalPasswordStrength .strength-text');
            
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]+/)) strength++;
            if (password.match(/[A-Z]+/)) strength++;
            if (password.match(/[0-9]+/)) strength++;
            if (password.match(/[$@#&!]+/)) strength++;
            
            const strengthPercentage = (strength / 5) * 100;
            strengthFill.style.width = strengthPercentage + '%';
            
            if (strength <= 2) {
                strengthFill.style.background = '#ef4444';
                strengthText.textContent = 'Weak password';
            } else if (strength <= 3) {
                strengthFill.style.background = '#f59e0b';
                strengthText.textContent = 'Medium password';
            } else {
                strengthFill.style.background = '#10b981';
                strengthText.textContent = 'Strong password';
            }
        });

        // Form Submission Loading States
        document.querySelector('.login-form')?.addEventListener('submit', function() {
            const submitBtn = this.querySelector('.btn-auth');
            submitBtn.disabled = true;
            submitBtn.querySelector('.btn-spinner').style.display = 'inline-block';
            submitBtn.querySelector('span').textContent = 'Logging in...';
        });

        document.querySelector('.register-form')?.addEventListener('submit', function() {
            const submitBtn = this.querySelector('.btn-auth');
            submitBtn.disabled = true;
            submitBtn.querySelector('.btn-spinner').style.display = 'inline-block';
            submitBtn.querySelector('span').textContent = 'Creating account...';
        });

        // Modal Reset on Close
        document.getElementById('loginModal')?.addEventListener('hidden.bs.modal', function () {
            this.querySelector('form')?.reset();
            const submitBtn = this.querySelector('.btn-auth');
            submitBtn.disabled = false;
            submitBtn.querySelector('.btn-spinner').style.display = 'none';
            submitBtn.querySelector('span').textContent = 'Login to Account';
            
            // Reset password visibility
            const passwordInput = document.getElementById('modal-password');
            const eyeIcon = document.getElementById('modalEyeIcon');
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        });

        document.getElementById('registerModal')?.addEventListener('hidden.bs.modal', function () {
            this.querySelector('form')?.reset();
            const submitBtn = this.querySelector('.btn-auth');
            submitBtn.disabled = false;
            submitBtn.querySelector('.btn-spinner').style.display = 'none';
            submitBtn.querySelector('span').textContent = 'Create Account';
            
            // Reset password visibility
            const passwordInput = document.getElementById('modal-password-reg');
            const confirmPasswordInput = document.getElementById('modal-password-confirm');
            const eyeIcon = document.getElementById('modalEyeIconReg');
            const confirmEyeIcon = document.getElementById('modalConfirmEyeIcon');
            
            passwordInput.type = 'password';
            confirmPasswordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
            confirmEyeIcon.classList.remove('fa-eye-slash');
            confirmEyeIcon.classList.add('fa-eye');
            
            // Reset password strength
            const strengthFill = document.querySelector('#modalPasswordStrength .strength-fill');
            const strengthText = document.querySelector('#modalPasswordStrength .strength-text');
            strengthFill.style.width = '0';
            strengthText.textContent = 'Password strength';
        });

        // Handle form validation errors in modals
        const loginModal = document.getElementById('loginModal');
        const registerModal = document.getElementById('registerModal');
        
        // Check for validation errors and open appropriate modal
        @if($errors->any())
            @if(request()->is('login'))
                loginModal?.addEventListener('shown.bs.modal', function () {
                    // Focus on first error field
                    const firstError = this.querySelector('.is-invalid');
                    if (firstError) {
                        firstError.focus();
                    }
                });
                // Auto-open login modal if there are login errors
                setTimeout(() => {
                    const modal = new bootstrap.Modal(loginModal);
                    modal.show();
                }, 100);
            @elseif(request()->is('register'))
                registerModal?.addEventListener('shown.bs.modal', function () {
                    // Focus on first error field
                    const firstError = this.querySelector('.is-invalid');
                    if (firstError) {
                        firstError.focus();
                    }
                });
                // Auto-open register modal if there are register errors
                setTimeout(() => {
                    const modal = new bootstrap.Modal(registerModal);
                    modal.show();
                }, 100);
            @endif
        @endif

        // Handle success messages and close modals
        @if(session('success'))
            setTimeout(() => {
                // Close any open modals on success
                bootstrap.Modal.getInstance(loginModal)?.hide();
                bootstrap.Modal.getInstance(registerModal)?.hide();
            }, 2000);
        @endif
    </script>
    </div> <!-- Close site-wrapper -->
</body>
</html>
