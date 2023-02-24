import adminItemColorAPI from "@/api/admin/adminItemColor";
import ListItemColorTemplate from "@/components/templates/admin/itemColor/list";
import AdminLayout from "@/layout/AdminLayout";
import Head from "next/head";
import React, { ReactElement } from "react";
import { useQuery } from "react-query";
import { NextPageWithLayout } from "@/pages/_app";

const ItemColor: NextPageWithLayout = () => {
  const itemColorQuery = useQuery({
    queryKey: ["item-color"],
    queryFn: adminItemColorAPI.getListOfItemColor,
  });

  return (
    <>
      <Head>
        <title>Item Color Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <ListItemColorTemplate data={itemColorQuery.data} />
    </>
  );
};

ItemColor.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default ItemColor;
