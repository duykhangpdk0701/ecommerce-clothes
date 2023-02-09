import ListOrdersTemplate from "@/components/templates/orders/listOrders";
import AccountLayout from "@/layout/AccountLayout";
import React, { ReactElement } from "react";

const Orders = () => {
  return <ListOrdersTemplate />;
};

Orders.getLayout = function getLayout(page: ReactElement) {
  return <AccountLayout>{page}</AccountLayout>;
};

export default Orders;
