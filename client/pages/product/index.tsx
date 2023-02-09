import ListProductTemplate from "@/components/templates/product/listProduct";
import HomeLayout from "@/layout/HomeLayout";
import Head from "next/head";
import React, { ReactElement } from "react";

const Product = () => {
  return (
    <>
      <Head>
        <title>Product | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <ListProductTemplate />;
    </>
  );
};

Product.getLayout = function getLayout(page: ReactElement) {
  return <HomeLayout>{page}</HomeLayout>;
};

export default Product;
