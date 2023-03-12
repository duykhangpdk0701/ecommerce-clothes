import adminItemStockAPI from "@/api/admin/adminItemStockAPI";
import ListItemStockTemplate from "@/components/templates/admin/itemStock/list";
import AdminLayout from "@/layout/AdminLayout";
import { NextPageWithLayout } from "@/pages/_app";
import Head from "next/head";
import React, { ReactElement } from "react";
import { useQuery } from "react-query";

const ItemStock: NextPageWithLayout = () => {
  const itemStockQuery = useQuery({
    queryKey: "item-stock",
    queryFn: () => adminItemStockAPI.getListOfItemStock(),
  });

  return (
    <>
      <Head>
        <title>Item Size Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <ListItemStockTemplate data={itemStockQuery.data} />
    </>
  );
};

ItemStock.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default ItemStock;
