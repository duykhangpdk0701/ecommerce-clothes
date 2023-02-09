import { Container, Grid } from "@mui/material";
import React from "react";
import ListProductProducts from "./products";
import ListProductSideBar from "./sideBar";
import ListProductSortBar from "./sortBar";

const ListProductTemplate = () => {
  return (
    <Container className="my-8">
      <ListProductSortBar />
      <div>
        <Grid container spacing={3}>
          <Grid item xs={3}>
            <ListProductSideBar />
          </Grid>
          <Grid item xs={9}>
            <ListProductProducts />
          </Grid>
        </Grid>
      </div>
    </Container>
  );
};

export default ListProductTemplate;
