import React, { FC, ReactNode } from "react";

interface IProductDetailTemplate {
  productContent: ReactNode;
}

const ProductDetailTemplate: FC<IProductDetailTemplate> = (props) => {
  const { productContent } = props;
  return <div>{productContent}</div>;
};

export default ProductDetailTemplate;
