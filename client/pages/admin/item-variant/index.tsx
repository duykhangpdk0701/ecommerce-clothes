import adminItemVariantAPI from "@/api/admin/adminItemVariant";
import AdminLayout from "@/layout/AdminLayout";
import { NextPageWithLayout } from "@/pages/_app";
import Head from "next/head";
import React, { ReactElement } from "react";
import { useQuery } from "react-query";

const ItemVariant: NextPageWithLayout = () => {
  const ItemVariantQuery = useQuery({
    queryKey: "item-variant",
    queryFn: () => adminItemVariantAPI.getListOfItemVariant(),
  });
  return (
    <>
      <Head>
        <title>Item Variant Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <div></div>
    </>
  );
};

ItemVariant.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default ItemVariant;
