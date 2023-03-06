import { Grid } from "@mui/material";
import Container from "@mui/material/Container";
import React, { FC, ReactNode } from "react";

interface ICheckoutTemplate {
  checkoutTotal: ReactNode;
  form: ReactNode;
}

const CheckoutTemplate: FC<ICheckoutTemplate> = (props) => {
  const { checkoutTotal, form } = props;
  return (
    <Container>
      <Grid container spacing={3}>
        <Grid item md={8} lg={8} xs={12}>
          {form}
        </Grid>
        <Grid item md={4} lg={4} xs={12}>
          {checkoutTotal}
        </Grid>
      </Grid>
    </Container>
  );
};

export default CheckoutTemplate;
