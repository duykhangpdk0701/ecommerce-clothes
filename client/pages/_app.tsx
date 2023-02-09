//css
import "@/styles/globals.css";
import "react-perfect-scrollbar/dist/css/styles.css";
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
//next
import { ReactElement, ReactNode, useEffect, useMemo, useState } from "react";
import type { AppProps } from "next/app";
import { NextPage } from "next";
import { Router } from "next/router";
import Head from "next/head";
import Script from "next/script";
//mui
import { createTheme } from "@mui/material/styles";
import { CssBaseline } from "@mui/material";
import { LocalizationProvider } from "@mui/x-date-pickers/LocalizationProvider";
import { AdapterMoment } from "@mui/x-date-pickers/AdapterMoment";
//component
import typography from "@/themes/typography";
import NProgress from "nprogress";
import { QueryClient, QueryClientProvider } from "react-query";
import { wrapper } from "@/contexts/store";
import palette from "@/themes/palette";
import shadows from "@/themes/shadows";
import GlobalStyles from "@/themes/globalStyles";
import customShadows from "@/themes/customShadows";
import componentsOverride from "@/themes/overrides";
import { EmotionCache } from "@emotion/cache";
import { CacheProvider } from "@emotion/react";
import createEmotionCache from "@/utils/CreateEmotionCache";
import ThemeProvider from "@/themes/index";

export type NextPageWithLayout<P = {}, IP = P> = NextPage<P, IP> & {
  getLayout?: (page: ReactElement) => ReactNode;
};

interface MyAppProps extends AppProps {
  emotionCache?: EmotionCache;
  Component: NextPageWithLayout;
}

const clientSideEmotionCache = createEmotionCache();

function MyApp(props: MyAppProps) {
  const { Component, emotionCache = clientSideEmotionCache, pageProps } = props;

  // Use the layout defined at the page level, if available
  const getLayout = Component.getLayout ?? ((page) => page);

  const layout = getLayout(<Component {...pageProps} />);

  const queryClient = new QueryClient();

  useEffect(() => {
    NProgress.configure({});
    Router.events.on("routeChangeStart", (url) => {
      NProgress.start();
    });

    Router.events.on("routeChangeComplete", (url) => {
      NProgress.done(false);
    });
  }, [Router]);

  const themeOptions = useMemo(
    () => ({
      palette,
      shape: { borderRadius: 6 },
      typography,
      shadows: shadows(),
      customShadows: customShadows(),
    }),
    []
  );

  const theme = createTheme(themeOptions);
  theme.components = componentsOverride(theme);

  return (
    <CacheProvider value={emotionCache}>
      <Head>
        <link
          rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css"
          integrity="sha512-42kB9yDlYiCEfx2xVwq0q7hT4uf26FUgSIZBK8uiaEnTdShXjwr8Ip1V4xGJMg3mHkUt9nNuTDxunHF0/EgxLQ=="
          referrerPolicy="no-referrer"
          crossOrigin="anonymous"
        />
        <link
          rel="stylesheet"
          href="https://unpkg.com/react-quill@1.3.3/dist/quill.snow.css"
        />
      </Head>
      <QueryClientProvider client={queryClient}>
        <ThemeProvider>
          <CssBaseline />
          <GlobalStyles />
          <LocalizationProvider dateAdapter={AdapterMoment}>
            {layout}
          </LocalizationProvider>
        </ThemeProvider>
      </QueryClientProvider>
      <Script>
        <script
          src="https://unpkg.com/react@16/umd/react.development.js"
          crossOrigin="anonymous"
        ></script>
        <script
          src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"
          crossOrigin="anonymous"
        ></script>
        <script src="https://unpkg.com/react-quill@1.3.3/dist/react-quill.js"></script>
        <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
        <script type="text/babel" src="/my-scripts.js"></script>
      </Script>
    </CacheProvider>
  );
}

export default wrapper.withRedux(MyApp);
