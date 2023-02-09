const withTM = require("next-transpile-modules")(["@mui/material"]);

/** @type {import('next').NextConfig} */
const nextConfig = {
  reactStrictMode: true,
  // experimental: {
  //   modularizeImports: {
  //     "@mui/material/?(((\\w*)?/?)*)": {
  //       transform: "@mui/material/{{ matches.[1] }}/{{member}}",
  //     },
  //     "@mui/icons-material/?(((\\w*)?/?)*)": {
  //       transform: "@mui/icons-material/{{ matches.[1] }}/{{member}}",
  //     },
  //     "@mui/material/styles/?(((\\w*)?/?)*)": {
  //       transform: "@mui/material/styles/{{ matches.[1] }}/{{member}}",
  //     },
  //   },
  // },
};

module.exports = nextConfig;
