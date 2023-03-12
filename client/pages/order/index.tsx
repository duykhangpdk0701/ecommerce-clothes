import { NextPageWithLayout } from "@/pages/_app";
import React, { ReactElement } from "react";
import AccountLayout from "@/layout/AccountLayout";
import ListOrdersTemplate from "@/components/templates/orders/listOrders";
import { useQuery } from "react-query";
import orderAPI from "@/api/order";
import Head from "next/head";

const Order: NextPageWithLayout = () => {
  const listOrderQuery = useQuery({
    queryKey: ["order"],
    queryFn: () => orderAPI.getList(),
  });

  return (
    <>
      <Head>
        <title>Order | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <ListOrdersTemplate
        loading={listOrderQuery.isLoading}
        data={listOrderQuery.data}
      />
    </>
  );
};

Order.getLayout = function getLayout(page: ReactElement) {
  return <AccountLayout>{page}</AccountLayout>;
};

export default Order;
