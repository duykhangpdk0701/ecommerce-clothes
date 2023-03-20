import IProduct from "@/interfaces/Product";
import Grid from "@mui/material/Grid";
import React, { FC } from "react";
import GridProductItem from "./gridProductItem";
import GridProductItemLoading from "./gridProductItemLoading";

interface IGridProducts {
  data?: IProduct[];
  loading: boolean;
}

const GridProducts: FC<IGridProducts> = (props) => {
  const { data, loading } = props;
  return (
    <div>
      <Grid container spacing={3}>
        {loading
          ? [...Array(9)].map((_, index) => (
              <Grid item xs={4} key={index}>
                <GridProductItemLoading />
              </Grid>
            ))
          : data?.map((item) => (
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
