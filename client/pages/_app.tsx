//css
import "@/styles/globals.css";
import "react-perfect-scrollbar/dist/css/styles.css";
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
//next
import { ReactElement, ReactNode, useEffect } from "react";
import type { AppProps } from "next/app";
import { NextPage } from "next";
import { Router } from "next/router";
//mui
import CssBaseline from "@mui/material/CssBaseline";
import StyledEngineProvider from "@mui/material/StyledEngineProvider";
import { LocalizationProvider } from "@mui/x-date-pickers/LocalizationProvider";
import { AdapterMoment } from "@mui/x-date-pickers/AdapterMoment";
//component
import NextNProgress from "nextjs-progressbar";
import { QueryClient, QueryClientProvider } from "react-query";
import { wrapper } from "@/contexts/store";
import GlobalStyles from "@/themes/globalStyles";
import { EmotionCache } from "@emotion/cache";
import { CacheProvider } from "@emotion/react";
import createEmotionCache from "@/utils/createEmotionCache";
import ThemeProvider from "@/themes/index";
import ActionSnackbar from "@/components/shared/actionSnackBar";
import { Route } from "@mui/icons-material";

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

  return (
    <StyledEngineProvider injectFirst>
      <CacheProvider value={emotionCache}>
        <QueryClientProvider client={queryClient}>
          <ThemeProvider>
            <CssBaseline />
            <GlobalStyles />
            <LocalizationProvider dateAdapter={AdapterMoment}>
              {layout}
              <ActionSnackbar />
              <NextNProgress
                color="#29D"
                startPosition={0.3}
                stopDelayMs={200}
                height={3}
                showOnShallow={false}
              />
            </LocalizationProvider>
          </ThemeProvider>
        </QueryClientProvider>
      </CacheProvider>
    </StyledEngineProvider>
  );
}

export default wrapper.withRedux(MyApp);
