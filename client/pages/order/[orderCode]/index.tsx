import {NextPageWithLayout} from "@/pages/_app";
import Head from "next/head";
import React, {ReactElement} from "react";
import AccountLayout from "@/layout/AccountLayout";
import {useRouter} from "next/router";
import OrderDetailTemplate from "@/components/templates/orders/orderDetail";
import {useQuery} from "react-query";
import orderAPI from "@/api/order";

const OrderDetail: NextPageWithLayout = () => {
    const router = useRouter();
    const {orderCode} = router.query;

    const orderDetailQuery = useQuery({
        queryKey: ['query-detail'],
        queryFn: () => {
            if (orderCode && typeof orderCode !== "object") {
                return orderAPI.getOrderDetail(orderCode);
            }
            return undefined;
        }
    })

    return <>
        <Head>
            <title>Order | DBRR store</title>
            <meta name="viewport" content="width=device-width, initial-scale=1"/>
            <link rel="icon" href="/favicon.ico"/>
        </Head>
        <OrderDetailTemplate/>
    </>

}

OrderDetail.getLayout = function getLayout(page: ReactElement) {
    return <AccountLayout>{page}</AccountLayout>
}
export default OrderDetail