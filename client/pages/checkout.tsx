import CheckoutTemplate from "@/components/templates/checkout";
import CheckoutFormAddress from "@/components/templates/checkout/form/address";
import CheckoutFormPayment from "@/components/templates/checkout/form/paymentDetail";
import CheckoutTotal from "@/components/templates/checkout/total";
import HomeLayout from "@/layout/HomeLayout";
import {ReactElement} from "react";
import {NextPageWithLayout} from "./_app";
import {useQuery} from "react-query";
import cartAPI from "@/api/cartAPI";
import Head from "next/head";
import addressAPI from "@/api/address";
import checkoutAPI from "@/api/checkout";
import {SubmitHandler, useForm} from "react-hook-form";

export interface ICheckoutParams {
    quoteId: number,
    shipping: {
        name: string,
        cityId: number,
        districtId: number,
        wardId: number,
        address: string,
        phone: string,
    }
    comment: string,
    paymentMethod: number,
}

const Checkout: NextPageWithLayout = () => {
    const quoteQuery = useQuery({
        queryKey: ['quote'],
        queryFn: () => cartAPI.getQuoteByUser()
    })

    const listAddress = useQuery({
        queryKey: ['address'],
        queryFn: () => addressAPI.getList()
    })

    const listPaymentMethod = useQuery({
        queryKey: ['payment'],
        queryFn: () => checkoutAPI.getListPaymentMethod(),
    })

    const {control, handleSubmit} = useForm<ICheckoutParams>();

    const onFinish:SubmitHandler<ICheckoutParams> = async (data)=>{
        const {} = data;
        console.log(data)
    }


    return (
        <>
            <Head>
                <title>Checkout | DBRR store</title>
                <meta name="viewport" content="width=device-width, initial-scale=1"/>
                <link rel="icon" href="/favicon.ico"/>
            </Head>
            <CheckoutTemplate
                form={
                    <form onSubmit={handleSubmit(onFinish)}>
                        <CheckoutFormAddress data={listAddress?.data}/>
                        <CheckoutFormPayment data={listPaymentMethod?.data}/>
                    </form>
                }
                checkoutTotal={<CheckoutTotal
                    quoteDetail={quoteQuery?.data?.quote_detail}
                    subtotal={quoteQuery?.data?.total_price}
                    shippingCost={quoteQuery?.data?.total_shipping}
                    taxCost={quoteQuery?.data?.total_tax}
                    discount={quoteQuery?.data?.total_discount}
                    total={quoteQuery?.data?.total}
                />}
            />
        </>
    );
};

Checkout.getLayout = function getLayout(page: ReactElement) {
    return <HomeLayout>{page}</HomeLayout>;
};

export default Checkout;
