import Container from "@mui/material/Container";
import Grid from "@mui/material/Grid";
import React, { ReactElement, FC } from "react";

interface ICartTemplate {
  cartList: ReactElement;
  cartTotal: ReactElement;
}

const CartTemplate: FC<ICartTemplate> = (props) => {
  const { cartList, cartTotal } = props;
  return (
    <Container className="my-8">
      {/* <CartBreadCrumb /> */}
      <Grid container spacing={3}>
        <Grid item xs={8}>
          {cartList}
        </Grid>
        <Grid item xs={4}>
          {cartTotal}
        </Grid>
      </Grid>
    </Container>
  );
};

export default CartTemplate;
