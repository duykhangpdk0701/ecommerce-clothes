const withTM = require("next-transpile-modules")([
  "@mui/material",
  "@mui/system",
  "@mui/icons-material", // If @mui/icons-material is being used
]);

/** @type {import('next').NextConfig} */
const nextConfig = {
  reactStrictMode: true,
  webpack: (config) => {
    config.resolve.alias = {
      ...config.resolve.alias,
    };
    return config;
  },
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

module.exports = withTM(nextConfig);
