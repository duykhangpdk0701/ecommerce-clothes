import { NextPageWithLayout } from "@/pages/_app";
import Head from "next/head";
import React, { ReactElement } from "react";
import AccountLayout from "@/layout/AccountLayout";
import { useRouter } from "next/router";
import OrderDetailTemplate from "@/components/templates/orders/orderDetail";
import { useQuery } from "react-query";
import orderAPI from "@/api/order";
import DeliveryProgress from "@/components/templates/orders/orderDetail/deliveryProgress";
import OrderDetailListItem from "@/components/templates/orders/orderDetail/listItem";
import OrderDetailInfo from "@/components/templates/orders/orderDetail/infor";

const OrderDetail: NextPageWithLayout = () => {
  const router = useRouter();
  const { orderCode } = router.query;

  const orderDetailQuery = useQuery({
    queryKey: ["query-detail"],
    queryFn: () => {
      if (orderCode && typeof orderCode !== "object") {
        return orderAPI.getOrderDetail(orderCode);
      }
      return undefined;
    },
  });

  return (
    <>
      <Head>
        <title>Order | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <OrderDetailTemplate
        deliveryProgress={<DeliveryProgress />}
        listItem={
          <OrderDetailListItem
            listItem={orderDetailQuery.data?.order_items}
            id={orderDetailQuery.data?.id}
            placeOn={orderDetailQuery.data?.created_at}
          />
        }
        infor={
          <OrderDetailInfo
            address={orderDetailQuery.data?.shipping_address}
            subtotal={orderDetailQuery.data?.total_price}
            shippingCost={orderDetailQuery.data?.total_shipping}
            discount={orderDetailQuery.data?.total_discount}
            total={orderDetailQuery.data?.total}
          />
        }
      />
    </>
  );
};

OrderDetail.getLayout = function getLayout(page: ReactElement) {
  return <AccountLayout>{page}</AccountLayout>;
};
export default OrderDetail;
