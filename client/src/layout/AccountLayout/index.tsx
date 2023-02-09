import { Container, Grid } from "@mui/material";
import React, { FC, ReactElement } from "react";
import { BACKGROUND_COLOR } from "@/styles/color";
import CartDrawer from "../shared/CartDrawer";
import Header from "../shared/Header";
import SideBar from "./SideBar";

interface IAccountLayout {
  children: ReactElement;
}

const AccountLayout: FC<IAccountLayout> = ({ children }) => {
  return (
    <>
      <Header />
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
      <CartDrawer />
    </>
  );
};

export default AccountLayout;
