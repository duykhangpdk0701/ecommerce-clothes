import ProductDetailTemplate from "@/components/templates/product/productDetails";
import HomeLayout from "@/layout/HomeLayout";
import { useRouter } from "next/router";
import React, { ReactElement } from "react";

const ProductDetail = () => {
  const router = useRouter();
  const { slug } = router.query;
  return (
    <>
      <ProductDetailTemplate />;
    </>
  );
};

ProductDetail.getLayout = function getLayout(page: ReactElement) {
  return <HomeLayout>{page}</HomeLayout>;
};

export default ProductDetail;
