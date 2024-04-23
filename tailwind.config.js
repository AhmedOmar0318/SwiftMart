/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./includes/**/*.{php,js}","./navbar/**/*.{php,js}"],
  theme: {
    extend: {},
  },
  plugins: [
    require("daisyui"),
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ],
}
