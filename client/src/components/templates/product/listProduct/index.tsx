import Container from "@mui/material/Container";
import Grid from "@mui/material/Grid";
import React, { FC, ReactNode } from "react";

interface IListProductTemplate {
  listProductSortBar: ReactNode;
  listProductSideBar: ReactNode;
  listProductProducts: ReactNode;
}

const ListProductTemplate: FC<IListProductTemplate> = (props) => {
  const { listProductSortBar, listProductSideBar, listProductProducts } = props;

  return (
    <Container className="my-8">
      {listProductSortBar}
      <div>
        <Grid container spacing={3}>
          <Grid item xs={3}>
            {listProductSideBar}
          </Grid>
          <Grid item xs={9}>
            {listProductProducts}
          </Grid>
        </Grid>
      </div>
    </Container>
  );
};

export default ListProductTemplate;
