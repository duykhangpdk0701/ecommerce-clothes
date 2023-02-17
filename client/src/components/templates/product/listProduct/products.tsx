import Grid from "@mui/material/Grid";
import React from "react";
import ProductItem from "./productItem";

const ListProductProducts = () => {
  return (
    <div>
      <Grid container spacing={3}>
        <ProductItem />
        <ProductItem />
        <ProductItem />
        <ProductItem />
        <ProductItem />
        <ProductItem />
      </Grid>
    </div>
  );
};

export default ListProductProducts;
