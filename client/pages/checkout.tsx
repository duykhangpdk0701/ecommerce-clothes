import CheckoutTemplate from "@/components/templates/checkout";
import CheckoutFormAddress from "@/components/templates/checkout/form/address";
import CheckoutFormPayment from "@/components/templates/checkout/form/paymentDetail";
import CheckoutTotal from "@/components/templates/checkout/total";
import HomeLayout from "@/layout/HomeLayout";
import { ReactElement } from "react";
import { NextPageWithLayout } from "./_app";
import { useMutation, useQuery } from "react-query";
import cartAPI from "@/api/cartAPI";
import Head from "next/head";
import addressAPI from "@/api/address";
import checkoutAPI from "@/api/checkout";
import { SubmitHandler, useForm } from "react-hook-form";
import { useRouter } from "next/router";
import { useAppDispatch } from "@/hooks/redux";
import { setSnackbar } from "@/contexts/slices/snackbarSlice";

export interface ICheckoutParams {
  shipping: {
    id: number;
    name: string;
    cityId: number;
    districtId: number;
    wardId: number;
    address: string;
    phone: string;
  };
  comment: string;
  paymentMethod: number;
}

interface ICheckoutReq {
  quoteId: number;
  shippingName: string;
  shippingCityId: number;
  shippingDistrictId: number;
  shippingWardId: number;
  shippingAddress: string;
  shippingPhone: string;
  comment: string;
  paymentMethodId: number;
}

const Checkout: NextPageWithLayout = () => {
  const router = useRouter();
  const dispatch = useAppDispatch();
  const quoteQuery = useQuery({
    queryKey: ["quote"],
    queryFn: () => cartAPI.getQuoteByUser(),
  });

  const listAddress = useQuery({
    queryKey: ["address"],
    queryFn: () => addressAPI.getList(),
  });

  const listPaymentMethod = useQuery({
    queryKey: ["payment"],
    queryFn: () => checkoutAPI.getListPaymentMethod(),
  });

  const confirmCheckoutMutation = useMutation({
    mutationKey: ["check-out"],
    mutationFn: ({
      quoteId,
      shippingName,
      shippingCityId,
      shippingDistrictId,
      shippingWardId,
      shippingAddress,
      shippingPhone,
      comment,
      paymentMethodId,
    }: ICheckoutReq) =>
      checkoutAPI.confirmCheckout(
        quoteId,
        shippingName,
        shippingCityId,
        shippingDistrictId,
        shippingWardId,
        shippingAddress,
        shippingPhone,
        comment,
        paymentMethodId
      ),
    onSuccess: async () => {
      await router.push("/order");
      dispatch(
        setSnackbar({
          snackbarOpen: true,
          snackbarType: "success",
          snackbarMessage: "Create Item Color successfully",
        })
      );
    },
    onError: (error: any) => {
      dispatch(
        setSnackbar({
          snackbarOpen: true,
          snackbarType: "error",
          snackbarMessage: error.message,
        })
      );
    },
  });

  const { control, handleSubmit } = useForm<ICheckoutParams>();

  const onFinish: SubmitHandler<ICheckoutParams> = async (data) => {
    const { shipping, comment, paymentMethod } = data;
    if (quoteQuery.data)
      confirmCheckoutMutation.mutate({
        quoteId: quoteQuery.data.id,
        shippingName: shipping.name,
        shippingCityId: shipping.cityId,
        shippingDistrictId: shipping.districtId,
        shippingWardId: shipping.wardId,
        shippingAddress: shipping.address,
        shippingPhone: shipping.phone,
        comment,
        paymentMethodId: paymentMethod,
      });
  };

  return (
    <>
      <Head>
        <title>Checkout | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <CheckoutTemplate
        form={
          <form onSubmit={handleSubmit(onFinish)}>
            <CheckoutFormAddress control={control} data={listAddress?.data} />
            <CheckoutFormPayment
              control={control}
              data={listPaymentMethod?.data}
              loadingSubmit={confirmCheckoutMutation.isLoading}
            />
          </form>
        }
        checkoutTotal={
          <CheckoutTotal
            quoteDetail={quoteQuery?.data?.quote_detail}
            subtotal={quoteQuery?.data?.total_price}
            shippingCost={quoteQuery?.data?.total_shipping}
            taxCost={quoteQuery?.data?.total_tax}
            discount={quoteQuery?.data?.total_discount}
            total={quoteQuery?.data?.total}
          />
        }
      />
    </>
  );
};

Checkout.getLayout = function getLayout(page: ReactElement) {
  return <HomeLayout>{page}</HomeLayout>;
};

export default Checkout;
