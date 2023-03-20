import IProduct from "@/interfaces/Product";

import React, { FC, ReactElement } from "react";

import ListProductItem from "./listProductItem";
import ListProductItemLoading from "./listProductItemLoading";

interface IListProduct {
  data?: IProduct[];
  loading: boolean;
}

const ListProducts: FC<IListProduct> = (props) => {
  const { data, loading } = props;

  return (
    <div>
      {loading
        ? [...Array(9)].map((_, index) => (
            <ListProductItemLoading key={index} />
          ))
        : data?.map((item) => (
            <ListProductItem
              key={item.id}
              slug={item.slug}
              name={item.name}
              price={item.stock_lowest_price}
              thumbnail={item.thumbnail_url}
            />
          ))}
    </div>
  );
};

export default ListProducts;
