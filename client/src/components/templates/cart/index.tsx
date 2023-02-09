import { Container, Grid } from "@mui/material";
import React from "react";
import CartBreadCrumb from "../../shared/CartBreadCrumb";
import CartList from "./cartList";
import CartTotal from "./cartTotal";

const CartTemplate = () => {
  return (
    <Container className="my-8">
      <CartBreadCrumb />
      <Grid container spacing={3}>
        <Grid item xs={8}>
          <CartList />
        </Grid>
        <Grid item xs={4}>
          <CartTotal />
        </Grid>
      </Grid>
    </Container>
  );
};

export default CartTemplate;
