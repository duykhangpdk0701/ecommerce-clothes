/** @type {import('tailwindcss').Config} */
module.exports = {
  corePlugins: {
    preflight: false,
  },
  content: ["./pages/**/*.{js,ts,jsx,tsx}", "./src/**/*.{js,ts,jsx,tsx}"],
  important: "#root",
  theme: {
    extend: {
      colors: {
        "background-color": "#F6F9FC",
        "color-black": "#2B3445",
        "color-gray": "#7d879c",
        "color-light-gray": "#f6f9fc",
        "color-price": "#d23f57",
        "color-strong-blue": "#2B3445",
        "color-blue": "#2065D1",
        "admin-side-bar": "#2B3445",
      },
      borderColor: {
        "color-gray": "#DAE1E7",
      },
      backgroundColor: {
        "color-gray": "#DAE1E7",
      },
    },
  },
  plugins: [],
  important: true,
};
