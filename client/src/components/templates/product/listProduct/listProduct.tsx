import IProduct from "@/interfaces/Product";

import React, { FC } from "react";

import ListProductItem from "./listProductItem";

interface IListProduct {
  data?: IProduct[];
}

const ListProducts: FC<IListProduct> = (props) => {
  const { data } = props;

  return (
    <div>
      {data?.map((item) => (
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
