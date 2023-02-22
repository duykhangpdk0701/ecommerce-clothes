import AdminLayout from "@/layout/AdminLayout";
import Head from "next/head";
import React, { ReactElement } from "react";
import { NextPageWithLayout } from "../../_app";
import ListProductTemplate from "@/components/templates/admin/product/ListProduct";
import { useQuery } from "react-query";
import adminItemAPI from "@/api/admin/adminItemAPI";

const Product: NextPageWithLayout = () => {
  const listProductQuery = useQuery({
    queryKey: "products",
    queryFn: () => adminItemAPI.getListOfItem(),
  });

  return (
    <>
      <Head>
        <title>Product Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <ListProductTemplate />
    </>
  );
};

Product.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default Product;
