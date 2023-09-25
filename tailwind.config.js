/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.tsx",
    "./resources/js/**/*.ts"
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: "#bf8802",
          dark: "#8F5F00",
          content: "white"
        },
        secondary: {
          DEFAULT: "#077012",
          dark: "#04470B",
          content: "white"
        },
        accent: {
          DEFAULT: "#061d8e",
          dark: "#020d42",
          content: "white"
        },
        success: {
          DEFAULT: "#259A35",
          dark: "#1a6900",
          content: "white"
        },
        error: {
          DEFAULT: "#E31E36",
          dark: "#D11E36",
          content: "white"
        },
        disable: {
          DEFAULT: "#DDD",
          dark: "#BDBDBD",
          content: "white"
        }
      }
    }
  },
  plugins: []
};
