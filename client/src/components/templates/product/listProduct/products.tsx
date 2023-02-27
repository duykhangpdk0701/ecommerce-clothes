import IProduct from "@/interfaces/Product";
import Grid from "@mui/material/Grid";
import React, { FC } from "react";
import ProductItem from "./productItem";

interface IListProductProducts {
  data?: IProduct[];
}

const ListProductProducts: FC<IListProductProducts> = (props) => {
  const { data } = props;
  return (
    <div>
      <Grid container spacing={3}>
        {data?.map((item) => (
          <ProductItem
            key={item.id}
            slug={item.slug}
            name={item.name}
            price={item.stock_lowest_price}
            thumbnail={item.thumbnail_url}
          />
        ))}
      </Grid>
    </div>
  );
};

export default ListProductProducts;
