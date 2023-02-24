import adminItemSizeAPI from "@/api/admin/adminItemSize";
import ListItemSizeTemplate from "@/components/templates/admin/itemSize/list";
import AdminLayout from "@/layout/AdminLayout";
import Head from "next/head";
import React, { ReactElement } from "react";
import { useQuery } from "react-query";
import { NextPageWithLayout } from "@/pages/_app";

const ItemSize: NextPageWithLayout = () => {
  const itemSizeQuery = useQuery(
    "item-size",
    adminItemSizeAPI.getListOfItemSize
  );
  return (
    <>
      <Head>
        <title>Item Size Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <ListItemSizeTemplate data={itemSizeQuery.data} />
    </>
  );
};

ItemSize.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default ItemSize;
