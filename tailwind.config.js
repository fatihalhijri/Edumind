import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    // Dark mode via class "dark" di <html>
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            // ── Font Families ──────────────────────────────────────────────
            fontFamily: {
                sans:  ['Outfit', ...defaultTheme.fontFamily.sans],
                serif: ['Syne', ...defaultTheme.fontFamily.serif],
                mono:  ['JetBrains Mono', ...defaultTheme.fontFamily.mono],
            },

            // ── Brand Colors (EduMind "Neural Clarity") ─────────────────────
            colors: {
                // Indigo – warna utama brand
                indigo: {
                    50:  '#eef2ff',
                    100: '#e0e7ff',
                    200: '#c7d2fe',
                    300: '#a5b4fc',
                    400: '#818cf8',
                    500: '#6366f1',
                    600: '#4f46e5',
                    700: '#4338ca',
                    800: '#3730a3',
                    900: '#312e81',
                    950: '#1e1b4b',
                },
                // Violet – secondary accent (AI features)
                violet: {
                    50:  '#f5f3ff',
                    100: '#ede9fe',
                    200: '#ddd6fe',
                    300: '#c4b5fd',
                    400: '#a78bfa',
                    500: '#8b5cf6',
                    600: '#7c3aed',
                    700: '#6d28d9',
                    800: '#5b21b6',
                    900: '#4c1d95',
                },
                // Slate – neutral text & surfaces
                slate: {
                    50:  '#f8fafc',
                    100: '#f1f5f9',
                    200: '#e2e8f0',
                    300: '#cbd5e1',
                    400: '#94a3b8',
                    500: '#64748b',
                    600: '#475569',
                    700: '#334155',
                    800: '#1e293b',
                    900: '#0f172a',
                    950: '#020617',
                },
                // Semantic
                success: { DEFAULT: '#10b981', light: '#f0fdf4', border: '#bbf7d0', text: '#15803d' },
                warning: { DEFAULT: '#f59e0b', light: '#fefce8', border: '#fef08a', text: '#a16207' },
                danger:  { DEFAULT: '#ef4444', light: '#fef2f2', border: '#fecaca', text: '#dc2626' },
                info:    { DEFAULT: '#3b82f6', light: '#eff6ff', border: '#bfdbfe', text: '#2563eb' },
            },

            // ── Font Sizes ────────────────────────────────────────────────
            fontSize: {
                'xs':  ['0.75rem',  { lineHeight: '1rem' }],
                'sm':  ['0.875rem', { lineHeight: '1.25rem' }],
                'base':['1rem',     { lineHeight: '1.625rem' }],
                'lg':  ['1.125rem', { lineHeight: '1.75rem' }],
                'xl':  ['1.25rem',  { lineHeight: '1.875rem' }],
                '2xl': ['1.5rem',   { lineHeight: '2rem' }],
                '3xl': ['1.875rem', { lineHeight: '2.25rem' }],
                '4xl': ['2.25rem',  { lineHeight: '2.5rem' }],
                '5xl': ['3rem',     { lineHeight: '1.1' }],
                '6xl': ['3.75rem',  { lineHeight: '1.05' }],
                '7xl': ['4.5rem',   { lineHeight: '1.05' }],
            },

            // ── Spacing ───────────────────────────────────────────────────
            spacing: {
                '4.5': '1.125rem',
                '13': '3.25rem',
                '15': '3.75rem',
                '18': '4.5rem',
                '22': '5.5rem',
            },

            // ── Border Radius ─────────────────────────────────────────────
            borderRadius: {
                'sm':  '8px',
                DEFAULT: '10px',
                'md':  '12px',
                'lg':  '16px',
                'xl':  '20px',
                '2xl': '24px',
            },

            // ── Box Shadow ────────────────────────────────────────────────
            boxShadow: {
                'sm':   '0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04)',
                'md':   '0 4px 16px rgba(0,0,0,0.08), 0 2px 6px rgba(0,0,0,0.04)',
                'lg':   '0 12px 40px rgba(0,0,0,0.12), 0 4px 12px rgba(0,0,0,0.06)',
                'xl':   '0 24px 64px rgba(0,0,0,0.16), 0 8px 24px rgba(0,0,0,0.08)',
                'glow': '0 0 24px rgba(99,102,241,0.25)',
                'glow-violet': '0 0 24px rgba(124,58,237,0.3)',
                'card': '0 1px 3px rgba(0,0,0,0.06)',
                'card-hover': '0 8px 24px rgba(0,0,0,0.1)',
            },

            // ── Transitions ───────────────────────────────────────────────
            transitionTimingFunction: {
                'smooth': 'cubic-bezier(0.4, 0, 0.2, 1)',
            },

            // ── Animations ────────────────────────────────────────────────
            keyframes: {
                fadeInUp: {
                    '0%':   { opacity: '0', transform: 'translateY(16px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                fadeIn: {
                    '0%':   { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                shimmer: {
                    '0%':   { backgroundPosition: '-200% 0' },
                    '100%': { backgroundPosition: '200% 0' },
                },
                pulseGlow: {
                    '0%, 100%': { boxShadow: '0 0 0 0 rgba(99,102,241,0)' },
                    '50%':      { boxShadow: '0 0 0 8px rgba(99,102,241,0.15)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%':      { transform: 'translateY(-8px)' },
                },
                slideInRight: {
                    '0%':   { opacity: '0', transform: 'translateX(40px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                slideInLeft: {
                    '0%':   { opacity: '0', transform: 'translateX(-20px)' },
                    '100%': { opacity: '1', transform: 'translateX(0)' },
                },
                countUp: {
                    '0%':   { opacity: '0', transform: 'translateY(10px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                confettiFall: {
                    '0%':   { transform: 'translateY(-100px) rotate(0deg)', opacity: '1' },
                    '100%': { transform: 'translateY(100vh) rotate(720deg)', opacity: '0' },
                },
                orbit: {
                    '0%':   { transform: 'rotate(0deg) translateX(24px) rotate(0deg)' },
                    '100%': { transform: 'rotate(360deg) translateX(24px) rotate(-360deg)' },
                },
            },
            animation: {
                'fade-in-up':    'fadeInUp 0.4s cubic-bezier(0.4,0,0.2,1) both',
                'fade-in':       'fadeIn 0.3s ease both',
                'shimmer':       'shimmer 1.5s infinite',
                'pulse-glow':    'pulseGlow 2s infinite',
                'float':         'float 6s ease-in-out infinite',
                'slide-in-right':'slideInRight 0.35s cubic-bezier(0.4,0,0.2,1) both',
                'slide-in-left': 'slideInLeft 0.3s cubic-bezier(0.4,0,0.2,1) both',
                'orbit':         'orbit 3s linear infinite',
            },

            // ── Max Width ─────────────────────────────────────────────────
            maxWidth: {
                'quiz':    '680px',
                'content': '1280px',
            },

            // ── Sidebar Width ─────────────────────────────────────────────
            width: {
                'sidebar': '260px',
            },

            // ── Z-Index ───────────────────────────────────────────────────
            zIndex: {
                'sidebar':  '40',
                'topbar':   '30',
                'modal':    '50',
                'toast':    '9999',
            },
        },
    },

    plugins: [
        forms,
    ],
};
