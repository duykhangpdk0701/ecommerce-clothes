import CheckoutTemplate from "@/components/templates/checkout";
import CheckoutFormAddress from "@/components/templates/checkout/form/address";
import CheckoutFormPayment from "@/components/templates/checkout/form/paymentDetail";
import CheckoutTotal from "@/components/templates/checkout/total";
import HomeLayout from "@/layout/HomeLayout";
import { ReactElement } from "react";
import { NextPageWithLayout } from "./_app";

const Checkout: NextPageWithLayout = () => {
  return (
    <>
      <CheckoutTemplate
        form={
          <form>
            <CheckoutFormAddress />
            <CheckoutFormPayment />
          </form>
        }
        checkoutTotal={<CheckoutTotal />}
      />
    </>
  );
};

Checkout.getLayout = function getLayout(page: ReactElement) {
  return <HomeLayout>{page}</HomeLayout>;
};

export default Checkout;
