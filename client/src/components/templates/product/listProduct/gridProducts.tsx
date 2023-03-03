import IProduct from "@/interfaces/Product";
import Grid from "@mui/material/Grid";
import React, { FC } from "react";
import GridProductItem from "./gridProductItem";

interface IGridProducts {
  data?: IProduct[];
}

const GridProducts: FC<IGridProducts> = (props) => {
  const { data } = props;
  return (
    <div>
      <Grid container spacing={3}>
        {data?.map((item) => (
          <Grid key={item.id} item xs={4}>
            <GridProductItem
              slug={item.slug}
              name={item.name}
              price={item.stock_lowest_price}
              thumbnail={item.thumbnail_url}
            />
          </Grid>
        ))}
      </Grid>
    </div>
  );
};

export default GridProducts;
