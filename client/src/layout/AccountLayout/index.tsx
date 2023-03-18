import Container from "@mui/material/Container";
import Grid from "@mui/material/Grid";
import React, { FC, ReactElement } from "react";
import { BACKGROUND_COLOR } from "@/styles/color";
import CartDrawer from "../shared/CartDrawer";
import Header from "../shared/Header";
import SideBar from "./SideBar";
import { useQuery } from "react-query";
import cartAPI from "@/api/cartAPI";

interface IAccountLayout {
  children: ReactElement;
}

const AccountLayout: FC<IAccountLayout> = ({ children }) => {
  const cartQuery = useQuery({
    queryKey: ["cart"],
    queryFn: () => cartAPI.getQuoteByUser(),
    onSuccess: (data) => {
      sessionStorage.setItem("quoteId", data.id.toString());
    },
  });

  return (
    <>
      <Header
        quoteItemLength={
          cartQuery.data ? cartQuery.data.quote_detail?.length : 0
        }
      />
      <main className={`bg-[${BACKGROUND_COLOR}]`}>
        <Container className="my-8">
          <Grid container spacing={3}>
            <Grid item xs={3}>
              <SideBar />
            </Grid>
            <Grid item xs={9}>
              {children}
            </Grid>
          </Grid>
        </Container>
      </main>
      <CartDrawer
        loading={cartQuery.isLoading}
        data={cartQuery?.data?.quote_detail}
        quoteItemLength={
          cartQuery.data ? cartQuery.data.quote_detail.length : 0
        }
      />
    </>
  );
};

export default AccountLayout;
