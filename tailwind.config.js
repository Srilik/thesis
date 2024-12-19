import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "./public/build/assets/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: "#002e77",
                darkPrimary: "#081b45",
                brand: {
                    50: "#e8f8ff",
                    100: "#d5f1ff",
                    200: "#b4e3ff",
                    300: "#87ceff",
                    400: "#58a9ff",
                    500: "#3285ff",
                    600: "#105aff",
                    700: "#064ffc",
                    800: "#0946ca",
                    900: "#12419d",
                    950: "#081b45",
                },
                bush: {
                    50: "#f2fbf3",
                    100: "#e2f6e4",
                    200: "#c6ecca",
                    300: "#9adba2",
                    400: "#66c272",
                    500: "#41a64e",
                    600: "#31883c",
                    700: "#296c32",
                    800: "#25562c",
                    900: "#204726",
                    950: "#113317",
                },
                border: "hsl(var(--border))",
                input: "hsl(var(--input))",
                ring: "hsl(var(--ring))",
                background: "hsl(var(--background))",
                foreground: "hsl(var(--foreground))",
                // primary: {
                //     DEFAULT: "hsl(var(--primary))",
                //     foreground: "hsl(var(--primary-foreground))",
                // },
                // secondary: {
                //     DEFAULT: "hsl(var(--secondary))",
                //     foreground: "hsl(var(--secondary-foreground))",
                // },
                destructive: {
                    DEFAULT: "hsl(var(--destructive))",
                    foreground: "hsl(var(--destructive-foreground))",
                },
                muted: {
                    DEFAULT: "hsl(var(--muted))",
                    foreground: "hsl(var(--muted-foreground))",
                },
                accent: {
                    DEFAULT: "hsl(var(--accent))",
                    foreground: "hsl(var(--accent-foreground))",
                },
                popover: {
                    DEFAULT: "hsl(var(--popover))",
                    foreground: "hsl(var(--popover-foreground))",
                },
                card: {
                    DEFAULT: "hsl(var(--card))",
                    foreground: "hsl(var(--card-foreground))",
                },
            },
        },
    },

    plugins: [forms, require("daisyui")],
    daisyui: {
        themes: ["light", "dark"],
    },
};
